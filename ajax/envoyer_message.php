<?php 
session_start();

require '../config/database.php';
require '../includes/functions.php';
// include('../filters/auth_filter.php');

if(!isset($_SESSION['user_id'])){
    exit;
}

$get_id = (int) $_POST['id'];
$get_message = (String) urldecode(trim($_POST['message']));

if($get_id <= 0 || empty($get_message)){
    
    exit;
}

$q=$db->prepare("SELECT id FROM friends_relationships
                WHERE ((user_id1, user_id2) = (:id1, :id2) OR (user_id1, user_id2) = (:id2, :id1))
                AND status = :status");
$q->execute(['id1'=> $_SESSION['user_id'], 'id2' => $get_id, 'status' => 1]);

$verifier_relation = $q->fetch(PDO::FETCH_OBJ);

if(!isset($verifier_relation->id)){
    exit;
}
$date_message = date("Y-m-d H:i:s");

$q=$db->prepare("INSERT INTO messagerie (id_from, id_to, message, date_message, lu)
                VALUES(?,?,?,?,?)
                ");
$q->execute([ $_SESSION['user_id'], $get_id, $get_message, $date_message, 1]);

?>

    
    <div class="message-gauche"><?=nl2br(replace_links($get_message))?></div>
    
   


