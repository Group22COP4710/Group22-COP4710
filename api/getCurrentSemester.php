<?php

	$retVal = [];

	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if( $error = mysqli_connect_error() )
	{
		$retVal = array("Error" => $error);
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
			$retVal = array("Error"=>"No semester found");
		}

		$conn->close();
	}
	
	
	function returnData($season, $year, $deadline)
	{
		return $retValue = array(
			"Season"=>$season,
			"Year"=>$year,
			"Deadline"=>$deadline
		);
	}
	
	
?>
