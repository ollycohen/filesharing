<!-- view.php - the homepage of the file viewer -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>File Sharing by TroZanne</title>
</head>

<body>
    <div class="container">
        <?php
        session_start();

        //User not valid until we know it exists
        $valid = false;
        $signup = isset($_POST["signup"]);

        // Check if a user already exists
        if (isset($_SESSION["user"])) {
            // valid is whether the username is valid.
            $valid = true;
            $user = $_SESSION["user"];
        } else {
            // If user does not exist, We look at users.txt to see if they exist
            // this site helped: https://www.w3schools.com/php/php_file_open.asp
            $user = isset($_POST["user"]) ? filter_input(INPUT_POST, "user") : "";

            // Check regex of username
            // https://classes.engineering.wustl.edu/cse330/index.php?title=PHP#Sending_a_File_to_the_Browser
            if (!preg_match('/^[\w_\-]+$/', $user)) {
                echo "Invalid user. Remove special characters.";
                exit;
            }

            // If signup is clicked, write to users.txt.
            if($signup){
                $userstxt = fopen("/srv/m2/users.txt", "a") or die("Unable to validate username");
                fwrite($userstxt, $user ."\n");
                $signup = false;
            }

            $user = isset($_POST["user"]) ? $_POST["user"] : "";
            // username is not validated here because we validate it against users.txt below
            $userstxt = fopen("/srv/m2/users.txt", "r") or die("Unable to validate username");


            while (($line = fgets($userstxt)) !== false) {
                $line = str_replace(" ", "", $line);
                if (strcmp(rtrim($line), $user) == 0) {
                    $valid = true;
                    $_SESSION["user"] = $user;
                }
            }
            fclose($userstxt);
        }
        if (!$valid) {
            echo "User not registered. click here to go back:";
        ?>
            <form action="login.php" method="GET">
                <input type="submit" value="back" />
            </form>
        <?php } else { ?>
            <h1> Welcome <?php echo htmlspecialchars($_SESSION["user"]) ?></h1>
            <br><br>
            <?php
            // in case the user hasn't uploaded anything, make the directory that their files go in
            $target_dir = "/srv/m2/uploads/$user";
            if (!file_exists($target_dir)) {
                mkdir("$target_dir");
            ?>
                <h3> You don't have any files yet. </h3>
            <?php } else { ?>
                <h3> Here are your files. </h3>
            <?php
            }
            // This will display the table of uploaded files
            include "file_list.php" ?>
            <!-- The button to upload a new file -->
            <div class="jumbotron">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000000" />
                    <h3> Upload a File: </h3>
                    <br>
                    <input type="file" name="newfile" id="newfile" multiple class="btn btn-primary">
                    <input type="submit" class="btn btn-primary">
                    <input type="hidden" name="user" value="<?php echo htmlentities($user) ?>" />
                </form>
            </div>
            <!-- The button to login -->
            <form action="login.php" method="GET">
                <input type="submit" value="logout" class="btn btn-danger" />
            </form>
        <?php } ?>
    </div>
</body>

</html>
