<?php
$target_dir = getcwd() . "\\images\\";
$target_file =  $target_dir . $_POST['screenID'] . ".gif";
if ($_POST['screenID'] == "all") {
	for ($i = 1; $i <= $_POST['screenCount']; $i++) {
		$target_file = $target_dir . $i . ".gif";
		if (!file_exists($target_file . ".ooo")) {
			copy($target_file, $target_file . ".ooo");
			copy($target_dir . "ooo.gif", $target_file);
		}
	}
} elseif ($_POST['screenID'] == "none") {
	for ($i = 1; $i <= $_POST['screenCount']; $i++) {
		$target_file = $target_dir . $i . ".gif";
		if (file_exists($target_dir . $i . ".gif.ooo")) {
			rename($target_file . ".ooo", $target_file);
		}
	}
} elseif (file_exists($target_file . ".ooo")) {
	rename($target_file . ".ooo", $target_file);
} else {
	copy($target_file, $target_file . ".ooo");
	copy($target_dir . "ooo.gif", $target_file);
}
?>
<script type="text/javascript">
window.location = "gif-upload.php?screenCount=" + <?php echo $_POST['screenCount']; ?>;
</script>