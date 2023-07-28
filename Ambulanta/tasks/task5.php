<?php

session_start();

if(!isset($_SESSION['username'])) {
    die();
}

require_once "../connection.php";
mysqli_set_charset($conn, 'utf8');

if($_SERVER['REQUEST_METHOD'] == "POST") { 

    $name = $conn->real_escape_string($_POST['name4']);
    $lastname = $conn->real_escape_string($_POST['lastname4']);
    $datetime = $conn->real_escape_string($_POST['datetime4']);
    $query = "CALL a('$datetime', '$name', '$lastname', @broj_count);";
    var_dump($query);
    $res = $conn->query($query);
   // $query = "SELECT @broj_count;";
   // $res = $conn->query($query);
   $sql = "SELECT CAST(@broj_count AS UNSIGNED) AS broj_count";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $broj_count = $row["broj_count"];
    echo "broj_count: " . $broj_count;
  }
} else {
  echo "0 results";
}
}
 
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <title>Task 5</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stilovi/style_tasks.css">
</head>
  <body>
    <div class="center">
      <br>
      <h3>Proverite broj zakazanih termina za datog radnika i datum</h3>
      <br>
      <span><h3>
        <?php 
          while($row = $result->fetch_assoc()) {
            echo ($row["@broj_count"]);
          }
        ?><h3>
      </span>
    </div>
  </body>
</html>