<!-- upload.php - php script for uploading a new file -->
<!-- Used this site for PHP Upload
    https://www.w3schools.com/php/php_file_upload.asp -->

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>TroZanne File System</title>
</head>

<body>
    <div class="container">
        <?php
        session_start();
        $user = $_SESSION["user"];
        $newfile = isset($_FILES['newfile']['name']) ? basename($_FILES["newfile"]["name"]) : '';
        // Regex for invalid filenames
        if (!preg_match('/^[\w_\.\-]+$/', $newfile)) {
            echo "Invalid filename";
        ?>
            <form action="view.php">
                <input type="submit" value="Go back to your homepage" class="btn-primary" />
            </form>
    </div>
</body>

</html>
<?php
            exit;
        }
        $target_dir = "/srv/m2/uploads/$user";
        if (move_uploaded_file($_FILES['newfile']['tmp_name'], "$target_dir/$newfile")) {
            echo "<br>The file " . basename($_FILES["newfile"]["name"]) . " has been uploaded.<br><br>";
        } else {
            echo "<br>Sorry, there was an error uploading your file. Error #" . $_FILES["newfile"]["error"] . "<br><br>";
        }
?>
<form action="view.php">
    <input type="submit" value="Go back to your homepage" class="btn-primary" />
</form>
</div>
</body>

</html>