DROP DATABASE IF EXISTS ambulanta;
CREATE DATABASE IF NOT EXISTS ambulanta;

USE ambulanta;

CREATE TABLE IF NOT EXISTS user(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    type VARCHAR(50) NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS worker(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    work_years INT NOT NULL,
    job_type VARCHAR(50) NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_worker_user_id
        FOREIGN KEY(user_id) REFERENCES user(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS client(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    adress VARCHAR(50) NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS service(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    serv_duration INT NOT NULL,
    worker_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_service_worker_id
        FOREIGN KEY(worker_id) REFERENCES worker(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS animal(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS term(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    worker_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    client_id INT UNSIGNED NOT NULL,
    animal_id INT UNSIGNED NOT NULL,
    date_time DATETIME NOT NULL,
    CONSTRAINT fk_term_worker_id
        FOREIGN KEY(worker_id) REFERENCES worker(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_term_service_id
        FOREIGN KEY(service_id) REFERENCES service(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_term_client_id
        FOREIGN KEY(client_id) REFERENCES client(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_term_animal_id
        FOREIGN KEY(animal_id) REFERENCES animal(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS pay(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date_time DATETIME,
    price INT NOT NULL,
    term_id INT UNSIGNED NOT NULL,
    worker_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    client_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_pay_term_id
        FOREIGN KEY(term_id) REFERENCES term(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_pay_worker_id
        FOREIGN KEY(worker_id) REFERENCES worker(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_pay_service_id
        FOREIGN KEY(service_id) REFERENCES service(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_pay_client_id
        FOREIGN KEY(client_id) REFERENCES client(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
)ENGINE=INNODB;



INSERT INTO user(`username`,`password`,`type`) VALUES ('kristinakiric','kristinakiric','radnik');
INSERT INTO user(`username`,`password`,`type`) VALUES ('markoi','markoi','radnik');
INSERT INTO user(`username`,`password`,`type`) VALUES ('viktorjovic','viktorjovic','radnik');
INSERT INTO user(`username`,`password`,`type`) VALUES ('aleksapejic','aleksapejic','radnik');
INSERT INTO user(`username`,`password`,`type`) VALUES ('milicas','milicas','radnik');

INSERT INTO worker(`name`,`last_name`,`phone`,`email`,`work_years`,`job_type`,`user_id`) VALUES ('Kristina','Kiric','065114792','kristinak@gmail.com','7','hirurg','1');
INSERT INTO worker(`name`,`last_name`,`phone`,`email`,`work_years`,`job_type`,`user_id`) VALUES ('Marko','Ilic','061774792','markoi@gmail.com','3','doktor','2');
INSERT INTO worker(`name`,`last_name`,`phone`,`email`,`work_years`,`job_type`,`user_id`) VALUES ('Viktor','Jovic','064938539','viktorj@gmail.com','2','asistent','3');
INSERT INTO worker(`name`,`last_name`,`phone`,`email`,`work_years`,`job_type`,`user_id`) VALUES ('Aleksa','Pejic','065948692','aleksap@gmail.com','2','anesteziolog','4');
INSERT INTO worker(`name`,`last_name`,`phone`,`email`,`work_years`,`job_type`,`user_id`) VALUES ('Milica','Savic','064645692','milicas@gmail.com','4','glavni doktor','5');

INSERT INTO `client`(`name`, `last_name`, `email`, `phone`, `adress`) VALUES ('Jela','Jovic','jelaj@gmail.com','069835783','Vizantijski Bulevar 12');
INSERT INTO `client`(`name`, `last_name`, `email`, `phone`, `adress`) VALUES ('Ivana','Krstic','ivanakrs@gmail.com','069893731','Knez Mihajlova 4');
INSERT INTO `client`(`name`, `last_name`, `email`, `phone`, `adress`) VALUES ('Maja','Obradovic','majao@gmail.com','0672435783','Episkopska 35');
INSERT INTO `client`(`name`, `last_name`, `email`, `phone`, `adress`) VALUES ('Stefan','Spasovic','stefans@gmail.com','0698095983','Mokranjceva 1');

INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Opšti klinički pregled','1200','1','2');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Izlazak na teren','3000','2','2');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Uverenje o zdravstvenom stanju','1300','1','3');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Vakcinacija','2000','1','2');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Sondiranje','800','1','1');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Klistiranje','1000','2','1');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Aplikacija leka','1200','1','3');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Previjanje','1000','1','1');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Infuzija i/v','1700','3','3');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Pregled uha','1200','1','2');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Lečenje gljivica uha','700','1','3');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Obeležavanje i izdavanje pasoša','1300','2','3');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Kateterizacija','1500','3','1');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Analiza brisa kože','2000','2','3');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Vađenje krpelja','1000','2','3');
INSERT INTO service(`name`,`price`,`serv_duration`,`worker_id`) VALUES ('Skraćivanje kljunova','1000','1','3');

INSERT INTO animal(`type`) VALUES ('Pas');
INSERT INTO animal(`type`) VALUES ('Mačka');
INSERT INTO animal(`type`) VALUES ('Papagaj');
INSERT INTO animal(`type`) VALUES ('Hrčak');

INSERT INTO term(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) VALUES ('1','5','2','2','2023-10-24 11:26:02');
INSERT INTO term(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) VALUES ('2','1','3','1','2023-10-27 16:13:02');
INSERT INTO term(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) VALUES ('3','7','1','4','2023-11-22 11:15:37');
INSERT INTO term(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) VALUES ('3','3','4','3','2023-10-15 13:17:45');
INSERT INTO term(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) VALUES ('2','10','1','1','2023-12-11 10:19:31');

INSERT INTO pay(`date_time`,`price`,`term_id`,`worker_id`,`service_id`,`client_id`) VALUES ('2023-10-24 12:26:02','800','1','4','5','2');
INSERT INTO pay(`date_time`,`price`,`term_id`,`worker_id`,`service_id`,`client_id`) VALUES ('2023-10-27 17:13:02','1200','2','4','1','3');
INSERT INTO pay(`date_time`,`price`,`term_id`,`worker_id`,`service_id`,`client_id`) VALUES ('2023-11-22 12:15:37','1200','3','4','7','1');
INSERT INTO pay(`date_time`,`price`,`term_id`,`worker_id`,`service_id`,`client_id`) VALUES ('2023-10-15 14:17:45','1300','4','4','3','4');
INSERT INTO pay(`date_time`,`price`,`term_id`,`worker_id`,`service_id`,`client_id`) VALUES ('2023-12-11 11:19:31','1200','5','4','10','1');

CREATE TABLE changes(id INT AUTO_INCREMENT PRIMARY KEY,
            datum DATETIME NOT NULL,
            tekst VARCHAR(500) NOT NULL)ENGINE=INNODB;


--a) Procedura kojoj prosledjujemo datum, radnika i ispisemo koliko
--termina ima zakazano za taj dan.

DROP PROCEDURE IF EXISTS a;

DELIMITER //

CREATE PROCEDURE a(IN datum DATETIME, IN name VARCHAR(50),IN lastname VARCHAR(50),OUT broj_count INT)
BEGIN
    SELECT COUNT(*)
    INTO broj_count
    FROM term 
    INNER JOIN worker ON worker.id = term.worker_id
    WHERE term.date_time = datum 
    AND worker.name = name 
    AND worker.last_name=lastname;
END//

DELIMITER ;

SET @broj_count="";
CALL a("2023-10-24", "Ivana", "Krstic", @broj_count);
SELECT @broj_count='';


--b) Procedura kojom se upisuju podaci u tabelu service;

DROP PROCEDURE IF EXISTS b;

DELIMITER //

CREATE PROCEDURE b(IN name VARCHAR(50),
                    IN price INT,
                    IN serv_duration INT,
                    IN worker_name VARCHAR(50),
                    IN worker_lname VARCHAR(50))

BEGIN
    DECLARE worker1_id INT DEFAULT NULL;
    DECLARE user1_id INT;
    SELECT
        id
    FROM
        worker
    WHERE 
        worker.name=worker_name
        AND worker.last_name=worker_lname
    INTO 
        worker1_id;

    IF worker1_id IS NULL THEN

    INSERT INTO 
        user(username, password, type)
    VALUES(worker_lname,worker_lname,'radnik');

    SELECT 
        user.id
    FROM
        user
    WHERE
        user.username=worker_lname
        AND user.type='radnik'
    INTO 
        user1_id;
    
    INSERT INTO worker(`name`,`last_name`,`phone`,`email`,
    `work_years`,`job_type`,`user_id`) VALUES 
    (worker_name,worker_lname,060,'@gmail.com',
    '0','x',user1_id);
    END IF;

    IF user1_id IS NOT NULL THEN

    SELECT
        id
    FROM
        worker
    WHERE 
        worker.name=worker_name
        AND worker.last_name=worker_lname
    INTO 
        worker1_id;
    
    END IF;

    IF worker1_id IS NOT NULL THEN 

    INSERT INTO service(`name`,`price`,`serv_duration`,
    `worker_id`) VALUES 
    (name,price,serv_duration,worker1_id);

    END IF; 

END //
DELIMITER ;

CALL b("Nova usluga",2000,1,"Miroslav","Miladinovic");


--c) Procedura koja vraca datum kojeg je uneti radnik 
--najzauzetiji.

DROP PROCEDURE IF EXISTS c;
DELIMITER //
CREATE PROCEDURE c(IN worker_name VARCHAR(50), IN worker_lname VARCHAR(50), OUT datum DATETIME)
BEGIN

DECLARE tr_datum VARCHAR(50);
DECLARE max_br INT DEFAULT -1;
DECLARE napusti_petlju INT DEFAULT 0;
DECLARE tr_br INT;

DECLARE c CURSOR FOR 
    SELECT
        DATE(term.date_time),
        COUNT(*)
    FROM 
        term 
    INNER JOIN 
        worker 
    ON 
        worker.id=term.worker_id
    WHERE 
        worker.name=worker_name
    AND 
        worker.last_name=worker_lname 
    GROUP BY(term.date_time);

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET napusti_petlju=1;

    OPEN c;
    WHILE napusti_petlju=0 DO
    FETCH c INTO tr_datum, tr_br;
    IF tr_br>max_br THEN
    SET max_br=tr_br;
    SET datum=tr_datum;
    END IF;
    END WHILE;

    CLOSE c;
END //

DELIMITER ; 

SET @datum="";
CALL c("Miki", "Mikic", @datum);
SELECT @datum;

--d) Triger koji se aktivira pre unosa u tabelu user
--i proverava da li je username iskoriscen;

DROP TRIGGER IF EXISTS d;

DELIMITER //

CREATE TRIGGER d
BEFORE INSERT ON user 
FOR EACH ROW 
BEGIN
    DECLARE tr_username VARCHAR(50);
    DECLARE username_exists INT DEFAULT 0;

    SELECT COUNT(*) INTO username_exists FROM user WHERE username = NEW.username;

    IF username_exists > 0 THEN 
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Username je vec iskoriscen!";
    END IF;

END //

DELIMITER ;


INSERT INTO user (username, password, type) VALUES  ("milicas", "milicas", "radnik");

--e) Triger koji se aktivira nakon azuriranja tabele worker i 
--upisuje koje su se izmene desile u tabelu izmene.

DROP TRIGGER IF EXISTS e;
DELIMITER //

CREATE TRIGGER e
AFTER UPDATE ON worker 
FOR EACH ROW 
BEGIN
    DECLARE tekst VARCHAR(250) DEFAULT "IZMENE: ";
    DECLARE tr_datum DATETIME DEFAULT now();
    SET tekst=CONCAT(tekst, " id: " , NEW.id);
	IF new.name <> old.name THEN
		SET tekst = CONCAT(tekst, ", izmena: ", old.name, "-", new.name);
	END IF;
    IF new.last_name <> old.last_name THEN
		SET tekst = CONCAT(tekst, ", izmena: ", old.last_name, "-", new.last_name);
	END IF;
    IF new.phone <> old.phone THEN
		SET tekst = CONCAT(tekst, ", izmena: ", old.phone, "-", new.phone);
	END IF;
    IF new.email <> old.email THEN
		SET tekst = CONCAT(tekst, ", izmena: ", old.email, "-", new.email);
	END IF;
    IF new.work_years <> old.work_years THEN
		SET tekst = CONCAT(tekst, ", izmena: ", old.work_years, "-", new.work_years);
	END IF;
    IF new.job_type <> old.job_type THEN
		SET tekst = CONCAT(tekst, ", izmena: ", old.job_type, "-", new.job_type);
	END IF;
    IF new.user_id <> old.user_id THEN
		SET tekst = CONCAT(tekst, ", izmena: ", old.user_id, "-", new.user_id);
	END IF;
    INSERT INTO changes(datum, tekst) VALUES 
    (tr_datum, tekst);

END //

DELIMITER ;

UPDATE worker SET name="Andrija" WHERE worker.id=4;

--f)Dogadjaj kojim se na svaka tri meseca proverava da li u tabeli
--izmene ima vise od 10 izmena i ukoliko ima, brisu se sve izmene
--koje su unesene pre vise od mesec dana.
SET GLOBAL event_scheduler = ON;
DELIMITER //
DROP EVENT IF EXISTS f //

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

END //

DELIMITER ;

INSERT INTO changes(datum, tekst) VALUES 
("2022-12-18 23:31:51", "cao");

--g)Procedura koja proverava koliko termina nije placeno 

DROP PROCEDURE IF EXISTS g;

DELIMITER //

CREATE PROCEDURE g(OUT broj_count INT)
BEGIN

    DECLARE termid INT DEFAULT 0;
    DECLARE termin BOOLEAN;
    DECLARE napusti_petlju INT DEFAULT 0;

    DECLARE c CURSOR FOR SELECT id FROM term;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET napusti_petlju = 1;

    SET broj_count = 0;

    OPEN c;

    WHILE napusti_petlju = 0 DO 
        FETCH c INTO termid;

        SELECT EXISTS(SELECT id FROM pay WHERE term_id = termid) INTO termin;

        IF termin = 0 THEN 
            SET broj_count = broj_count + 1;
        END IF;
    END WHILE;

    CLOSE c;

END //

DELIMITER ;


INSERT INTO term(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) VALUES ('1','8','1','2','2023-12-11 10:19:31');

call g(@broj_count);
SELECT @broj_count;

--h)Procedura koja vraca broj zakazanih termina za dati datum

DROP PROCEDURE IF EXISTS h;

DELIMITER //

CREATE PROCEDURE h(IN datum DATETIME, OUT broj_count INT)

BEGIN 

    SELECT 
        COUNT(*)
    FROM 
        term
    WHERE 
        DATE(term.date_time)=datum
    INTO
        broj_count;
    

END //

DELIMITER ;

set @broj_count="";
CALL h("2023-05-04", @broj_count);
SELECT @broj_count;

--i)Funkcija koja proverava da li je termin za dato vreme i uslugu slobodan

