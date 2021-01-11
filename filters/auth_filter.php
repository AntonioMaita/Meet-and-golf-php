<?php 

    if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_pseudo'])) {
        
        $_SESSION['forwarding_url'] = $_SERVER['REQUEST_URI'];
        
        $_SESSION['notification']['message'] = "Vous devez être connécter pour accéder à cette page.";
        $_SESSION['notification']['type'] = 'danger';
        
        header('Location: login.php');
            exit();
    }

?>