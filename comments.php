
<?php
session_start();

require("includes/init.php");  
include('filters/auth_filter.php');

if(isset($_POST['postcomment'])){
    if(!empty($_POST['comment'])){
        extract($_POST);
        

        $q=$db->prepare('INSERT INTO comments_micropost (comment, user_id, micropost_id) VALUES (:comment, :user_id, :micropost_id)');
        $q->execute([
            'comment'=> $comment,
            'user_id'=> get_session('user_id'),
            'micropost_id' => get_session('user_id')
        ]);

        set_flash('Commentaires mis à jour!');
    } else {
        clear_input_data();
    }
}


redirect('profile.php?id='.get_session('user_id'));



?>