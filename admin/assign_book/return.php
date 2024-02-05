<?php require_once '../../database/connection.php' ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../../');
}
$title = "Edit Book";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
}

$sql = "SELECT users.*, books.*, books_borrowed.*
FROM users
JOIN books_borrowed ON users.id = books_borrowed.user_id
JOIN books ON books_borrowed.book_id = books.id
WHERE books_borrowed.id = '$id';";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$assignDate = new DateTime($data["date"]);
$next120Days = $assignDate->add(new DateInterval('P120D'));

$currentDate = new DateTime();
if ($data["status"]  == "Borrowed" && $next120Days < $currentDate) {
    $overdueDays = $currentDate->diff($next120Days)->days;
    $fine = $overdueDays * 50;
}

$status = "Returned";
$returned_date = $currentDate->format('Y-m-d');
$fine_amount = $fine;

$sql = "UPDATE `books_borrowed` SET `fine_amount`='$fine_amount',`returned_date`='$returned_date',`status`='$status' WHERE `id` = '$id' ";
if($conn->query($sql)){
    header('location: ./index.php');
}







// updating the book 
$book_id = $data['book_id'];

$sql = "SELECT * FROM `books` WHERE `id` = '$book_id' ";
$result = $conn->query($sql);
$book = $result->fetch_assoc();

$quantity = $book["quantity"] + 1;
$borrowed = $book["borrowed"] - 1;

$sql = "UPDATE `books` SET `quantity`= '$quantity',`borrowed`='$borrowed' WHERE `id` = '$book_id'";
if ($conn->query($sql)) {
}
