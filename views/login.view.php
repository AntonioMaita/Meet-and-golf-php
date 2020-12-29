<?php $title = "Connexion"; ?>
<?php include('partials/_header.php'); ?>

<div class="main-content">
    <main class="container">

        <h1 class="lead">Connexion</h1>
        
        <?php include('partials/_error.php'); ?>

        <form data-parsley-validate method="post" class="shadow-none p-3 col-md-6 col-md-offset-3 mb-5 bg-light rounded" autocomplete="off">

           
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

            <input type="submit" class="btn btn-primary" value="Connexion" name="login">

        </form>
    

    </main><!-- /.container -->

</div>

<?php include('partials/_footer.php'); ?>