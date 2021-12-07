<?php


	$userid = $_POST["User_ID"];
	$oldpass = $_POST["oldpass"];
	$newpass = $_POST["newpass"];
	$retype = $_POST["retypepass"];
	
	$retVal;

	if(isset($_POST['submit']))
	{
		
		$conn = mysqli_connect("localhost", "user", "password", "final"); 	
		if( $conn->connect_error )
		{
			$retVal = $conn->connect_error;
		}
		else if ($newpass != $retype)
		{
			$retVal = "Passwords don't match";
		}
		else
		{
			$result = mysqli_query($conn, "SELECT Password FROM Users WHERE User_ID = {$userid}");
			
			if ($row = mysqli_fetch_assoc($result))
			{
				if ($row["Password"] == $oldpass)
				{
					$result = mysqli_query($conn, "UPDATE Users SET Password = '{$newpass}' WHERE User_ID = {$userid}");
					$retVal =  "Password successfully changed";
				}
				else
				{
					$retVal =  "Old password incorrect";
				}
			}
			else
			{	
				$retVal =  "Error Occured";
			}
	
			$conn->close();
		}
	}
	
?>
