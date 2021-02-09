<?php 
session_start();

require("includes/init.php");
include('filters/auth_filter.php');

$get_id = (int) $_GET['id'];

if($get_id <= 0){
    header('Location: messagerie.php');
    exit;
}

$q=$db->prepare("SELECT * FROM friends_relationships
                WHERE ((user_id1, user_id2) = (:id1, :id2) OR (user_id1, user_id2) = (:id2, :id1))
                AND status = :status");
$q->execute(['id1'=> get_session('user_id'), 'id2' => $_GET['id'], 'status' => 1]);

$verifier_relation = $q->fetch(PDO::FETCH_OBJ);

if(!isset($verifier_relation->id)){
    header('Location: messagerie.php');
    exit;
}


$q=$db->prepare("SELECT * FROM messagerie
                WHERE ((id_from, id_to) = (:id1, :id2) OR (id_from, id_to) = (:id2, :id1))
                ORDER BY date_message DESC
                ");
$q->execute(['id1'=> get_session('user_id'), 'id2' => $get_id]);

$afficher_message = $q->fetchAll(PDO::FETCH_OBJ);

$q=$db->prepare("UPDATE messagerie SET lu = ? 
                WHERE id_to = ? AND id_from = ?");
$q->execute([0, $_SESSION['user_id'], $get_id]);



if(!empty($_GET['id'])){
    //recup info user db utilisant id
    $user= find_user_by_id($_GET['id']);
}


if(!empty($_POST)){
    extract($_POST);
    $get_id = (int) $_GET['id'];
    $valid = (boolean) true;

    if (isset($_POST['envoyer'])){
        $message = (String) trim($message);
        if(empty($message)) {
            $valid = false ;
            $er_message = "Veuillez entrez un message";
        }
        if($valid){
            
            $q=$db->prepare('INSERT INTO messagerie (id_from, id_to, message,  lu )
                         VALUES (?,?,?,?)');
            $q->execute([get_session('user_id'), $get_id, $message, 1]);
        }

        redirect('message.php?id='.$get_id);
        exit;
        
    }
}








 
 require('views/message.view.php');

 ?>