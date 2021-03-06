<?php 

	$conn = mysqli_connect("localhost", "user", "password", "final"); 	
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	else
	{
		$result = mysqli_query($conn, "SELECT Req_ID FROM RequestForms WHERE User_ID = {$_COOKIE['User_ID']} AND Sem_ID = {$_COOKIE['Sem_ID']}");
		if ($row = mysqli_fetch_assoc($result))
		{
			setcookie("Req_ID",$row["Req_ID"],time()+3600 , '/' );	
		}
		else
		{
			mysqli_query($conn, "INSERT INTO RequestForms (Sem_ID, User_ID) VALUES ({$_COOKIE['Sem_ID']},{$_COOKIE['User_ID']})");
			
			$result = mysqli_query($conn, "SELECT Req_ID FROM RequestForms WHERE User_ID = {$_COOKIE['User_ID']} AND Sem_ID = {$_COOKIE['Sem_ID']}");
			$row = mysqli_fetch_assoc($result);
			setcookie("Req_ID",$row["Req_ID"],time()+3600 , '/' );	
		}
	}

	$orders = [];
	$orderCount = 0;

	if (isset($_POST['view_edit']))
	{
		include('../api/getRequestForm.php');
	}

	if (isset($_POST['delete_form']))
	{
		include('../api/deleteRequestForm.php');
	}

	$title = $authors = $edition = $publisher = $ISBN = '';
	$errors = array('title' => '', 'authors' => '', 'edition' => '', 'publisher' => '', 'ISBN' => '');

	if(isset($_POST['submit'])){
		
		include('../api/createBookOrder.php');

	} // end POST check
	
	if (isset($_POST['deleteOrder']))
	{
		include('../api/deleteBookOrder.php');	
	}
?>



<!DOCTYPE html>
<html>
	<?php include('../templates/header.php'); ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>


	<section class="grey-text requests-container">
		
		<form class="white book-request-form" action="../pages/book_requests.php" method="POST">
			<h4 class="center">Add new book request</h4>
			<hr />
			<br />
			<label>Current Deadline: <p><?php echo $_COOKIE['Deadline'];?></p><label>
			<label>Book Title</label>
			<input type="text" name="title" value="">
			<div class="red-text"><?php echo $errors['title']; ?></div>

			<label>Authors Name(s)</label>
			<input type="text" name="authors" value="">
			<div class="red-text"><?php echo $errors['authors']; ?></div>

			<label>Book edition</label>
			<input type="text" name="edition" value="">
			<div class="red-text"><?php echo $errors['edition']; ?></div>

			<label>Publisher</label>
			<input type="text" name="publisher" value="">
			<div class="red-text"><?php echo $errors['publisher']; ?></div>

			<label>ISBN</label>
			<input type="text" name="ISBN" value="">
			<div class="red-text"><?php echo $errors['ISBN']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="Add to form" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<div class="center">
		<a class="waves-effect waves-light btn modal-trigger brand z-depth-0" href="#demo-modal">View/Edit Request Form</a>
		
	</div>

	<div class="">
        <!-- Modal Trigger -->
        
  
        <!-- Modal Structure -->
        <div id="demo-modal" class="modal">
            <div class="modal-content grey-text">
                <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>View/edit request form</strong></h4>
				<hr>
				<form class="" action="../pages/book_requests.php" method="POST">
					<label>Enter Order ID to delete</label>
					<input type="text" name="oiddelete" value="">
				<div class="center">
				<input type="submit" name="deleteOrder" value="Delete Order" class="btn brand z-depth-0">
				</div>
		    		</form>
				<form class="float-right" action="../pages/book_requests.php" method="POST">
					<label></label>
                    			<input type="submit" name="view_edit" value="All">

				</form>
				<h3>Books in current order</h3>
				<ul>
                <?php foreach($orders as $item => $preVal){ ?>
                    <?php foreach($preVal as $key => $value){ ?>

                        <li><h5>
                        <?php
                            echo $key . ": ";
                            echo $value; ?>
                        <h5></li>

                    <?php } ?>

                    <?php echo '<br/>'; ?>
                <?php } ?>
                </ul>

            </div>
  
            <form class="modal-footer" action="../pages/book_requests.php" method="POST">
				<input style="margin-right: 10px;" class="modal-action 
                    modal-close waves-effect waves-red 
                    btn red lighten-1" type="submit" name="delete_form" value="Delete form">
                    

                <a href="#!" class="modal-action 
                    modal-close waves-effect 
                    btn brand lighten-1">
                    Close
                </a>
            </form>
        </div>
    </div>

	<?php include('../templates/footer.php'); ?>

	<script>
        $(document).ready(function () {
            $('.modal').modal();
        }
        )
    </script>

</html>
