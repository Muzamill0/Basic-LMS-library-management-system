<?php require_once '../../database/connection.php' ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../../');
}

$title = "Assign Book";

$sql = "SELECT * FROM `books`";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);


$sql = "SELECT * FROM `users` WHERE `user_type` = 'Student'";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);

$user_id = '';
$book_id = '';
$date = '';
$status = '';
$error = '';

if (isset($_POST['submit'])) {

    $user_id = htmlspecialchars($_POST['user_id']);
    $book_id = htmlspecialchars($_POST['book_id']);
    $date = htmlspecialchars($_POST['date']);



    if (empty($user_id)) {
        $error = "Select user!";
    } elseif (empty($book_id)) {
        $error = "Select book !";
    } elseif (empty($date)) {
        $error = "Enter book date!";
    } else {

        $sql = "SELECT * FROM `users` WHERE `id` = '$user_id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        $sql = "SELECT * FROM `books_borrowed` WHERE `user_id` = '$user_id' AND `status` = 'Borrowed'";
        $result = $conn->query($sql);

        if($result->num_rows >= 3){
            $error = "Student already borrowed 3 book";
        } else{
            // creating unique id 
        $name = explode(' ', $user["name"]);
        $firstName = $name[0];
        $lastName = $name[1];
        $firstLetter = substr($firstName, 0, 1);
        $lastLetter = substr($lastName, 0, 1);
        $unique_id = $firstLetter . $lastLetter . '-' .rand(000, 999);
        $status = "Borrowed";

        $sql = "INSERT INTO `books_borrowed`(`user_id`, `book_id`, `unique_id`,`status` ,`date`) VALUES ('$user_id','$book_id','$unique_id','$status' ,'$date')";
        if ($conn->query($sql)) {

            $sql = "SELECT * FROM `books` WHERE `id` = '$book_id'";
            $result = $conn->query($sql);
            $book = $result->fetch_assoc();

            $quantity = $book["quantity"] - 1;
            $borrowed = $book["borrowed"] + 1;

            $sql = "UPDATE `books` SET `quantity`= '$quantity',`borrowed`='$borrowed' WHERE `id` = '$book_id'";

            if ($conn->query($sql)) {
                $success = "Book Assigned succesfully with Unique ID " . $unique_id;
            } else {
                $error = "book has Failed to Assign!";
            }
        } else {
            $error = "book has Failed to Assign!";
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
                width: 60%;
            }

            select {
                width: 100%;
                padding: 8px;
                margin-bottom: 16px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .input-head {
                display: flex;
                justify-content: space-around;
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
                            <h3>Assign Book</h3>
                        </div>
                        <div>
                            <a href="./">Back</a>
                        </div>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <?php require_once('../../partials/alerts.php'); ?>

                        <label for="title">Student:</label>
                        <select name="user_id">
                            <option value="" selected disabled>Select the Student</option>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?php echo $user["id"]; ?>">
                                    <?php echo $user["name"]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="publisher">Book:</label>
                        <select name="book_id">
                            <option value="" selected disabled>Select the Book</option>
                            <?php foreach ($books as $book) : ?>
                                <option value="<?php echo $book["id"]; ?>">
                                    <?php echo $book["title"]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" value="<?php echo $date ?>">

                        <button type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </section>
        </div>
    </body>

    </html>
</span>