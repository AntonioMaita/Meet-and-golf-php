<?php foreach($comments_post_post as $comment_post_post): ?> 
<?php if($comment_post_post->c_post_id == $user->p_id) : ?>
    
                             
            
<div class="card card-text bg-dark shadow" id="comment<?=$comment_post_post->c_id?>">

    <div class="card-group text-white shadow col-md-12">
    
        <?php if (!empty($comment_post_post->u_avatar)) {

        ?>
            <img class="rounded-circle" src="assets/avatars/<?=$comment_post_post->u_avatar; ?>" alt="avatar" width="40px" height="auto" />
        <?php } else { ?>
            <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px">
        <?php } ?>
        <p><a class="text-white " href="profile.php?id=<?= $comment_post_post->c_user_id ?>"><?=e($comment_post_post->u_pseudo)?></a> a commenter</p> <br> 
        
        
       
        <?php if(get_session('user_id') == ($comment_post_post->c_user_id)  || get_session('user_id') == ($user->users_id) ): ?>
            <a  onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')" 
                class="btn btn-sm tooltip-test" href="delete_post_comment_post.php?id=<?= $comment_post_post->c_id ?>"> 
                <i class="fa fa-trash text-white"></i>
            </a>
        <?php endif;?>
        
        

    </div>

    <p><i class="fa fa-clock-o text-white"> <span class="timeago" title="<?= $comment_post_post->c_created_at ?>"><?= $comment_post_post->c_created_at ?></span></i></p> <br>
    
     <?php if(!empty($comment_post_post)) :?>
        
        <p class="text-white"><?= nl2br(replace_links($comment_post_post->comment)) ?></p>
        
               
    <?php endif ; ?>
    <hr class="text-white"> 
   
     <br>
</div>

<?php endif; ?>
<?php endforeach ;?>