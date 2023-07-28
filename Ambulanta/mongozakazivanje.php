<?php

require_once __DIR__ . '/vendor/autoload.php'; 

//echo extension_loaded("mongodb") ? "loaded" : "not loaded";
$uri = 'mongodb://localhost:27017';

$client = new MongoDB\Client($uri);

$collection = $client->ambulanta->client;

$message1 = "";

if($_SERVER['REQUEST_METHOD'] == "POST") { 
    $name = $_POST['name'];
	$lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $datetime = $_POST['datetime'];
	$adress = $_POST['adress'];
	$phone = $_POST['phone'];
    $service = $_POST['service'];
    $animal = $_POST['animal'];

	$datetimeObj = new DateTime($datetime);
    $hour1 = $datetimeObj->format('H');

	$clientCollection = $client->ambulanta->client;
    $exists = $clientCollection->findOne([
		'name' => $name,
		'last_name' => $lastname,
		'email' => $email
	]);
	

    if ($exists === null) {

	$result = $collection->insertOne([
		'name' => $name,
		'last_name' => $lastname,
		'email' => $email,
		'phone' => $phone,
		'adress' => $adress,
	]);

	if ($result->getInsertedCount() > 0) {
		echo "Informacije su uspešno unete u bazu.";
	} else {
		echo "Informacije nisu unete u bazu.";
	}
} 

    $serviceCollection = $client->ambulanta->service;
    $serviceid = $serviceCollection->findOne(['name' => $service]);

    $animalCollection=$client->ambulanta->animal;
    $animalid=$animalCollection->findOne(['type'=>$animal]);
    $termCollection = $client->ambulanta->term;
    $booked = $termCollection->findOne([
		'service_id' => $serviceid->_id,
		'$expr' => [
			'$eq' => [
				['$hour' => '$datetime'],
				intval('$hour')
			]
		]
	]);
	

    if ($booked === null) {
		$message1 = "Termin je zakazan!";
		$clientid = $collection->findOne(['adress' => $adress, 'name' => $name]);

		$workerid = $serviceid->worker_id;

		$result1 = $termCollection->insertOne([
			'date_time' => $datetime,
			'client_id' => $clientid->_id,
			'worker_id' => $workerid,
			'service_id' => $serviceid->_id,
            'animal_id'=>$animalid->_id
		]);
	} else {
		$message1 = "Termin je zauzet. Izaberite neki drugi termin.";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Zakazivanje</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../stilovi/style_tasks.css">
  <style>
    form input {
  display: block;
  margin-bottom: 10px;
}
form input[type="submit"] {
  font-size: 15px;
  padding: 7px 10px;
}
    </style>
</head>
<body>
<nav class="row, meni"> 
		<ul>
			<a href="index.php"><li>Početna</li></a>
			<a href="cenovnik.html"><li>Cenovnik</li></a>
			<a href="zakazivanje.php"><li>Zakažite termin MySQL</li></a>
		</ul>
	</nav>
	<br>
	<br>
    <h1 class="center">Zakažite Vaš termin!</h1>

    <h3 class="center">Ostavite Vaše informacije</h3>
	<form action="#" method="post" name="form" class="center">
        <label for="name">Ime:</label>
		<input type="text" id="name" name="name" required><br>
		
		<label for="lastname">Prezime:</label>
		<input type="text" id="lastname" name="lastname" required><br>
		
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br>

		<label for="phone">Kontakt telefon:</label>
		<input type="text" id="phone" name="phone" required><br>
        
        <label for="adress">Adresa:</label>
		<input type="text" id="adress" name="adress" required><br>

		
        <label for="animal">Životinja:</label>
		<select id="animal" name="animal">
			<option value="Pas">Pas</option>
			<option value="Mačka">Mačka</option>
			<option value="Papagaj">Papagaj</option>
			<option value="Hrčak">Hrčak</option>
        </select><br>

		<label for="service">Usluge:</label>
		<select id="service" name="service">
			<option value="Opšti klinički pregled">Opšti klinički pregled</option>
			<option value="Izlazak na teren">Izlazak na teren</option>
			<option value="Uverenje o zdravstvenom stanju">Uverenje o zdravstvenom stanju</option>
			<option value="Vakcinacija">Vakcinacija</option>
            <option value="Sondiranje">Sondiranje</option>
            <option value="Klistiranje">Klistiranje</option>
            <option value="Aplikacija leka">Aplikacija leka</option>
            <option value="Previjanje">Previjanje</option>
            <option value="Infuzija i/v">Infuzija i/v</option>
            <option value="Pregled uha">Pregled uha</option>
            <option value="Lečenje gljivica uha">Lečenje gljivica uha</option>
            <option value="Obeležavanje i izdavanje pasoša">Obeležavanje i izdavanje pasoša</option>
            <option value="Kateterizacija">Kateterizacija</option>
            <option value="Analiza brisa kože">Analiza brisa kože</option>
            <option value="Vađenje krpelja">Vađenje krpelja</option>
            <option value="Skraćivanje kljunova">Skraćivanje kljunova</option>
		</select><br>
		
		<label for="datetime">Datum i vreme:</label>
		<input type="datetime-local" id="datetime" name="datetime" required><br>

		<span class='error'><?php echo $message1 ?></span>

		<input type="submit" value="Pošalji informacije">
    </form>

</body>
</html>
