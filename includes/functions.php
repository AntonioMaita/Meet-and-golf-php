<?php 

//Sanitizer
if(!function_exists('e')){

    function e($string) {

        if($string){
            return htmlspecialchars($string);
            
        }
        
    }
}

//check_if_the_current_user_has_liked_the_micropost
if(!function_exists('check_if_the_current_user_has_liked_the_micropost')){
    function check_if_the_current_user_has_liked_the_micropost($micropost_id) {
        global $db;
        $q=$db->prepare('SELECT id FROM micropost_like WHERE user_id = ? 
                        AND micropost_id = ?');
        $q->execute([get_session('user_id'), $micropost_id]);

        $count = $q->rowCount();
        $q->closeCursor();
        return (bool)$count;
        
        
    }
}
//check_if_the_current_user_has_liked_the_POST
if(!function_exists('check_if_the_current_user_has_liked_the_post')){
    function check_if_the_current_user_has_liked_the_post($post_id) {
        global $db;
        $q=$db->prepare('SELECT id FROM post_like WHERE user_id = ? 
                        AND post_id = ?');
        $q->execute([get_session('user_id'), $post_id]);

        $count = $q->rowCount();
        $q->closeCursor();
        return (bool)$count;
        
        
    }
}


// System de Like
    //return get like count of a given micropost
    if(!function_exists('get_like_count')){

        function get_like_count($micropost_id) {
            global $db;
            $q=$db->prepare('SELECT like_count FROM microposts WHERE id = ?');
            $q->execute([$micropost_id]);

            $data = $q->fetch(PDO::FETCH_OBJ);
            return intval($data->like_count);

            
            
        }
    }

   
    //return  likers of a given micropost
    if(!function_exists('get_likers')){

        function get_likers($micropost_id) {
            global $db;
            $q=$db->prepare('SELECT users.id, users.pseudo FROM users
                            LEFT JOIN micropost_like
                            ON users.id = micropost_like.user_id
                            WHERE micropost_id = ?
                            ORDER BY micropost_like.id DESC
                            LIMIT 3');
            $q->execute([$micropost_id]);

            return $q->fetchAll(PDO::FETCH_OBJ);       
            
            
        }
    }

    

    //display likers of a given micropost
    if(!function_exists('get_likers_text')){

        function get_likers_text($micropost_id) {
            $like_count = get_like_count($micropost_id);
            $likers = get_likers($micropost_id);
            
            
            $output = '';

            if($like_count > 0) {
                $remaining_like_count = $like_count -3;
                $itself_like = check_if_the_current_user_has_liked_the_micropost($micropost_id);      
                
                
                foreach($likers as $liker){
                    if(get_session('user_id') != $liker->id){
                        $output .='<a class="link" href="profile.php?id='.$liker->id.'">'.$liker->pseudo.'</a>, ';
                    }
                }

                $output = $itself_like ? '<i class="fas fa-thumbs-up text-primary"> </i> Vous, ' . $output : $output;
                
                if(($like_count == 2 || $like_count == 3) && $output != ""){
                    $output = trim($output, ', ');
                    $arr = explode(',', $output);
                    $lastItem = array_pop($arr);
                    $output = implode(', ', $arr);
                    $output .= ' et ' . $lastItem;
                }
                
                $output = trim($output, ', ');

                
                switch($like_count){
                    case 1:
                        $output .=  $itself_like ? ' aimez cela.' 
                                                : ' aime cela.';
                    break;

                    case 2:
                    case 3:
                        $output .= $itself_like ? ' aimez cela.' 
                                                : ' aiment cela.';
                    break;
                    
                    case 4:
                        $output .= $itself_like ? 'et 1 autre personne aimez cela.' 
                                                : ' et 1 autre personne aiment cela.';
                    break;

                    default:
                    $output .= $itself_like ? ' et '. $remaining_like_count .' autres personnes aimez cela.' 
                                             : ' et ' . $remaining_like_count .' autres personnes aiment cela.';
                    break;

                }
                            
            }
            return $output;
        }

    }

     //return get like count of a given POST
     if(!function_exists('get_like_count_post')){

        function get_like_count_post($post_id) {
            global $db;
            $q=$db->prepare('SELECT like_count FROM post WHERE id = ?');
            $q->execute([$post_id]);

            $data = $q->fetch(PDO::FETCH_OBJ);
            return intval($data->like_count);

            
            
        }
    }

    //return  likers of a given POST
    if(!function_exists('get_likers_post')){

        function get_likers_post($post_id) {
            global $db;
            $q=$db->prepare('SELECT users.id, users.pseudo FROM users
                            LEFT JOIN post_like
                            ON users.id = post_like.user_id
                            WHERE post_id = ?
                            ORDER BY post_like.id DESC
                            LIMIT 3');
            $q->execute([$post_id]);

            return $q->fetchAll(PDO::FETCH_OBJ);       
            
            
        }
    }

    //display likers of a given POST
    if(!function_exists('get_likers_text_post')){

        function get_likers_text_post($post_id) {
            $like_count = get_like_count_post($post_id);
            $likers_post = get_likers_post($post_id);
            

            $output = '';
            if($like_count > 0) {
                $remaining_like_count = $like_count -3; 
                $itself_like_post =check_if_the_current_user_has_liked_the_post($post_id);     
                
                
                foreach($likers_post as $liker_post){
                    if(get_session('user_id') != $liker_post->id){
                        $output .='<a class="link" href="front_page.php?id='.$liker_post->id.'">'.$liker_post->pseudo.'</a>, ';
                    }
                }

                $output = $itself_like_post ? '<i class="fas fa-thumbs-up text-primary"> </i> Vous, ' . $output : $output;

                if(($like_count == 2 || $like_count == 3) && $output != ""){
                    $output = trim($output, ', ');
                    $arr = explode(',', $output);
                    $lastItem = array_pop($arr);
                    $output = implode(', ', $arr);
                    $output .= ' et ' . $lastItem;
                }

                $output = trim($output, ', ');
                
                switch($like_count){
                    case 1:
                        $output .=  $itself_like_post ? ' aimez cela.' 
                                                : ' aime cela.';
                    break;

                    case 2:
                                            
                    case 3:
                        $output .= $itself_like_post ? ' aimez cela.' 
                                                : ' aiment cela.';
                    break;
                    
                    case 4:
                        $output .= $itself_like_post ? 'et 1 autre personne aimez cela.' 
                                                : ' et 1 autre personne aiment cela.';
                    break;

                    default:
                    $output .= $itself_like_post ? ' et '. $remaining_like_count .' autres personnes aimez cela.' 
                                             : ' et ' . $remaining_like_count .' autres personnes aiment cela.';
                    break;

                }

            }
            return $output;
            
        }
    }
//fin Systeme de Like



//user_has_already_liked_the_micropost
if(!function_exists('user_has_already_liked_the_micropost')){

    function user_has_already_liked_the_micropost($micropost_id) {
        global $db;
        
        $q = $db->prepare('SELECT id FROM micropost_like
                            WHERE user_id = :user_id AND micropost_id = :micropost_id');
        $q->execute([
        'user_id' => get_session('user_id'),
        'micropost_id' => $micropost_id
        
        ]);

        return (bool) $q->rowCount();        
        
    }
}

//user_has_already_liked_the_post
if(!function_exists('user_has_already_liked_the_post')){

    function user_has_already_liked_the_post($post_id) {
        global $db;

        $q = $db->prepare('SELECT id FROM post_like
                            WHERE user_id = :user_id AND post_id = :post_id');
        $q->execute([
            'user_id' => get_session('user_id'),
            'post_id' => $post_id

        ]);

        return (bool) $q->rowCount();       
        
        
    }
}


//checks if a friend request has already be sent
if(!function_exists('if_a_friend_request_has_already_be_sent')){

    function if_a_friend_request_has_already_be_sent($id1, $id2) {
        
        global $db;

        $q = $db->prepare("SELECT status FROM friends_relationships 
                            WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
                            OR (user_id1 = :user_id2 AND user_id2 = :user_id1 )");
        $q->execute([
            'user_id1' => $id1,
            'user_id2' => $id2
        ]);

        $count = $q->rowCount();
        $q->closeCursor();

        return (bool)$count;
                
    }
}


//checks if the cxurrent user is friend with the second
if(!function_exists('current_user_is_friend_with')){

    function current_user_is_friend_with($second_user_id) {
        
        global $db;

        $q = $db->prepare("SELECT status FROM friends_relationships 
                            WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
                            OR (user_id1 = :user_id2 AND user_id2 = :user_id1 ) AND status = '1'");
        $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $second_user_id
        ]);
        

        $count = $q->rowCount();
        $q->closeCursor();

        return (bool)$count;
                
    }
}


//friends count
if(!function_exists('friends_count')){

    function friends_count($id) {
        global $db;


        $q = $db->prepare("SELECT status FROM friends_relationships WHERE (user_id1 = :user OR user_id2 = :user)
                            AND status = '1' ");
        $q->execute([
            'user' => $id
        ]);

        $count = $q->rowCount();
        $q->closeCursor();

        return $count;
       
        
    }
}


//check if a friend request has already been sent
if(!function_exists('relation_link_to_display')){
    
    function relation_link_to_display($id) {
        
        global $db;
        
        $q = $db->prepare('SELECT user_id1, user_id2, status FROM friends_relationships 
                    WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
                    OR (user_id1 = :user_id2 AND user_id2 = :user_id1 )');
                    $q->execute([
                        'user_id1' => get_session('user_id'),
                        'user_id2' => $id
                    ]);
                    
                    $data = $q->fetch(PDO::FETCH_OBJ);
                    $q->closeCursor();
                    

                    if($data) {
                    
                    if($data->user_id2 == get_session('user_id') && $data->status == '0'){
                        //Lien pour accepter ou refuser la demande d'amitié
                        return "accept_reject_relation_link";

                    } elseif($data->user_id1 == get_session('user_id') && $data->status == '0') {
                        //msg pour dire que la demande a deja ete envoye.Lien pour annuler la demande
                        return "cancel_relation_link";

                    }elseif(($data->user_id1 == get_session('user_id') || $data->user_id1 == $id) && $data->status == '1') {
                        //lien pour supprimer la relation d'amitie
                        return "delete_relation_link";

                    }else{
                        // un lien pour ajouter la personne comme ami
                        return "add_relation_link";
                    }      
                                       
                } else{
                    // un lien pour ajouter la personne comme ami
                    return "add_relation_link";
                }           
                   
    }
        
}



//permet de rendre les liens d'une chaine de caractere cliquable
if(!function_exists('replace_links')){

    function replace_links($texte) {
        $regex_url= "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";

       return preg_replace($regex_url, "<a href=\"$0\" target=\"\_blank\">$0</a>", $texte);
       
       
                
    }


    
}
//cell Count , retourne le nbr d'enregistrement trouve respectant une condition
if(!function_exists('cell_count')){

    function cell_count($table, $field_name, $field_value) {
        global $db;

        $q=$db->prepare("SELECT * FROM $table WHERE $field_name= ?");
        $q->execute([$field_value]);

        return $q->rowCount();
                    
                
    }
}

//Remenber me
if(!function_exists('remember_me')){    

    function remember_me($user_id) {  
        global $db;                 
        // Generer le token aléatoire
        $token = openssl_random_pseudo_bytes(24);

        

        //generer le selecteur aléatoire
        // selecteur unique
        do {
            $selector = openssl_random_pseudo_bytes(9);

        } while(cell_count('auth_tokens','selector', $selector) > 0);
        
        
        //sauver sur la DB (user_id, selector, expires(14jours), token(hashed))
        $q = $db->prepare('INSERT INTO auth_tokens(expires, selector, user_id, token)
                        VALUES (DATE_ADD(NOW(), INTERVAL 14 DAY), :selector, :user_id,
                        :token)');
        $q->execute([
            
            'selector' => $selector,
            'user_id'  => $user_id,
            'token'    => hash('sha256',$token)
        ]);
        //creation cookie 'auth' (14 jours expires) httpOnly => true
        //contenu: base64_encode(selector).':'.base64_encode(token)           
         setcookie('auth',base64_encode($selector).':'.base64_encode($token) 
            ,time()+1209600,null, null, false, true);
    }
}

//auto login
if(!function_exists('auto_login')){

    function auto_login() {    
        global $db;               
        //verifier si cookie existe 'auth'
        if(!empty($_COOKIE['auth'])){
            $split = explode(':', $_COOKIE['auth']);

            if(count($split) !==2) {
                return false;
            }
            //recupere via cookie selector et token 
            $selector = $split[0];
            $token = $split[1];

            $q=$db->prepare('SELECT auth_tokens.token, auth_tokens.user_id,
                             users.id, users.pseudo, users.avatar, users.email                              
                            FROM auth_tokens 
                            LEFT JOIN users
                            ON auth_tokens.user_id = users.id
                            WHERE selector = ? AND expires >= CURDATE()');
            $q->execute([base64_decode($selector)]);

            $data = $q->fetch(PDO::FETCH_OBJ);
            if($data){
                if(hash_equals($data->token, hash('sha256',base64_decode($token)))){
                       
                    session_regenerate_id(true);

                    $_SESSION['user_id'] = $data->id;
                    $_SESSION['user_pseudo'] = $data->pseudo;
                    $_SESSION['user_avatar'] = $data->avatar;
                    $_SESSION['user_email'] = $data->email;
                    
                    return true; 
                }
            }
            
           
        }
        return false;        

    }
}


if(!function_exists('redirect_intent_or')){

    function redirect_intent_or($default_url) {

        if($_SESSION['forwarding_url']){
            
            $url = $_SESSION['forwarding_url'];
            $_SESSION['forwarding_url'] = null ;
            
        }else {
            $url = $default_url ;
        }

        
        redirect($url);
        
    }
}


//get a session value by key 
if(!function_exists('get_session')){

    function get_session($key) {

        if($key){
            return !empty($_SESSION[$key]) ? e($_SESSION[$key]) : null;
            
        }
        
    }
}
//check if a user is connected 

if(!function_exists('is_logged_in')){

    function is_logged_in() {

       return isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo']);
        
    }
}

//hash password with blowfish algorithm
if(!function_exists('bcrypt_hash_password')){

    function bcrypt_hash_password($value, $options = array()) {
        $cost = isset($options['rounds']) ? $options['rounds'] : 10;
        $hash = password_hash($value, PASSWORD_BCRYPT, array('cost' => $cost));

        if($hash === false) {
            throw new Exception("Bcrypt hashing n'est pas supporte.");
        }
        return $hash;
        
        
    }
}

//verify password 

if(!function_exists('bcrypt_verify_password')){
    function bcrypt_verify_password($value, $hashedValue) {
        return password_verify($value, $hashedValue);
    }
}


//find user by id

if(!function_exists('find_user_by_id')){

    function find_user_by_id($id) {

        global $db;

        $q = $db->prepare('SELECT id, name, pseudo, email, sex, adress, city, country, club, bio, created_at, avatar FROM users WHERE id = ?');
        $q->execute([$id]);

        $data = current($q->fetchAll(PDO::FETCH_OBJ));

        $q->closeCursor();
        return $data;

        
        
    }
}

if(!function_exists('find_post')){

    function find_post($id) {

        global $db;

        $q = $db->prepare('SELECT * FROM post');
        $q->execute([$id]);

        $data = $q->fetchAll(PDO::FETCH_OBJ);
        

        
        $q->closeCursor();
        return $data;

        
        
    }
}




if(!function_exists('not_empty')){

    function not_empty($fields = []) {

        if(count($fields) != 0) {
            foreach($fields as $field) {
                if(empty($_POST[$field]) || trim($_POST[$field]) == "") {
                    return false;
                }
            }

            return true;
        }


    }


}

if(!function_exists('is_already_in_use')){
    function is_already_in_use($field, $value, $table) {

        global $db;

        $q = $db->prepare("SELECT id FROM $table WHERE $field = ? ");
        $q->execute([$value]);

        $count = $q->rowCount();
        $q->closeCursor();

        return $count;

    }
}


if(!function_exists('set_flash')) {
    function set_flash($message, $type ='info'){
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;



    }
}

if(!function_exists('redirect')) {
    function redirect($page){
        header('Location: ' . $page);
        exit();
    }
}

if(!function_exists('save_input_data')) {
    function save_input_data(){
       foreach($_POST as $key => $value){

        if(strpos($key, 'password') === false) {

            $_SESSION['input'][$key] = $value;

        }
          
       }
    }
}

if(!function_exists('get_input')) {
    function get_input($key){

        return !empty($_SESSION['input'][$key]) ? e($_SESSION['input'][$key]) : null;           
          
       
    }
}

if(!function_exists('clear_input_data')) {
    function clear_input_data(){

        if(isset($_SESSION['input'])) {
            $_SESSION['input'] = [];
        }     
       
    }
}
//Gere l'etat actif de nos differents liens
if(!function_exists('set_active')){

    function set_active($file, $class='active') {
        $page = (explode('/', $_SERVER['SCRIPT_NAME']));

        if($page == $file.'.php') {
            return $class;
        } else {
            return "";
        }

                        
        
    }
}







