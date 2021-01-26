<?php $title = "Page du mur"; ?>
<?php include('partials/_header.php'); ?>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <form action="" method="post">
                        <label class="card-body bg-secondary text-white question"for="post">Quoi de neuf <?=e($user->pseudo)?> ?</label> <br> <br>
                        <textarea name="post" id="post" cols="30" rows="5" placeholder="Entrez votre sujet"
                            class="form-control publishPost" data-parsley-maxlength="150"></textarea><br>

                            <input type="submit" class="btn btn-success btn-xl float-end" value="Publier" name="postmessage" >  <br> <br>
                    </form>
                </div>                
                                            
            </div>  

        </div>
        <div class="row">
            <div class="col-md-offset-3">
                <div class="card card-header text-white bg-success shadow fildactualite">
                    <h5 class="lead card-text">Fil d'actualité</h5>
                </div>
                <div class="card card-body  bg-dark text-dark messagepost">
                    <?php if (count($users) != 0) :?>
                            <?php foreach($users as $user) : ?>                

                                <div class="card card-text shadow">
                                    <div class="card-group text-dark shadow ">  
                                    <?php
                                    if(!empty($user->avatar)) {
                                                                                                                                            
                                        ?>
                                        <a class="publishName" href="profile.php?id=<?=$user->users_id?>"><img class="rounded-circle img-thumbnail" src="assets/avatars/<?php echo $user->avatar;?>" alt="avatar" width="40px" height="40px"/></a><br><br>
                                            <?php } else { ?> 
                                                <a class="publishName" href="profile.php?id=<?=$user->users_id?>"><img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px"></a>
                                            <?php } ?>  
                                        <p><a class="text-dark publishName" href="profile.php?id=<?=$user->users_id?>"><?=e($user->pseudo)?></a> a publié</p>
                                    </div>
                                
                                    <p><i class="fa fa-clock-o"> <span class="timeago" title="<?= $user->date ?>"><?= $user->date ?></span></i></p> <br>
                                    
                                    <p ><?php echo nl2br(replace_links(e($user->post)))?></p> <br> 
                                                                                                
                                
                                </div> <br>                
                            <?php endforeach;?>
                    <?php else : ?>
                    <div class="text-white shadow">
                        <p>pas de message pour le moment...</p>
                    </div>
                    <?php endif; ?>  
                                
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('partials/_footer.php');