<?php

namespace AppPHP;

use AppPHP\DB\Connection;

require_once '../vendor/autoload.php';

new Connection();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовое задание | Stat4Market</title>
</head>

<body>
    <ul>
        <li><a href="migration.php">Migration</a></li>
        <li><a href="taskOne.php">TaskOne</a></li>
        <li><a href="taskTwo.php">TaskTwo</a></li>
        <li><a href="taskThree.php">TaskThree</a></li>
    </ul>
</body>

</html>