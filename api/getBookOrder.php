<?php

	//$inData = getRequestInfo();

	$oid = $_Post["Order_ID"];
	$retVal = [];
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if( $error mysqli_connect_error())
	{
		$retVal = array("Error" => $error );
	}
	else
	{

		$result = mysqli_query($conn,"SELECT * FROM bookOrder WHERE Order_ID={$oid}");
		
		if ($row = mysqli_fetch_assoc($result))
		{
			$retVal = returnData($row["Order_ID"],$row["Title"],$row["ISBN"],$row["Author"],$row["Edition"],$row["Publisher"],$row["Req_ID"]);
		}
		else 
		{
			$retVal = array("Error"=>"No orders found");
		}

		mysqli_close($conn);
	}
		
?>
