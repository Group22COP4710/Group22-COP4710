<?php

	$reqid = $_COOKIE['Req_ID'];
	echo $reqid;
	$semid = $_COOKIE['Sem_ID'];
	$userid = $_COOKIE['User_ID'];
// 	$orders = [];
// 	$orderCount = 0;
	
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{			
			$sql = "SELECT * FROM bookOrder WHERE Req_ID = {$reqid}";
			$bookOrders = mysqli_query($conn, $sql);
			
			while ($row = mysqli_fetch_assoc($bookOrders))
			{
				$bookOrder = array(
					"Order_ID"=>$row["Order_ID"],
					"Title"=>$row["Title"],
					"ISBN"=>$row["ISBN"],
					"Author"=>$row["Author"],
					"Edition"=>$row["Edition"],
					"Publisher"=>$row["Publisher"]);
				array_push($orders, $bookOrder);
				$orderCount++;
			}
			
			// returnData($reqid,$userid,$semid,$orderCount,$orders);

		mysqli_close($conn);
	}
	
	header('Location: ../homepage.php');
	
?>
