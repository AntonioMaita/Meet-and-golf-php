<?php 

require('includes/functions.php');
session_start();

//supprimer entre en db au niveau de auth_tokens
require "config/database.php";
$q=$db->prepare('DELETE FROM auth_tokens WHERE user_id = ?');
$q->execute([$_SESSION['user_id']]);

//supprimer le cookie et detruire la session
setcookie('auth', '', time()-3600);
session_destroy();
$_SESSION = [];


redirect('login.php');


?>