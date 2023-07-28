<?php
require_once "tasksindex.php";

$query = "SELECT @@event_scheduler AS enabled;";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if($row['enabled'] == 'OFF') {
    $query = "SET GLOBAL event_scheduler=ON;";
    mysqli_query($conn, $query);
    echo "Event scheduler enabled.";
}

$query = "SHOW TRIGGERS LIKE 'e';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    $query = "DROP TRIGGER IF EXISTS e;
    CREATE TRIGGER e
    AFTER UPDATE ON worker 
FOR EACH ROW 
BEGIN
    DECLARE tekst VARCHAR(250) DEFAULT 'IZMENE: ';
    DECLARE tr_datum DATETIME DEFAULT now();
    SET tekst=CONCAT(tekst, ' id: ' , NEW.id);
	IF new.name <> old.name THEN
		SET tekst = CONCAT(tekst, ', izmena: ', old.name, '-', new.name);
	END IF;
    IF new.last_name <> old.last_name THEN
		SET tekst = CONCAT(tekst, ', izmena: ', old.last_name, '-', new.last_name);
	END IF;
    IF new.phone <> old.phone THEN
		SET tekst = CONCAT(tekst, ', izmena: ', old.phone, '-', new.phone);
	END IF;
    IF new.email <> old.email THEN
		SET tekst = CONCAT(tekst, ', izmena: ', old.email, '-', new.email);
	END IF;
    IF new.work_years <> old.work_years THEN
		SET tekst = CONCAT(tekst, ', izmena: ', old.work_years, '-', new.work_years);
	END IF;
    IF new.job_type <> old.job_type THEN
		SET tekst = CONCAT(tekst, ', izmena: ', old.job_type, '-', new.job_type);
	END IF;
    IF new.user_id <> old.user_id THEN
		SET tekst = CONCAT(tekst, ', izmena: ', old.user_id, '-', new.user_id);
	END IF;
    INSERT INTO changes(datum, tekst) VALUES 
    (tr_datum, tekst);

    END ;";
    mysqli_multi_query($conn, $query);
} 
?>