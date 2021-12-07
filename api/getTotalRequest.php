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


			
			$orders = [];
			$orderCount = 0;

			$sql = "SELECT * FROM bookOrder;
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
					"Req_ID"=>$reqid,
					"User_ID"=>$userid,
					"Sem_ID"=>$semid,
					"Order Count"=>$orderCount,
					"Orders"=>$orders);
			
			array_push($forms, $requestForm);
			$formCount++;

		
		
	}
	
?>
