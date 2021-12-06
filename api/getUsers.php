<?php

	$inData = getRequestInfo();

	$usertype = $inData["User_Type"];
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
			$result = $conn->query("SELECT * FROM  WHERE User_Type LIKE '{$usertype}'");
		}
		
		while ($row = $result->fetch_assoc())
		{
			$user = array("User_ID"=>$row["User_ID"], "email"=>$row["email"],
					"Name"=>$row["Name"], "User_Type"=>$row["User_Type"]);

			array_push($retArray, $user);
			$searchCount++;
		}
		
		if ($searchCount == 0)
		{
			returnError(500, "No users found");
		}
		else
		{
			returnData($retArray, $searchCount);
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
	
	function returnData($users, $count)
	{
		$retValue = array(
			"Users Found"=>$count,
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
