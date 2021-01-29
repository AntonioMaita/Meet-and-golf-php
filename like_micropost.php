<?php
    session_start();

    require("includes/init.php");
    include('filters/auth_filter.php');


    if(!empty($_GET['id'])){
        $q = $db->prepare('SELECT id FROM micropost_like
                            WHERE user_id = :user_id AND micropost_id = :micropost_id');
        $q->execute([
        'user_id' => get_session('user_id'),
        'micropost_id' => $_GET['id']
        
        ]);

        $count = $q->rowCount();

        if($count == 0) {

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

 redirect('profile.php?id='.get_session('user_id'));