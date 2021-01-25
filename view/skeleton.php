<!DOCTYPE html>
<html lang="en">
<head>
    <? include "../view/templates/html-head.php" ?>
    <title>Badnotes</title>
</head>
<body>
<? include "../view/templates/header.php" ?>

<div class="container">
    <? /** @var string $page */
    include "../view/pages/" . $page . ".php" ?>


    <? echo "Page = " . $page ?>
</div>

<? include "../view/templates/footer.php" ?>
</body>
</html>
