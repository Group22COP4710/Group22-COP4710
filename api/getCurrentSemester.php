<?php

	$inData = getRequestInfo();

	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{
		$result = $conn->query("select Season, Year, Deadline from Semester where Current = true");
		
		if ($row = $result->fetch_assoc())
		{
			returnData($row["Season"], $row["Year"],$row["Deadline"]);
		}
		else
		{
			returnError(500, "No semester found");
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
	
	function returnData($season, $year, $deadline)
	{
		$retValue = array(
			"data"=>array(
				"Season"=>$season,
				"Year"=>$year,
				"Deadline"=>$deadline)
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