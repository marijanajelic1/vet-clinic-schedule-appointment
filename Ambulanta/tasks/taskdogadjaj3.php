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

$query = "SHOW EVENTS WHERE Name = 'f';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    $query = "DROP EVENT IF EXISTS f;

    CREATE EVENT f
    ON SCHEDULE 
    EVERY 3 MONTH
    DO
    BEGIN
        DECLARE zbir INT;
        DECLARE tr_datum DATE DEFAULT now();
        SELECT COUNT(*) FROM changes INTO zbir;
    
        IF zbir > 10 THEN
        DELETE FROM changes WHERE DATEDIFF(tr_datum, changes.datum) > 31;
        END IF;
    END;";
    mysqli_multi_query($conn, $query);
} 
?>