DROP FUNCTION IF EXISTS i;
DELIMITER //
CREATE FUNCTION i(usluga_name VARCHAR(255), start_datum DATETIME)
RETURNS BOOLEAN
BEGIN
    DECLARE Nije_Slobodan BOOLEAN DEFAULT FALSE;
    DECLARE end_datum DATETIME;
    
    SET end_datum = DATE_ADD(start_datum, INTERVAL 1 HOUR);
    
    SELECT EXISTS(
        SELECT *
        FROM term
        INNER JOIN service
        ON service.id = term.service_id
        WHERE term.date_time >= start_datum AND term.date_time <= end_datum
        AND service.name = usluga_name
    )
    INTO Nije_Slobodan;
    
    RETURN Nije_Slobodan;
END //
DELIMITER ;

SELECT i( "Opšti klinički pregled","2023-10-27 16:13:02");


--j)Funkcija za zakazivanje termina

DROP FUNCTION IF EXISTS j;
DELIMITER //

CREATE FUNCTION j(name VARCHAR(255), lastname VARCHAR(255), email VARCHAR(255), start_datum DATETIME, usluga_name VARCHAR(255), animal_name VARCHAR(255))
RETURNS INT
BEGIN
    DECLARE nije_slobodan, client_id, service_id, worker_id, animal_id INT;
    DECLARE end_datum DATETIME;
    SET end_datum = DATE_ADD(start_datum, INTERVAL 1 HOUR);

    SELECT
        client.id
    INTO 
        client_id
    FROM
        client
    WHERE 
        client.name=name AND client.last_name=lastname AND client.email=email;

    SELECT
        service.id
    INTO
        service_id
    FROM
        service
    WHERE 
        service.name=usluga_name;

    SELECT
        service.worker_id
    INTO 
        worker_id
    FROM
        service
    WHERE 
        service.id=service_id;
    
    SELECT
        id
    INTO 
        animal_id
    FROM
        animal
    WHERE
        animal.type=animal_name;

    SELECT 
        COUNT(*) 
    INTO
        nije_slobodan
    FROM
        term
    WHERE term.date_time >= start_datum AND term.date_time <= end_datum
        AND service_id = service_id;
    
    IF nije_slobodan>=1 
        THEN RETURN 0;
    ELSE 
        INSERT INTO term(`worker_id`,`service_id`,`client_id`,`animal_id`,`date_time`) 
        VALUES (worker_id,service_id,client_id,animal_id,start_datum);
        RETURN 1;
    END IF;
