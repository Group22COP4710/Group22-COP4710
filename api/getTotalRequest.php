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

			$sql = "SELECT * FROM bookOrder";
			$ordersResult = mysqli_query($conn, $sql);
			
			while ($row = mysqli_fetch_assoc($ordersResult))
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

		
		
	}
	
?>
