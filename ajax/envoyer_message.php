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

// $q=$db->prepare("SELECT * FROM messagerie
//     WHERE id_to = ? AND id_from = ? AND lu = ?");
// $q->execute([$_SESSION['user_id'], $get_id, 1]);

// $afficher_message= $q->fetchAll(PDO::FETCH_OBJ);
// if($afficher_message == 1){
//     $q = $db->prepare('INSERT INTO notifications(subject_id, name, user_id)
//                                 VALUES(:subject_id, :name, :user_id)');
//                 $q->execute([
//                 'subject_id' => $_POST['id'],
//                 'name' => 'nouveau_message',
//                 'user_id' => get_session('user_id')
//                 ]);
//     }
//         $q=$db->prepare("SELECT email, pseudo FROM users WHERE id = ?");
//         $q->execute([$_POST['id']]);
//         $users = $q->fetchAll(PDO::FETCH_OBJ);

//         foreach ($users as $user){
//             $email = $user->email;
            
//         }


//         $q=$db->prepare("SELECT email, pseudo FROM users WHERE id = ?");
//         $q->execute([$_SESSION['user_id']]);
//         $pseudos = $q->fetchAll(PDO::FETCH_OBJ);

//         foreach($pseudos as $pseudo ){
//             $pseu = $pseudo->pseudo;
//         }


//             if($lu == '1' && !isset($_SESSION['user_id']) ) {

//             $message = "<html>
//                             <body>
//              					<p style='font-size: 18px'><b>Bonjour,</b></p><br/>
//              					<p><i><b> Vous avez reçus un nouveau message de $pseu</b></i></p><br/>
//              				</body>
//              			</html>";
            
            
//             // "Bonjour, voici votre nouveau mot de passe : $password";
//             $headers = "From: Meet and Golf <no-reply@meetadngolf.com> \n";
//             $headers .='Content-Type: text/html; charset="utf-8"'."";
//             $headers .= "Content-Transfer-Encoding: 8bit";

//             mail($email, 'Meet and Golf - Nouveau message reçu', $message, $headers);	
            
//             }



?>
    <div class="message-gauche"><?=nl2br(replace_links($get_message));?></div>
    
   


