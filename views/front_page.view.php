<?php $title = "Page du mur"; ?>
<?php include('partials/_header.php'); ?>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label class="card-body bg-secondary text-white question"for="post">Quoi de neuf <?php echo $user_sess;?> ?</label> <br> <br>
                <form action="" method="post"  enctype="multipart/form-data" >
                                                                       
                        <textarea  name="content" id="content" cols="50" rows="5" placeholder="Entrez votre sujet"
                            class="form-control publishPost" data-parsley-maxlength="150"></textarea><br>
                            
                            <input type="file" id="file_micropost_image" name="file_micropost_image"style="visibility:hidden" >
                           <i class="fas fa-image text-white btn btn-lg float-start bg-success" onclick="$('#file_micropost_image').click();"></i>
                            <input type="submit" class="btn btn-success btn-xl float-end" value="Publier" name="publish" > 
                            
                        </form> <br>
                        
                </div>                
                                            
            </div>  
        
        </div>
        
        
        <div class="row">
            <div class="col-md-offset-3 ">
                <div class="card card-header text-white bg-success shadow fildactualite">
                    <h5 class="lead card-text">Fil d'actualité</h5>
                </div>               

                                                                
                    
                    <?php if ($microposts) : ?>

                                <!-- Micropost -->
                            <div class="card-body  bg-dark text-dark messagepost" >
                                    <?php foreach($microposts as $micropost): ?>

                                                                          
                                <div class="card card-text shadow" id="micropost<?=$micropost->m_id?>">
                                    <div class="card-group text-dark shadow "> 
                                    
                                        <?php
                                        if(!empty($micropost->avatar)) {
                                                                                                                                            
                                        ?>                                                                 
                  
                                        <a class="publishName" href="profile.php?id=<?=$micropost->user_id?>"><img class="rounded-circle img-thumbnail" src="assets/avatars/<?php echo $micropost->avatar;?>" alt="avatar" width="40px" height="auto"/></a><br><br>
                                            <?php } else { ?> 
                                                <a class="publishName" href="profile.php?id=<?=$micropost->user_id?>"><img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px"></a>
                                            <?php } ?>  
                                        <p><a class="text-dark publishName" href="profile.php?id=<?=$micropost->user_id?>"><?=e($micropost->u_pseudo)?></a> a publié</p>
                                                                                
                                       <?php if(get_session('user_id') == ($micropost->user_id) || get_session('user_id') == ($micropost->user_id) ): ?>
                                        <a  onclick="return confirm('Voulez-vous vraiment supprimer cette publication ?')" 
                                            class="btn btn-sm tooltip-test" href="delete_micropostPost.php?id=<?= $micropost->m_id ?>"> 
                                            <i class="fa fa-trash "></i> Supprimer 
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                
                                    <p><i class="fa fa-clock-o"> <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span></i></p> <br>
                                                         
                                   
                                    <p> <?php echo nl2br(replace_links(e($micropost->content))); ?> <p> 
                                    <?php if($micropost->img): ?>
                                    <a href="assets/images/<?=$micropost->img?>" target="_blank"><img class="img-fluid" src="assets/images/<?=$micropost->img?>" alt="" width="auto"></a>
                                   <?php endif;?>
                                    <hr class="text-dark">
                                    <div class="text-dark">
                                    
                                        <div class="text-dark" id="likers_<?=$micropost->m_id?>"> 
                                            <!-- <i class="fas fa-thumbs-up text-primary"> </i>                 -->
                                            <?=get_likers_text($micropost->m_id)?>
                                        </div>
                                    
                                        <br>
                                        <?php if (user_has_already_liked_the_micropost($micropost->m_id)): ?>
                                            <a class ="btn  text-primary fas fa-thumbs-up likeMicropostPost" data-action="unlikeMicropostPost" id="unlikeMicropostPost<?= $micropost->m_id ?>" href="unlike_micropostPost.php?id=<?= $micropost->m_id ?>">Je n'aime plus</a>
                                        <?php else : ?>
                                            <a class ="btn likeMicropostPost fas fa-thumbs-up" data-action="likeMicropostPost" id="likeMicropostPost<?= $micropost->m_id ?>" href="like_micropostPost.php?id=<?= $micropost->m_id ?>">J'aime</a> 
                                        <?php endif ;?>  
                                    </div> <br>                                                    
                                
                                </div> <br>
                                
                                <button type="button" data-id="<?= $micropost->m_id ?>"  data-bs-backdrop="false" class="btn btn-success btn-xs" 
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop_micropost<?= $micropost->m_id ?>">
        
                                    <?=$micropost->comments_count?> Commentaire<?=$micropost->comments_count <= 1 ? '' : 's'?>
          
                                </button> <br>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop_micropost<?= $micropost->m_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" 
                                    tabindex="-1" aria-labelledby="staticBackdropLabel"  aria-hidden="true" data-bs-refresh="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="staticBackdropLabel">Commentaires</h5>
                                        <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> 
                                    <div class="modal-body">
                                    
                                        <?php include('views/comments_post.view.php'); ?> <br>
                                    
                                        <div id="commentaires">
                                            <form action="comments_post.php?id=<?= $micropost->m_id ?>" method="post" data-parsley-validate>
                                                <textarea name="comment_micropost" id="comment_micropost<?=$micropost->m_id?>" cols="30" rows="2" placeholder="Laissez un commentaire..."></textarea>
                                                <input class="btn btn-success btn-sm" name="postcomment_micropost" type="submit" value="Envoyer">
                                            </form>
                                        </div>    
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> <br>

                               
                                <?php endforeach;?> 

                    <?php else  : ?>
                        <div class="card card-body  bg-dark text-white messagepost">

                            <div class="card card-text bg-dark shadow">

                                <div class="card-group text-white shadow col-md-12">
                                    <p>Encore rien de posté pour le moment...</p>
                                </div>    

                            </div>
                        </div>

                    <?php endif;?>        
                
            </div>
        </div>
       
    </div>
    

</div>

<?php include('partials/_footer.php');