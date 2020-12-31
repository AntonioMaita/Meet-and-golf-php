<?php $title = "Page de profil"; ?>
<?php include('partials/_header.php'); ?>



<div class="main-content">
    <div class="container">

        <div class="row">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header text-white bg-success mb-3 shadow ">
                        <h3 class="card-title">Profil de <?=e($user->pseudo)?></h3>
                    </div>
                    <div class="card-body shadow">
                        <form class="card-header shadow" method="post" action="" enctype="multipart/form-data">
                                
                            <label for="file" style="margin-bottom: 0; margin-top: 5px;">
                               Avatar :
                            </label> <br> <br>
                            
                            <div>
                                <?php  
                                    // $id = $_GET['id'];
                                    $q = $db->query("SELECT avatar from users where id = ".get_session('user_id'));
                                    $img = $q->fetch();
                                                                    
                                    if(!empty($img['avatar'])) {
                                                                                                                                   
                                ?>
                                <img class="rounded-circle" src="assets/avatars/<?php echo $img['avatar'];?>" alt="avatar" width="25%" height="150px"  /> <br> <br>
                                    <?php } else { ?> 
                                <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="25%" >
                                    <?php } ?>
                                                              
                            </div>
                            <input  class="custom-file-input" id="file" type="file" name="file" required/><br><br>
                                
                            <button class="btn btn-success" type="submit" name="avatar">Valider</button><br> <br>
                            
                            
                                                       


                        </form><br>

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

                <div class="card shadow">
                    <div class="card-header text-white bg-success mb-3 shadow">
                        <h3 class="card-title">Completer le profil</h3>
                    </div>
                    <div class="card-body shadow">

                        <?php include('partials/_error.php'); ?>

                        <form data-parsley-validate method="post" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nom<span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                                required="required" value="<?= get_input('name')  ?: e($user->name)?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">Ville<span class="text-danger">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control"
                                         required="required" value="<?=get_input('city')  ?: e($user->city)?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label for="country">Pays<span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="country" class="form-control"
                                         required="required" value="<?= get_input('country')  ?: e($user->country)?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adress">Adresse</label>
                                        <input type="text" name="adress" id="adress" class="form-control"
                                          value="<?=get_input('adress')  ?: e($user->adress)?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <label for="sex">Sexe<span class="text-danger">*</span></label>
                                        <select required="required" name="sex" id="sex" class="form-control">
                                            <option value="null">Veuillez selectionner votre sexe</option>
                                            <option value="H" <?= $user->sex == "H" ? "selected" : "" ?>>Homme</option>
                                            <option value="F" <?= $user->sex == "F" ? "selected" : "" ?>>Femme</option>
                                            <option value="X" <?= $user->sex == "X" ? "selected" : "" ?>>X</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="club">Votre club de golf<span class="text-danger">*</span></label>
                                        <input type="text" name="club" id="club" class="form-control" 
                                        required="required" value="<?=get_input('club')  ?: e($user->club)?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bio">Votre Biographie<span class="text-danger">*</span></label>
                                        <textarea name="bio" id="bio" cols="30" row="10" placeholder="Entrez votre biographie"
                                         class="form-control" required="required"><?= get_input('bio')  ?: e($user->bio)?></textarea><br>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" value="Valider" name="update" >
                            

                        </form>
                    
                    </div>
               
                </div>
            </div>    

        </div>

    </div>                
    

</div><!-- /.container -->


<?php include('partials/_footer.php'); ?>