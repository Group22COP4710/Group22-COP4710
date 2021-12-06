<?php

	$inData = getRequestInfo();

	$userid = $inData["User_ID"];
	$semid = $inData["Sem_ID"];
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error);
	}
	else
	{
		$result = $conn->query("INSERT INTO RequestForms (Sem_ID, User_ID) VALUES ({$semid},{$userid})");
		
		if ($result)
		{
			$query = $conn->query("SELECT Req_ID FROM RequestForms WHERE Sem_ID = {$semid}, User_ID = {$userid}");
			if ($row = $query->fetch_assoc())
			{
				returnData($row["Req_ID"],$semid,$userid);
			}
			else
			{
				returnError(500, "Error occured");
			}
		}
		else
		{
			returnError(400, "Request Form not found");
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
	
	function returnData($reqid, $sem, $user)
	{
		$retValue = array(
			"data"=>array(
				"Req_ID"=>$reqid,
				"Sem_ID"=>$sem,
				"User_ID"=>$user),
			"Error"=>array("code"=>200));
		
		sendJSON(json_encode($retValue, JSON_FORCE_OBJECT));
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
