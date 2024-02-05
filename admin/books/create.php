<?php require_once '../../database/connection.php' ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../../');
}

$title = "Create Book";

    $book_title= '';
     $publisher= '';
     $publication_year= '';
     $version= '';
     $field= '';
     $quantity= '';
     $status= '';
     $error = '';

if (isset($_POST['submit'])) {

    $book_title = htmlspecialchars($_POST['title']);
    $publisher = htmlspecialchars($_POST['publisher']);
    $publication_year = htmlspecialchars($_POST['publication_year']);
    $version = htmlspecialchars($_POST['version']);
    $field = htmlspecialchars($_POST['field']);
    $quantity = htmlspecialchars($_POST['quantity']);

    

    if (empty($book_title)) {
        $error = "Enter book title!";
    } elseif (empty($publisher)) {
        $error = "Enter book publisher!";
    } elseif (empty($publication_year)) {
        $error = "Enter book published year!";
    } elseif (empty($version)) {
        $error = "Enter book Version!";
    } elseif (empty($field)) {
        $error = "Enter book field!";
    }  elseif (empty($quantity)) {
        $error = "Enter book quantity!";
    }else {
        $sql = "INSERT INTO `books`(`title`, `publisher`, `publication_year`, `version`, `field`,`quantity`) VALUES ('$book_title','$publisher','$publication_year', '$version','$field', $quantity)";
        if ($conn->query($sql)) {
            $success = "Book created succesfully";
        } else {
            $error = "book has Failed to create!";
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
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo $book_title ?>">

                        <label for="publisher">Publisher:</label>
                        <input type="text" id="publisher" name="publisher" value="<?php echo $publisher ?>">

                        <label for="publication_year">Publication Year:</label>
                        <input type="number" id="publication_year" name="publication_year" value="<?php echo $publication_year ?>">

                        <label for="version">Version:</label>
                        <input type="text" id="version" name="version" value="<?php echo $version ?>">

                        <label for="field">Field:</label>
                        <input type="text" id="field" name="field" value="<?php echo $field ?>">

                        <label for="quantity">Quantity:</label>
                        <input type="text" id="quantity" name="quantity" value="<?php echo $quantity ?>">

                        <button type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </section>
        </div>
    </body>

    </html>
</span>