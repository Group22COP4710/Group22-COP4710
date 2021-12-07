<?php

	$oid= $_POST["oiddelete"];
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$sql = "DELETE FROM bookOrder WHERE Order_ID={$oid} AND Req_ID={$_COOKIE['Req_ID']}";
		$result = mysqli_query($conn, $sql);
		
		if ($result)
		{
			echo "Delete Successful";
		}

		mysqli_close($conn);
	}
	
?>
