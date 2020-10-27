<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>メイン画面</title>
        <style>
            .box {
                
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .block {
                display: block;
            }
        </style>
    </head>

    <body>
        <div class="box">

            <h1 class="center">入力フォーム</h1>

            <form  class="box" method="post" action="Lesson8-2-2.php">
                
                <div class="box ">
                    <div class="block">
                    <p class="block">monthを以下に入力して下さい</p>
                    <input type="text" name="month" value="">
                    </div>

                    <div class="flex block">
                    <p class="block">foodを以下に入力して下さい</p>
                    <input type="text" name="food" value="">
                    </div>

                    <div class="flex block">
                    <p class="block">trafficを以下に入力して下さい</p>
                    <input type="text" name="traffic" value="">
                    </div>

                    <div class="flex block">
                    <p class="block">salaryを以下に入力して下さい</p>
                    <input type="text" name="salary" value="">
                    </div>
                    <br>
                </div>

                <button type="submit" name="Btn1" value="Btn1">登録</button>
            </form>
        </box>  
        
    </body>
</html>