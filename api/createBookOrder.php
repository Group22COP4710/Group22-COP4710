<?php

	// $inData = getRequestInfo();

	$reqid = $_POST["Req_ID"];
	$title = $_POST["Title"];
	$ISBN = $_POST["ISBN"];
	$author = $_POST["Author"];
	$publisher = $_POST["Publisher"];
	$edition = $_POST["Edition"];
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$sql = "INSERT INTO bookOrder(Req_ID,Title,ISBN,Author,Publisher,Edition) 
		VALUES({$reqid},'{$title}','{$ISBN}','{$author}','{$publisher}','{$edition}')";
		$result = mysqli_query($conn, $sql);
		
		if ($result)
		{
			$sql = "SELECT Order_ID FROM bookOrder WHERE
			Req_ID={$reqid} AND Title='{$title}' AND ISBN='{$ISBN}' AND Author='{$author}' AND Publisher='{$publisher}' AND Edition='{$edition}'";
			$query = mysqli_query($conn, $sql);
			
			if ($row = mysqli_fetch_assoc($query))
			{
				//returnData($row["Order_ID"],$reqid,$title,$ISBN,$author,$publisher,$edition);
			}
			else
			{
				//returnError(500, "Error Occured");
			}
		}
		else
		{
			//returnError(500, "Invalid Request");
		}

		mysqli_close($conn);
	}
	
?>
