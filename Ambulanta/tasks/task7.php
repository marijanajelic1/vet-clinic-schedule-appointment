<?php

session_start();

if(!isset($_SESSION['username'])) {
    die();
}

require_once "../connection.php";
mysqli_set_charset($conn, 'utf8');

if($_SERVER['REQUEST_METHOD'] == "POST") { 
    $query = "
    CALL g(@broj);
    ";

$stmt = $conn->query($query);

$query = "SELECT @broj;";
$stmt = $conn->query($query);

}
 
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <title>Task 7</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stilovi/style_tasks.css">
</head>
  <body>
    <div class="center">
      <br>
      <h3>Proverite koliko ima neplaćenih termina</h3>
      <br>
      <span><h3><?php while($row = $stmt->fetch_assoc()) {
echo ($row["@broj"]);
}?></h3></span>
    </div>
  </body>
</html>