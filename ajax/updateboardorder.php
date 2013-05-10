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
    $categories = json_decode(stripslashes($_POST['forums']),true);
    foreach($categories as $category) {
        $categoryId = $category['id'];
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

if (isset($_POST['newforum'])) {
    $fName = $_POST['newforum'][0];
    $cId = $_POST['newforum'][1];
    $category = new Category($db);
    if ($category->getById($cId)) {
        $forum = new Forum($db);
        $forum->setCategory($cId);
        $forum->setForumName($fName);
        if ($forum->save()) {
            echo $forum->getId();
        }
    }
}

if (isset($_POST['newcategory'])) {
    $cName = $_POST['newcategory'][0];
    $category = new Category($db);
    $category->setCategoryname($cName);
    if ($category->save()) {
       echo $category->getId();
    }
}



?>
