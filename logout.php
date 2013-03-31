<?php
session_start();
include 'includes.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_destroy();
        echo "Je bent uitgelogd.";
        header("location:index.php");
        ?>
    </body>
</html>
