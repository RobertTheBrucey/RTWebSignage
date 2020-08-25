<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Cache-control" content="No-Cache, No-Store, Must-Revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<meta charset="UTF-8">
	<title>RT Web Signage</title>
	<!--Favicon Links -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<!--CSS LINK-->
	<link rel="stylesheet" type="text/css" href="display.css">
</head>
<body class="displayBody">
	<div class="myBack" id="myImage"></div>
	<script src="display.js"></script>
	<iframe id="modFrame" tabindex="-1"></iframe>
	<script>
	var url_string = window.location.href; //window.location.href
	var url = new URL(url_string);
	var screenID = url.searchParams.get("screenID");
	if (isNaN(screenID)) {
		screenID = 1;
	}
	document.getElementById("modFrame").id = "modFrame" + screenID;
	init();
	</script>
</body>
</html>