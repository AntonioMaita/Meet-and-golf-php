<?php $title = "Changer de mot de passe"; ?>
<?php include('partials/_header.php'); ?>

<div class="main-content">
    <main class="container"> 

        <h1 class="card lead col-md-6 shadow bg-secondary text-white">Changer le mot de passe</h1>
        
        <?php include('partials/_error.php'); ?>

        <form data-parsley-validate method="post" class="shadow p-3 col-md-6 col-md-offset-3 mb-5 bg-light changePassword" autocomplete="off">

           
            <!-- mot de passe actuel -->
            <div class="form-group">
                <label class="control-label" for="current_password">Mot de passe actuel<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="current_password" name="current_password" required="required">
                
            </div>                      


            <!-- nouveau mot de passe -->
            <div class="form-group">
                <label class="control-label" for="new_password">Nouveau mot de passe<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="new_password" name="new_password" required="required" data-parsley-minlength="6">
                
            </div>

            <!-- confimer nouveau mot de passe -->
            <div class="form-group">
                <label class="control-label" for="new_password_confirmation">Confirmer votre nouveau mot de passe<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required="required" data-parsley-equalto="#new_password">
                
            </div> <br>           

            <input type="submit" class="btn btn-success" value="Changer le mot de passe" name="change_password">

        </form>            
    

    </main><!-- /.container -->

</div>

<?php include('partials/_footer.php'); ?>