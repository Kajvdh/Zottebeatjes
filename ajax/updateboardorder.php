<?php
include '../includes.php';
$database = new Database();
$db = $database->getConnection();


if (isset($_POST['categories'])) {
    $categories = $_POST['categories'];
    $order = 1;
    foreach($categories as $c) {
        $category = new Category($db);
        $category->getById($c);
        $category->setOrder($order);
        $category->update();
        $order++;
    }
}


if (isset($_POST['forums'])) {
    $categories = json_decode($_POST['forums'],true);
    foreach($categories as $category) {
        $categoryId = $category['id'];
        echo $categoryId."<br />".PHP_EOL;

        $order = 1;
        foreach ($category['forums'] as $f) {
            $forum = new Forum($db);
            $forum->getById($f['id']);
            $forum->setCategory($categoryId);
            $forum->setOrder($order);

            $forum->update();
            $order++;
        }
    }
}

?>
