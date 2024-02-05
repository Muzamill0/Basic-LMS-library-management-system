<?php
if (isset($error) && !empty($error)) { ?>
    <div class="error alert">
        <?php
        echo $error;
        ?>
    </div>
<?php
}

if (isset($success) && !empty($success)) { ?>
    <div class="success alert">
        <?php
        echo $success;
        ?>
    </div>
<?php
}
?>

<style>
    .alert{
        padding: 5px;
        border-radius: 4px;
        color: red;
    }
    .error{
        background-color: #f23565;
        color: #ffff;
    }

    .success{
        background-color: lightgreen;
    }

</style>