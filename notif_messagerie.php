<?php

if(isset($_GET['id'])){ 
$q=$db->prepare("SELECT u.pseudo , u.id, u.avatar, m.message, m.date_message, m.id_from, m.lu 
                FROM (
                    SELECT IF(f.user_id1 = :id, f.user_id2, f.user_id1) id_utilisateur, MAX(m.id) max_id
                    FROM friends_relationships f
                    LEFT join messagerie m ON ((m.id_from, m.id_to) = (f.user_id1, f.user_id2) 
                    OR (m.id_from, m.id_to) = (f.user_id2, f.user_id1))
                    WHERE (f.user_id1 = :id OR f.user_id2 = :id) AND status = '1'
                    GROUP BY IF(m.id_from = :id, m.id_to, m.id_from), f.id ) as DM
                LEFT JOIN messagerie m ON m.id = DM.max_id
                LEFT JOIN users u ON u.id = DM.id_utilisateur
                ORDER BY m.date_message DESC");
               
$q->execute([ 'id' => $_GET['id']]);

    }
$afficher_conversation = $q->fetchAll(PDO::FETCH_OBJ);

?>