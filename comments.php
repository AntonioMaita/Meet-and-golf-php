
<?php

if(isset($_POST['comment'])){
    if(!empty($_POST['postcomment'])){
        extract($_POST);
        $error=[];

        $q=$db->prepare('INSERT INTO comments (comment, user_id) VALUES (:comment, :user_id)');
        $q->execute([
            'comment'=> $comment,
            'user_id'=> get_session('user_id')
        ]);

        set_flash('Votre status a été mis à jour!');
    } else {
        clear_input_data();
    }
}


// redirect('profile.php?id='.get_session('user_id'));
// include('views/comments.view.php');
?>