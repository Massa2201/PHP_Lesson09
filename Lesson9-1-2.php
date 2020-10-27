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
        
        <?php
        if(isset($_POST['content'])) {
            $content=$_POST['content'];
        }else {
            $content="";
        }
        ?>

        <div class="box">
        <h1> 投稿記事入力画面 </h1>
        <form  class="box" method="post" action="Lesson9-1-3.php">
            <div class="flex">
            <p class="block">ここに入力してください</p>
            <textarea name="content" rows="4" cols="25"
             ><?php
              if(isset($_POST['content'])){echo $_POST['content'];}
              echo $content;
             ?></textarea>
            <br>
            </div>
            <button type="submit" name="Btn1" value="Btn1">投稿</button>
        </form>
        <form  class="box" method="post" action="Lesson9-1-1.php">
            <button class="btn" type="submit" name="Btn1" value="Btn1">取り消し</button>
        </form>
        </div>
    </body>
</html>