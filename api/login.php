<?php


	$email = $_POST["email"];
	$password = $_POST["password"];
	$retVal = [];

	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{

		$result = $conn->query("SELECT * FROM Users WHERE email= '{$email}' AND Password= '{$password}'");
		
		if ($row = $result->fetch_assoc())
		{
			$retVal = returnData($row["User_ID"],$row["Name"],$row["User_Type"]);
		}
		else 
		{
			$retVal = array("Error"=>"Login Unsuccessful");
		}

		$conn->close();
	}
	
	
	function returnData($id, $name, $type)
	{
		$retValue = array(
				"User_ID"=>$id,
				"Name"=>$name,
				"User_Type"=>$type);
	}
	
?>
