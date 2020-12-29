<?php 

require('includes/functions.php');
session_start();
session_destroy();

$_SESSION = [];

redirect('login.php');

?>