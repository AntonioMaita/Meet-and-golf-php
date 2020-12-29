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

            $q= $db->prepare("SELECT id , pseudo FROM users WHERE (pseudo= :identifiant OR email= :identifiant)
                            AND password= :password AND active = '1'");

            $q->execute([
                'identifiant' => $identifiant,
                'password' => sha1($password)
            ]);

            $userHasBeenFound = $q->rowCount();

            if($userHasBeenFound) {

                $user = $q->fetch(PDO::FETCH_OBJ);
                                
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_pseudo'] = $user->pseudo;
                $_SESSION['user_avatar'] = $user->avatar;

                redirect('profile.php?id='.$user->id);
            } else {
                set_flash('Combinaison Identifiant/Password incorrecte', 'warning');
                save_input_data();
            }
            
        }


    } else {
        clear_input_data();
    }

?>

<?php require('views/login.view.php'); ?>