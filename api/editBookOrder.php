<?php

	$inData = getRequestInfo();

	$oid= $inData["Order_ID"];
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
		$result = $conn->query("UPDATE bookOrder SET Title='{$title}',ISBN='{$ISBN}',Author='{$author}',
							Publisher='{$publisher}',Edition='{$edition}' 
							WHERE Order_ID={$oid}");
		
		if ($result)
		{
			returnData($oid,$title,$ISBN,$author,$publisher,$edition);
		}
		else
		{
			returnError(500, "Invalid Request");
		}

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
