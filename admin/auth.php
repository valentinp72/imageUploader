<?php

	$title = "Log in";
	$page  = "auth";

	if(
		!isset($_POST["submit"]) or
		empty($_POST["login"]) or
		empty($_POST["password"])
	){

		require("header.php");
		echo "<div class='center-container'><h1>Authentication</h2></div>";

		if(isset($_POST["submit"]))
			echo "<h3 class='error'>All fields are requiered</h3>";
	?>

	<div class="center-container">
		<form method="post" class="login-form">
			<div class="form-group">
				<label for="login">Login:</label>
				<input name="login" id="login" required class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" required class="form-control">
			</div>
			<input type="submit" name="submit" value="Log In" class="btn btn-default"/>
		</form>
	</div>

	<?php

	} else{
		require("users.php");

		if(password_verify($_POST['password'], $users[$_POST['login']] )){

			session_start();
			$_SESSION['login'] = $_POST['login'];

			header('location: index.php');

		}
		else {
			require("header.php");
			echo "<h1>Authentication</h2>";
			echo "Wrong login / password.<br/><a href='auth.php'>Back to the log-in page</a>";
		}

	}

	require("footer.php");

?>
