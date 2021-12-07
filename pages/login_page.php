<?php 


	$email = $password = '';
	$errors = array('email' => '', 'password' => '');
	$superAdmin = array('email' => 'demo@ucf.edu', 'password' => 'pass'); 


	if(isset($_POST['submit'])){

		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} 
		// else{
		// 	$email = $_POST['email'];
		// 	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		// 		$errors['email'] = 'Email must be a valid email address';
		// 	}
		// }


		// check password
		if(empty($_POST['password'])){
			$errors['password'] = 'A password is required';
		}
		// else{
		// 	$title = $_POST['password'];
		// 	if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
		// 		$errors['password'] = 'Password must be letters and spaces only';
		// 	}
		// }


		if(array_filter($errors)){
			echo 'errors in form';
		} else {
			include('../api/login.php');
			include('../api/getCurrentSemester.php');
			
			session_start();
			
			$_SESSION["User"]=$retVal;
			$_SESSION["Semeseter"]=$semester;
			
			if ($retVal["User_Type"] == 'Admin' || $retVal["User_Type"] == 'Super_Admin') {
				header('Location: ../admin_homepage.php');
			}
			else if ($retVal["User_Type"] == 'Professor'){
				header('Location: ../homepage.php');
			}
			else {
				echo $retVal["Error"];	
			}
		}

	} // end POST check

?>

<html>
<head>
	<title>COP 4710 Book Order Site</title>
    <link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body>

	<section class="container grey-text">
		<h1 class="brand-logo brand-text center">COP 4710 Book Order Site</h1>
		<form class="white login-form" action="/pages/login_page.php" method="POST">
			<label>Email</label>
			<input type="text" name="email" value="">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Password</label>
			<input type="text" name="password" value="">
			<div class="red-text"><?php echo $errors['password']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="login" class="btn brand z-depth-0">
				<br /><br />

				<a href="pages/sign_up_page.php" id="sign-up-link" style="margin-right: 20px;">New here? Sign up</a>
				<a href="pages/forgot_password_page.php" id="sign-up-link">Forgot password?</a>
			</div>
		</form>
	</section>

</body>
</html>
