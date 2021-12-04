<?php 
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	//Load Composer's autoloader
	require '../phpmailer/vendor/autoload.php';

    $email = '';
	$errors = array('email' => '');

    if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

        if(array_filter($errors)){
			// echo 'errors in form';
		} else {
			// echo 'form is valid';
            // echo $email;
            sendMailFunction($email);
			// header('Location: index.php');
		}	

	} // end POST check
	
	//Create an instance; passing `true` enables exceptions
	function sendMailFunction($resetEmail) {
		$mail = new PHPMailer();
		
		try {
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
            // $mail->addAddress('fecen71933@sinagalore.com');     //Add a recipient
            $mail->addAddress($resetEmail);     //Add a recipient

            $temp_password = randomPassword();
            $body_content = 'Hello there we have sent you a new temporary password. <br />Do not forget to reset your password after logging in. <br />Temporary password: ' . $temp_password . '<br />';
            

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Group 22 temporary password retrieval';
			$mail->Body    = $body_content;
			$mail->AltBody = strip_tags($body_content);
		
			$mail->send();
			// echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
  	}

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
?>

<html>
<head>
	<title>COP 4710 Book Order Site</title>
    <link href="../css/styles.css" rel="stylesheet">	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body class="grey lighten-4">

	<section class="container grey-text">
		<h1 class="brand-logo brand-text center">COP 4710 Book Order Site</h1>
        <hr>
		<h3 class="brand-logo brand-text center">Reset password?</h3>

		<form class="white login-form" action="forgot_password_page.php" method="POST">
			<label>Email</label>
			<input type="text" name="email" value="">
			<div class="red-text"><?php echo $errors['email']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="Send temp password" class="btn brand z-depth-0">
				<br /><br />

				<a href="../index.php" id="sign-up-link">Back to login</a>
			</div>
		</form>

		<div id="sign-up-div">

            

            
        </div>


	</section>

</body>
</html>