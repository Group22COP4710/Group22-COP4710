<?php

	$inData = getRequestInfo();

	$userid = $inData["User_ID"];
	$oldpass = $inData["oldPassword"];
	$newpass = $inData["newPassword"];
	$retype = $inData["retypePassword"];
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error);
	}
	else if ($newpass != $retype)
	{
		returnError(400, "Passwords don't match");
	}
	else
	{
		$result = $conn->query("SELECT Password FROM Users WHERE User_ID = {$userid}");
		
		if ($row = $result->fetch_assoc())
		{
			if ($row["password"] == $oldpass)
			{
				$result = $conn->query("UPDATE Users SET Password = '{$newpass}' WHERE User_ID = {$userid}");
				returnError(200, "Password successfully changed");
			}
			else
			{
				returnError(400, "Old password incorrect");
			}
		}
		else
		{
			returnError(500, "Error Occured");
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
