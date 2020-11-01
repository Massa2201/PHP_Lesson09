<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "dbpass";
$dbname = "board";
$tablename = "table1";

if(isset($_POST['transition']))
{
    


if ($_POST['transition'] == "trans_input_new")
{
    //trans_input_new遷移
    echo_page_input();
}
elseif ($_POST['transition'] == "trans_confirm")
{
    //trans_confirm遷移、page_confirm表示処理
    echo_page_confirm();
}
elseif ($_POST['transition'] == "trans_submit")
{
    action_trans_submit();
    //trans_submit遷移、遷移先表示処理
    // junction処理記述: 後述
}
elseif ($_POST['transition'] == "trans_return_top")
{
    //trans_return_top遷移
    
    if(isset($_POST['btn03-1'])) {

        $content=$_POST['content'];

        $escaped_content = mysqli_real_escape_string($link, $content);

        $result = mysqli_query($link,"INSERT INTO $tablename SET content='$escaped_content'");
        if(! $result) { 
            exit("INSERT error(1)!");
        }
    }

    echo_page_list();
}
}
elseif (!isset($_POST['transition']))
{
    echo_page_list();
}
else
{
    echo "Internal Error!"; // あり得ないエラー
}    

////////////////////////////////////////////////////////////////
function echo_page_list()
{
    global $hostname, $username, $password, $dbname, $tablename;


    echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>トップページ</title>
    </head>
    <body>
EOT;

    $link = mysqli_connect($hostname,$username,$password,$dbname);
    if (! $link){ exit("Connect error!"); }

    $result = mysqli_query($link, "USE $dbname");
    if(!$result) { exit("USE failed!"); }

    $result = mysqli_query($link,"select * from $tablename");
    if (!$result){ exit("Unexpected query error!"); } 

    echo '<table border="1">';

    $ary_of_fieldinfo = mysqli_fetch_fields($result);

    foreach($ary_of_fieldinfo as $key => $value)
    {
        echo "<th>" . htmlspecialchars($value->name) . "</th>";
    }

    while ($row = mysqli_fetch_row($result))
    {
        echo "<tr>";
        foreach($row as $key => $value)
        {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    echo <<<EOT
        <form method="post" action="Lesson10-2.php">
            <button type="submit" name="btn01-1" value="btn01-1">新規入力</button>
            <input type="hidden" name="transition" value="trans_input_new">
        </form>
EOT;
    echo <<<EOT
    </body>
</html>
EOT;

mysqli_free_result($result);

mysqli_close($link);
}
function echo_page_input()
{
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8" />
            <title>トップページ</title>
        </head>
        <body>
        
        <div class="box">
        <h1> 投稿記事入力画面 </h1>
        <form  class="box" method="post" action="Lesson10-2.php">
            <div class="flex">
            <p class="block">ここに入力してください</p>
            <textarea name="content" rows="4" cols="25">
EOT;
              if(isset($_POST['content'])){echo $_POST['content'];
              echo $content;
              }
              else {
                  echo "";
              }
              echo <<<EOT
              </textarea>
            <br>
            </div>
            <button type="submit" name="btn02-1" value="btn02-1">投稿</button>
            <input type="hidden" name="transition" value="trans_confirm">
        </form>
        <form  class="box" method="post" action="Lesson10-2.php">
            <button class="btn" type="submit" name="btn02-2" value="btn02-1">戻る</button>
            <input type="hidden" name="transition" value="trans_return_top">
        </form>
        </div>

        </body>
    </html>
EOT;
}

function echo_page_confirm()
{
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8" />
            <title>トップページ</title>
        </head>
        <body>
EOT;
        $content = "";
        $content = $_POST['content'];
        echo '入力内容は' . htmlspecialchars($content) . "です";

    echo <<<EOT

    <form method ="post" action="Lesson10-2.php">
    <button class="center btn" type="submit" name="btn03-1" value="btn03-1">投稿</button>
    <input type="hidden" name="transition" value="trans_return_top">
    </form>
    <form  class="box" method="post" action="Lesson10-2.php">
    <input type="hidden" name="transition" value="trans_input_new">
    <input type="hidden" name="content" value="$content">

    <button type="submit" name="Btn12" value="Btn12">修正</button>
    </form> 

        </body>
    </html>
EOT;

}

?>