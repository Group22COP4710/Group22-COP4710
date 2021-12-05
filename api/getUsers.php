<?php

	$inData = getRequestInfo();

	$usertype = inData["User_Type"];
	$searchCount = 0;
	$retArray = [];
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{
		if ($usertype == "All")
		{
			$result = $conn->query("select * from Users");
		}
		else
		{
			$result = $conn->query("select * from  where User_Type = {$usertype}");
		}
		
		while ($row = $result->fetch_assoc())
		{
			$rowJSON = json_encode(array(
					"User_ID"=>$row["User_ID"], "email"=>$row["email"],
					"Name"=>$row["Name"], "User_Type"=>$row["User_Type"]),
					JSON_FORCE_OBJECT);

			array_push($retArray, $rowJSON);
			$searchCount++;
		}
		
		if ($searchCount == 0)
		{
			returnError(500, "No users found");
		}
		else
		{
			returnData($retArray);
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
	
	function returnData($users)
	{
		$retValue = array(
			"users"=>$users,
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