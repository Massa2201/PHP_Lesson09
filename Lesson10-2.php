<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "dbpass";
$dbname = "board";
$tablename = "table1";

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
    echo_page_list();
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
    mysqli_free_result($result);

    mysqli_close($link);

    echo <<<EOT
        <form method="post" action="Lesson10-2.php">
            <button type="submit" name="button_new" value="button_new">新規入力</button>
            <input type="hidden" name="transition" value="trans_input_new">
        </form>
EOT;
    echo <<<EOT
    </body>
</html>
EOT;
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
        <p>inputのスクリーン</p>
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
        <p>confirmのスクリーン</p>
        </body>
    </html>
EOT;
}

function action_trans_submit()
{
    global $hostname, $username, $password, $dbname, $tablename;
}

?>