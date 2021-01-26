<div class="card card-body  bg-dark text-white microposts">


    <div class="card card-text bg-light shadow">

        <div class="card-group text-dark shadow col-md-12">
            <?php if (!empty($img['avatar'])) {

            ?>
                <img class="rounded-circle" src="assets/avatars/<?php echo $img['avatar']; ?>" alt="avatar" width="40px" height="40px" />
            <?php } else { ?>
                <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px">
            <?php } ?>
            <p><?= e($user->pseudo) ?></p> <br> 
            <a class="btn btn-sm " href="#"> <i class="fa fa-trash "></i> Supprimer</a>

        </div>

        <p><i class="fa fa-clock-o text-dark"> <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span></i></p> <br>

        <p class="text-dark"><?= nl2br(replace_links(e($micropost->content))) ?></p>


    </div>

</div>