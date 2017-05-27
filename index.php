<?php

	function return404(){
		header('HTTP/1.0 404 Not Found');
		include "404.html";
		die();
	}

	function write_header($title){

		$image = pathinfo($title);

		// Favicon
		$type  = "image/";
		$type .= $image['extension'];

		echo "<!doctype html>\n";
		echo "<html>\n";
		echo "\t<head>\n";
		echo "\t\t<title>" . $image['basename'] . "</title>\n\n";
		echo "\t\t<link rel='icon' type='". $type ."' href='" . $title . "' />\n";
		echo "\t\t<link rel='stylesheet' href='style.css' />\n";
		write_twitter_card($title);
		echo "\n\t</head>\n";
		echo "\t<body>\n\t\t";
	}
	function write_twitter_card($title){
		?>

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@valentinp72">
		<meta name="twitter:creator" content="@valentinp72">
		<meta name="twitter:title" content="Image">
		<meta name="twitter:description" content="@valentinp72 image">
		<meta name="twitter:image" content="/<?php echo $title; ?>">

		<?php
	}
	function write_footer(){
		echo "\n\t</body>\n";
		echo "</html>";
	}

	// URL given by the server
	$requestFile = $_SERVER['REQUEST_URI'];

	// Delete de first slash at the begining of the URL
	$requestFile = substr($requestFile, 1);

	// Delete the trailing slash in the URL
	$requestFile = rtrim($requestFile, '/');

	// Home page
	if($requestFile == "" || $requestFile == "index.php"){
		die("<h2>Nothing here...</h2>");
	}
	// Prevent form requesting non-valid file : only alphanumeric names
	else if(!ctype_alnum($requestFile) || strlen($requestFile) != 5){
		return404();
	}
	// Correct image request
	else {

		// check if the file exists
		$data = exec("ls i/" . $requestFile . ".* | head -1", $output, $return);

		if(!empty($data)){
			// the file exists

			write_header($data);
			echo "\n\t\t<div class='align-horizontal'>\n";
			echo "\t\t\t<div class='align-vertical'>\n";
			echo "\t\t\t\t<img src='/". $data . "' alt='Image de @valentinp72' />\n";
			echo "\t\t\t</div>\n";
			echo "\t\t</div>\n";
			write_footer();

		}
		else {
			return404();
		}
	}

?>
