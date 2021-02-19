<?php 
session_start();

require '../config/database.php';
require '../includes/functions.php';

if(isset($_POST['postcomment'])){
    if(!empty($_POST['comment'])){
        extract($_POST);

        
                     
        

                    $q=$db->prepare('INSERT INTO comments_micropost (comment, user_id, micropost_id) VALUES (:comment, :user_id, :micropost_id)');
                    $q->execute([
                        'comment'=> $comment,
                        'user_id'=> $_SESSION['user_id'],
                        'micropost_id' =>  $_GET['id']
                    ]);

                    $q = $db->prepare('UPDATE microposts SET comments_count = comments_count +1 
                                    WHERE id = ?');
                    $q->execute([$_GET['id']]);
                
                      
            
                set_flash('Commentaires mis à jour!');

                $q = $db->query('SELECT  U.id u_id, U.pseudo u_pseudo, U.avatar u_avatar, C.id c_id , C.comment, C.micropost_id , C.user_id c_user_id, M.id m_id , C.created_at c_created_at 
                            FROM comments_micropost C , microposts M, users U
                            WHERE  C.micropost_id = M.id AND C.user_id = U.id
                            ORDER BY c_created_at ASC
                            ');
        
                       
       
        $comments = $q->fetchAll(PDO::FETCH_OBJ);

                
    } else {
        clear_input_data();
    }
}
?>
<?php $get_message = (String) urldecode(trim($_POST['comment']));?>
<div class="comment_micropost"></div>
