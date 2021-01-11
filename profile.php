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

     
    
    
    

    
    
  require('views/profile.view.php');

