<?php

	$MAX_SIZE  = 52428800; // 50 Mo
	$VALID_EXT = ['jpg', 'jpeg', 'png', 'gif', 'psd', 'svg', 'bmp', 'psd'];


	function error($msg){

		$title = "Error - " . $msg;
		$page  = "error";

		require('member.php');
		require('header.php');

		echo "<h1>" . $msg . "</h1>";

		require('footer.php');

		die();
	}

	function generateRandomName($length){

		$possibleChar = 'abcdefghijklmnopqrstuvwxyz0123456789';

		$name = '';
		$max  = strlen($possibleChar) - 1;

		for($i = 0 ; $i < $length ; $i++){
			$name .= $possibleChar[mt_rand(0, $max)];
		}

		return $name;
	}

	function generateUniqueName($length){
		do {
			$tmp = generateRandomName($length);
			$cmd = '[ -f ../i/' . $tmp . '.* ] && echo "1" || echo "0"';
		} while(exec($cmd) != "0");

		return $tmp;
	}

	if(!empty($_FILES)){

		if($_FILES['upload-file']['error'] > 0)
			error("Transfer error.");

		if($_FILES['upload-file']['error'] > $MAX_SIZE)
			error("Image too heavy (50 Mo max.)");

		$fileInfo = pathinfo($_FILES['upload-file']['name']);

		if(!in_array($fileInfo['extension'], $VALID_EXT))
			error("Non-valid extension");

		$uniqueName = generateUniqueName(5);
		$newName    = "../i/" . $uniqueName . "." . $fileInfo['extension'];

		$moved = move_uploaded_file($_FILES['upload-file']['tmp_name'], $newName);
		if(!$moved)
			error("Error while moving the image.");

		header("Location: list.php?i=" . $uniqueName);
	}
	else {

		$title = "Admin";
		$page  = "index";

		require('member.php');
		require('header.php');

?>
<form method="post" class="upload-form" enctype="multipart/form-data">

	<div class="form-group">
		<div class="btn btn-lg upload-file">
			<span>Upload</span>
			<input type="file" name="upload-file" accept="image/*" class="upload" onchange="form.submit()" />
		</div>
	</div>

</form>

<?php

		require('footer.php');
	}
?>
