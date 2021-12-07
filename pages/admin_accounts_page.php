<?php

$usertype = $_POST["User_Type"];
$searchCount = 0;
$retArray = [];

include('../api/changePassword.php');

if($_POST['User_Type'] == 'All')
{
    
    

    include('../api/getUsers.php');

    // echo $searchCount;
    // print_r($retArray);

}

$email = $name = $password = '';
$errors = array('email' => '', 'name' => '', 'password' => '');
$creation = array('success' => '');


if(isset($_POST['createAdmin'])){
    // connect to the database
    $conn = mysqli_connect('localhost', 'user', 'password', 'final');
    
    // check email
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required';
    } else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    if(empty($_POST['name'])){
        $errors['name'] = 'An name is required';
    } else{
        $name = $_POST['name'];
    }

    if(empty($_POST['password'])){
        $errors['password'] = 'Password is required';
    } else{
        $password = $_POST['password'];
    }

    if(array_filter($errors)){
        // echo 'errors in form';
    } else {
        // echo 'form is valid';
        // echo $email . " " . $password;
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else{
            // echo 'connect successful';
            
            $sql = "INSERT INTO Users (email, Name, Password, User_Type) VALUES ('$email', '$name', '$password', 'Admin')";
    
            if (mysqli_query($conn, $sql)) {
                // echo "New record created successfully";
                $creation['success'] = 'Account created successfully';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }	

} // end POST check


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require '../phpmailer/vendor/autoload.php';
	
	function sendMailFunction() {
		$mail = new PHPMailer();
		
		try {
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Port = 587;

			$mail->Username = 'Group22COP4710@gmail.com';
			$mail->Password = 'c9ikDm0xHRk84Ad7';
		
			$mail->setFrom('info@Group22.com', 'UCF');

			$mail->addAddress($_POST['profemail']);     

		
			$mail->isHTML(true);                                  
			$mail->Subject = 'Reminder to submit book orders';
			$mail->Body    = "Book orders are due soon, log on or sign up at andregr.xyz/index.php to submit. <br />";
		
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}


  	}


	if (isset($_POST['profEmail'])) {
		sendMailFunction();
	}
?>

<!DOCTYPE html>
<html>
    

	<?php include('../templates/admin_header.php'); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    

    <div class="">
        <!-- Modal Trigger -->

        <section class="container grey-text accounts-page">
            <form class="white login-form" action="admin_accounts_page.php" method="POST">
                <div class="center">
                    <a class="waves-effect waves-light btn modal-trigger brand z-depth-0" href="#change-password-modal">
                    Change password
                    </a>
                </div>
                
                <br />

                <div class="center">
                    <a class="waves-effect waves-light btn modal-trigger brand z-depth-0" 
                        name="view-admin" href="#view-admin-modal">
                    View all faculty accounts
                    </a>
                </div>
                <input type="text" value="Admin" name="User_Type" style="display: none;">

                <br />

                <div class="center">
                    <a class="waves-effect waves-light btn modal-trigger brand z-depth-0" href="#create-admin-modal">
                    Create new admin account
                    </a>
                </div>
		
		<br />

                <div class="center">
                    <a class="waves-effect waves-light btn modal-trigger brand z-depth-0" href="#send-prof-modal">
                    Send Professor Reminder
                    </a>
                </div>
            </form>
            
            
        </section>
        
        <!-- Change Password Modal Structure -->
	<div id="change-password-modal" class="modal">
            <div class="modal-content grey-text">
                <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>Change Password</strong></h4>
				<hr>

		<form class="white login-form"  action="../pages/admin_accounts_page.php" method="POST">
                    <label>Old password</label>
                    <input type="text" name="oldpass" value="">
                    <div class="red-text"><?php echo $errors['password']; ?></div>
                    <label>New password</label>
                    <input type="text" name="newpass" value="">
                    <div class="red-text"><?php echo $errors['password']; ?></div>
                    <label>Retype new password</label>
                    <input type="text" name="retypepass" value="">
                    <div class="red-text"><?php echo $errors['password']; ?></div>
		    <input type="submit" name="submit" value="Apply" href="#!" style="margin-right: 10px;" class="modal-action 
                    modal-close waves-effect waves-green 
                    btn green lighten-1">
                </form>

            </div>
  
            <div class="modal-footer">
				
                <a href="#!" class="modal-action 
                    modal-close waves-effect 
                    btn brand lighten-1">
                    Cancel
                </a>
            </div>
        </div>

        <!-- View Faculty Modal Structure -->
        <div id="view-admin-modal" class="modal">
            <div class="modal-content grey-text">
                <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>Faculty accounts</strong></h4>
				<hr>
                <form class="login-form" action="admin_accounts_page.php" method="POST">
			<label></label>
                    <input type="submit" name="User_Type" value="All">

                </form>

                <ul>
                <?php foreach($retArray as $item => $preVal){ ?>
                    
                    <?php foreach($preVal as $key => $value){ ?>

                        <li><h5>
                        <?php
                            echo $key . ": ";
                            echo $value; ?>
                        <h5></li>

                    <?php } ?>

                    <?php echo '<br/>'; ?>
                <?php } ?>
                </ul>
                




            </div>
  
            <div class="modal-footer">
				<a href="#!" style="margin-right: 10px;" class="modal-action 
                    modal-close waves-effect waves-green 
                    btn green lighten-1">
                    Apply changes
                </a>

                <a href="#!" class="modal-action 
                    modal-close waves-effect 
                    btn brand lighten-1">
                    Cancel
                </a>
            </div>
        </div>

        <!-- Create Admin Modal Structure -->
        <div id="send-prof-modal" class="modal">
            <div class="modal-content grey-text">
                <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>Send professor email</strong></h4>
				<hr>

                <form class="white login-form" action="../pages/admin_accounts_page.php" method="POST">
                    <label>Email</label>
                    <input type="text" name="profemail" value="">
                    <div class="red-text"><?php echo $errors['email']; ?></div>

                    <div class="center">
                        <div class="green-text"><?php echo $creation['success']; ?></div>
                    </div>

                    <div class="modal-footer">
                        
                        <input type="submit" name="profEmail" value="Professor Email" class="btn brand z-depth-0">
        

                        <a href="#!" class="modal-action 
                            modal-close waves-effect 
                            btn brand lighten-1">
                            Close
                        </a>
                    </div>
                </form>
            </div>
  
            
        </div>
		
		 <!-- Send Create Admin Structure -->
		<div id="create-admin-modal" class="modal">
            <div class="modal-content grey-text">
                <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>Create admin account</strong></h4>
				<hr>

                <form class="white login-form" action="admin_accounts_page.php" method="POST">
                    <label>Email</label>
                    <input type="text" name="email" value="">
                    <div class="red-text"><?php echo $errors['email']; ?></div>
                    <label>Name</label>
                    <input type="text" name="name" value="">
                    <div class="red-text"><?php echo $errors['name']; ?></div>
                    <label>Password</label>
                    <input type="text" name="password" value="">
                    <div class="red-text"><?php echo $errors['password']; ?></div>

                    <div class="center">
                        <div class="green-text"><?php echo $creation['success']; ?></div>
                    </div>

                    <div class="modal-footer">
                        
                        <input type="submit" name="createAdmin" value="Create admin" class="btn brand z-depth-0">
        

                        <a href="#!" class="modal-action 
                            modal-close waves-effect 
                            btn brand lighten-1">
                            Close
                        </a>
                    </div>
                </form>
            </div>
  
            
        </div>
    </div>

	<script>
        $(document).ready(function () {
            $('.modal').modal();
        }
        )
    </script>

	<?php include('../templates/footer.php'); ?>

</html>
