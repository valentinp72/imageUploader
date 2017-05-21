<?php

	require('header.php');

	if(
		isset($_POST['submit']) and
		!empty($_POST['login']) and
		!empty($_POST['password']) and
		!empty($_POST['password2']) and
		$_POST['password'] == $_POST['password2']
	){
		echo "Write this into the users.php file :<br/>$";
		echo "users = array('" . $_POST['login'] . "' => '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "');";
	}
	else {

		if($_POST['password'] != $_POST['password2'])
			echo "Passwords does not match.";
	?>

	<form method="post">
		Login : <input name="login" required/><br/>
		Password : <input type="password" name="password" required/><br/>
		Retype password : <input type="password" name="password2" required/><br/>
		<input type="submit" name="submit" />
	</form>

	<?php

	}

	require('footer.php');
?>
