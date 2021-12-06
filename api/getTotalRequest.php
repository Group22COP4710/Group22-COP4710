<?php

	$inData = getRequestInfo();

	$semid = inData["Sem_ID"];
	$userid;
	$reqid;
	$forms = [];
	$formCount = 0;
	
	$conn = new mysqli("localhost", "user", "password", "final"); 	
	if( $conn->connect_error )
	{
		returnError(500, $conn->connect_error );
	}
	else
	{
		$result = $conn->query("select Season, Year from Semesters where Sem_ID={$semid}");
		if ($row = $result->fetch_assoc())
		{
			$season = $row["Season"];
			$year = $row["Year"];
		}
		else
		{
			returnError(500, "Error Occured");
		}
		
		$reqForm = $conn->query("select * from RequestForms where Sem_ID={$semid}");
		
		while ($row = $reqForm->fetch_assoc())
		{
			$reqid = $row["Req_ID"];
			$userid = $row["User_ID"];
			
			$orders = [];
			$orderCount = 0;
			
			$bookOrders = $conn->query("select * from bookOrder where Req_ID = {$reqid}");
			
			while ($orderRow = $bookOrders->fetch_assoc())
			{
				$bookOrder = array(
					"Order_ID"=>$orderRow["Order_ID"],
					"Title"=>$orderRow["Title"],
					"ISBN"=>$orderRow["ISBN"],
					"Author"=>$orderRow["Author"],
					"Edition"=>$orderRow["Edition"],
					"Publisher"=>$orderRow["Publisher"]);
				$json = json_encode($bookOrder, JSON_FORCE_OBJECT);
				array_push($orders, $json);
				$orderCount++;
			}
			
			$requestForm = array(
				"Request Form"=>array(
					"Req_ID"=>$reqid,
					"User_ID"=>$userid,
					"Sem_ID"=>$semid,
					"Order Count"=>$oderCount,
					"Orders"=>$bookOrders,),
				"Error"=>array("code"=>200));
			
			$json = json_encode($requestForm, JSON_FORCE_OBJECT);
			array_push($forms, $json);
			$formCount++;
		}
		
		
		returnData($forms, $formCount, $season, $year);

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
	
	function returnData($count, $array, $s, $y)
	{
		$retValue = array(
			"Season"=>$s,
			"Year"=>$y,
			"Forms Found"=> $count,
			"Forms"=>$array,
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