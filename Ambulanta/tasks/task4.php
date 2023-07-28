<?php
require_once "tasksindex.php";
require_once "validation.php";
mysqli_set_charset($conn, 'utf8');

if(empty($_SESSION['id'])) {
    header('../login.php');
}

$id = $_SESSION['id'];
$validated = true;
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $conn->real_escape_string($_POST['name3']);
    $lastname = $conn->real_escape_string($_POST['lastname3']);
    $phone = $conn->real_escape_string($_POST['phone3']);
    $email = $conn->real_escape_string($_POST['email3']);
    $job = $conn->real_escape_string($_POST['job3']);


    $q = "UPDATE `worker`
            SET `name` = '$name', `last_name` = '$lastname', `phone` = '$phone', `email` = '$email',`job_type`='$job'
            WHERE `user_id` = '$id'; ";
    var_dump($q);
    $res = $conn->query($q);
    
 }
 
?>