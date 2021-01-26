
<?php $title = "Accueil"; ?>

<?php include('partials/_header.php'); ?>

<div class="main-content ">
    <main class="container">

    <div id="index" class="shadow p-3 mb-5 text-center py-5 px-2  bg-dark text-white">
        <h1><?= WEBSITE_NAME;?>  est le réseau social des golfeurs amateur et professionnel</h1>
        <p class="lead" >Grâce à cette plateforme, vous avez la possibilité de tisser des liens d'amitier avec d'autres golfeurs, échanger des événements, recevoir de l'aide de connaisseurs si vous rencontrez des difficultés à votre apprentissage et bien plus encore. ⛳ <br>Alors n'hesitez plus et <a href="register.php">rejoignez la communauté <?= WEBSITE_NAME;?></a>! 🏌🏿‍♂️</p>
        <a href="register.php" class="btn btn-success btn-lg">Créer un compte</a>
    </div>

    </main><!-- /.container -->

</div>

<?php include('partials/_footer.php'); ?>
  
