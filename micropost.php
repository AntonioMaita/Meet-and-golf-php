<?php 
session_start();


include('filters/auth_filter.php');
require('config/database.php');
require('includes/functions.php');

if(isset($_POST['publish'])){
    if(!empty($_POST['content'])){
        extract($_POST);

        $q=$db->prepare('INSERT INTO microposts(content, user_id, created_at) VALUES (:content, :user_id, NOW())');
        $q->execute([
            'content'=> $content,
            'user_id'=> get_session('user_id')
        ]);

        set_flash('Votre status a été mis à jour!');
    }
}
redirect('profile.php?id='.get_session('user_id'));
