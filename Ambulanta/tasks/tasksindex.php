<?php

session_start();

if(!isset($_SESSION['username'])) {
    die();
}

require_once "../connection.php";
mysqli_set_charset($conn, 'utf8');
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Zadaci</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="">
	<link rel="stylesheet" href="../stilovi/style_tasks.css">
	<title>Zadaci</title>
    <style>
        .logout-container {
            position: fixed;
            top: ;
            right: 0;
            padding: 10px;
            margin-right=10px;
            padding-right=5px;
        }

        form input, label,select {
            display: block;
            margin-bottom: 10px;
        }
        form input[type="submit"] {
            font-size: 15px;
            padding: 7px 10px;
        }
        form button{
            display: block;
            margin-bottom: 10px;
            font-size: 15px;
            padding: 7px 10px;
        }

        </style>
</head>
<body>
   <br>
    <div class="logout-container">
        <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
    </div>
    <br>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Zakažite termin</h2>
        <br>
        <form action="task1.php" method="POST">
            <input type="text" name="name1" placeholder="Ime">
		    <input type="text" name="lastname1" placeholder="Prezime">
		    <input type="text" name="email1" placeholder="Email">
		    <input type="datetime-local" name="datetime1">
            <label for="service1">Usluga:</label>
		    <select name="service1">
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
            <label for="animal1">Životinja:</label>
		    <select name="animal1">
			    <option value="Pas">Pas</option>
			    <option value="Mačka">Mačka</option>
			    <option value="Papagaj">Papagaj</option>
			    <option value="Hrčak">Hrčak</option>
            </select><br>
            <input type="submit" Value="Zakazi">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Plati termin</h2>
        <br>
        <form action="task2.php" method="POST">
            <input type="datetime-local" name="datetime8" >
            <input type="text" name="termid8" placeholder="Termin id">
            <label for="service8">Usluga:</label>
		    <select name="service8">
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
		    <input type="text" name="name8" placeholder="Ime klijenta">
            <input type="text" name="lastname8" placeholder="Prezime klijenta">
            <input type="text" name="email8" placeholder="Email id...">
            <input type="submit" Value="Plati">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Dodajte novu uslugu</h2>
        <br>
        <form action="task3.php" method="POST">
            <input type="text" name="service2" placeholder="Ime usluge">
            <input type="text" name="price2" placeholder="Cena">
		    <input type="text" name="duration2" placeholder="Trajanje">
		    <input type="text" name="name2" placeholder="Ime radnika">
            <input type="text" name="lastname2" placeholder="Prezime radnika">
            <input type="submit" Value="Dodaj">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Izmenite Vaše informacije</h2>
        <br>
        <form action="task4.php" method="POST">
            <input type="text" name="name3" placeholder="Ime">
            <input type="text" name="lastname3" placeholder="Prezime">
		    <input type="text" name="phone3" placeholder="Telefon">
		    <input type="text" name="email3" placeholder="Email">
            <input type="text" name="job3" placeholder="Vrsta posla">
            <input type="submit" Value="Promena">
        </form>
    </section>
    <!-- <section class="center">
        <br>
        <hr>
        <br>
        <h2>Proverite broj zakazanih termina za datog radnika i datum</h4>
        <br>
        <form action="t.php" method="POST">
            <input type="text" name="name4" placeholder="Ime radnika">
            <input type="text" name="lastname4" placeholder="Prezime radnika">
            <input type="text" name="datetime4" placeholder="Datum">
            <input type="submit" Value="Provera">
        </form>
    </section> -->
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Datum koga je prosledjeni radnik najzauzetiji</h2>
        <br>
        <form action="task6.php" method="POST">
            <input type="text" name="name5" placeholder="Ime radnika">
            <input type="text" name="lastname5" placeholder="Prezime radnika">
            <input type="submit" Value="Provera">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Proverite koliko ima neplaćenih termina</h2>
        <br>
        <form action="task7.php" method="POST">
            <input type="submit" Value="Provera">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Proverite broj zakazanih termina za dati datum</h2>
        <br>
        <form action="task8.php" method="POST">
        <input type="text" name="datetime6" placeholder="Datum">
            <input type="submit" Value="Provera">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Proverite da li je termin za datu uslugu i vreme slobodan</h2>
        <br>
        <form action="task9.php" method="POST">
        <input type="text" name="datetime7" placeholder="Datum i vreme">
            <label for="service7">Usluga:</label>
		    <select name="service7">
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
            <input type="submit" Value="Provera">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Povećanje cena usluga za 10% na svakih godinu dana</h2>
        <br>
        <form action="taskdogadjaj1.php" method="POST">
            <input type="submit" Value="Pokreni">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Brisanje izvršenih uplata starijih od 3 godine</h2>
        <br>
        <form action="taskdogadjaj2.php" method="POST">
            <input type="submit" Value="Pokreni">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Brisanje suvišnih podataka o izmenama</h2>
        <br>
        <form action="taskdogadjaj3.php" method="POST">
            <input type="submit" Value="Pokreni">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Trigger za proveru username u bazi</h2>
        <br>
        <form action="tasktrigger1.php" method="POST">
            <input type="submit" Value="Pokreni">
        </form>
    </section>
    <section class="center">
        <br>
        <hr>
        <br>
        <h2>Trigger za upisivanje izmena izvršenih nad tabelom worker</h2>
        <br>
        <form action="tasktrigger2.php" method="POST">
            <input type="submit" Value="Pokreni">
        </form>
    </section>
</body>
</html>



