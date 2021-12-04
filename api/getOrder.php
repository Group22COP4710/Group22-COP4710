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
		$stmt = $conn->prepare("SELECT Order_ID, Title, Deadline,ISBN, Author, Edition, Publisher FROM bookOrder WHERE User_ID = ?");
		$stmt->bind_param("s", $inData["User_ID"]);
		$stmt->execute();
		$result = $stmt->get_result();

		if( $row = $result->fetch_assoc()  )
		{
			
			returnWithInfo( $row['Order_ID'], $row['Title'], $row['Deadline'], $row['ISBN'] , $row['Author'], $row['Edition'], $row['Publisher']);
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
	
	function returnWithInfo($oid, $title, $deadline, $ISBN, $author, $edition, $pub )
	{
		$retValue = '{"Order_ID":' . $oid . ',"title":"' . $title . ',"ISBN":"' . $ISBN .',"Author":"' . $author . ',"Deadline":"' . $deadline. ',"Publisher":"' . $pub .'","error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
