<?php


	$userid = $_COOKIE["User"]["User_ID"];
	$oldpass = $_POST["oldpass"];
	$newpass = $_POST["newpass"];
	$retype = $_POST["retypepass"];
	
	$retVal;

	if(isset($_POST['submit']))
	{
		
		$conn = mysqli_connect("localhost", "user", "password", "final"); 	
		if( $mess = mysqli_connect_error() )
		{
			$mess = $conn->connect_error;
		}
		else if ($newpass != $retype)
		{
			$mess = "Passwords don't match";
		}
		else
		{
			$result = mysqli_query($conn, "SELECT Password FROM Users WHERE User_ID = {$userid}");
			
			if ($row = mysqli_fetch_assoc($result))
			{
				if ($row["Password"] == $oldpass)
				{
					$result = mysqli_query($conn, "UPDATE Users SET Password = '{$newpass}' WHERE User_ID = {$userid}");
					$mess =  "Password successfully changed";
				}
				else
				{
					$mess =  "Old password incorrect";
				}
			}
			else
			{	
				$mess =  "Error Occured";
			}
	
			$conn->close();
		}
	}
	
?>
