<?php

	$inData = getRequestInfo();
	
	$id = 0;
	$email = "";
	$password = "";
	$name = "";
	$type = "";

	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("SELECT User_ID, Name, User_Type FROM Users WHERE email=? AND Password =?");
		// $password = $md5($inData["password"]);
		// $stmt->bind_param("ss", $inData["email"], $password);
		$stmt->bind_param("ss", $inData["email"], $inData["password"]);
		$stmt->execute();
		$result = $stmt->get_result();

		if( $row = $result->fetch_assoc()  )
		{
			
			returnWithInfo( $row['Name'], $row['User_ID'], $row['User_Type'] );
		}
		else
		{
			returnWithError("No Records Found");
		}

		$stmt->close();
		$conn->close();
	}
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"id":-1,"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $name, $id, $type )
	{
		$retValue = '{"id":' . $id . ',"Name":"' . $name . ',"User_Type":"' . $type . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
