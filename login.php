<?php
session_start();
include 'includes.php';
?>

<?php 

$login = new Login();

if (!$login->getSession()) {
    // niet ingelogd
    echo "Je bent niet ingelogd.";
}
else {
    // wel ingelogd
    echo "Je bent ingelogd.";
    header("location:index.php");
}


?>






<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
        
        
        
        <?php
        // put your code here
        ?>
    </body>
</html>
