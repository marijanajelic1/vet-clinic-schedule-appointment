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

$query = "SHOW EVENTS WHERE Name = 'k';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    $query = "DROP EVENT IF EXISTS k;
    CREATE EVENT k
    ON SCHEDULE EVERY 5 SECOND
    ENDS NOW() + INTERVAL 5 HOUR
    DO
    BEGIN
    
        DECLARE napusti_petlju INT DEFAULT 0;
        DECLARE pay_id INT DEFAULT 0;
        DECLARE term_id INT DEFAULT 0;
    
        DECLARE c CURSOR FOR
        SELECT
            p.id,
            p.term_id
        FROM
            pay p
            INNER JOIN term t ON p.term_id = t.id
        WHERE
            YEAR(p.date_time) < 2020;
        
        DECLARE CONTINUE HANDLER FOR NOT FOUND SET napusti_petlju=1;
    
        OPEN c;
        WHILE napusti_petlju=0 DO
        FETCH c INTO pay_id,term_id;
    
        DELETE FROM `pay`
        WHERE pay.id=pay_id;
        DELETE FROM `term`
        WHERE term.id=term_id;
    
        END WHILE;
    
        CLOSE c;
     END;";
    mysqli_multi_query($conn, $query);
} 
?>
