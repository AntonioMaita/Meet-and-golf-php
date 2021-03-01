<?php
session_start();

require("includes/init.php");  

include('filters/guest_filter.php');

if(isset($_POST['email'])){
	$password = uniqid();
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$message = "<html>
					<body>
	 					<p style='font-size: 18px'><b>Bonjour, </b></p><br/>
	 					<p><i><b> Voici votre nouveau mot de passe : </b></i>".$password."</p><br/>
	 				</body>
	 			</html>";
	
	
	// "Bonjour, voici votre nouveau mot de passe : $password";
	$headers = "From: Meet and Golf <no-reply@meetadngolf.com> \n";
	$headers .='Content-Type: text/html; charset="utf-8"'."";
	$headers .= "Content-Transfer-Encoding: 8bit";

	if(mail($_POST['email'], 'Meet and Golf - Mot de passe oublié', $message, $headers)){
		// $sql = "UPDATE users SET password = ? WHERE email =?";
		$stmt = $db->prepare("UPDATE users SET password = ? WHERE email =?");
		$stmt->execute([$hashedPassword, $_POST['email']]);
		set_flash('Votre nouveau mot de passe a bien été envoyé', 'success');
		redirect('login.php');
	} else {
		set_flash('Une erreur est survenue', 'danger');
	}

	
}



  require ('views/mot_de_passe.view.php')
    ?>