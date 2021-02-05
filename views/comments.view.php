
<?php if($comment->micropost_id == $micropost->id) : ?>
<div class="card card-text bg-dark shadow" id="comment<?=$comment->id?>">

    <div class="card-group text-white shadow col-md-12">
    
        <?php if (!empty($user->avatar)) {

        ?>
            <img class="rounded-circle" src="assets/avatars/<?=$user->avatar; ?>" alt="avatar" width="40px" height="40px" />
        <?php } else { ?>
            <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px">
        <?php } ?>
        <p><a class="text-white " href="profile.php?id=<?= $micropost->user_id ?>"><?=e($user->pseudo)?></a> a commenter</p> <br> 
        
        
       
        <?php if(get_session('user_id') == ($comment->c_user_id) ): ?>
            <a  onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')" 
                class="btn btn-sm tooltip-test" href="delete_micro_comment.php?id=<?= $comment->c_id ?>"> 
                <i class="fa fa-trash text-white"></i>
            </a>
        <?php endif;?>
        
        

    </div>

    <p><i class="fa fa-clock-o text-white"> <span class="timeago" title="<?= $comment->c_created_at ?>"><?= $comment->c_created_at ?></span></i></p> <br>
    
     <?php if($comments) :?>
        
        <p class="text-white"><?= nl2br(replace_links(e($comment->comment))) ?></p>
        
               
    <?php endif ; ?>
    <hr class="text-white">  
   
     <br>
</div>

<?php endif; ?>