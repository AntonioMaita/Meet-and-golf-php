<?php    
    session_start();

    require("includes/init.php");  

    include('filters/auth_filter.php');

   

    if(!empty($_GET['id'])){
        //recup info user db utilisant id
        $user= find_user_by_id($_GET['id']);

                

        if(!$user){
            redirect('index.php');

        }

    } else {
        redirect('profile.php?id='.get_session('user_id'));

    } 
  


    //requete Post
    if(isset($_POST['publish'])){    
        if(!empty($_POST['content'])){
            extract($_POST);
            $error=[];
            if(mb_strlen($content) < 3 || mb_strlen($content) > 140) {
    
                set_flash('Contenu invalide (Minimum 3 caractères | Maximum 140 caractères)', 'danger');
    
            } else {
    
                if(isset($_FILES['file_micropost_image']) AND !empty($_FILES['file_micropost_image']['name'])) {
                        $tailleMax = 2097152;
                            // 2mo  = 2097152
                            // 3mo  = 3145728
                            // 4mo  = 4194304
                            // 5mo  = 5242880
                            // 7mo  = 7340032
                            // 10mo = 10485760
                            // 12mo = 12582912
                            
                    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                    if($_FILES['file_micropost_image']['size'] <= $tailleMax) {
                        
                        $extensionUpload = strtolower(substr($_FILES['file_micropost_image']['name'], -3));
                                
                        if(in_array($extensionUpload, $extensionsValides)) {
                                        $randomfile = md5(uniqid(rand()));
                                        $chemin = "assets/images/".$randomfile.".".$extensionUpload;
                                        $resultat = move_uploaded_file($_FILES['file_micropost_image']['tmp_name'], $chemin);
                    
                                    if($resultat) {
    
                                                $q=$db->prepare('INSERT INTO microposts(content, img, user_id) VALUES (:content, :img, :user_id)');
                                                $q->execute([
                                                    'content' => $content,
                                                    'img' => $randomfile.".".$extensionUpload,
                                                    'user_id'=> get_session('user_id')
                                                ]);                                                       
                                    
                                        } else {
                                        
                                                $msg = "Erreur durant l'importation de votre photo";
                                        }
                        } else {
                           set_flash('Votre photo doit être au format jpg, jpeg, gif ou png', 'danger');
                            }     
    
                    } else {
                        set_flash('Votre Photo ne doit pas dépasser 2Mo', 'danger');
                    }
                
                } else {
                                
                    $updatecontent = $db->prepare('INSERT INTO microposts(content, user_id) VALUES (:content, :user_id)');
                    $updatecontent->execute(array(
                        'content' => $content ,           
                        'user_id'=> get_session('user_id')                                                
                    ));  
                    set_flash('Votre status a été mis à jour!'); 
                    header('Location: front_page.php?id='.get_session('user_id'));
 
                }
            }
        } 
    
    }


    
    

    
    


    //Requete MicroPost
    if(!empty($_GET['id'])){
        //recup info user db utilisant id
        // $user= find_user_by_id($_GET['id']);                

        if(!$user){
            redirect('index.php');

        } else {
            $q = $db->prepare("SELECT U.id user_id, U.pseudo u_pseudo, U.email, U.avatar, 
                                M.id m_id, M.content,M.img, M.created_at, M.like_count, M.comments_count
                                FROM users U, microposts M, friends_relationships F 
                                WHERE M.user_id = U.id 

                                AND

                                CASE
                                WHEN F.user_id1 = :user_id
                                THEN F.user_id2 = M.user_id

                                WHEN F.user_id2 = :user_id
                                THEN F.user_id1 = M.user_id

                                
                                END

                                AND F.status > 0
                                
                                ORDER BY M.created_at DESC
                                
                                ");
            $q->execute([
                'user_id' => $_GET['id'],
                
            ]);
            $microposts = $q->fetchAll(PDO::FETCH_OBJ);
            
            foreach ($microposts as $micropost){
                $microDate = $micropost->created_at;
                
            }
            
        }

        if(isset($_GET['id']) && !empty($_GET['id'])){         

       

            $q = $db->query('SELECT  U.id u_id, U.pseudo u_pseudo, U.avatar u_avatar, C.id c_id , C.comment, C.micropost_id , C.user_id c_user_id, M.id m_id , C.created_at c_created_at 
                                FROM comments_micropost C , microposts M, users U
                                WHERE  C.micropost_id = M.id AND C.user_id = U.id
                                ORDER BY c_created_at ASC
                                ');
            
                           
           
            $comments_post = $q->fetchAll(PDO::FETCH_OBJ);
        }
    

   

    $q = $db->prepare('SELECT pseudo FROM users WHERE id = ?');
    $q->execute([get_session('user_id')]);

    $users_session = $q->fetchAll(PDO::FETCH_OBJ);

    foreach ($users_session as $user_session){
        $user_sess = $user_session->pseudo;
    }

} else {

    redirect('front_page.php?id='.$_GET['id']);

}    
    
    require ('views/front_page.view.php');
