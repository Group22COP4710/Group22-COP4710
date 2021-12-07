<?php


	$semid = $_COOKIE["Sem_ID"];
	$userid;
	$reqid;
	
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
// 		$sql = "SELECT Season, Year FROM Semester WHERE Sem_ID = {$semid}";
// 		$result = mysqli_query($conn, $sql);

		// if ($row = $result->fetch_assoc())
		// {
		// 	$season = $row["Season"];
		// 	$year = $row["Year"];
		// }
		// else
		// {
		// 	returnError(500, "Error Occured");
		// }
		
		$sql = "SELECT * FROM RequestForms WHERE Sem_ID={$semid}";
		$reqForm = mysqli_query($conn, $sql);
		
		while ($row = mysqli_fetch_assoc($reqForm))
		{
			$reqid = $row["Req_ID"];
			$userid = $row["User_ID"];
			
			$orders = [];
			$orderCount = 0;

			$sql = "SELECT * FROM bookOrder WHERE Req_ID = {$reqid}";
			$ordersResult = mysqli_query($conn, $sql);
			
			while ($orderRow = mysqli_fetch_assoc($ordersResult))
			{
				$bookOrder = array(
					"Order_ID"=>$orderRow["Order_ID"],
					"Title"=>$orderRow["Title"],
					"ISBN"=>$orderRow["ISBN"],
					"Author"=>$orderRow["Author"],
					"Edition"=>$orderRow["Edition"],
					"Publisher"=>$orderRow["Publisher"]);
				array_push($orders, $bookOrder);
				$orderCount++;
			}
			
			$requestForm = array(
				"Request Form"=>array(
					"Req_ID"=>$reqid,
					"User_ID"=>$userid,
					"Sem_ID"=>$semid,
					"Order Count"=>$orderCount,
					"Orders"=>$orders));
			
			array_push($forms, $requestForm);
			$formCount++;
		}
		
		
	}
	
?>
