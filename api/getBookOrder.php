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

		$conn->close();
	}
	
	// function getRequestInfo()
	// {
	// 	return json_decode(file_get_contents('php://input'), true);
	// }

	// function sendJSON( $obj )
	// {
	// 	header('Content-type: application/json');
	// 	echo $obj;
	// }
	
	function returnData($oid,$title,$isbn,$author,$edition,$pub,$reqid)
	{
		$retValue = array(
				"Order_ID"=>$oid,
				"Title"=>$title,
				"ISBN"=>$isbn,
				"Author"=>$author,
				"Edition"=>$edition,
				"Publisher"=>$pub,
				"Req_ID"=>$reqid);
		
		//sendJSON(json_encode($retValue, JSON_FORCE_OBJECT));
	}
	
	// function returnError($code, $err )
	// {
	// 	$retValue = array(
	// 		"Error"=>array(
	// 			"code"=>$code,
	// 			"Message"=>$err));
		
	// 	sendJSON(json_encode($retValue,JSON_FORCE_OBJECT));
	// }
	
?>
