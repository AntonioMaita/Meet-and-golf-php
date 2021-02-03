<?php 



session_start();
require '../config/database.php';
require '../includes/functions.php';
extract($_POST);


if($action == 'likePost'){

    if(!user_has_already_liked_the_post($post_id)){

        $q = $db->prepare('INSERT INTO post_like(user_id, post_id)
                            VALUES(:user_id, :post_id )');
        $q->execute([
        'user_id' => get_session('user_id'),
        'post_id' => $post_id
        
        ]);

        $q = $db->prepare('UPDATE post SET like_count = like_count +1 
                            WHERE id = ?');
        $q->execute([$post_id]);

    }

}else {
    if(user_has_already_liked_the_post($post_id)){

        $q = $db->prepare('DELETE FROM post_like WHERE user_id =:user_id 
                            AND post_id = :post_id');
                            
        $q->execute([
        'user_id' => get_session('user_id'),
        'post_id' => $post_id
        
        ]);

        $q = $db->prepare('UPDATE post SET like_count = like_count -1 
                            WHERE id = ?');
        $q->execute([$post_id]);

    }

};
echo get_likers_text_post($post_id); 
