<?php 
require('includes/config.php'); 
require_once('includes/functions.php');
require 'includes/parse-signup.php';
//doctype and visible header
require('includes/header.php');

?>
<style>
	.errors{
		background-color: orange ;
	}
	.success{
		background-color: cyan ;
	}

</style>
<main class="content">
	<div class="important-form">
	<h1>Create an Account</h1>
<?php show_feedback($feedback, $feedback_class, $errors) ?>
	<form method="post" action="signup.php">
		<label>Username:</label>
		<input type="text" name="name">

		<label>Email Address:</label>
		<input type="email" name="email">

		<label>Password:</label>
		<input type="password" name="password">

		<label>
			<input type="checkbox" name="policy" value="1"><span class="checkable">
			I agree to the <a href="#" target="_blank">terms of use and privacy policy</a>
			</span>
		</label>

		<input type="submit" value="Sign Up">
		<input type="hidden" name="did_register" value="1">
	</form>
	</div>
</main>

<?php include('includes/footer.php'); ?>