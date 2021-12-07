<?php

	$semid = $_COOKIE["Sem_ID"];

	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if( $error = mysqli_connect_error())
	{
		echo $error ;
	}
	else
	{
		$result = mysqli_query($conn,"SELECT Season, Year FROM Semester WHERE Sem_ID = {$semid}");
		
		if ($row = mysqli_fetch_assoc($result))
		{
			if ($row["Season"] == "Fall")
			{
				$newYear = $row["Year"] + 1;
				$newSeason = "Spring";
			}
			else if ($row["Season"] == "Spring")
			{
				$newYear = $row["Year"];
				$newSeason = "Fall";
			}
			else
			{
				echo "Database Error";
			}
		}
		else
		{
			echo "Invalid Request";
		}
		
		$result = mysqli_query($conn,"UPDATE Semester SET Current = false WHERE Sem_ID = {$semid}");
		if ($result)
		{
			$result = mysqli_query($conn,"INSERT INTO Semester (Season, Year, Current) VALUES ('{$newSeason}',{$newYear},true)");
			
			include('../api/getCurrentSemester.php');
			setcookie("Sem_ID",$semester["Sem_ID"], time()+3600, '/');
			setcookie("Year",$semester["Year"], time()+3600, '/');
			setcookie("Deadline",null, time()+3600, '/');
			setcookie("Season",$semester["Season"], time()+3600, '/');
		}
		else
		{
			echo "Database Error";
		}
		
		mysqli_close($conn);
	}
	
?>
