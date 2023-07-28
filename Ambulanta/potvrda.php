<?php

require_once "connection.php";
mysqli_set_charset($conn, 'utf8');

$message1 = "";
if($_SERVER['REQUEST_METHOD'] == "POST") { 
    $name = $conn->real_escape_string($_POST['name']);
	$lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $starttime_str = $conn->real_escape_string($_POST['datetime']);
    $service = $conn->real_escape_string($_POST['service']);
    $animal=$conn->real_escape_string($_POST['animal']);

    $q="SELECT id FROM `client` WHERE `email`='$email'";
    $res = $conn->query($q);
    $row = $res->fetch_assoc();
    $clientid=$row['id'];

    /*$q="SELECT * FROM `service` WHERE `name` LIKE '%$service%'";
    var_dump($q);
    $res = mysqli_query($conn, $q);
    var_dump($res);
    $row = $res->fetch_assoc();
    $serviceid=$row['id'];
    $workerid=$row['worker_id'];
    $servduration=$row['serv_duration'];*/

   /* $q = "SELECT * FROM `service` WHERE `name` LIKE '%$service%'";*/
  
   $q = "SELECT * FROM `service` WHERE `name` = '$service'";
    $res = mysqli_query($conn, $q);
    if ($res && mysqli_num_rows($res) > 0) {
    $row = $res->fetch_assoc();
    $serviceid = $row['id'];
    $workerid = $row['worker_id'];
    $servduration = $row['serv_duration'];
}
    
   
    $starttime = DateTime::createFromFormat('Y-m-d\TH:i', $starttime_str);
    $endtime = $starttime;
    $endtime->modify('+1 hour');
    $endtime->format('Y-m-d\TH:i');
    $q="SELECT id FROM `animal` WHERE `type`='$animal'";
    $res = $conn->query($q);
    $row = $res->fetch_assoc();
    $animalid=$row['id'];
    $starttime_sql = $starttime->format('Y-m-d H:i');
    $endtime_sql = $endtime->format('Y-m-d H:i');
   
   $termvalidation="SELECT * FROM `term` WHERE `worker_id`='$workerid' AND `date_time` >= '$starttime_sql' AND `date_time`<='$endtime_sql'";
    
    $res=$conn->query($termvalidation);
    if($res->num_rows==0){
        $result1 = $conn->query("INSERT INTO `term`(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) VALUES ('$workerid','$serviceid','$clientid','$animalid','$starttime_sql')");
        if($result1) {
            $message1 = "Successfully added";
        } else {
            $message1 = "error";
        }
    }
    else{
        $message1="Ovaj termin je zauzet. Molimo zakazite termin.";
  }

}
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <title>Potvrda</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../stilovi/style_tasks.css">
</head>
  <body>
  <nav class="row, meni"> 
		<ul>
			<a href="index.php"><li>Početna</li></a>
			<a href="mongozakazivanje.php"><li>Mongo zakazivanje</li></a>
            <a href="zakazivanje.php"><li>Zakažite termin</li></a>
		</ul>
	</nav>
    <div>
        <br>
        <br>
      <h1>Uspesno ste zakazali termin</h1>
    </div>
  </body>
</html>