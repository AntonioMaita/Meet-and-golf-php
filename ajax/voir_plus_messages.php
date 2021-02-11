<?php 
session_start();

require '../config/database.php';
require '../includes/functions.php';

if(!isset($_SESSION['user_id'])){
    exit;
}

$limit = (int) trim($_POST['limit']);
$get_id = (int) trim($_POST['id']);

if($limit <= 0 || $get_id <= 0){
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

$nombre_total_message = 25;

$limit_mini = 0;
$limit_maxi = 0;

$q=$db->prepare("SELECT COUNT(id) nbMessage FROM messagerie 
                WHERE ((id_from, id_to) = (:id1, :id2) OR (id_from, id_to) = (:id2, :id1))                               
                ");
$q->execute(['id1'=> $_SESSION['user_id'], 'id2' => $get_id]);

$nombre_message = $q->fetch();

$limit_mini = $nombre_message['nbMessage'] - $limit;

    if($limit_mini > $nombre_total_message){
        $limit_maxi = $nombre_total_message;
        $limit_mini = $limit_mini - $nombre_total_message;        
    }else {
        if($limit_mini > 0){
            $limit_maxi =$limit_mini;
        } else {
            $limit_maxi = 0 ;
        }
        $limit_mini = 0;
    }


$q=$db->prepare("SELECT * FROM messagerie
                WHERE ((id_from, id_to) = (:id1, :id2) OR (id_from, id_to) = (:id2, :id1))
                ORDER BY date_message
                LIMIT $limit_mini, $limit_maxi
                ");

$q->execute(['id1'=> $_SESSION['user_id'], 'id2' => $get_id]);

$afficher_message = $q->fetchAll(PDO::FETCH_OBJ);

if($limit_mini <= 0 ){
    ?>
    <div>
        <script>
            var el = document.getElementById('voir-plus');
            el.classList.add('btn-masquer-voir-plus-message');
        </script>
    </div>
<?php     
}
?>

<div id="voir-plus-message"></div>


<?php foreach($afficher_message as $am ) :               
                    
    if($am->id_from == $_SESSION['user_id']) :?>
        <div class="message-gauche">                                
            <?=nl2br(replace_links($am->message))?>                                 
            
        </div>                         
    <?php else : ?>   
        <div class="message-droit">                                            
            <?=nl2br(replace_links($am->message))?>                        
           
        </div> 
        
    <?php endif; ?>                
          
             

<?php endforeach; ?>



