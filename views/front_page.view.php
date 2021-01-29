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
            <div class="col-md-offset-3 ">
                <div class="card card-header text-white bg-success shadow fildactualite">
                    <h5 class="lead card-text">Fil d'actualité</h5>
                </div>
                        <!-- POST       -->
                               
                <div class="card-body  bg-dark text-dark messagepost">
                               
                <?php if (count($users) != 0 || count($microposts) !=0) :?>
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
                                                                                
                                       <?php if(get_session('user_id') == ($user->users_id) ): ?>
                                        <a  onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')" 
                                            class="btn btn-sm tooltip-test" href="delete_post.php?id=<?= $user->id ?>"> 
                                            <i class="fa fa-trash "></i> Supprimer 
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                
                                    <p><i class="fa fa-clock-o"> <span class="timeago" title="<?= $user->date ?>"><?= $user->date ?></span></i></p> <br>
                                                         
                                   
                                   <p> <?php echo nl2br(replace_links(e($user->post))); ?> <p> <br> 
                                    <hr class="text-dark">                                                      
                                    <p class="text-dark">
                                    <i class="fas fa-thumbs-up text-primary"> </i> 
                                        
                                        <?php if($user->like_count == 0) : ?>
                                        <?php  echo '';?>
                                        <?php else : ?>
                                            <?=$user->like_count?>
                                        <?php endif; ?>
                                        <br>
                                        <a class ="btn" href="like_post.php?id=<?= $user->id ?>"><i class="far fa-thumbs-up "> </i> J'aime</a>

                                    </p>
                                </div> <br>
                        <?php endforeach;?>                                                     
                    


                                <!-- Micropost -->
                                 
                                    <?php foreach($microposts as $micropost): ?>
                                      
                                <div class="card card-text shadow">
                                    <div class="card-group text-dark shadow "> 
                                    
                                    <?php
                                    if(!empty($micropost->avatar)) {
                                                                                                                                            
                                        ?>                                                                 
                  
                                        <a class="publishName" href="profile.php?id=<?=$micropost->user_id?>"><img class="rounded-circle img-thumbnail" src="assets/avatars/<?php echo $micropost->avatar;?>" alt="avatar" width="40px" height="40px"/></a><br><br>
                                            <?php } else { ?> 
                                                <a class="publishName" href="profile.php?id=<?=$micropost->user_id?>"><img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px"></a>
                                            <?php } ?>  
                                        <p><a class="text-dark publishName" href="profile.php?id=<?=$micropost->user_id?>"><?=e($micropost->pseudo)?></a> a publié</p>
                                                                                
                                       <?php if(get_session('user_id') == ($micropost->user_id) ): ?>
                                        <a  onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')" 
                                            class="btn btn-sm tooltip-test" href="delete_micropost.php?id=<?= $micropost->m_id ?>"> 
                                            <i class="fa fa-trash "></i> Supprimer 
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                
                                    <p><i class="fa fa-clock-o"> <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span></i></p> <br>
                                                         
                                   
                                    <p> <?php echo nl2br(replace_links(e($micropost->content))); ?> <p> 
                                            <hr class="text-dark">
                                    <p class="text-dark">
                                    <i class="fas fa-thumbs-up text-primary"> </i>                                        
                                        <?php if($micropost->like_count == 0) : ?>
                                        <?php  echo '';?>
                                        <?php else : ?>
                                            <?=$micropost->like_count?>
                                        <?php endif; ?>
                                        <br>
                                        <a class ="btn" href="like_post.php?id=<?= $micropost->id ?>"><i class="far fa-thumbs-up "> </i> J'aime</a>

                                    </p>                                                     
                                
                                </div> <br> 


                        <?php endforeach;?>                  
                           
                <?php else : ?>
                    <div class="text-white shadow">
                        <p>Aucun message pour le moment...</p>
                    </div>
                <?php endif; ?> 
                      
                     
                    
                                
                </div>
                
            </div>
        </div>
       
    </div>

</div>

<?php include('partials/_footer.php');