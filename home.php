<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home page</title>
</head>
<body>
        Welcome <?php echo $_SESSION["emailname"]; ?>! Click to <a href="logout.php">Logout</a>.

</body>
</html>
