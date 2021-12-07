<?php 
	include('../api/changePassword.php');
?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header.php'); ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<!-- Modal Trigger -->

	<section class="container grey-text accounts-page">
		<form class="white login-form" action="admin_accounts_page.php" method="POST">
			<div class="center">
				<a class="waves-effect waves-light btn modal-trigger brand z-depth-0" href="#change-password-modal">
				Change password
				</a>
			</div>
		</form>
	</section>

	<!-- Change Password Modal Structure -->
	<div id="change-password-modal" class="modal">
            <div class="modal-content grey-text">
                <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>Change Password</strong></h4>
				<hr>

		<form class="white login-form"  action="../pages/accounts_page.php" method="POST">
                    <label>Old password</label>
                    <input type="text" name="oldpass" value="">
                    <div class="red-text"><?php echo $errors['password']; ?></div>
                    <label>New password</label>
                    <input type="text" name="newpass" value="">
                    <div class="red-text"><?php echo $errors['password']; ?></div>
                    <label>Retype new password</label>
                    <input type="text" name="retypepass" value="">
                    <div class="red-text"><?php echo $errors['password']; ?></div>
		    <input type="submit" name="submit" value="Apply" href="#!" style="margin-right: 10px;" class="modal-action 
                    modal-close waves-effect waves-green 
                    btn green lighten-1">
                </form>

            </div>
  
            <div class="modal-footer">
				
                <a href="#!" class="modal-action 
                    modal-close waves-effect 
                    btn brand lighten-1">
                    Cancel
                </a>
            </div>
        </div>

	<script>
		$(document).ready(function () {
			$('.modal').modal();
		}
		)
    </script>

	<?php include('../templates/footer.php'); ?>

</html>
