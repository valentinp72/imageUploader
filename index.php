<?php

	function write_header($title){
		echo "<!doctype html>\n";
		echo "<html>\n";
		echo "\t<head>\n";
		echo "\t\t<title>" . $title . "</title>\n";
		write_twitter_card($title);
		echo "\n\t</head>\n";
		echo "\t<body>\n\t\t";
	}
	function write_twitter_card($title){
		?>

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@valentinp72">
		<meta name="twitter:creator" content="@valentinp72">
		<meta name="twitter:title" content="Screenshot">
		<meta name="twitter:description" content="Screenshot">
		<meta name="twitter:image" content="/i/<?php echo $title; ?>">

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
	else if(!ctype_alnum($requestFile)){
		die("<h2>Non-valid image...</h2>");
	}
	// Correct image request
	else {

		require '_database.php'; // connect to the database

		// we search the file to see if it exists
		$query = $DB->query("SELECT * FROM images WHERE name = '" . $requestFile . "' LIMIT 1");
		$data = $query->fetch();

		if(!empty($data)){
			// the file exists
			$file = $requestFile;
			$ext  = $data['extension'];

			write_header($file . "." . $ext);
			echo "<img src='/i/" . $file . "." . $ext . "' />";
			write_footer();

		}
		else {
			die("<h2>Image not found...</h2>");
		}
	}

?>
