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
    <body>
        <div class="box">
        <h1> 投稿記事入力画面 </h1>
        <form  class="box" method="post" action="Lesson6-1-3.php">
            <div class="flex">
            <p class="block">ここに入力してください</p>
            <textarea name="TxT1" rows="5" cols="30"></textarea>
            <br>
            </div>
            <button type="submit" name="Btn1" value="Btn1">投稿</button>
        </form>
        </div>
    </body>
</html>