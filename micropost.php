<?php 
session_start();

require("includes/init.php");  
include('filters/auth_filter.php');


if(isset($_POST['publish'])){
    if(!empty($_POST['content'])){
        extract($_POST);

        if(mb_strlen($content) <3 || mb_strlen($content) > 140) {
            set_flash('Contenu invalide (Minimum 3 caractères | Maximum 140 caractères)', 'danger');

        } else {

            $q=$db->prepare('INSERT INTO microposts(content, user_id, created_at) VALUES (:content, :user_id, NOW())');
            $q->execute([
                'content'=> $content,
                'user_id'=> get_session('user_id')
            ]);

            set_flash('Votre status a été mis à jour!');
   
        set_flash('Aucun message pour le moment');
            }
    }

}


redirect('profile.php?id='.get_session('user_id'));
