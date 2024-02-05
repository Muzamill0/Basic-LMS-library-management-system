<?php require_once '../../database/connection.php' ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../../');
}

$title = "Create Student";

$name = '';
$email = '';
$password = '';

if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $user_type = "Student";

    if (empty($name)) {
        $error = "Enter student name!";
    } elseif (empty($email)) {
        $error = "Enter student email!";
    } elseif (empty($password)) {
        $error = "Enter student password!";
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Email already exist";
        }
         else {
            $new_pass = sha1($password);
            $sql = "INSERT INTO `users` ( `name`, `email`, `password`,`user_type`) VALUES ('$name','$email','$new_pass', '$user_type')";
            if ($conn->query($sql)) {
                $success = "student created succesfully";
            } else {
                $error = "student has Failed to create!";
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
                            <h3>Add Book</h3>
                        </div>
                        <div>
                            <a href="./">Back</a>
                        </div>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <?php require_once('../../partials/alerts.php'); ?>
                        <label for="name">Fullname:</label>
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