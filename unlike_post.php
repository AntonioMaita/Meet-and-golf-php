<?php
    session_start();

    require("includes/init.php");
    include('filters/auth_filter.php');


    if(!empty($_GET['id'])){

        if(user_has_already_liked_the_post($_GET['id'])){

            $q = $db->prepare('DELETE FROM post_like WHERE user_id =:user_id 
                                AND post_id = :post_id');
                                
            $q->execute([
            'user_id' => get_session('user_id'),
            'post_id' => $_GET['id']
            
            ]);

            $q = $db->prepare('UPDATE post SET like_count = like_count -1 
                                WHERE id = ?');
            $q->execute([$_GET['id']]);

        }    
        
    
        
    }
    
    
        redirect('front_page.php?id='.get_session('user_id').'#post'.$_GET['id']); 
        