<?php

	$retVal = [];

	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		$retVal = array("Error" => $conn->connect_error );
	}
	else
	{
		$result = mysqli_query($conn, "SELECT Season, Year, Deadline FROM Semester WHERE Current = true");
		
		if ($row = mysqli_fetch_assoc($result))
		{
			$retVal = returnData($row["Season"], $row["Year"],$row["Deadline"]);
		}
		else
		{
			$retVal => array("Error"=>"No semester found");
		}

		$conn->close();
	}
	
	// function sendJSON( $obj )
	// {
	// 	header('Content-type: application/json');
	// 	echo $obj;
	// }
	
	function returnData($season, $year, $deadline)
	{
		return $retValue = array(
			"Season"=>$season,
			"Year"=>$year,
			"Deadline"=>$deadline
		);
	}
	
	// function returnError($code, $err )
	// {
	// 	$retValue = array(
	// 		"Error"=>array(
	// 			"code"=>$code,
	// 			"Message"=>$err));
		
	// 	sendJSON(json_encode($retValue, JSON_FORCE_OBJECT));
	// }
	
?>
