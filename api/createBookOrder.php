<?php

	$inData = getRequestInfo();

	$reqid = $inData["Req_ID"];
	$title = $inData["Title"];
	$ISBN = $inData["ISBN"];
	$author = $inData["Author"];
	$publisher = $inData["Publisher"];
	$edition = $inData["Edition"];
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error);
	}
	else
	{
		$result = $conn->query("INSERT INTO bookOrder(Req_ID,Title,ISBN,Author,Publisher,Edition) 
						VALUES({$reqid},'{$title}','{$ISBN}','{$author}','{$publisher}','{$edition}')");
		
		if ($result)
		{
			$query = $conn->query("SELECT Order_ID FROM bookOrder WHERE
			Req_ID={$reqid} AND Title='{$title}' AND ISBN='{$ISBN}' AND Author='{$author}' AND Publisher='{$publisher}' AND Edition='{$edition}'");
			
			if ($row = $query->fetch_assoc())
			{
				returnData($row["Order_ID"],$reqid,$title,$ISBN,$author,$publisher,$edition);
			}
			else
			{
				returnError(500, "Error Occured");
			}
		}
		else
		{
			returnError(500, "Invalid Request");
		}

		$stmt->close();
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
	
	function returnData($id, $t, $i, $a, $p, $e)
	{
		$retValue = array(
			"data"=>array(
				"Order_ID"=>$id,
				"Title"=>$t,
				"ISBN"=>$i,
				"Author"=>$a,
				"Publisher"=>$p,
				"Edition"=>$e),
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
