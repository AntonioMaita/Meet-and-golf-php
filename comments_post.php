<?php
session_start();

require("includes/init.php");  
include('filters/auth_filter.php');

if(isset($_POST['postcomment_micropost'])){
    if(!empty($_POST['comment_micropost'])){
        extract($_POST);
                     
        

                    $q=$db->prepare('INSERT INTO comments_micropost (comment, user_id, micropost_id) VALUES (:comment, :user_id, :micropost_id)');
                    $q->execute([
                        'comment'=> $comment_micropost,
                        'user_id'=> $_SESSION['user_id'],
                        'micropost_id' =>  $_GET['id']
                    ]);

                    $q = $db->prepare('UPDATE microposts SET comments_count = comments_count +1 
                                    WHERE id = ?');
                    $q->execute([$_GET['id']]);
                
                      
            
                set_flash('Commentaires mis à jour!');
    } else {
        clear_input_data();
    }
}

if(isset($_POST['postcomment_post'])){
    if(!empty($_POST['comment_post'])){
        extract($_POST);
                     
        

                    $q=$db->prepare('INSERT INTO comments_post (comment, user_id, post_id) VALUES (:comment, :user_id, :post_id)');
                    $q->execute([
                        'comment'=> $comment_post,
                        'user_id'=> $_SESSION['user_id'],
                        'post_id' =>  $_GET['id']
                    ]);

                    $q = $db->prepare('UPDATE post SET comments_count = comments_count +1 
                                    WHERE id = :id');
                    $q->execute([ 'id' => $_GET['id']]);
                
                      
            
                set_flash('Commentaires mis à jour!');
    } else {
        clear_input_data();
    }
}



redirect('front_page.php?id='.get_session('user_id').'#post'.$_GET['id']);


?>