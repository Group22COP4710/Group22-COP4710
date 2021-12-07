<?php 
	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$result = mysqli_query($conn, "SELECT Req_ID FROM RequestForms WHERE USER_ID = {$_COOKIE['User_ID']} AND {$_COOKIE['Sem_ID']}");
		if ($row = mysqli_fetch_assoc($result))
		{
			setcookie("Req_ID",$row["Req_ID"],time()+3600 , '/' );	
		}
		else
		{
			echo "Request Form not found";	
		}
	}
?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <?php include('pages/book_requests.php'); ?>

	<?php include('templates/footer.php'); ?>

</html>
