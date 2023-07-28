<?php

session_start();

if(!isset($_SESSION['username'])) {
    die();
}

require_once "../connection.php";
mysqli_set_charset($conn, 'utf8');

if($_SERVER['REQUEST_METHOD'] == "POST") { 
$datetime = $conn->real_escape_string($_POST['datetime6']);
    $query = "
    CALL h('$datetime', @broj);
    ";

$stmt = $conn->query($query);

$query = "SELECT @broj;";
$stmt = $conn->query($query);


}
 
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <title>Task 8</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stilovi/style_tasks.css">
</head>
  <body>
    <div class="center">
      <br>
      <h3>Proverite broj zakazanih termina za dati datum</h3>
      <br>
      <span><h3><?php while($row = $stmt->fetch_assoc()) {
echo ($row["@broj"]);
}?></h3></span>
    </div>
  </body>
</html>