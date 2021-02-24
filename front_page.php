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
    if(isset($_POST['postmessage'])) {       

        if (!empty($_POST['post'])) {
            extract($_POST);

            $error=[];
            if(mb_strlen($post) <3 || mb_strlen($post) > 140) {
                set_flash('Contenu invalide (Minimum 3 caractères | Maximum 140 caractères)', 'danger');
    
            } else {
    
                if(isset($_FILES['file_post_image']) AND !empty($_FILES['file_post_image']['name'])) {
                        $tailleMax = 2097152;
                            // 2mo  = 2097152
                            // 3mo  = 3145728
                            // 4mo  = 4194304
                            // 5mo  = 5242880
                            // 7mo  = 7340032
                            // 10mo = 10485760
                            // 12mo = 12582912
                            
                    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                    if($_FILES['file_post_image']['size'] <= $tailleMax) {
                        
                        $extensionUpload = strtolower(substr($_FILES['file_post_image']['name'], -3));
                                
                        if(in_array($extensionUpload, $extensionsValides)) {
                                        $chemin = "assets/images/".$_FILES['file_post_image']['name'].".".$extensionUpload;
                                        $resultat = move_uploaded_file($_FILES['file_post_image']['tmp_name'], $chemin);
                    
                                    if($resultat) {
    
                                                $q=$db->prepare('INSERT INTO post(post, img, users_id) VALUES (:post, :img, :users_id)');
                                                $q->execute([
                                                    'post' => $post,
                                                    'img' => $_FILES['file_post_image']['name'].".".$extensionUpload,
                                                    'users_id'=> get_session('user_id')
                                                ]);                                                       
                                    
                                        } else {
                                        
                                                $msg = "Erreur durant l'importation de votre photo de profil";
                                        }
                        } else {
                            $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                            }     
    
                    }
                
                } else {

                    $q= $db->prepare('INSERT INTO post (post, users_id) VALUE (:post, :users_id)');

                    $q->execute([
                        'post' => $post,
                        'users_id' => get_session('user_id')                   
                        
                        ]);
                    
                    set_flash("Publication envoyé");
                    header('Location: front_page.php?id='.get_session('user_id'));
                }
        }
    }


    }else {
        clear_input_data();
    }

    
    if(!empty($_GET['id'])){        
        
        $q = $db->prepare("SELECT U.*, P.id as p_id, P.users_id, P.post,P.img, P.date, P.like_count, P.comments_count, F.*
                            
                            FROM users U, friends_relationships F , post P 
                            WHERE P.users_id = U.id 

                            AND

                            CASE
                            WHEN F.user_id1 = :id
                            THEN F.user_id2 = P.users_id

                            WHEN F.user_id2 = :id
                            THEN F.user_id1 = P.users_id

                            
                            END

                            AND F.status > 0
                            
                            ORDER BY P.date DESC
                            
                            ");
        $q->execute([
            'id' => $_GET['id']
            
        ]);

        $users = $q->fetchAll(PDO::FETCH_OBJ);
        
        foreach ($users as $user) {
            $postDate = $user->date;
        }
               

    } else {
        redirect('front_page.php');

    }


    //Requete MicroPost
    if(!empty($_GET['id'])){
        //recup info user db utilisant id
        // $user= find_user_by_id($_GET['id']);                

        if(!$user){
            redirect('index.php');

        } else {
            $q = $db->prepare("SELECT U.id user_id, U.pseudo, U.email, U.avatar, 
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
    

    if(isset($_GET['id']) && !empty($_GET['id'])){         

       

        $q = $db->query('SELECT  U.id u_id, U.pseudo u_pseudo, U.avatar u_avatar, C.id c_id , C.comment, C.post_id c_post_id, C.user_id c_user_id, P.id p_id , C.created_at c_created_at 
                            FROM comments_post C , post P, users U
                            WHERE  C.post_id = P.id AND C.user_id = U.id
                            ORDER BY c_created_at ASC
                            ');       
                       
       
        $comments_post_post = $q->fetchAll(PDO::FETCH_OBJ);
    }
} else {
    redirect('front_page.php?id='.$_GET['id']);

}    
    
    require ('views/front_page.view.php');
