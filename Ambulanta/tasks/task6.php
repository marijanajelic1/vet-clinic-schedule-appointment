<?php

session_start();

if(!isset($_SESSION['username'])) {
    die();
}

require_once "../connection.php";
mysqli_set_charset($conn, 'utf8');

if($_SERVER['REQUEST_METHOD'] == "POST") { 
    $name = $conn->real_escape_string($_POST['name5']);
    $lastname = $conn->real_escape_string($_POST['lastname5']);
   

    $query = "
    CALL c('$name','$lastname', @datum);
    ";

$stmt = $conn->query($query);

$query = "SELECT @datum;";
$stmt = $conn->query($query);


}
 
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <title>Task 6</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stilovi/style_tasks.css">
</head>
  <body>
    <div class="center">
      <br>
      <h3>Datum koga je prosleđeni radnik najzauzetiji</h3>
      <br>
      <span><h3><?php while($row = $stmt->fetch_assoc()) {
echo ($row["@datum"]);
}?></h3></span>
    </div>
  </body>
</html>