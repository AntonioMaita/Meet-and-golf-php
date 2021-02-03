<?php 



session_start();
require '../config/database.php';
require '../includes/functions.php';
extract($_POST);


if($action == 'likeMicropostPost'){

    if(!user_has_already_liked_the_micropost($micropostPost_id)){

           

        $q = $db->prepare('INSERT INTO micropost_like(user_id, micropost_id)
                            VALUES(:user_id, :micropost_id)');
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropostPost_id

        ]);
        $q = $db->prepare('UPDATE microposts SET like_count = like_count +1 
                            WHERE id = ?');
        $q->execute([$micropostPost_id]);
    
}
}else {
    if(user_has_already_liked_the_micropost($micropostPost_id)){

        $q = $db->prepare('DELETE FROM micropost_like WHERE user_id = :user_id 
                        AND micropost_id = :micropost_id');
                            
        $q->execute([
            'user_id' => get_session('user_id'),
            'micropost_id' => $micropostPost_id

        ]);
        $q = $db->prepare('UPDATE microposts SET like_count = like_count -1 
                            WHERE id = ?');
        $q->execute([$micropostPost_id]);
    
}
};
echo get_likers_text($micropostPost_id);