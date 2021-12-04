<?php

	$inData = getRequestInfo();
	
	$id = $inData["User_ID"];
	$deadline = $inData["Deadline"];

	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnWithResult( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("INSERT INTO bookOrder (User_ID, Deadline) VALUES (?,?)");
		$stmt->bind_param("ss", $id, $deadline);
		$stmt->execute();
		$result = $stmt->get_result();

		returnWithError("Book Order Created");

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
	
	function returnWithResult( $err )
	{
		$retValue = '{"id":-1,"Message":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
