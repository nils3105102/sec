<?php
session_start();
if (isset($_POST["submit"])) {
    include_once 'bd.php';

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars(md5($_POST['password']));

    $database = new dbConnect();

    $db = $database->openConnection();

    $sql = "select * from registered_users where email = '$email' and password= '$password'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_ASSOC);

    $id = @$result[0]['id'];
    //$name = @$result[0]['name'];
    //$email = @$result[0]['email'];
    $_SESSION['emailname'] = $email;
    $_SESSION['id'] = $id;

    $database->closeConnection();
    /*header('location: home.php');*/
}

if(isset($_SESSION['emailname']) and isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $email = $_SESSION['emailname'];
    header('location: home.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="" method="POST">
            <label>Email</label>
                <input type="text" name="email" required placeholder="Enter your Email ID"> <br />
            <label>Password</label>
                <input type="Password" name="password" required placeholder="Enter your password"> <br />

                <button type="submit" name="submit">Login</button> <br />
                <a href="index.php"><button type="button" name="submit">Signup</button></a>
    </form>
</body>
</html>
