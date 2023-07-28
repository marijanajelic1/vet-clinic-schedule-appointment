<?php
require_once "tasksindex.php";
mysqli_set_charset($conn, 'utf8');

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $service = $conn->real_escape_string($_POST['service2']);
    $price = $conn->real_escape_string($_POST['price2']);
    $duration = $conn->real_escape_string($_POST['duration2']);
    $name = $conn->real_escape_string($_POST['name2']);
    $lastname = $conn->real_escape_string($_POST['lastname2']);

    $q = "CALL b('$service','$price','$duration','$name','$lastname');";
    $res = $conn->query($q);
}
?>