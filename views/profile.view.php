<?php $title = "Page de profil"; ?>
<?php include('partials/_header.php'); ?>


<div class="main-content">
    <div class="container">

        <div class="row">
            
            <div class=" col-md-6">
                
                <div class="card shadow profile">
                    <div class="card-header text-white bg-success mb-3 shadow ">
                        
                        <h3 class="card-title">Profil de <?=e($user->pseudo)?> 
                        <a class=" text-dark <?= set_active('edit_user')?>" href="edit_user.php?id=<?=get_session('user_id')?>"><i class="fas fa-user-edit"></i> </a>
                        <a class ="text-white" href="list_contact.php?id=<?=$_GET['id']?>"><p class=" card-text float-end">(<?=friends_count($_GET['id'])?> ami<?=friends_count($_GET['id']) <= 1 ? '' : 's'?>)</p></a>
                        
                        </h3>
                        
                    </div>
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col-md-6">
                                <?php  
                                    // $id = $_GET['id'];
                                    $q = $db->query("SELECT avatar from users where id = ".$_GET['id']);
                                    $img = $q->fetch();
                                                             
                                    if(!empty($img['avatar'])) {
                                                                                                                                
                                ?>
                                <img class="rounded-circle float-start" src="assets/avatars/<?php echo $img['avatar'];?>" alt="avatar" width="200px" height="200px"  />
                                    <?php } else { ?> 
                                <img class="rounded-circle float-start" src="assets/avatars/defaults/default.png" alt="default" width="25%" >
                                    <?php } ?>                                    
                                                                    
                            </div>
                            <div class="col-xl-6 ">
                                <?php if(!empty($_GET['id']) && $_GET['id'] !== get_session('user_id') ): ?> 
                                                          
                                    <?php if(relation_link_to_display($_GET['id']) == "cancel_relation_link") :?>
                                        <p>Demande d'ami a déjà été envoyée. <a class="btn btn-danger btn-sm" href="delete_friend.php?id=<?=$_GET['id'] ?>">Annuler la demande</a> </p>
                                    
                                    <?php elseif(relation_link_to_display($_GET['id']) == "accept_reject_relation_link") :?>
                                            Accepter ou refuser la demande d'ami.
                                        <a class="btn btn-success btn-sm" href="accept_friend_request.php?id=<?=$_GET['id'] ?>">Accepter</a>
                                        <a class="btn btn-danger btn-sm" href="delete_friend.php?id=<?=$_GET['id'] ?>">Refuser</a>
                                    
                                    <?php elseif(relation_link_to_display($_GET['id']) == "delete_relation_link") :?>
                                        Vous êtes déjà ami.
                                        <a class="btn btn-danger btn-sm float-end" href="delete_friend.php?id=<?=$_GET['id'] ?>">Retirer de ma liste d'amis.</a>

                                    <?php  elseif(relation_link_to_display($_GET['id']) == "add_relation_link") : ?>
                                        <a href="add_friend.php?id=<?=$_GET['id'] ?>" class="btn btn-success btn-sm float-end ">
                                        <i class="fa fa-plus"></i> Ajouter comme ami</a>
                                        
                                        <?php endif; ?>
                                        
                                    <?php endif; ?>                                                                   
                                

                            </div>
                        </div>
                        

                    
                        

                        <div class="row">
                            <div class="col-sm-6 shadow">
                                <strong><?=e($user->name) ?></strong> <br>
                                <a class="btn btn-success btn-sm" href="mailto:<?= e($user->email)?>"><?= e($user->email)?></a>
                            </div>
                            
                            <div class="col-sm-6 shadow">
                                <h6>Club de golf</h6>
                                <?= 
                                   e($user->club) ? '<i class="fas fa-golf-ball"></i>&nbsp;'.e($user->club) : '';
                                ?> <br>
                                <a class="btn btn-sm" href="https://google.com/maps?q=<?= e($user->club)?>" target="_blank">Voir sur Google Maps </a>
                                
                                 <br> <br>
                            </div> <br> <br>
                            
                            <div class="col-sm-6 shadow" >                                
                                <h6>Adresse, Ville et pays</h6>
                                <?= 
                                    e($user->adress) && e($user->city) &&  e($user->country) ? '<i class="fas fa-map-marker-alt"></i>&nbsp;'.e($user->adress). ' - '.e($user->city) . ' - ' .e($user->country) : '';
                                ?>
                                <br>
                                <a class="btn btn-sm" href="https://google.com/maps?q=<?= e($user->adress). ' '.e($user->city) . ' ' .e($user->country)?>" target="_blank">Voir sur Google Maps </a>
                                <br> <br>    
                            </div>                    
                            
                            
                            <div class="col-sm-6 shadow">
                                <h6>Genre</h6>
                                <?php 
                                    if ($user->sex == "H") {
                                        echo ' <h2><i class="fas fa-male"></i></h2>';
                                     } 
                                    
                                    if($user->sex == "F") {
                                        echo '<h2><i class="fas fa-female"></i></h2>';
                                     } 
                                    
                                    if ($user->sex == "X") {
                                       echo '<h2><i class="fas fa-transgender"></i></h2>';
                                     }
                                    
                                ?>
                                
                                 <br> <br>
                            </div>

                            <div class="col-md-12 shadow">
                                <h6>Biographie de <?=e($user->pseudo)?></h6>
                                <?= 
                                    e($user->bio) ? '<i class="fas fa-book-reader"></i>&nbsp;'.nl2br(e($user->bio)) : 'Aucune biographie';
                                ?>
                                
                                 <br> <br>
                            </div>

                            

                        </div>
                                               
                    </div>
                    
                </div> <br>  
                <div>
                <a class="card nav-link" href="messagerie.php?id=<?=get_session('user_id')?>">Messagerie</a>         
                </div>
                <div class="card shadow profile">
                                <div class="card-header text-white bg-success mb-3 shadow ">
                                     <h5 class="lead">cela pourrait vous intéresser</h5>
                                </div>                            
                </div> 

            </div>            

            <div class="col-md-6">
                <?php if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')) :?>
                <div class="card shadow profile">
                        <div class="card-header text-white bg-success mb-3 shadow ">
                            <h3 class="card-title">Status de  <?=e($user->pseudo)?></h3>
                        </div>
                        <div class="card-body shadow">
                            <div class="form-group">
                                <form action="micropost.php" method="post" data-parsley-validate>
                                    <br> <br>
                                    <textarea name="content" id="content" cols="20" rows="5" placeholder="Entrez votre status"
                                        class="form-control" required="required" data-parsley-maxlength="250"></textarea><br>

                                    <input type="submit" class="btn btn-success btn-sm float-end" value="Publier" name="publish" >  <br> <br>
                                
                                </form>
                                
                            </div>
                            

                        </div>

                </div>
                <?php endif ;?>  

                <?php  if (current_user_is_friend_with($_GET['id'])) : ?>              
                <?php if(count($microposts) !=0): ?>   
                    <?php foreach($microposts as $micropost): ?>                     
                 
                        <?php include('partials/_micropost.php'); ?> <br>                
                        
                    
                    <?php endforeach ;?>
                    
                    
                <?php else:  ?>

                    <div class="card card-body  bg-dark text-white messagepost">

                        <div class="card card-text bg-dark shadow">

                            <div class="card-group text-white shadow col-md-12">
                                <p>Encore rien de posté pour le moment...</p>
                            </div>    

                        </div>
                    </div>
                    
                <?php endif;?>
                <?php endif;?>

                
            </div>              

        </div>

    </div>                
    

</div><!-- /.container -->


<?php include('partials/_footer.php'); ?>