<?php

	$inData = getRequestInfo();
	
	$search = $inData["search"];
	$retArray = [];
	$searchCount = 0;
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("SELECT Order_ID, Title, Deadline, ISBN, Author, Edition, Publisher, Class_ID FROM bookOrder WHERE contact(Title, ISBN, Author, Edition, Publisher) like ?");
		$stmt->bind_param("s", $search);
		$stmt->execute();
		$result = $stmt->get_result();

		while( $row = $result->fetch_assoc()  )
		{
			$rowJSON = "{'Order_ID':'{$row['Order_ID']}', 'Title':'{$row['Title']}', 'Deadline':'{$row['Deadline']}', 'ISBN':'{$row['ISBN']}', 'Author':'{$row['Author']}', 'Edition':'{$row['Edition']}', 'Publisher':'{$row['Publisher']}', 'Class_ID':'{$row['Class_ID']}'}";
			array_push($retArray, $rowJSON);
			$searchCount++;
		}
		if ($searchCount == 0)
		{
			returnWithError("No book orders matching search found");
		}
		else
		{
			returnWithInfo($retArray);
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
	
	function returnWithInfo($orders)
	{
		$retValue = "{'Orders':";
		foreach ($orders as $order)
		{
			$retValue .= "'{$order}',";
		}
		$retValue .= "'error':''}"
		sendResultInfoAsJson( $retValue );
	}
	
?>
