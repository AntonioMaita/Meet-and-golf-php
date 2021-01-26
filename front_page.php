<?php    
    session_start();

    require("includes/init.php");  

    include('filters/auth_filter.php');

   

    if(!empty($_GET['id'])){
        //recup info user db utilisant id
        $user= find_user_by_id($_GET['id']);

                

        if(!$user){
            redirect('index.php');

        }

    } else {
        redirect('profile.php?id='.get_session('user_id'));

    } 
  



    if(isset($_POST['postmessage'])) {

       

        if (not_empty(['post'])) {


            extract($_POST);

            $error=[];

            $q= $db->prepare('INSERT INTO post (post, users_id) VALUE (:post, :users_id)');

                $q->execute([
                    'post' => $post,
                    'users_id' => get_session('user_id')
                    
                    
                    ]);
                
                set_flash("Sujet envoyé");
                header('Location: front_page.php?id='.get_session('user_id'));
        }


    }else {
        clear_input_data();
    }

    if(!empty($_GET['id'])){

        
        
        $q = $db->query("SELECT * FROM post INNER JOIN users on post.users_id = users.id WHERE  post.users_id = users.id ORDER BY date DESC" );
       

        $users = $q->fetchAll(PDO::FETCH_OBJ);
        
               

    } else {
        redirect('front_page.php');

    }



   

    
    
    
    
    require ('views/front_page.view.php');
