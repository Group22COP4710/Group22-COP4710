<?php
	$conn = mysqli_connect('localhost', 'user', 'password', 'final');


	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
    	else{
        	echo 'connect successful';
    	}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body class="">
    
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
				<br /><br />
                <hr style="border-top: 1px dashed grey;">
                <br />
			</div>

            <div class="center">
                <a class="btn modal-trigger brand z-depth-0" href="#view-forms-modal">
                View all forms
                </a>
            </div>
		</form>
        

	</section>

    

    <!-- View Forms Modal Structure -->
    <div id="view-forms-modal" class="modal">
        <div class="modal-content grey-text">
            <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>All book order forms</strong></h4>
            <hr>

        </div>

        <div class="modal-footer">
            <a href="#!" style="margin-right: 10px;" class="modal-action 
                modal-close waves-effect waves-green 
                btn green lighten-1">
                Finalize orders
            </a>

            <a href="#!" class="modal-action 
                modal-close btn brand lighten-1">
                Close
            </a>
        </div>
    </div>

</body>

    <script>
        $(document).ready(function () {
            $('.modal').modal();
        }
        )
    </script>
</html>
