<?php

	$inData = getRequestInfo();

	$oid= $inData["Order_ID"];
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error);
	}
	else
	{
		$result = $conn->query("delete from bookOrder where Order_ID={$oid}");
		
		if ($result)
		{
			returnError(200, "Delete Successful");
		}
		else
		{
			returnError(400, "Invalid Request");
		}

		$stmt->close();
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
	
	function returnError($code, $err )
	{
		$retValue = array(
			"Error"=>array(
				"code"=>$code,
				"Message"=>$err));
		
		sendJSON(json_encode($retValue, JSON_FORCE_OBJECT));
	}
	
?>