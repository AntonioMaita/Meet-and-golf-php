<?php $title = "Page de profil"; ?>
<?php include('partials/_header.php'); ?>



<div class="main-content">
    <div class="container">

        <div class="row">
            <div class=" col-md-6">

                <div class="card shadow profile">
                    <div class="card-header text-white bg-success mb-3 shadow ">
                        <h3 class="card-title">Profil de <?=e($user->pseudo)?></h3>
                    </div>
                    <div class="card-body shadow">
                        <div>
                            <?php  
                                // $id = $_GET['id'];
                                $q = $db->query("SELECT avatar from users where id = ".$_GET['id']);
                                $img = $q->fetch();
                                                               
                                if(!empty($img['avatar'])) {
                                                                                                                            
                            ?>
                            <img class="rounded-circle img-thumbnail" src="assets/avatars/<?php echo $img['avatar'];?>" alt="avatar" width="150px" height="150px"  /><br><br>
                                <?php } else { ?> 
                            <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="25%" >
                                <?php } ?>
                                                                
                        </div>

                    
                        

                        <div class="row">
                            <div class="col-sm-6 shadow">
                                <strong><?=e($user->name) ?></strong> <br>
                                <a href="mailto:<?= e($user->email)?>"><?= e($user->email)?></a>
                            </div>
                            
                            <div class="col-sm-6 shadow">
                                <h6>Club de golf</h6>
                                <?= 
                                   e($user->club) ? '<i class="fas fa-golf-ball"></i>&nbsp;'.e($user->club) : '';
                                ?> <br>
                                <a href="https://google.com/maps?q=<?= e($user->club)?>" target="_blank">Voir sur Google Maps </a>
                                
                                 <br> <br>
                            </div> <br> <br>
                            
                            <div class="col-sm-6 shadow" >                                
                                <h6>Adresse, Ville et pays</h6>
                                <?= 
                                    e($user->adress) && e($user->city) &&  e($user->country) ? '<i class="fas fa-map-marker-alt"></i>&nbsp;'.e($user->adress). ' - '.e($user->city) . ' - ' .e($user->country) : '';
                                ?>
                                <br>
                                <a href="https://google.com/maps?q=<?= e($user->adress). ' '.e($user->city) . ' ' .e($user->country)?>" target="_blank">Voir sur Google Maps </a>
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
                                    <textarea name="content" id="content" cols="20" row="40" placeholder="Entrez votre status"
                                        class="form-control" required="required"></textarea><br>

                                    <input type="submit" class="btn btn-success btn-sm float-end" value="Publier" name="publish" >  <br> <br>
                                </form>
                            </div>

                        </div>

                </div>
                <?php endif ?>

                <div class="card card-body  bg-dark text-white messagepost">                
                                

                    <div class="card card-text bg-dark shadow">
                        
                        <div class="card-group text-white bg-secondary shadow col-md-12">
                            <?php if(!empty($img['avatar'])) {
                                                                                                                                        
                            ?>
                            <img class="rounded-circle" src="assets/avatars/<?php echo $img['avatar'];?>" alt="avatar" width="40px" height="40px"  />
                                <?php } else { ?> 
                            <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="40px" height="40px" >
                                <?php } ?>
                                <p><?=e($user->pseudo)?> le <?=e($user->created_at)?></p>
                        </div> <br>
                            <p>Blabla</p>
                    </div>
                </div>
            </div>              

        </div>

    </div>                
    

</div><!-- /.container -->


<?php include('partials/_footer.php'); ?>