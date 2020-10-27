<!DOCTYPE html>
<html>
    <head>
            <meta charset="UTF-8"/>
            <title>確認画面</title>
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

$dbname = 'board';
$tablename = 'table1';

$link = mysqli_connect($hostname,$username,$password);
if(! $link) { exit("Connect error!"); }

$content=$_POST['content'];

$escaped_content = mysqli_real_escape_string($link, $content);

$result = mysqli_query($link, "USE $dbname");
if(!$result) { exit("USE failed!"); }

$result = mysqli_query($link,"INSERT INTO $tablename SET content='$escaped_content'");
if(! $result) { exit("INSERT error(1)!"); }

?>

    <body>
    <div class="box">
    <h1>確認画面</h1>
<?php
$a=$_POST['content'];
echo '入力内容は' . htmlspecialchars($content) . "です";
?>
<form method ="post" action="Lesson9-1-1.php">
            <button class="center btn" type="submit" name="Btn1" value="Btn1">投稿</button>
   </form>
   <form  class="box" method="post" action="Lesson9-1-2.php">
        <input type="hidden" name="content" value="<?php echo $_POST["content"]; ?>">
        <button type="submit" name="Btn12" value="Btn12">修正</button>
    </form>
    </body>
</html>