<?php

	$inData = getRequestInfo();

	$oid= $inData["Order_ID"];
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	iif(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$sql = "DELETE FROM bookOrder WHERE Order_ID={$oid}";
		$result = mysqli_query($conn, $sql);
		
		if ($result)
		{
			returnError(200, "Delete Successful");
		}
		else
		{
			// returnError(500, "Invalid Request");
		}

		mysqli_close($conn);
	}
	
?>
