<?php

	// $inData = getRequestInfo();

	// $usertype = $inData["User_Type"];
	// $searchCount = 0;
	// $retArray = [];
	
	$conn = mysqli_connect('localhost', 'user', 'password', 'final');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		if ($usertype == "All")
		{
			$sql = "SELECT * FROM Users";
			$result = mysqli_query($conn, $sql);
		}
		else
		{
			$sql = "SELECT * FROM Users WHERE User_Type LIKE '{$usertype}'";
			$result = mysqli_query($conn, $sql);
		}
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$user = array("User_ID"=>$row["User_ID"], "email"=>$row["email"],"Name"=>$row["Name"], "User_Type"=>$row["User_Type"]);

			array_push($retArray, $user);
			$searchCount++;
		}
		
		if ($searchCount == 0)
		{
			// echo (500, "No users found");
		}
		else
		{
			// returnData($retArray, $searchCount);
		}
		mysqli_close($conn);
	}
 ?>
