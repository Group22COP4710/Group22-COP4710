<?php


	$email = $_POST["email"];
	$password = $_POST["password"];
	$retVal = [];

	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if($error = mysqli_connect_error() )
	{
		$retVal = array("Error" => $error );
	}
	else
	{

		$result = mysqli_query($conn, "SELECT * FROM Users WHERE email= '{$email}' AND Password= '{$password}'");
		
		if ($row = mysqli_fetch_assoc($result))
		{
			$retVal = returnData($row["User_ID"],$row["Name"],$row["User_Type"]);
		}
		else 
		{
			$retVal = array("Error"=>"Login Unsuccessful");
		}

		mysqli_close($conn);
	}
	
	
	function returnData($id, $name, $type)
	{
		return $retValue = array(
				"User_ID"=>$id,
				"Name"=>$name,
				"User_Type"=>$type);
	}
	
?>
