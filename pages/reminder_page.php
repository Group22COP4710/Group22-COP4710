<?php
    $email = $password = '';
    $errors = array('email' => '', 'password' => '');
    $creation = array('success' => '');

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

        if(empty($_POST['password'])){
            $errors['password'] = 'Password is required';
        } else{
            $password = $_POST['password'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Password must follow restrictions';
            }
        }

        if(array_filter($errors)){
            // echo 'errors in form';
        } else {
            // echo 'form is valid';
            echo $email . " " . $password;
            $creation['success'] = 'Account created successfully';
            // header('Location: index.php');
        }	

    } // end POST check
?>

<html>
<head>
    <link href="../css/styles.css" rel="stylesheet">	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body class="grey lighten-4">
    
	<section class="container grey-text" style="display: flex;">
		<form class="white login-form" action="sign_up_page.php" method="POST">
            <h3 class="brand-logo brand-text center">Set deadline date</h3>
            <hr style="margin-bottom: 15px; border-top: 3px solid;">

			<label>Deadline date (mm/dd/yyyy)</label>
			<input type="text" name="deadline" value="">
			<div class="red-text"><?php echo $errors['deadline']; ?></div>

			<div class="center">
                <div class="green-text"><?php echo $creation['success']; ?></div>
				<input type="submit" name="submit" value="Set deadline" class="btn brand z-depth-0">
				<br />
                <br />

			</div>
		</form>

	</section>

</body>
</html>