<?php

	$inData = getRequestInfo();

	$oid = inData["Order_ID"];
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{

		$result = $conn->query("SELECT * FROM bookOrder WHERE Order_ID={$oid}");
		
		if ($row = $result->fetch_assoc())
		{
			returnData($row["Order_ID"],$row["Title"],$row["ISBN"],$row["Author"],$row["Edition"],$row["Publisher"],$row["Req_ID"]);
		}
		else 
		{
			returnError(500, "No Order found");
		}

		$conn->close();
	}
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendJSON( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnData($oid,$title,$isbn,$author,$edition,$pub,$reqid)
	{
		$retValue = array(
			"Order"=>array(
				"Order_ID"=>$oid,
				"Title"=>$title,
				"ISBN"=>$isbn,
				"Author"=>$author,
				"Edition"=>$edition,
				"Publisher"=>$pub,
				"Req_ID"=>$reqid),
			"Error"=>array("code"=>200));
		
		sendJSON(json_encode($retValue, JSON_FORCE_OBJECT));
	}
	
	function returnError($code, $err )
	{
		$retValue = array(
			"Error"=>array(
				"code"=>$code,
				"Message"=>$err));
		
		sendJSON(json_encode($retValue,JSON_FORCE_OBJECT));
	}
	
?>
