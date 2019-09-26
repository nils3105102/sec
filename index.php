<?php
if (isset($_POST["submit"])) {
    include_once 'bd.php';

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars(md5($_POST['password']));
    //$password = md5($pass); //захешированный пароль
    //$confpass = htmlspecialchars($_POST['confirm_password']); //подтверждение пароля
    $database = new dbConnect();

    $db = $database->openConnection();
    $sql1 = "select name, email from registered_users where email='$email'";

    $user = $db->query($sql1);
    $result = $user->fetchAll();
    $_SESSION['emailname'] = @$result[0]['email'];

    if (empty($result)) {
        $sql = "insert into registered_users (name,email, password) values('$name','$email','$password')";

        $db->exec($sql);

        $database->closeConnection();
        $response = array(
            "message" => "You have registered successfully.<br/><a href='login.php'>Now Login</a>."
        );
    } else {
        $response = array(
            "message" => "Email already in use.",
        );
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <?php
        if (! empty($response)) {
            echo $response["message"];
        }
    ?>
    <form action="" method="POST">
            <label>Name</label>
                <input type="text" name="name" placeholder="Enter your name" required> <br />
            <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter your Email" pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$" required> <br />
            <label>Password</label>
                <input type="Password" name="password"  placeholder="Enter your password" required> <br />
            <!--<label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Re-enter your password" required> <br />-->
                <button type="submit" name="submit">Sign Up</button> <br />
                <a href="login.php"><button type="button" name="submit">Login</button></a> <br />

    </form>
</body>
</html>
