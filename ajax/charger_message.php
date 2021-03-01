<?php 
session_start();

require '../config/database.php';
require '../includes/functions.php';

if(!isset($_SESSION['user_id'])){
    exit;
}

$get_id = (int) $_POST['id'];


if($get_id <= 0 ){
    
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

$q=$db->prepare("SELECT * FROM messagerie
                WHERE id_to = ? AND id_from = ? AND lu = ?");
$q->execute([$_SESSION['user_id'], $get_id, 1]);

$afficher_message= $q->fetchAll(PDO::FETCH_OBJ);

$user= find_user_by_id($get_id);


$q=$db->prepare("UPDATE messagerie SET lu = ? 
                WHERE id_to = ? AND id_from = ?");
$q->execute([0, $_SESSION['user_id'], $get_id]);



?>

    


   <?php foreach($afficher_message as $am){ ?>

            
    <div class="message-droit"><?=nl2br(replace_links($am->message))?></div>
        
<?php } ?>


