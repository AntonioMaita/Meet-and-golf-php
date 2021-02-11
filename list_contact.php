<?php
session_start();

require("includes/init.php");
include('filters/auth_filter.php');


$q=$db->prepare('SELECT u.pseudo , u.id, u.avatar, m.message, m.date_message, m.id_from, m.lu 
                FROM (
                    SELECT IF(f.user_id1 = :id, f.user_id2, f.user_id1) id_utilisateur, MAX(m.id) max_id
                    FROM friends_relationships f
                    LEFT join messagerie m ON ((m.id_from, m.id_to) = (f.user_id1, f.user_id2) 
                    OR (m.id_from, m.id_to) = (f.user_id2, f.user_id1))
                    WHERE (f.user_id1 = :id OR f.user_id2 = :id) AND status = "1"
                    GROUP BY IF(m.id_from = :id, m.id_to, m.id_from), f.id ) as DM
                LEFT JOIN messagerie m ON m.id = DM.max_id
                LEFT JOIN users u ON u.id = DM.id_utilisateur
                ORDER BY u.pseudo 
                ');
$q->execute([ 'id'=> $_GET['id']]);

$afficher_contact = $q->fetchAll(PDO::FETCH_OBJ);

require("views/list_contact.view.php");
?>