

<html>
<head>
	<title>COP 4710 Book Order Site</title>
    <link href="css/styles.css" rel="stylesheet">	
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body>

<section class="container grey-text">
        <h1 class="brand-logo brand-text center">COP 4710 Book Order Site</h1>
		<form class="white login-form" action="index.php" method="POST">
			<label>Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Password</label>
			<input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
			<div class="red-text"><?php echo $errors['password']; ?></div>
			<div class="center">
				<input type="submit" name="login" value="Login" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

</body>
</html>