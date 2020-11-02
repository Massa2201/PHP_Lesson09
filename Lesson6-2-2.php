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

            .btn {
                margin: 10px 0px;
            }
        </style>
    </head>
    <body>
        

        <div class="box">
        <h1> 投稿記事入力画面 </h1>
        <form  class="box" method="post" action="Lesson6-2-3.php">
            <div class="flex">
            <p class="block">ここに入力してください</p>
            <textarea name="TxT1" rows="5" cols="30"
             ><?php if(isset($_POST['TxT1'])){echo $_POST['TxT1'];}?></textarea>
            <br>
            </div>
            <button type="submit" name="Btn1" value="Btn1">投稿</button>
        </form>
        <form  class="box" method="post" action="Lesson6-2-1.php">
            <button class="btn" type="submit" name="Btn1" value="Btn1">取り消し</button>
        </form>
        </div>
    </body>
</html>