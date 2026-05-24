<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "../src/partial/head.php";
    require_once '../src/function.php';
    require_once '../test.php';
    ?>
    <?php
    great();
    getville();

     

    ?>

    <form action="#" method = "POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? ''); ?>" placeholder="Enter your name" >
    <button type="submit">Greet</button>



    <form action="#" method="POST">
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" placeholder="Enter a city" value="<?php echo htmlspecialchars($ville ?? ''); ?>">
        <button type="submit">Search</button>
    </form>
</body>
</html>


