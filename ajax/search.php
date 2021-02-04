<?php 

session_start();
require '../config/database.php';
require '../includes/functions.php';

extract($_POST);

$q=$db->prepare('SELECT * FROM users
                    WHERE(name LIKE :query OR pseudo LIKE :query OR email LIKE :query OR club LIKE :query)');
$q->execute([
    'query'=> '%'.$query.'%'
]);

$users = $q->fetchAll(PDO::FETCH_OBJ);

if(count($users) >0 ){
    foreach ($users as $user){
        ?>
        <div class=" display-box-user form-control">
            <a class="link-display-box-user" href="profile.php?id=<?=$user->id?>">
            <?php if(!empty($user->avatar)) {                                                                                                                                    
                    ?>                  
                        <img class="avatar rounded justify-content-end" src="assets/avatars/<?php echo $user->avatar;?>" alt="<?=e($user->pseudo)?>" width="50px" height="50px"/> 
                    <?php } else { ?> 
                        <img class="rounded-circle rounded justify-content-end" src="assets/avatars/defaults/default.png" alt="<?=e($user->pseudo)?>" width="40px" height="40px"/>
                    <?php } ?> <br>
                
                nom :<?=e($user->name)?><br>email :<?=e($user->email)?><br>club :<?=e($user->club)?>
            </a>
        </div>
    <?php 
    }
}else {
    echo '<div class="display-box-user form-control"><p>Aucun utilisateur trouvé.</p></div>';
}
?>