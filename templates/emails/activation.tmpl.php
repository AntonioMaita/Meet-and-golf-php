<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
</head>
<body>
    <div class="row">
        <div class="card shadow">
            <h1>Activation du compte !</h1>
            <h4>Merci de vous être enregistré sur Meet and Golf. J'espère que votre navigation ce passera bien.</h4> 
            <p>Pour activer votre compte veuillez cliquez sur le lien suivant:</p> 
            <a href="<?= WEBSITE_URL.'/activation.php?p='.$pseudo.'&amp;token='.$token ?>">Lien d'activation</a>
        </div>
    </div>
    
</body>
</html>