<?php 
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	//Load Composer's autoloader
	require 'phpmailer/vendor/autoload.php';
	
	//Create an instance; passing `true` enables exceptions
	function sendMailFunction() {
		$mail = new PHPMailer();
		
		try {
			//Server settings for mailtrap, for testing emails
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			// $mail->isSMTP();
			// $mail->Host = 'smtp.mailtrap.io';
			// $mail->SMTPAuth = true;
			// $mail->Port = 2525;
			// $mail->Username = '0b7e907a283918';
			// $mail->Password = '7f01cd43972bd3';

			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Port = 587;
			// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Username = 'Group22COP4710@gmail.com';
			$mail->Password = 'c9ikDm0xHRk84Ad7';
		
			//Recipients
			$mail->setFrom('info@Group22.com', 'UCF');
			// temp email
			$mail->addAddress('bamadib229@simdpi.com');     //Add a recipient

			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');
		
			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
		
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Second subject';
			$mail->Body    = 'Hello there i am now secondass!<br />';
			$mail->AltBody = 'Hello there i am first';
		
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}


  	}


	if (isset($_GET['hello'])) {
		sendMailFunction();
	}


?>

<!DOCTYPE html>
<html>

<head>
	<title>Group 22 Book order website</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="../css/styles.css">

</head>
<body class="grey lighten-4">

	<?php include('pages/login_page.php'); ?>

	<?php include('templates/footer.php'); ?>
	

</html>