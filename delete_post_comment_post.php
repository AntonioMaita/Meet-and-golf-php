<?php

session_start();

    require("includes/init.php");
    include('filters/auth_filter.php');


    if(!empty($_GET['id'])){
        $q = $db->prepare('SELECT users_id, id FROM post WHERE id = :id');
        $q->execute([
        'id' => $_GET['id']
        ]);

        $data = $q->fetch(PDO::FETCH_OBJ);
        $user_id = $data->users_id;
     }

     $q = $db->prepare('SELECT post_id, id, user_id FROM comments_post 
                            WHERE  id = ?
                            ');
        $q->execute([
            $_GET['id']
        ]);
                       
       
        $comments = $q->fetchAll(PDO::FETCH_OBJ);

       

     foreach($comments as $comment){

        if($comment->user_id == get_session('user_id')){
            
            
          
           $q = $db->prepare('UPDATE post SET comments_count = comments_count -1
                                WHERE id = :id');
            $q->execute(['id' => $comment->post_id]);
           
            $q = $db->prepare('DELETE FROM comments_post WHERE id = :id');
                $q->execute([
                'id' => $comment->id
            ]);           
                  

            set_flash("Votre commentaire a été supprimée avec succès!");
        }       
        
    } 
        
    
 

        
    

 redirect('front_page.php?id='.get_session('user_id'));
 
 ?>