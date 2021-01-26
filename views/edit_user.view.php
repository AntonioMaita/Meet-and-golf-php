<?php $title = "Edition du profil"; ?>
<?php include('partials/_header.php'); ?>



<div class="main-content">
    <div class="container">

        <div class="row">



            <?php if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')) : ?>
                                            
                    <div class="col-md-offset-3">

                        <div class="card shadow completeprofile">
                            <div class="card-header text-white bg-success mb-3 shadow">
                                <h3 class="card-title">Compléter le profil</h3>
                            </div>
                            <div class="card-body shadow">

                            <form class="card-header shadow" method="post" action="" enctype="multipart/form-data">
                                
                            <label for="file" style="margin-bottom: 0; margin-top: 5px;">
                               Avatar :
                            </label> <br>
                            
                            <div>
                                <?php  
                                    // $id = $_GET['id'];
                                    $q = $db->query("SELECT avatar from users where id = ".get_session('user_id'));
                                    $img = $q->fetch();
                                                                    
                                    if(!empty($img['avatar'])) {
                                                                                                                                   
                                ?>
                                <img class="rounded-circle img-thumbnail" src="assets/avatars/<?php echo $img['avatar'];?>" alt="avatar" width="150px" height="150px"/> <br>
                                    <?php } else { ?> 
                                <img class="rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="25%" >
                                    <?php } ?>
                                <input id="file" type="file" name="file" class="form-control" required/><br>
                                                              
                            </div>
                           
                                
                            <button class="btn btn-success" type="submit" name="avatar">Valider</button><br> <br>                      
                            
                                                       


                        </form><br>

                                <?php include('partials/_error.php') ?>
                                
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
                                                <label for="adress">Adresse<span class="text-danger">*</span></label>
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
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('partials/_footer.php'); ?>
        