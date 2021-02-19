<?php

session_start();

    require("includes/init.php");
    include('filters/auth_filter.php');


    if(!empty($_GET['id'])){
        $q = $db->prepare('SELECT user_id, id FROM microposts WHERE id = :id');
        $q->execute([
        'id' => $_GET['id']
        ]);

        $data = $q->fetch(PDO::FETCH_OBJ);
        $user_id = $data->user_id;
     }

     $q = $db->prepare('SELECT micropost_id, id, user_id FROM comments_micropost 
                            WHERE  id = ?
                            ');
        $q->execute([
            $_GET['id']
        ]);
                       
       
        $comments = $q->fetchAll(PDO::FETCH_OBJ);

       

     foreach($comments as $comment){

        
            
            
          
           $q = $db->prepare('UPDATE microposts SET comments_count = comments_count -1
                                WHERE id = ?');
            $q->execute([$comment->micropost_id]);
           
            $q = $db->prepare('DELETE FROM comments_micropost WHERE id = :id');
                $q->execute([
                'id' => $_GET['id']
            ]);           
                  

            set_flash("Votre commentaire a été supprimée avec succès!");
       
        
    } 
        
    
 

        
    

 redirect('front_page.php?id='.get_session('user_id'));
 
 ?>