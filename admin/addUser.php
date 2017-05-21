<?php

	$title = "Add an user";
	$page  = "addUser";

	require('header.php');

	if(
		isset($_POST['submit']) and
		!empty($_POST['login']) and
		!empty($_POST['password']) and
		!empty($_POST['password2']) and
		$_POST['password'] == $_POST['password2']
	){
		echo "<strong>1 - </strong>Write this into the users.php file :<br/>";
		echo "<pre>\$users = array('" . $_POST['login'] . "' => '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "');</pre>";
		echo "<strong>2 - </strong>Now, you can <a href='auth.php'>log in</a>.";
	}
	else {

		if($_POST['password'] != $_POST['password2'])
			echo "Passwords does not match.";
	?>


	<div class="center-container">
		<h1>Add an user</h1>
	</div>
	<div class="center-container">

		<form method="post">
			<div class="form-group">
				<label for="login">Login:</label>
				<input name="login" required class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="password" required class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Retype password:</label>
				<input type="password" name="password2" required class="form-control">
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-default"/>
		</form>
	</div>

	<?php

	}

	require('footer.php');
?>
