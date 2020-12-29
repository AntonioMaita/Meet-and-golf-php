<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Antonio Maita">
    
    <title>

        <?= isset($title) 
            ? $title.'- '.WEBSITE_NAME
            : WEBSITE_NAME.'-Simple Rapide Efficace !'
    
    
        ?>
            
    </title>

    

    

    <!-- Bootstrap core CSS -->
<!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
  
    
    <!-- Custom styles for this template -->
  <link rel="stylesheet" href="assets/css/main.css">
    
  </head>
  <body>

<?php include('partials/_nav.php'); ?>
<?php include('partials/_flash.php'); ?>