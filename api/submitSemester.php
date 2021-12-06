<?php

	$inData = getRequestInfo();

	$semid = $inData["Sem_ID"];
	$newYear;
	$newSeason;
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error);
	}
	else
	{
		$result = $conn->query("SELECT Season, Year FROM Semester WHERE Sem_ID = {$semid}");
		
		if ($row = $result->fetch_assoc())
		{
			if ($row["Season"] == "Fall")
			{
				$newYear = $row["Year"] + 1;
				$newSeason = "Spring";
			}
			else if ($row["Season"] = "Spring")
			{
				$newYear = $row["Year"];
				$newSeason = "Fall";
			}
			else
			{
				returnError(500, "Database Error");
			}
		}
		else
		{
			returnError(500, "Invalid Request");
		}
		
		$result = $conn->query("UPDATE Semester SET Current = false WHERE Sem_ID = {$semid}");
		if ($result)
		{
			$result = conn->query("INSERT INTO Semester (Season, Year, Current) VALUES ('{$newSeason}',{$newYear},true)");
			returnData($newSeason, $newYear);
		}
		else
		{
			returnError(500, "Database Error");
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
	
	function returnData($season, $year)
	{
		$retValue = array(
			"data"=>array(
				"Season"=>{$season},
				"Year"=>{$year}),
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
