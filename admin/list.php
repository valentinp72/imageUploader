<?php

	$title = "List";
	$page  = "list";

	require('member.php');
	require('header.php');

	$rootURL = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

	if(!empty($_GET)){
		if(!empty($_GET['i'])){
			$requestFile = $_GET['i'];

			if(ctype_alnum($requestFile) && strlen($requestFile) == 5){
				// check if the file exists
				$data = exec("ls ../i/" . $requestFile . ".* | head -1", $output, $return);

				if(!empty($data)){

					echo "\t\t\t\t<h2>File " . $requestFile . " :</h2>\n";
					echo "\t\t\t\t<img src='/". $data . "' class='preview-image' />\n";
					echo "\t\t\t\t<pre><a href='" . $rootURL . $requestFile . "'>" . $rootURL . $requestFile . "/</a></pre></td>\n";

				}
				else {
					echo "<div class='alert alert-warning'><strong>Warning! </strong>The file " . $requestFile . " could not be found!</div>";
				}
			}
		}
	}

	$fileList = scandir("../i/");
	$fileList = array_diff($fileList, array('..', '.', '.DS_Store', '.gitkeep'));

	if(empty($fileList)){
		echo "<h1>No files found</h1>";
	}
	else {

	?>

	<h1>List of images</h1>

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Link</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php

					foreach ($fileList as $id => $file) {
						$fileName = pathinfo($file)['filename'];

						echo "\n\t\t\t\t<tr>\n";
						echo "\t\t\t\t	<td><a href='list.php?i=" . $fileName . "'>" . $file ."</a></td>\n";
						echo "\t\t\t\t	<td><pre><a href='" . $rootURL . $fileName . "'>" . $rootURL . $fileName . "/</a></pre></td>\n";
						echo "\t\t\t\t	<td><a href='delete.php?i=" . $fileName . "'>Delete</a></td>\n";
						echo "\t\t\t\t</tr>\n";
					}

				?>
			</tbody>
		</table>
	</div>
	<?php

	}

	require('footer.php');

?>
