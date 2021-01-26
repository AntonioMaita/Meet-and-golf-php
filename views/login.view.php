<?php $title = "Connexion"; ?>
<?php include('partials/_header.php'); ?>

<div class="main-content">
    <main class="container">

        <h1 class="card lead col-md-6 shadow bg-secondary text-white">Connexion</h1>
        
        <?php include('partials/_error.php'); ?>

        <form data-parsley-validate method="post" class="shadow p-3 col-md-6 col-md-offset-3 mb-5 bg-light rounded login" autocomplete="off">

           
            <!-- Identifiant field -->
            <div class="form-group">
                <label class="control-label" for="identifiant">Pseudo ou adresse Email</label>
                <input type="text" value="<?= get_input('identifiant') ?>"class="form-control" id="identifiant" name="identifiant" required="required">
                
            </div>                      


            <!-- password field -->
            <div class="form-group">
                <label class="control-label" for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required="required">
                
            </div>

            <!-- Remember me -->
            <div class="form-group">
                <label class="control-label" for="remember_me">
                    <input type="checkbox" name="remember_me" id="remember_me">
                    Garder ma session active
                </label>
                
            </div> <br>           

            <input type="submit" class="btn btn-success" value="Connexion" name="login">

        </form>
       
    

    </main><!-- /.container -->

</div>

<?php include('partials/_footer.php'); ?>