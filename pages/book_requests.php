<?php 

	$title = $authors = $edition = $publisher = $ISBN = '';
	$errors = array('title' => '', 'authors' => '', 'edition' => '', 'publisher' => '', 'ISBN' => '');

	if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		// check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		echo $email;
		echo $title;

	} // end POST check

?>



<!DOCTYPE html>
<html>

	<section class="grey-text requests-container">
		
		<form class="white book-request-form" action="book_requests.php" method="POST">
			<h4 class="center">Add new book request</h4>
			<hr />
			<br />

			<label>Book Title</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>

			<label>Authors Name(s)</label>
			<input type="text" name="authors" value="<?php echo htmlspecialchars($authors) ?>">
			<div class="red-text"><?php echo $errors['authors']; ?></div>

			<label>Book edition</label>
			<input type="text" name="edition" value="<?php echo htmlspecialchars($edition) ?>">
			<div class="red-text"><?php echo $errors['edition']; ?></div>

			<label>Publisher</label>
			<input type="text" name="publisher" value="<?php echo htmlspecialchars($publisher) ?>">
			<div class="red-text"><?php echo $errors['publisher']; ?></div>

			<label>ISBN</label>
			<input type="text" name="ISBN" value="<?php echo htmlspecialchars($ISBN) ?>">
			<div class="red-text"><?php echo $errors['ISBN']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>		
	</section>

	<div class="center">
		<a href="" class="view-edit-form btn brand z-depth-0" name="book-requests">View/edit request form</a>
	</div>

</html>
