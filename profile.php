<?php    
    session_start();

    require("includes/init.php");  

    include('filters/auth_filter.php');
    
    header("Cache-Control: no-cache, must-revalidate");


    if(!empty($_GET['id'])){
        //recup info user db utilisant id
        $user= find_user_by_id($_GET['id']);

                

        if(!$user){
            redirect('index.php');

        } else {
            $q = $db->prepare('SELECT id, content, created_at, user_id, like_count FROM microposts
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

    if(!empty($_GET['id'])){         

    
        $q = $db->prepare('SELECT id, comment, created_at, user_id, micropost_id FROM comments_micropost
                            WHERE user_id = :user_id AND micropost_id = :micropost_id
                            ORDER BY created_at DESC');
        $q->execute([
            'user_id' => $_GET['id'],
            'micropost_id'=> $_GET['id']            
        ]);
        $comments = $q->fetchAll(PDO::FETCH_OBJ);
        
    

} else {
    redirect('profile.php?id='.get_session('user_id'));

}

        
    
  require('views/profile.view.php');