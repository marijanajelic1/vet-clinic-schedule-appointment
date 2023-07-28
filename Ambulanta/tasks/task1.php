<?php
require_once "tasksindex.php";
mysqli_set_charset($conn, 'utf8');

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $name = $conn->real_escape_string($_POST['name1']);
    $lastname = $conn->real_escape_string($_POST['lastname1']);
    $email = $conn->real_escape_string($_POST['email1']);
    $datetime = $conn->real_escape_string($_POST['datetime1']);
    $service = $conn->real_escape_string($_POST['service1']);
    $animal = $conn->real_escape_string($_POST['animal1']);

    $q = "SELECT j('$name', '$lastname', '$email', '$datetime','$service','$animal');";
    $res = $conn->query($q);
}
?>