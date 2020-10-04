<!-- Login page for users: olly, daniel, tarzan, tropic -->
<?php
// Logs out the old user 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Enter Your Username</title>
</head>

<body>
    <div class="container">
        <h1 class="jumbotron">Welcome to TroZanne File Sharing Site!</h1>
        <form action="view.php" method="POST">
            <h3>Enter your username to log in:
                <input type="text" name="user">
                <input type="submit" name="signup" value="signup">
                <button type="submit" class="btn-primary">Log In</button>
            </h3>
        </form>
    </div>
</body>

</html>
