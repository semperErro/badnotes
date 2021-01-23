<?php

use controller\UserController;

session_start();

$pages = [
    "home.php",
    "login.php",
    "register.php",
    "404.php",
    "notes.php"
];
if (!isset($_GET["page"])) {
    $_GET["page"] = "home";
}

$page = in_array($_GET['page'], $pages) ? $_GET['page'] : '404.php';

if ($page == "notes.php" && !$_SESSION["loggedin"]) {
    $page = "login.php";
}
if (isset($_POST["action"]) && $_POST["action"] == "register") {
    $userController = new UserController();
    $userController->createUser($_POST["name"], $_POST["email"], $_POST["passwd"], $_POST["passwd-repeated"]);
}

header("location: /index.php?page=notes");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <? include "../view/templates/html-head.php" ?>
    <title>Badnotes</title>
</head>
<body>
<? include "../view/templates/header.php" ?>
<? include "../view/pages/" . $page ?>

Hello World!

<? include "../view/templates/footer.php" ?>
</body>
</html>