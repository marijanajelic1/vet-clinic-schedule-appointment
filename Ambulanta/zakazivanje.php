<?php

require_once "connection.php";
$message1 = "";

if($_SERVER['REQUEST_METHOD'] == "POST") { 
   
	$name = $conn->real_escape_string($_POST['name']);
    $lastname = $conn->real_escape_string($_POST['lastname']);

	
    $email = $conn->real_escape_string($_POST['email']);
	$adress = $conn->real_escape_string($_POST['adress']);
	$phone = $conn->real_escape_string($_POST['phone']);
 
    $q="SELECT * FROM `client` WHERE `email`='$email'";
    $res=$conn->query($q);
    if($res->num_rows==0){
        $result = $conn->query("INSERT INTO `client`(`name`, `last_name`, `email`, `phone`, `adress`) VALUES ('$name','$lastname','$email','$phone','$adress')");
        if($result) {
            $message1 = "Informacije su uspešno unete u bazu.";
        } else {
            $message1 = "Greška.";
        }
    }
    else{
        $message1="Klijent već postoji u bazi. Molimo zakažite termin.";
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
			<a href="mongozakazivanje.php"><li>Mongo zakazivanje</li></a>
		</ul>
	</nav>
    <br>
    <br>
    <h1 class="center">Zakažite Vaš termin!</h1>
    <br>
    <h3 class="center">Ostavite Vase informacije</h3>
    <br>
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

		<span class='error'><?php echo $message1 ?></span>

		<input type="submit" value="Pošalji informacije" name="insertClient">
    </form>
    <br>
	<h1 class="center">Zakažite termin</h1>
    <br>
	
	<form action="potvrda.php" method="post" name="form" class="center">
		<label for="name">Ime:</label>
		<input type="text" id="name" name="name" required><br>
		
		<label for="lastname">Prezime:</label>
		<input type="text" id="lastname" name="lastname" required><br>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br>

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

		<input type="submit" value="Zakaži">
	</form>
</body>
</html>
