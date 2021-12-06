<?php

	$inData = getRequestInfo();

	$reqid = inData["Req_ID"];
	$semid;
	$userid;
	$orders = [];
	$orderCount = 0;
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{

		$reqForm = $conn->query("SELECT * FROM RequestForms WHERE Req_ID = {$reqid}");
		
		if ($row = $reqForm->fetch_assoc())
		{
			$semid = $row["Sem_ID"];
			$userid = $row["User_ID"];
			
			$bookOrders = $conn->query("SELECT * FROM bookOrder WHERE Req_ID = {$reqid}");
			
			while ($row = $bookOrders->fetch_assoc())
			{
				$bookOrder = array(
					"Order_ID"=>$row["Order_ID"],
					"Title"=>$row["Title"],
					"ISBN"=>$row["ISBN"],
					"Author"=>$row["Author"],
					"Edition"=>$row["Edition"],
					"Publisher"=>$row["Publisher"]);
				$json = json_encode($bookOrder, JSON_FORCE_OBJECT);
				array_push($orders, $json);
				$orderCount++;
			}
			
			returnData($reqid,$userid,$semid,$orderCount,$orders);
		}
		else 
		{
			returnError(500, "No forms found");
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
	
	function returnData($rid,$uid,$sid,$count,$orderarray)
	{
		$retValue = array(
			"Request Form"=>array(
				"Req_ID"=>$rid,
				"User_ID"=>$uid,
				"Sem_ID"=>$sid,
				"Orders Found"=>$count,
				"Orders"=>$orderarray),
			"Error"=>array("code"=>200));
		
		sendJSON(json_encode($retValue, JSON_FORCE_OBJECT));
	}
	
	function returnError($code, $err )
	{
		$retValue = array(
			"Error"=>array(
				"code"=>$code,
				"Message"=>$err));
		
		sendJSON(json_encode($retValue,JSON_FORCE_OBJECT));
	}
	
?>
