<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>投稿記事入力画面</title>
        <style>
            .box {
                
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            


            .center {
                margin: 40px;
            }

            .flex {
                display: flex;
                margin: 15px;
            }

            .block {
                margin-right: 10px;
            }
        </style>
    </head>

    <?php

        $hostname = "127.0.0.1";
        $username = 'root';
        $password = 'dbpass';

        $dbname = 'testdb1';
        $tablename = 'deposit';

        $link = mysqli_connect($hostname,$username,$password);
        if(! $link) { exit("Connect error!"); }

        $a=$_POST['month'];
        $b=$_POST['food'];
        $c=$_POST['traffic'];
        $d=$_POST['salary'];

        $escaped_a = mysqli_real_escape_string($link, $a);
        $escaped_b = (double)$b;
        $escaped_c = (double)$c;
        $escaped_d = (double)$d;

        $result = mysqli_query($link, "USE $dbname");
        if(!$result) { exit("USE failed!"); }

        $result = mysqli_query($link,"INSERT INTO $tablename SET month='$escaped_a',"
         . "food=$escaped_b, traffic=$escaped_c, salary=$escaped_d");
        if(! $result) { exit("INSERT error(1)!"); }
        
        ?>
    
    <body>
        <div class="box">
        <h1>登録フォーム</h1>
        <form  class="box" method="post" action="Lesson8-2-2.php">
            <div class="flex">
            <p class="block">登録できました</p>
            
            <br>
            </div>
           
        </form>
        </div>
    </body>
</html>