<?php 
session_start();


include('filters/guest_filter.php');
require('config/database.php');
require('includes/functions.php');
require('includes/constants.php');

//si le formulaire a ete soumis
    if(isset($_POST['login'])) {

        //si tout les champs ont ete rempli
        if(not_empty(['identifiant', 'password'])) {
            
            extract($_POST);

            $q= $db->prepare("SELECT id , pseudo, password AS hashed_password, email FROM users WHERE (pseudo= :identifiant OR email= :identifiant)
                             AND active = '1'");

            $q->execute([
                'identifiant' => $identifiant
                
                
            ]);

            $user= $q->fetch(PDO::FETCH_OBJ);
            

            if($user && bcrypt_verify_password($password, $user->hashed_password)) {

                
                                
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_pseudo'] = $user->pseudo;
                $_SESSION['user_avatar'] = $user->avatar;
                $_SESSION['user_email'] = $user->email;

                redirect_intent_or('profile.php?id='.$user->id);
                
            } else {
                set_flash('Combinaison Identifiant/Password incorrecte', 'danger');
                save_input_data();
            }
            
        }


    } else {
        clear_input_data();
    }

?>

<?php require('views/login.view.php'); ?>