<a href="profile.php?id=<?= $notification->user_id ?>">
  <?php                   
    
    if(!empty($notification->avatar)) {                                                                                                                                    
  ?>    
      <img class="avatar rounded float-start" src="assets/avatars/<?php echo $notification->avatar;?>" alt="avatar" width="50px" height="50px"/> 
    <?php } else { ?> 
      <img class="rounded-circle rounded float-start" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px"/>
    <?php } ?>
    
  <?= e($notification->pseudo) ?>
</a>
 vous a envoyé une demande d'amitié <span class="timeago" title="<?= $notification->created_at ?>"><?= $notification->created_at ?></span>.
<a class="btn btn-primary" href="accept_friend_request.php?id=<?= $notification->user_id ?>">Accepter</a>
<a class="btn btn-danger" href="delete_friend.php?id=<?= $notification->user_id?>">Decliner</a>