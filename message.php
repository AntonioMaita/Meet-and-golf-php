<?php 
session_start();

require("includes/init.php");
include('filters/auth_filter.php');

$get_id = (int) $_GET['id'];

if($get_id <= 0){
    header('Location: messagerie.php');
    exit;
}

$q=$db->prepare('SELECT * FROM messagerie
                WHERE ((id_from, id_to) =  (:id1, :id2) OR (id_from, id_to) =  (:id2, :id1))
                ORDER BY date_message DESC');
$q->execute(['id1'=> get_session('user_id'), 'id2' => $get_id]);

$afficher_message = $q->fetchAll(PDO::FETCH_OBJ);






 
 require('views/message.view.php');

 ?>