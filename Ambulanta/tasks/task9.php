<?php

session_start();

if(!isset($_SESSION['username'])) {
    die();
}

require_once "../connection.php";
mysqli_set_charset($conn, 'utf8');

if($_SERVER['REQUEST_METHOD'] == "POST") { 
	$service = $conn->real_escape_string($_POST['service7']);
	$datetime = $conn->real_escape_string($_POST['datetime7']);

	$res = $conn->query("SELECT i('$service', '$datetime') AS result");

	if($res->num_rows > 0) {
		$result = $res->fetch_assoc();
		$final = $result['result'];
	}
}
 
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <title>Task 9</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stilovi/style_tasks.css">
</head>
  <body>
    <div class="center">
      <br>
      <h3>Proverite da li je termin za datu uslugu i vreme slobodan</h3>
      <br>
      <p> <h3><?php echo $final ?> </h3></p>
    </div>
  </body>
</html>