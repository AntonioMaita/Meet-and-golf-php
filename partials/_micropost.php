<div class="card card-body  bg-dark text-white microposts">


    <div class="card card-text bg-light shadow">

        <div class="card-group text-dark shadow col-md-12">
            <?php if (!empty($user->avatar)) {

            ?>
                <img class="rounded-circle" src="assets/avatars/<?=$user->avatar; ?>" alt="avatar" width="40px" height="40px" />
            <?php } else { ?>
                <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px">
            <?php } ?>
            <p><a class="text-dark publishName" href="profile.php?id=<?=$micropost->user_id?>"><?=e($user->pseudo)?></a> a publié</p> <br> 
            
          
           
            <?php if(get_session('user_id') == ($micropost->user_id) ): ?>
                <a  onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')" 
                    class="btn btn-sm tooltip-test" href="delete_micropost.php?id=<?= $micropost->id ?>"> 
                    <i class="fa fa-trash "></i> Supprimer
                </a>
            <?php endif;?>
            
            

        </div>

        <p><i class="fa fa-clock-o text-dark"> <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span></i></p> <br>

        <p class="text-dark"><?= nl2br(replace_links(e($micropost->content))) ?></p>


    </div>

</div>