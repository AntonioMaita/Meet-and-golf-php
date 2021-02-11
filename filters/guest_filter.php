<?php 

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_pseudo'])) {

        header('Location:front_page.php');
            exit();
    }

?>