<!DOCTYPE html>
<html>
    <head>
            <meta charset="UTF-8"/>
            <title>Lesson8-1</title>
           
    </head>
    <body>
        <?php
            $hostname = '127.0.0.1';
            $username = 'root';
            $password = 'dbpass';

            $link = mysqli_connect($hostname,$username,$password);
            if(!$link){exit("Connect error!"); }

            $result = mysqli_query($link,"CREATE DATABASE testdb1 CHARACTER SET utf8");
            if(!$result) {echo "Create database testdb1 failed!\n"; }

            $result = mysqli_query($link,"USE testdb1");
            if(!$result) {exit("USE failed!");}

            $result = mysqli_query($link,"CREATE TABLE deposit (id INT NOT NULL AUTO_INCREMENT, month VARCHAR(100)BINARY, food REAL, traffic REAL, salary REAL, PEIMAEY KEY(id)) CHAEACTER SET utf8");

            $result = mysqli_query($link,"INSERT INTO deposit (month,food,traffic,salary) VALUES('7month',800,1000,100000),VALUES('8month',5000,1000,120000),VALUES('9month',1800,500,100000),VALUES('10month',3000,0,100000");

            mysqli_close($link);

        ?>

    </body>
</html>