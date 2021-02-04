

<div class="card card-text bg-dark shadow" id="comment<?=$comment->id?>">

    <div class="card-group text-white shadow col-md-12">
    
        <?php if (!empty($user->avatar)) {

        ?>
            <img class="rounded-circle" src="assets/avatars/<?=$user->avatar; ?>" alt="avatar" width="40px" height="40px" />
        <?php } else { ?>
            <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px">
        <?php } ?>
        <p><a class="text-white publishName" href="profile.php?id=<?=$comment->user_id?>"><?=e($user->pseudo)?></a> a commenter</p> <br> 
        
        
       
        <?php if(get_session('user_id') == ($comment->user_id) ): ?>
            <a  onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')" 
                class="btn btn-sm tooltip-test" href="delete_micropost.php?id=<?= $comment->id ?>"> 
                <i class="fa fa-trash text-white"></i> Supprimer
            </a>
        <?php endif;?>
        
        

    </div>

    <p><i class="fa fa-clock-o text-white"> <span class="timeago" title="<?= $comment->created_at ?>"><?= $comment->created_at ?></span></i></p> <br>

    <p class="text-white"><?= nl2br(replace_links(e($comment->comment))) ?></p>
    <hr class="text-white">  
   
     <br>
</div>