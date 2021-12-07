<?php

	$semid = $_COOKIE["Sem_ID"];

	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if( $error = mysqli_connect_error())
	{
		echo $error ;
	}
	else
	{
		
			if ($_COOKIE["Season"] == "Fall")
			{
				$newYear = $_COOKIE['Year'] + 1;
				$newSeason = "Spring";
			}
			else if ($_COOKIE["Season"] == "Spring")
			{
				$newYear = $_COOKIE["Year"];
				$newSeason = "Fall";
			}

		
		$result = mysqli_query($conn,"UPDATE Semester SET Current = false WHERE Sem_ID = {$semid}");
		if ($result)
		{
			$result = mysqli_query($conn,"INSERT INTO Semester (Season, Year, Current) VALUES ('{$newSeason}',{$newYear},true)");
			
			include('../api/getCurrentSemester.php');
			setcookie("Sem_ID",$semester["Sem_ID"], time()+3600, '/');
			setcookie("Year",$newYear, time()+3600, '/');
			setcookie("Deadline",null, time()+3600, '/');
			setcookie("Season",$newSeason, time()+3600, '/');
		}
		else
		{
			echo "Database Error";
		}
		
		mysqli_close($conn);
	}
	
?>
