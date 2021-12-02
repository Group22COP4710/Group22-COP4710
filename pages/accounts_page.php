<?php 

?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header.php'); ?>

	<section class="container grey-text accounts-page">
        <form class="white login-form" action="accounts_page.php" method="POST">
			<div class="center">
				<input type="submit" name="submit" value="Change password" class="btn brand z-depth-0">
			</div>
            <br />
            <div class="center">
				<input type="submit" name="submit" value="Create new admin account" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>