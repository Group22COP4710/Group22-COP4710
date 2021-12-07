<?php 
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	//Load Composer's autoloader
	require '../phpmailer/vendor/autoload.php';


    // get an array of all the professors
    $emailArray=[];
    $conn = mysqli_connect('localhost', 'user', 'password', 'final');
	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$sql = "SELECT email FROM Users WHERE User_Type='Professor';";
		$result = mysqli_query($conn, $sql);
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$emails = $row['email'];

			array_push($emailArray, $emails);
        }
		
		mysqli_close($conn);
	}

    // Loop through professor array and send reminder email
    foreach($emailArray as $reminderEmail)
    {
        sendRemindMailFunction($reminderEmail,$deadlineStatus);
    }


	
	//Create an instance; passing `true` enables exceptions
	function sendRemindMailFunction($reminderEmail, $deadlineStatus) {
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
            $mail->addAddress($reminderEmail);     //Add a recipient

            $body_content = 'Reminder: Order forms must be in by <br />' . $deadlineStatus . '<br />';
            

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Group 22 deadline reminder';
			$mail->Body    = $body_content;
			$mail->AltBody = strip_tags($body_content);
		
			$mail->send();
			// echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
  	}
?>