END //

DELIMITER ;

SELECT j("Jela", "Jovic", "jelaj@gmail.com", "2023-05-11 20:00","Infuzija i/v","Pas");

--k)Dogadjaj koji brise uplate koje su starije od tri godine
SET GLOBAL event_scheduler = ON;
DROP EVENT IF EXISTS k;

DELIMITER //

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
END //

DELIMITER ;
    
  --INSERT INTO pay(`date_time`,`price`,`term_id`,`worker_id`,`service_id`,`client_id`) VALUES ('2019-12-11 11:19:31','1200','19','4','10','1');


--l)Procedura za placanje

DROP PROCEDURE IF EXISTS l;
DELIMITER //

CREATE PROCEDURE l(datum DATETIME,termin_id INT, usluga_name VARCHAR(255), client_name VARCHAR(255),client_lname VARCHAR(255),email VARCHAR(255))
BEGIN
    DECLARE nije_slobodan, client_id, service_id, worker_id, animal_id,service_price INT;

    SELECT
        client.id
    INTO 
        client_id
    FROM
        client
    WHERE 
        client.name=client_name AND client.last_name=client_lname AND client.email=email;

    SELECT
        service.id,
        price
    INTO
        service_id,
        service_price
    FROM
        service
    WHERE 
        service.name=usluga_name;

    SELECT
        service.worker_id
    INTO 
        worker_id
    FROM
        service
    WHERE 
        service.id=service_id;
    

        INSERT INTO pay(`date_time`,`price`,`term_id`,`worker_id`,`service_id`,`client_id`)
         VALUES (datum,service_price,termin_id,worker_id,service_id,client_id);

END //

DELIMITER ;

CALL l("2023-05-11 20:00",4,"Infuzija i/v","Jela", "Jovic", "jelaj@gmail.com");


--m)Na svakih godinu dana povecavamo cenu usluge za 10%

SET GLOBAL event_scheduler=ON;
DROP EVENT IF EXISTS m;
DELIMITER //


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
        SELECT
            price,
            id
        FROM
            service;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET napusti_petlju=1;

    OPEN c;
    WHILE napusti_petlju=0 DO
    FETCH c INTO tr_cena, service_id;
    SET nova_cena=tr_cena*1.1;
    UPDATE service SET price=nova_cena WHERE id=service_id;
    END WHILE;
    CLOSE c;

END //

DELIMITER ;
