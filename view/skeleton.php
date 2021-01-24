<!DOCTYPE html>
<html lang="en">
<head>
    <? include "../view/templates/html-head.php" ?>
    <title>Badnotes</title>
</head>
<body>
<? include "../view/templates/header.php" ?>
<? /** @var string $page */
include "../view/pages/" . $page . ".php" ?>

Hello World! <br>
<? echo "Page = " . $page ?>

<? include "../view/templates/footer.php" ?>
</body>
</html>
