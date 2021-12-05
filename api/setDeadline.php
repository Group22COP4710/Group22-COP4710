<?php

	$inData = getRequestInfo();

	$deadline = date('Y-m-d',$inData["Deadline"]);
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{
		$result = $conn->query("update Semester SET Deadline = {$deadline} where Current = true");
		
		if ($result)
		{
			returnError(200,"Deadline set for {$deadline}");
		}
		else
		{
			returnError(500, "Process Failed");
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