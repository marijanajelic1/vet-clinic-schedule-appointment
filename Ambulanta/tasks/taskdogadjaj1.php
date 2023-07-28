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

$query = "SHOW EVENTS WHERE Name = 'm';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    $query = "DROP EVENT IF EXISTS m;
              CREATE EVENT m 
              ON SCHEDULE EVERY 1 YEAR
              STARTS NOW()
              DO
              BEGIN
                  DECLARE napusti_petlju INT DEFAULT 0;
                  DECLARE tr_cena INT;
                  DECLARE nova_cena INT;
                  DECLARE service_id INT;
                  DECLARE c CURSOR FOR
                      SELECT price, id
                      FROM service;
                  DECLARE CONTINUE HANDLER FOR NOT FOUND SET napusti_petlju=1;
                  OPEN c;
                  WHILE napusti_petlju=0 DO
                      FETCH c INTO tr_cena, service_id;
                      SET nova_cena=tr_cena*1.1;
                      UPDATE service SET price=nova_cena WHERE id=service_id;
                  END WHILE;
                  CLOSE c;
              END;";
    mysqli_multi_query($conn, $query);
} 
?>
