<?php
$target_dir = getcwd() . "\\images\\";
//$target_file = getcwd() . $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file =  $target_dir . $_POST['screenID'] . ".gif";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".<br>";
    $uploadOk = 1;
  } else {
    echo "File is not an image.<br>";
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 100000000) {
  echo "Sorry, your file is too large.<br>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
	if ($_POST['screenID'] == "all")
	{
		for ($i = 1; $i <= $_POST['screenCount']; $i++) {
			if (file_exists($target_dir . $i . ".gif.ooo")) {
				copy($target_file, $target_dir . $i . ".gif.ooo");
			} else {
				copy($target_file, $target_dir . $i . ".gif");
			}
		}
	}
	if ($_POST['screenID'] == "ooo")
	{
		for ($i = 1; $i <= $_POST['screenCount']; $i++) {
			if (file_exists($target_dir . $i . ".gif.ooo")) {
				copy($target_file, $target_dir . $i . ".gif");
			}
		}
	}
  } else {
    echo "Sorry, there was an error uploading your file.<br>";
	echo $_FILES["fileToUpload"]["tmp_name"] . "<br>";
	echo $target_file . "<br>";
  }
}
?>
<script type="text/javascript">
window.location = "gif-upload.php?screenCount=" + <?php echo $_POST['screenCount']; ?>;
</script>      