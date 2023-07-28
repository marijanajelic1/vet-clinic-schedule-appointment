<?php
require_once "tasksindex.php";
mysqli_set_charset($conn, 'utf8');

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $name = $conn->real_escape_string($_POST['name8']);
    $lastname = $conn->real_escape_string($_POST['lastname8']);
    $email = $conn->real_escape_string($_POST['email8']);
    $datetime = $conn->real_escape_string($_POST['datetime8']);
    $service = $conn->real_escape_string($_POST['service8']);
    $term_id= $conn->real_escape_string($_POST['termid8']);

    $q = "CALL l('$datetime','$term_id','$service','$name', '$lastname', '$email');
    ";
    $res = $conn->query($q);
}
?>