<?php    
    session_start();

    require("./includes/init.php");  

    include('filters/auth_filter.php');
    
    header("Cache-Control: no-cache, must-revalidate");


    if(!empty($_GET['id'])){
        //recup info user db utilisant id
        $user= find_user_by_id($_GET['id']);

                

        if(!$user){
            redirect('index.php');

        } else {
            $q = $db->prepare('SELECT id, content, created_at, user_id, like_count, comments_count, img FROM microposts
                                WHERE user_id = :user_id
                                ORDER BY created_at DESC');
            $q->execute([
                'user_id' => e($_GET['id'])
            ]);
            $microposts = $q->fetchAll(PDO::FETCH_OBJ);
            
        }

    } else {
        redirect('profile.php?id='.get_session('user_id'));

    }

    if(isset($_GET['id']) && !empty($_GET['id'])){         

       

        $q = $db->query('SELECT  U.id u_id, U.pseudo u_pseudo, U.avatar u_avatar, C.id c_id , C.comment, C.micropost_id , C.user_id c_user_id, M.id m_id , C.created_at c_created_at 
                            FROM comments_micropost C , microposts M, users U
                            WHERE  C.micropost_id = M.id AND C.user_id = U.id
                            ORDER BY c_created_at ASC
                            ');
        
                       
       
        $comments = $q->fetchAll(PDO::FETCH_OBJ);    
        
      
               
    

    } else {
    redirect('profile.php?id='.get_session('user_id'));

    }

     

        
    
  require('views/profile.view.php');