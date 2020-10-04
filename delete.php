<!-- Called when user deletes a file  --> 
<?php
session_start();
$filename = isset($_POST["filename"]) ? $_POST["filename"] : "";
// https://www.php.net/manual/en/function.unlink.php
unlink($filename);
?>
<meta http-equiv="Refresh" content="0; url=/view.php" />