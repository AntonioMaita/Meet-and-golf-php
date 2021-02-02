<?php
    session_start();

    require("includes/init.php");
    include('filters/auth_filter.php');


    if(!empty($_GET['id'])){
        if(!user_has_already_liked_the_micropost($_GET['id'])){

           

                $q = $db->prepare('INSERT INTO micropost_like(user_id, micropost_id)
                                    VALUES(:user_id, :micropost_id)');
                $q->execute([
                    'user_id' => get_session('user_id'),
                    'micropost_id' => $_GET['id']

                ]);
                $q = $db->prepare('UPDATE microposts SET like_count = like_count +1 
                                    WHERE id = ?');
                $q->execute([$_GET['id']]);
            
        }   
        
    
        
    }
    redirect('front_page.php?id='.get_session('user_id').'#micropost'.$_GET['id']); 