<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? 'Guest';
    $greeting = greet($name);
    echo $greeting;
}


function greet($name) {
    return "Hello, " . $name . "!";
}
?>