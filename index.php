<?php require_once './database/connection.php' ?>


<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['user_type'] == "Admin") {
        header('location: ./admin/dashboard/dashboard.php');
    } elseif ($_SESSION['user']['user_type'] == "Student") {
        header('location: ./student/dashboard.php');
    } 
}
$email = "";
$password = "";
if (isset($_POST['submit'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($email)) {
        $error = "Enter your email!";
    } elseif (empty($password)) {
        $error = "Enter your password!";
    } else {
        $hashed_password = sha1($password);
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$hashed_password' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user;
            if ($user["user_type"] == "Admin") {
                header('location: ./admin/dashboard/dashboard.php');
            } elseif ($user["user_type"] == "Student") {
                header('location: ./student/dashboard/dashboard.php');
            }
        } else {
            $error = "Invalid login credentials!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="login-page">
            <div class="card">
                <div class="card-body">
                </div>
                <div class="form">
                    <div class="heading">
                        <p>Welcome to AAU Libraray
                        </p>
                    </div>
                    <?php require_once('./partials/alerts.php'); ?>
                    <form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <input type="text" name="email" placeholder="Email" />
                        <input type="password" name="password" placeholder="Password" />
                        <button name="submit" type="submit">login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>