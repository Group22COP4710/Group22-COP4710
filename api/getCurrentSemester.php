<?php

	$semester = [];

	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if( $error = mysqli_connect_error() )
	{
		$retVal = array("Error" => $error);
	}
	else
	{
		$result = mysqli_query($conn, "SELECT Season, Year, Deadline, Sem_ID FROM Semester WHERE Current = true");
		
		if ($row = mysqli_fetch_assoc($result))
		{
			$semester = returnSem($row["Season"], $row["Year"],$row["Deadline"],$row["Sem_ID"]);
		}
		else
		{
			$semester = array("Error"=>"No semester found");
		}

		$conn->close();
	}
	
	
	function returnSem($season, $year, $deadline,$id)
	{
		return  array(
			"Season"=>$season,
			"Year"=>$year,
			"Deadline"=>$deadline,
			"Sem_ID" => $id
		);
	}
	
	
?>
