<?php

	$admin_id= $_POST["adminID_Delete"];
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$sql = "DELETE FROM Users WHERE User_Type = 'Admin' AND User_ID={$admin_id}";
		$result = mysqli_query($conn, $sql);
		
		if ($result)
		{
			echo "Delete Successful";
		}

		mysqli_close($conn);
	}
	
?>
