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

$screenID = $params['screenID'];

if (!is_numeric($screenID) && $screenID != "all" && $screenID != "ooo") {
	$screenID = 1;
}

$target_dir = getcwd() . "\\images\\";

$target_file =  $target_dir . $screenID . ".gif";

echo "<p hidden id='modified'>" . filemtime($target_file) . "</p>";
?>