<?php require_once '../../database/connection.php' ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../../');
}

$title = 'Dashboard';
?>
<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<?php require_once('../layouts/head.php'); ?>
<body>
  <style>
    .box{
      margin: 40px 40px;
      width: 200px;
      height: 200px;
      border-radius: 4px;
      border: 1px solid black;
      background-color: lightblue;
    }
  </style>
  <div class="container">

  <?php require_once('../layouts/navbar.php'); ?>

    <section class="main">
      <div class="main-top">
        <p>AAU Libraray</p>
      </div>
      <div style="margin: 20px;" class="main-body">
        <p>Welcome To AAU Libraray Management System</p>
      </div>
    </section>
  </div>

</body>
</html></span>