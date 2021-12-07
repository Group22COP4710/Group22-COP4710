<?php

	$inData = getRequestInfo();

	$oid= $inData["Order_ID"];
	$title = $inData["Title"];
	$ISBN = $inData["ISBN"];
	$author = $inData["Author"];
	$publisher = $inData["Publisher"];
	$edition = $inData["Edition"];
	
	$conn = mysqli_connect('localhost', 'user', 'password', 'final');
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$sql = "UPDATE bookOrder SET Title='{$title}',ISBN='{$ISBN}',Author='{$author}',
		Publisher='{$publisher}',Edition='{$edition}' 
		WHERE Order_ID={$oid}";
		$result = mysqli_query($conn, $sql);
		
		if ($result)
		{
			//returnData($oid,$title,$ISBN,$author,$publisher,$edition);
		}
		else
		{
			//returnError(500, "Invalid Request");
		}

		mysqli_close($conn);
	}
	
?>
