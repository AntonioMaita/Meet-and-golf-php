<?php $title = "Page de profil"; ?>
<?php include('partials/_header.php'); ?>



<div class="main-content">
    <div class="container">

        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header text-white bg-success mb-3">
                        <h3 class="card-title">Profil de <?=e($user->pseudo)?></h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                                
                            <label for="file" style="margin-bottom: 0; margin-top: 5px;">
                               Avatar :
                            </label> <br> <br>
                            
                            <div>
                                <?php  
                                 $id = $_GET['id'];
                                 $q = $db->query("SELECT avatar from users where id = $id");
                                 $img = $q->fetch();
                                 
                                //  echo $img['avatar'];

                                if(!empty($img['avatar'])) {
                                                                                                                                   
                                ?>
                                <img src="assets/avatars/<?php echo $img['avatar'];?>" alt="" width="100px" height="100px"/> <br> <br>
                                    <?php } else { 
                                        ?> <img src="assets/avatars/defaults/default.png" alt="" width="100px" height="100px">
                                    <?php    }
                                        
                                    
                                    ?>
                                                              
                            </div>
                            <input  class="custom-file-input" id="file" type="file" name="file" required/><br><br>
                                
                            <button class="btn btn-success" type="submit" name="avatar" value="Envoyer">Valider </button><br> <br>
                            
                            <?php header("Cache-Control: no-cache, must-revalidate"); ?>
                           


                        </form><br>
                        <div class="row">
                            <div class="col-md-6">
                                <strong><?=e($user->pseudo) ?></strong> <br>
                                <a href="mailto:<?= e($user->email)?>"><?= e($user->email)?></a>
                            </div>

                        </div>
                       
                    </div>
                </div>    

            </div>

            <div class="col-md-6">

                <div class="card">
                    <div class="card-header text-white bg-success mb-3">
                        <h3 class="card-title">Completer le profil</h3>
                    </div>
                    <div class="card-body">

                        <?php include('partials/_error.php'); ?>

                        <form method="post" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nom<span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                                required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">Ville<span class="text-danger">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Pays<span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="country" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sex">Sexe<span class="text-danger">*</span></label>
                                        <select name="sex" id="sex" class="form-control">
                                            <option value="H">Homme</option>
                                            <option value="F">Femme</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="club">Votre club de golf</label>
                                        <input type="text" name="club" id="club" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bio">Votre Biographie</label>
                                        <textarea name="bio" id="bio" cols="30" row="10" placeholder="Entrez votre biographie" class="form-control"></textarea><br>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Valider" name="update">

                        </form>
                    
                    </div>
               
                </div>
            </div>    

        </div>

    </div>                
    

</div><!-- /.container -->



<?php include('partials/_footer.php'); ?>