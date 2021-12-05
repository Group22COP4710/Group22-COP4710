<?php
    $email = $name = $password = '';
    $errors = array('email' => '', 'name' => '', 'password' => '');
    $creation = array('success' => '');

    // connect to the database
	$conn = mysqli_connect('localhost', 'user', 'password', 'final');

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

        if(empty($_POST['name'])){
            $errors['name'] = 'An name is required';
        } else{
            $name = $_POST['name'];
            if(!filter_var($name, FILTER_VALIDATE_EMAIL)){
                $errors['name'] = 'Email must be a valid name address';
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
            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            else{
                echo 'connect successful';
                
                $sql = "INSERT INTO Users (email, Name, Password, User_Type) VALUES ('$email', '$name', '$password', 'Professor')";
        
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
		<h3 class="brand-logo brand-text center">Create new account</h3>

		<form class="white login-form" action="sign_up_page.php" method="POST">
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
				<input type="submit" name="submit" value="Create account" class="btn brand z-depth-0">
				<br /><br />

				<a href="../index.php" id="sign-up-link">Back to login</a>
			</div>
		</form>
	</section>

</body>
</html>