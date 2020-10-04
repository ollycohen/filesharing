<?php
session_start();
$fileName = isset($_POST["filename"]) ? $_POST["filename"] : "";
// https://classes.engineering.wustl.edu/cse330/index.php?title=PHP#Other_PHP_Tips
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($fileName);
header("Content-Type: " . $mime);
header('Content-disposition: inline; filename="' . basename($fileName) . '";');
readfile($fileName);
