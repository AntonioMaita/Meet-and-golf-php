<?php    
    session_start();

    include('filters/auth_filter.php');

    require('config/database.php');
    
    require('includes/functions.php');

    require('includes/constants.php');

    header("Cache-Control: no-cache, must-revalidate");


    if(!empty($_GET['id'])){
        //recup info user db utilisant id
        $user= find_user_by_id($_GET['id']);

                

        if(!$user){
            redirect('index.php');

        }

    } else {
        redirect('profile.php?id='.get_session('user_id'));

    }

    if(isset($_POST['update'])) {

        $errors= [];

        //si tout les champs ont ete rempli
        if(not_empty(['name', 'adress', 'city', 'country', 'club', 'bio', 'sex'])) {
            
            extract($_POST);

            $q= $db->prepare('UPDATE users SET name= :name, adress= :adress, city= :city, country= :country, club= :club, bio= :bio, sex= :sex WHERE id= :id ');

            $q->execute([
                'name' => $name,
                'adress' => $adress,
                'city' => $city,
                'country' => $country,
                'club' => $club,
                'bio' => $bio,
                'sex' => $sex,
                'id' => get_session('user_id')
            ]);
            
            set_flash("Votre profil a été mis à jour");
            header('Location: profile.php?id='.get_session('user_id'));
            
            
        } else {
            save_input_data();
            $errors[]= "Veuillez remplir tout les champs marqués d'un (*)";
        }



    } else {
        clear_input_data();
    }

    
if(isset($_FILES['file']) AND !empty($_FILES['file']['name'])) {
   $tailleMax = 2097152;
    // 2mo  = 2097152
    // 3mo  = 3145728
    // 4mo  = 4194304
    // 5mo  = 5242880
    // 7mo  = 7340032
    // 10mo = 10485760
    // 12mo = 12582912
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['file']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
         $chemin = "assets/avatars/".get_session('user_id').".".$extensionUpload;
         $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $chemin);
         if($resultat) {
            $updateavatar = $db->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
            $updateavatar->execute(array(
               'avatar' => get_session('user_id').".".$extensionUpload,
               'id' => get_session('user_id')
               ));
            
            header('Location: profile.php?id='.get_session('user_id'));
         } else {
            $msg = "Erreur durant l'importation de votre photo de profil";
         }
      } else {
         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
      }
   } else {
      $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
   }
}
    
    
    

    
    
  require('views/profile.view.php');

