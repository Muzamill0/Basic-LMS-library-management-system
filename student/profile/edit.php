<?php require_once '../../database/connection.php' ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../../');
} else{
    $id = $_SESSION['user']["id"];
}
$title = "Edit Profile";

$name = $email =  "";

$sql = '';

$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user) {
    $name = $user["name"];
    $email = $user["email"];
}
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (isset($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        $new_pass = sha1($password);
    } else {
        $new_pass = $user["password"];
    }

    $user_type = "Student";
    if (empty($name)) {
        $error = "Enter user name!";
    } elseif (empty($email)) {
        $error = "Enter user email!";
    } elseif (empty($password)) {
        $error = "Enter user password!";
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `id` != '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Email already exists for another user";
        } else {
            $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `password`='$new_pass', `user_type`='$user_type' WHERE `id`= '$id' ";
            if ($conn->query($sql)) {
                $success = "user updated successfully";
            } else {
                $error = "user update failed: ";
            }
        }
    }
}
?>
<span style="font-family: verdana, geneva, sans-serif;">
    <!DOCTYPE html>
    <html lang="en">
    <?php require_once('../layouts/head.php'); ?>

    <body>
        <style>
            .header {
                display: flex;
                justify-content: space-between;
            }

            .header a {
                background-color: skyblue;
                padding: 5px 20px;
                border-radius: 3px;
                transition: ease-in .3s;
            }

            .header a:hover {
                background-color: white;
                border: 1px solid black;
            }

            form {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 50%;
            }

            label {
                display: block;
                margin-bottom: 8px;
            }

            input {
                width: 100%;
                padding: 8px;
                margin-bottom: 12px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            button {
                background-color: #4caf50;
                color: #fff;
                padding: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            button:hover {
                background-color: #45a049;
            }
        </style>
        <div class="container">
            <?php require_once('../layouts/navbar.php'); ?>
            <section class="main">
                <div class="main-top">
                    <p>AAU Libraray</p>
                </div>
                <div class="main-body">
                    <div class="header">
                        <div>
                            <h3>Edit Profile</h3>
                        </div>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> ?id=<?php echo $id; ?>" method="POST">
                        <?php require_once('../../partials/alerts.php'); ?>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $name ?>">

                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="<?php echo $email ?>">

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">

                        <button type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </section>
        </div>
    </body>

    </html>
</span>