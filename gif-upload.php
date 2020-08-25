<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Cache-control" content="No-Cache, No-Store, Must-Revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta charset="UTF-8">
		<title>RT Web Signage Admin</title>
		<!--Favicon Links -->
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<!--CSS LINK-->
		<link rel="stylesheet" type="text/css" href="display.css">
		<?php
			// Inintialize URL to the variable 
			$url = $_SERVER['REQUEST_URI']; 

			// Use parse_url() function to parse the URL  
			// and return an associative array which 
			// contains its various components 
			$url_components = parse_url($url); 

			// Use parse_str() function to parse the 
			// string passed via URL 
			parse_str($url_components['query'], $params); 

			$screenCount = $params['screenCount'];
			if ($screenCount < 1) {
				$screenCount = 8;
			}
			echo "<p hidden id='screenCount'>" . $screenCount . "</p>";
		?>
	</head>
	<body style="background-color:#4161AB">
	<ul class="header-space" style="background-color:#4161AB">
	<li>
		<form action='upload.php' method='post' enctype='multipart/form-data' id="form">
		<h2>Select image for all screens: </h2>
		<img src=<?php echo "'images/all.gif?" . time() . "'"; ?> id='image-all'><br>
		  <label for="fileToUpload" class="customForm">
			Upload Image
		  </label>
		  <input type='file' name='fileToUpload' id='fileToUpload' onchange="javascript:document.getElementById('form').submit();"><br>
		  <input type='hidden' name='screenID' value="all">
		  <input type='hidden' name='screenCount' value=<?php echo "'" . $screenCount . "'" ?>>
		</form>
		<iframe id='modFrameall' tabindex='-1'></iframe>
	</li>
	<li>
		<form action='upload.php' method='post' enctype='multipart/form-data' id="form-ooo">
		<h2>Select image for Out-Of-Order: </h2>
		<img src=<?php echo "'images/ooo.gif?" . time() . "'"; ?> id='image-ooo'><br>
		  <label for="fileToUpload-ooo" class="customForm">
			Upload Image
		  </label>
		  <input type='file' name='fileToUpload' id='fileToUpload-ooo' onchange="javascript:document.getElementById('form-ooo').submit();"><br>
		  <input type='hidden' name='screenID' value="ooo">
		  <input type='hidden' name='screenCount' value=<?php echo "'" . $screenCount . "'" ?>>
		</form>
		<iframe id='modFrameooo' tabindex='-1'></iframe>
		<form action='ooo-toggle.php' method='post' enctype='multipart/form-data' id='form-ooo-all'>
			  <input type='hidden' name='screenID' value='all'>
			  <input type='hidden' name='screenCount' value=<?php echo "'" . $screenCount . "'" ?>>
			  <input type='submit' name='toggleOOO-all' value='Set OOO for All' style='border-color:#44EE44'>
		</form>
		<form action='ooo-toggle.php' method='post' enctype='multipart/form-data' id='form-ooo-none'>
			  <input type='hidden' name='screenID' value='none'>
			  <input type='hidden' name='screenCount' value=<?php echo "'" . $screenCount . "'" ?>>
			  <input type='submit' name='toggleOOO-none' value='Unset OOO for All' style='border-color:#EE4444'>
		</form>
	</li>
	<li>
		<h2>Number of screens: </h2>
		<form>
			<label for="screenCount">Screen Count:</label><br>
			<input type="text" id="screenCount" name="screenCount" value=<?php echo '"' . $screenCount . '"'?>><br>
			<input type='submit' value='Change' name='submit'><br>
		</form>
	</li>
	</ul>
		<div class="layout-main">
			<ul class="bruce-pic-space">
				<?php
				for ($i = 1; $i <= $screenCount; $i++) {
				echo
				"<li>
				<a href='display.php?screenID=" . $i . "'><img src='images/" . $i . ".gif?cache=" . time() . "' alt='' id=\"image" . $i . "\"></a>
				<form action='upload.php' method='post' enctype='multipart/form-data' id='form" . $i . "'>
				  <label for=\"fileToUpload" . $i . "\" class=\"customForm\">
					Upload Image To Screen " . $i . "
				  </label>
				  <input type='hidden' name='screenID' value='" . $i . "'>
				  <input type='hidden' name='screenCount' value='" . $screenCount . "'>
				  <input type='file' name='fileToUpload' id='fileToUpload" . $i . "' onchange=\"javascript:document.getElementById('form" . $i . "').submit();\">
				</form>
				<form action='ooo-toggle.php' method='post' enctype='multipart/form-data' id='form-ooo" . $i . "'>
				  <input type='hidden' name='screenID' value='" . $i . "'>
				  <input type='hidden' name='screenCount' value='" . $screenCount . "'>
				  <input type='submit' name='toggleOOO" . $i . "' value='";
				  if (file_exists("images/" . $i . ".gif.ooo")) {
					  echo "Disable Out-Of-Order' style='border-color:#EE4444'";
				  } else {
					  echo "Enable Out-Of-Order' style='border-color:#44EE44'";
				  }
				echo ">
				</form>
				<iframe id='modFrame" . $i . "' tabindex='-1'></iframe>
				</li>
				";
				}
				?>
			</ul>
		</div>
	<script src="display.js"></script>
    <script>
		var i;
		setInterval(function(){
			for (i = 0; i < <?php echo $screenCount ?>; i++) {
				var imgId = "image" + (i+1);
				checkImage(i+1, document.getElementById(imgId) );
			}
			checkImage("all", document.getElementById("image-all"));
			checkImage("ooo", document.getElementById("image-ooo"));
		}, <?php echo $screenCount ?> * 1000);
	 </script>
	</body>
</html>

