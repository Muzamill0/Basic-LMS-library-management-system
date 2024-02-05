<?php require_once '../../database/connection.php' ?>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../../');
}

$title = "Students";
$serails_number = 1;

$sql = "SELECT * FROM `users` WHERE `user_type` = 'Student'";

$result = $conn->query($sql);

$students = $result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($result->fetch_all(MYSQLI_ASSOC));
// echo "</pre>";
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
            .header a{
                background-color: skyblue;
                padding: 5px 20px;
                border-radius: 3px;
                transition: ease-in .3s;
            }
            .header a:hover{
                background-color: white;
                border: 1px solid black;
            }

            .table-wrapper {
                margin: 10px 0;
                box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
            }

            .fl-table {
                border-radius: 5px;
                font-size: 12px;
                font-weight: normal;
                border: none;
                border-collapse: collapse;
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
                background-color: white;
            }

            .fl-table td,
            .fl-table th {
                text-align: center;
                padding: 8px;
            }

            .fl-table td {
                border-right: 1px solid #f8f8f8;
                font-size: 12px;
            }

            .fl-table thead th {
                color: #ffffff;
                background: #4FC3A1;
            }


            .fl-table thead th:nth-child(odd) {
                color: #ffffff;
                background: #324960;
            }

            .fl-table tr:nth-child(even) {
                background: #F8F8F8;
            }

            /* Responsive */

            @media (max-width: 767px) {
                .fl-table {
                    display: block;
                    width: 100%;
                }

                .table-wrapper:before {
                    content: "Scroll horizontally >";
                    display: block;
                    text-align: right;
                    font-size: 11px;
                    color: white;
                    padding: 0 0 10px;
                }

                .fl-table thead,
                .fl-table tbody,
                .fl-table thead th {
                    display: block;
                }

                .fl-table thead th:last-child {
                    border-bottom: none;
                }

                .fl-table thead {
                    float: left;
                }

                .fl-table tbody {
                    width: auto;
                    position: relative;
                    overflow-x: auto;
                }

                .fl-table td,
                .fl-table th {
                    padding: 20px .625em .625em .625em;
                    height: 60px;
                    vertical-align: middle;
                    box-sizing: border-box;
                    overflow-x: hidden;
                    overflow-y: auto;
                    width: 120px;
                    font-size: 13px;
                    text-overflow: ellipsis;
                }

                .fl-table thead th {
                    text-align: left;
                    border-bottom: 1px solid #f7f7f9;
                }

                .fl-table tbody tr {
                    display: table-cell;
                }

                .fl-table tbody tr:nth-child(odd) {
                    background: none;
                    font-size: 15px;
                }

                .fl-table tr:nth-child(even) {
                    background: transparent;
                    font-size: 15px;
                }

                .fl-table tr td:nth-child(odd) {
                    background: #F8F8F8;
                    border-right: 1px solid #E6E4E4;
                }

                .fl-table tr td:nth-child(even) {
                    border-right: 1px solid #E6E4E4;
                }

                .fl-table tbody td {
                    display: block;
                    text-align: center;
                }
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
                        <h3>Users</h3>
                        <a href="./create.php">Add Student</a>
                    </div>
                    <div class="table-wrapper">
                    <?php if(count($students) > 0){?>
                        <table class="fl-table">
                            <thead>
                                <tr>
                                    <th>S no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($students as $student) {  ?>
                                    <tr>
                                        <td><?php echo $serails_number ?></td>
                                        <td><?php echo $student["name"] ?></td>
                                        <td><?php echo $student["email"] ?></td>
                                        <td>
                                            <a href="./edit.php?id=<?php echo $student['id']; ?>">Edit</a>
                                        </td>
                                    </tr>

                                    <?php
                                $serails_number++;
                                } ?>
                            <tbody>
                        </table>
                        <?php } else{  ?>
                            <p>No Record Found</p>
                            <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </body>

    </html>
</span>