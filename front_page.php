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

        if (not_empty(['post'])) {


            extract($_POST);

            $error=[];

            $q= $db->prepare('INSERT INTO post (post, users_id) VALUE (:post, :users_id)');

                $q->execute([
                    'post' => $post,
                    'users_id' => get_session('user_id')
                    
                    
                    ]);
                
                set_flash("Publication envoyé");
                header('Location: front_page.php?id='.get_session('user_id'));
        }


    }else {
        clear_input_data();
    }

    
    if(!empty($_GET['id'])){        
        
        $q = $db->prepare("SELECT U.*, P.id as p_id, P.users_id, P.post, P.date, P.like_count, F.*
                            
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
                                M.id m_id, M.content, M.created_at, M.like_count, M.comments_count
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
            
            
        }

        if(isset($_GET['id']) && !empty($_GET['id'])){         

       

            $q = $db->query('SELECT  U.id u_id, U.pseudo u_pseudo, C.id c_id , C.comment, C.micropost_id , C.user_id c_user_id, M.id m_id , C.created_at c_created_at 
                                FROM comments_micropost C , microposts M, users U
                                WHERE  C.micropost_id = M.id AND C.user_id = U.id
                                ');
            
                           
           
            $comments_post = $q->fetchAll(PDO::FETCH_OBJ);
        }
    } else {
        redirect('front_page.php?id='.get_session('user_id'));

    }
    
    
    require ('views/front_page.view.php');
