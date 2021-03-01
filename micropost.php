<?php 
session_start();

require("includes/init.php");  
include('filters/auth_filter.php');


if(isset($_POST['publish'])){    
    if(!empty($_POST['content'])){
        extract($_POST);
        $error=[];
        if(mb_strlen($content) < 3 || mb_strlen($content) > 140) {

            set_flash('Contenu invalide (Minimum 3 caractères | Maximum 140 caractères)', 'danger');

        } else {

            if(isset($_FILES['file_micropost_image']) AND !empty($_FILES['file_micropost_image']['name'])) {
                    $tailleMax = 2097152;
                        // 2mo  = 2097152
                        // 3mo  = 3145728
                        // 4mo  = 4194304
                        // 5mo  = 5242880
                        // 7mo  = 7340032
                        // 10mo = 10485760
                        // 12mo = 12582912
                        
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                if($_FILES['file_micropost_image']['size'] <= $tailleMax) {
                    
                    $extensionUpload = strtolower(substr($_FILES['file_micropost_image']['name'], -3));
                            
                    if(in_array($extensionUpload, $extensionsValides)) {
                                    $randomfile = md5(uniqid(rand()));
                                    $chemin = "assets/images/".$randomfile.".".$extensionUpload;
                                    $resultat = move_uploaded_file($_FILES['file_micropost_image']['tmp_name'], $chemin);
                
                                if($resultat) {

                                            $q=$db->prepare('INSERT INTO microposts(content, img, user_id) VALUES (:content, :img, :user_id)');
                                            $q->execute([
                                                'content' => $content,
                                                'img' => $randomfile.".".$extensionUpload,
                                                'user_id'=> get_session('user_id')
                                            ]);                                                       
                                
                                    } else {
                                    
                                            $msg = "Erreur durant l'importation de votre photo";
                                    }
                    } else {
                       set_flash('Votre photo doit être au format jpg, jpeg, gif ou png', 'danger');
                        }     

                } else {
                    set_flash('Votre Photo ne doit pas dépasser 2Mo', 'danger');
                }
            
            } else {
                            
                $updatecontent = $db->prepare('INSERT INTO microposts(content, user_id) VALUES (:content, :user_id)');
                $updatecontent->execute(array(
                    'content' => $content ,           
                    'user_id'=> get_session('user_id')                                                
                ));  
                set_flash('Votre status a été mis à jour!');  
            }
        }
    }

}



redirect('profile.php?id='.get_session('user_id'));
