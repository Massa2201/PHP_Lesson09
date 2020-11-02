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
    <body>
    <div class="box">
    <h1>確認画面</h1>
<?php
$a=$_POST['TxT1'];
echo '入力内容は' . htmlspecialchars($a) . "です";
?>
<form method ="post" action="Lesson6-1-1.php">
            <button class="center btn" type="submit" name="Btn1" value="Btn1">投稿</button>
   </div>
    </body>
</html>