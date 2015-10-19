<?php

include 'dash.php';

set_time_limit(0);

$uploadPath = "uploads";
$oldFiles = array();

//add all file in upload folder
$oldFiles = scandir($uploadPath);

while (1) { 
	$uploadedFiles = scandir($uploadPath);
	$newFiles = array_merge(array_diff($uploadedFiles, $oldFiles));

	for($i = 0; $i < count($newFiles); ++$i) {
		//if the file is new, then add it to the list and process dash
		$ext = getFileExtension($newFiles[$i]);
		if(strcmp($ext, "mp4") === 0) {
			makeMpd($uploadPath . DIRECTORY_SEPARATOR . $newFiles[$i]);
			print("Processed: " . $newFiles[$i] . "\n");
		}
	}
	$oldFiles = scandir($uploadPath);
	print("watching... \n");
	sleep(3); 
}

?>