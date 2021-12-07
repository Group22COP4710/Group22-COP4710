<?php



	$deadline = $_POST["deadline"];
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if($error = mysqli_connect_error() )
	{
		echo $error;
	}
	else
	{
		$result = mysqli_query($conn, "UPDATE Semester SET Deadline = '{$deadline}' WHERE Current = true");
		
		if ($result)
		{
			echo "Deadline set for {$deadline}";
		}
		else
		{
			echo "Process Failed";
		}

	}
	setcookie("Deadline",$deadline, time()+3600, '/');
	header('Location: ../admin_homepage.php');
	
?>
