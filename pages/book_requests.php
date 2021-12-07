<?php 


	$orders = [];
	$orderCount = 0;

	if ($_POST["view/edit"] == 'View/Edit')
	{
		include('../api/getRequestForm.php');
	}

	$title = $authors = $edition = $publisher = $ISBN = '';
	$errors = array('title' => '', 'authors' => '', 'edition' => '', 'publisher' => '', 'ISBN' => '');

	if(isset($_POST['submit'])){
		
		include('../api/createBookOrder.php');

	} // end POST check

?>



<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<section class="grey-text requests-container">
		
		<form class="white book-request-form" action="../pages/book_requests.php" method="POST">
			<h4 class="center">Add new book request</h4>
			<hr />
			<br />

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

				<form class="float-left" action="../pages/book_requests.php">
					<label></label>
                    			<input type="submit" name="View/Edit" value="All">
					
					<h5>Books in current order</h5>
					<input type="checkbox" id="book1" name="book1" value="book1">
					<label for="book1"> Calc 3</label><br>
					<input type="checkbox" id="book2" name="book2" value="book2">
					<label for="book2"> Bio</label><br>
					<input type="checkbox" id="book3" name="book3" value="book3">
					<label for="book3"> English</label><br><br>
				</form>

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
  
            <div class="modal-footer">
				<a href="#!" style="margin-right: 10px;" class="modal-action 
                    modal-close waves-effect waves-red 
                    btn red lighten-1">
                    Delete form
                </a>

                <a href="#!" class="modal-action 
                    modal-close waves-effect 
                    btn brand lighten-1">
                    Close
                </a>
            </div>
        </div>
    </div>

	<script>
        $(document).ready(function () {
            $('.modal').modal();
        }
        )
    </script>

</html>
