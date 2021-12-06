<?php

	$inData = getRequestInfo();

	$email = $inData["email"];
	$password = $inData["Password"];
	// $password = $md5($inData["password"]);
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{

		$result = $conn->query("SELECT * FROM Users WHERE email= '{$email}' AND Password= '{$password}'");
		
		if ($row = $result->fetch_assoc())
		{
			returnData($row["User_ID"],$row["Name"],$row["User_Type"]);
		}
		else 
		{
			returnError(500, "No user found");
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
	
	function returnData($id, $name, $type)
	{
		$retValue = array(
			"User"=>array(
				"User_ID"=>$id,
				"Name"=>$name,
				"User_Type"=>$type),
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
