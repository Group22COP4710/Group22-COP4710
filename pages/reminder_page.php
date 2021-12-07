<?php
	
	if ($_COOKIE["Deadline"] == null)
	{
		$deadlineStatus = "Not set";	
	}
	else
	{
		$deadlineStatus = $_COOKIE['Deadline'];
	}

    $orders = [];
    if(isset($_POST['view_all_orders']))
    {
        include('../api/getTotalRequest.php');
        print_r($orders);
    }

    if(isset($_POST['finalize']))
    {
	include('../api/sumbitSemester.php');    
    }

    if(isset($_POST['submit'])){
        
       include('../api/setDeadline.php');
	    
    } 
    else if(isset($_POST['remindersubmit'])){
        
        include('../api/sendReminder.php');
         
     }// end POST check
?>

<html>

    

<body class="grey lighten-4">
    <?php include('../templates/admin_header.php'); ?>

    <link href="../css/styles.css" rel="stylesheet">	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    
	<section class="container grey-text" style="display: flex;">
		<form class="white login-form" action="../pages/reminder_page.php" method="POST">
            <h3 class="brand-logo brand-text center">Set deadline date</h3>
            <hr style="margin-bottom: 15px; border-top: 3px solid;">
			<label>Current Deadline: <p><?php echo $deadlineStatus;?></p>
			<label>Deadline date (mm-dd-yyyy)</label>
			<input type="text" name="deadline" value="">

			<div class="red-text"></div>

			<div class="center">
                <div class="green-text"></div>
				<input type="submit" name="submit" value="Set deadline" class="btn brand z-depth-0">
				<br /><br />
			</div>

            <div class="center">
                <a class="btn modal-trigger brand z-depth-0"
                    href="#view-forms-modal" >View all forms
                </a>
                
                
            </div>
		</form>

        <form class="login-form" action="../pages/reminder_page.php" method="POST">
			<div class="center">
				<input type="submit" name="remindersubmit" value="Send reminder for deadline" class="btn brand z-depth-0">
			</div>
		</form>
        

	</section>

    

    <!-- View Forms Modal Structure -->
    <div id="view-forms-modal" class="modal">
        <div class="modal-content grey-text">
            <h4 class="brand-text text-bold" id="view-edit-modal-title"><strong>All book order forms</strong></h4>
            <hr>

            <form class="float-right" action="../pages/reminder_page.php" method="POST">
					<label></label>
                    <input type="submit" value="View" name="view_all_orders">

				</form>
				<h3>All book orders</h3>
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
		<form class="float-right" action="../pages/reminder_page.php" method="POST">
            <input style="margin-right: 10px;" value="Finalize orders"
                type="submit" name="finalize" class="modal-action modal-close waves-effect waves-green 
                btn green lighten-1">
                </form?


            <a href="#!" class="modal-action 
                modal-close btn brand lighten-1">
                Close
            </a>
        </div>
    </div>

    <?php include('../templates/footer.php'); ?>

</body>

    <script>
        $(document).ready(function () {
            $('.modal').modal();
        }
        )
    </script>
</html>
