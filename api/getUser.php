<?php

	$inData = getRequestInfo();
	
	$id = $inData["User_ID"];

	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("SELECT Name, email, User_Type FROM Users WHERE User_ID = ?");
		$stmt->bind_param("s", $inData["email"]);
		$stmt->execute();
		$result = $stmt->get_result();

		if( $row = $result->fetch_assoc()  )
		{
			
			returnWithInfo( $id, $row['Name'], $row['email'], $row['User_Type'] );
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
	
	function returnWithInfo($id, $name, $email, $type )
	{
		$retValue = '{"id":' . $id . ',"Name":"' . $name . ',"Email":"' . $email .',"User_Type":"' . $type . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
