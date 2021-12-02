<?php 

	
	$email = $password = '';
	$errors = array('email' => '', 'password' => '');
	$superAdmin = array('email' => 'demo@ucf.edu', 'password' => 'pass'); 
	

	if(isset($_POST['login'])){
		
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
		} else if ($_POST['email'] == $superAdmin['email'] && $_POST['password'] == $superAdmin['password']) {
			//echo 'form is valid';
			header('Location: ../homepage.php');
		} else {

		}

	} // end POST check

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