<?php $title = "Inscription"; ?>
<?php include('partials/_header.php'); ?>

<div class="main-content">
    <main class="container">

        <h1 class="lead shadow p-3 col-md-6">Devenez dés à présent membre ! </h1>
        
        <?php include('partials/_error.php'); ?>

        <form data-parsley-validate method="post" class="shadow p-3 col-md-6 col-md-offset-3 mb-5 bg-light rounded" autocomplete="off">

            <!-- Name field -->
            <div class="form-group">
                <label class="control-label" for="name">Nom:</label>
                <input type="text" value="<?= get_input('name') ?>" class="form-control" id="name" name="name" required="required">
                
            </div>

            <!-- Pseudo field -->
            <div class="form-group">
                <label class="control-label" for="pseudo">Pseudo:</label>
                <input type="text" data-parsley-minlength="3" value="<?= get_input('pseudo') ?>"class="form-control" id="pseudo" name="pseudo" required="required">
                
            </div>

            <!-- email field -->
            <div class="form-group">
                <label class="control-label" for="email">Email:</label>
                <input type="email" data-parsley-trigger="change" value="<?= get_input('email') ?>"class="form-control" id="email" name="email" required="required">
                
            </div>

           
            <!-- password field -->
            <div class="form-group">
                <label class="control-label" for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required="required">
                
            </div>

            <!-- password confiramtion field -->
            <div class="form-group">
                <label class="control-label" for="password">confirmer votre mot de passe:</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required="required" data-parsley-equalto="#password">
                
            </div><br>

            <input type="submit" class="btn btn-success" value="Inscription" name="register">



        </form>

    

    </main><!-- /.container -->

</div>

<?php include('partials/_footer.php'); ?>


    