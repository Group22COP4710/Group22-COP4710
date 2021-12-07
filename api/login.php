<?php


	$email = $_POST["email"];
	$password = $_POST["password"];
	$retVal = [];

	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		$retVal = array("Error" => $conn->connect_error );
	}
	else
	{

		$result = mysqli_query($conn, "SELECT * FROM Users WHERE email= '{$email}' AND Password= '{$password}'");
		
		if ($row = $result_fetch_assoc())
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
		return $retValue = array(
				"User_ID"=>$id,
				"Name"=>$name,
				"User_Type"=>$type);
	}
	
?>
