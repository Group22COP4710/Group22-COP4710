<?php

	$inData = getRequestInfo();

	$reqid = $inData["Req_ID"];
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{
		$result = $conn->query("DELETE FROM bookOrder WHERE Req_ID = {$reqid}");
		
		if ($result)
		{
			$result = $conn->query("DELETE FROM RequestForms WHERE Req_ID = {$reqid}");
			if ($result)
			{
				returnError(200, "Deletion succesful");
			}
			else
			{
				returnError(500, "Orders could not be deleted");
			}
		}
		else 
		{
			returnError(500, "Form could not be deleted");
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
	
	function returnError($code, $err )
	{
		$retValue = array(
			"Error"=>array(
				"code"=>$code,
				"Message"=>$err));
		
		sendJSON(json_encode($retValue,JSON_FORCE_OBJECT));
	}
	
?>
