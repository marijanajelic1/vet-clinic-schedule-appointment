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

$query = "SHOW TRIGGERS LIKE 'd';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    $query = "DROP TRIGGER IF EXISTS d;
    CREATE TRIGGER d
    BEFORE INSERT ON user 
    FOR EACH ROW 
    BEGIN
        DECLARE tr_username VARCHAR(50);
        DECLARE username_exists INT DEFAULT 0;

        SELECT COUNT(*) INTO username_exists FROM user WHERE username = NEW.username;

        IF username_exists > 0 THEN 
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Username je vec iskoriscen!';
        END IF;

    END;";
    mysqli_multi_query($conn, $query);
} 
?>