<?php

	$inData = getRequestInfo();

	$reqid = $inData["Req_ID"];
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$sql = "DELETE FROM bookOrder WHERE Req_ID = {$reqid}";
		$result = mysqli_query($conn, $sql);
		
		if ($result)
		{
			$sql = "DELETE FROM RequestForms WHERE Req_ID = {$reqid}";
			$result = mysqli_query($conn, $sql);
			if ($result)
			{
				returnError(200, "Deletion succesful");
			}
			else
			{
				//returnError(500, "Orders could not be deleted");
			}
		}
		else 
		{
			//returnError(500, "Form could not be deleted");
		}

		mysqli_close($conn);
	}
	
?>
