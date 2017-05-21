<!DOCTYPE html>
<?php
	session_start();


	if(!isset($title))
		$title = "Image uploader";
	else
		$title = "Image uploader - " . $title;

	if(!isset($page))
		$page  = "index";

?>
<html lang="en">
	<head>
		<meta charset="utf-8" />

	    <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="style.css" media="all" />

		<title><?php echo $title; ?></title>
	</head>
	<body>

		<!-- Fixed navbar -->
		<nav class="navbar navbar-fixed-top navbar-custom">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Image uploader</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<?php if(isset($_SESSION['login'])){ ?>
							<li <?php if($page == "index") echo 'class="active"'; ?>><a href="/admin/index.php">Admin</a></li>
							<li <?php if($page == "list") echo 'class="active"'; ?>><a href="/admin/list.php">List</a></li>
							<li <?php if($page == "stats") echo 'class="active"'; ?>><a href="/admin/stats.php">Stats</a></li>
						<?php } ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">

						<?php
							if(!isset($_SESSION['login'])){
								echo '<li ';
								if($page == "auth")
								echo 'class=active';
								echo '><a href="/admin/auth.php">Log in</a></li>';
							}
							else {
								echo '<li ';
								if($page == "logout")
								echo 'class=active';
								echo '><a href="/admin/logout.php">Logout</a></li>';
							}
						?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container">

<?php echo "\n"; ?>
