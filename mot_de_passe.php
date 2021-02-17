<?php
session_start();

require("includes/init.php");  

include('filters/guest_filter.php');

if(isset($_POST['email'])){
	$password = uniqid();
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$message = "Bonjour, voici votre nouveau mot de passe : $password";
	$header = "From: Meet and Golf <no-reply@meetadngolf.com> \n";
	$headers .='Content-Type: text/html; charset="utf-8"'."";

	if(mail($_POST['email'], 'Mot de passe oublié', $message, $headers)){
		$sql = "UPDATE users SET password = ? WHERE email =?";
		$stmt = $db->prepare($sql);
		$stmt->execute([$hashedPassword, $_POST['email']]);
		set_flash('Mail envoyé', 'success');
		redirect('login.php');
	} else {
		set_flash('Une erreur est survenue', 'danger');
	}

	
}



  require ('views/mot_de_passe.view.php')
    ?>