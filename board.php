<?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Board</title>
    </head>
    <body>
        <?php
        $board = new Board($db);
        ?>
    </body>
</html>
