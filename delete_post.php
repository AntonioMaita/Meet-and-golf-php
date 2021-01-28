<?php
    session_start();

    require("includes/init.php");
    include('filters/auth_filter.php');
    


    if(!empty($_GET['id'])){
        $q = $db->prepare('SELECT users_id FROM post WHERE id = :id');
        $q->execute([
        'id' => $_GET['id']
        ]);

        $data = $q->fetch(PDO::FETCH_OBJ);
        $user_id = $data->users_id;
       

        if($user_id == get_session('user_id')){
            $q = $db->prepare('DELETE FROM post WHERE id = :id');
            $q->execute([
            'id' => $_GET['id']
            ]);
            set_flash("Votre publication a été supprimée avec succès!");
        }
    
        
    }

 redirect('front_page.php?id='.get_session('user_id'));