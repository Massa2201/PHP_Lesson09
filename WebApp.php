<?php

$passlist = array('imai' => 'imaipass', 'kimura' => 'kimurapass');
date_default_timezone_set('Asia/Tokyo');
$time_now = date('H:i:s');
$date_now = date('Y-m-d');

if (!isset($_POST['user'])) {
    login("ログインしてください");
    exit;
}
$user = $_POST['user'];
$pass = $_POST['pass'];

$hostname = '127.0.0.1';
$username = 'root';
$password = 'dbpass';
$dbname = 'work_db';
$tablename01 = 'masashi';
$tablename02 = 'kimura';

$link = mysqli_connect($hostname, $username, $password);
if (!$link) {
    exit("Connect error!");
}

$result = mysqli_query($link, "USE $dbname");
if (!$result) {
    exit("Using database is failed!");
}


if ((!isset($passlist[$user])) || $passlist[$user] != $pass) {
    login("パスワードが存在しないか違っています");
    exit;
}

if (isset($_POST['trans'])) {

    if ($_POST['trans'] == "login") {
        login("");
        exit;
    } else if ($_POST['trans'] == "start") {

        if (isset($_POST['start'])) {
            if ($_POST['start'] == "1") {
                $finish = "1";
            }
        }
        if ($user == 'imai') {
            start("imai", "");
            exit;
        } else if ($user == 'kimura') {
            start("kimura", "");
            exit;
        } else {
            start("ユーザ認証に失敗しました。エラーコード0001", "");
        }
    } else if ($_POST['trans'] == "finish") {
        if ($_POST['start'] == "0") {
            finish("0");
            exit;
        } else {
            start("出勤に失敗しました。エラーコード0002", "");
        }
    } else if ($_POST['trans'] == "work_data") {
        work_data();
        exit;
    }
} else {
    login("");
    exit;
}

function start($name_text, $start01)
{

    global $user, $pass, $link, $result, $finish, $tablename01, $date_now, $time_now, $tablename02;

    if ($finish == '1' && $user == 'imai') {
        $result = mysqli_query(
            $link,
            "update $tablename01 set FinishTime = '$time_now' order by id DESC LIMIT 1;"
        );
        if (!$result) {
            exit("UPDATE error!");
        }
    }

    if ($finish == '1' && $user == 'kimura') {
        $result = mysqli_query(
            $link,
            "update $tablename02 set FinishTime = '$time_now' order by id DESC LIMIT 1;"
        );
        if (!$result) {
            exit("UPDATE error!");
        }
    }

    echo <<<EOT
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <title>出勤準備画面</title>
    </head>

    <body>

    <header>

    <h1>出勤画面</h1>

    </header>

    <main>
    <p>$name_text</p>
    <p>$date_now</p>
    <p>$time_now</p>
EOT;
    if ($name_text == "imai") {

        echo <<<EOT
    <form method="POST" action="WebApp.php">
        <button type="submit" name="btn04" value="btn04">勤務データ</button>
        <input type="hidden" name="trans" value="work_data">
        <input type="hidden" name="user" value="$user">
        <input type="hidden" name="pass" value="$pass">
    </form>


    <form method="POST" action="WebApp.php">
        <button type="submit" name="btn05" value="btn05">出勤</button>
        <input type="hidden" name="trans" value="finish">
        <input type="hidden" name="user" value="$user">
        <input type="hidden" name="pass" value="$pass">
        <input type="hidden" name="start" value="0">
    </form>

EOT;
    }

    if ($name_text == "kimura") {

        echo <<<EOT
        <form method="POST" action="WebApp.php">
            <button type="submit" name="btn03" value="btn03">勤務データ</button>
            <input type="hidden" name="trans" value="work_data">
            <input type="hidden" name="user" value="$user">
            <input type="hidden" name="pass" value="$pass">
        </form>

        <form method="POST" action="WebApp.php">
        <button type="submit" name="btn02" value="btn02">出勤</button>
        <input type="hidden" name="trans" value="finish">
        <input type="hidden" name="user" value="$user">
        <input type="hidden" name="pass" value="$pass">
        <input type="hidden" name="start" value="0">

    </form>
EOT;
    }

    echo <<<EOT

    </main>

    <footer>

    </footer>


    </body>
    </html>

EOT;
}

function login($text)
{

    global $user, $pass;

    echo <<<EOT
    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8" />
        <title>ログイン画面</title>
    </head>
    
    <body>
    
        <h1>勤務管理システム</h1>
        <p>$text</p><br>
        <form method="POST" action="WebApp.php">
            username <input type="text" name="user" value=""><br>
            password <input type="password" name="pass" value=""><br>
            <button type="submit" name="btn01" value="btn01">ログイン</button>
            <input type="hidden" name="trans" value="start">
        </form>
    
    
    
    </body>
    </html>

EOT;
}

function finish($finish)
{
    global $user, $pass, $link, $tablename01, $date_now, $time_now, $tablename02;

    echo <<<EOT

    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8" />
        <title>出勤完了画面</title>
    </head>
    
    <body>
EOT;

    if ($finish == '0' && $user == 'imai') {
        $result = mysqli_query(
            $link,
            "INSERT INTO $tablename01 SET WorkDate='$date_now', StartTime='$time_now'"
        );
        if (!$result) {
            exit("INSERT error!");
        }
    }

    if ($finish == '0' && $user == 'kimura') {
        $result = mysqli_query(
            $link,
            "INSERT INTO $tablename02 SET WorkDate='$date_now', StartTime='$time_now'"
        );
        if (!$result) {
            exit("INSERT error!");
        }
    }


    echo <<<EOT
        <h1>出勤完了画面</h1>
        <p>出勤いたしました。</p><br>

        <form method="POST" action="WebApp.php">
            <button type="submit" name="btn03" value="btn03">勤務データ</button>
            <input type="hidden" name="trans" value="work_data">
            <input type="hidden" name="user" value="$user">
            <input type="hidden" name="pass" value="$pass">
            <input type="hidden" name="number" value="1">
        </form>
        <form method="POST" action="WebApp.php">
            <button type="submit" name="btn01" value="btn01">退勤</button>
            <input type="hidden" name="trans" value="start">
            <input type="hidden" name="user" value="$user">
            <input type="hidden" name="pass" value="$pass">
            <input type="hidden" name="start" value="1">
        </form>
    
    
    
    </body>
    </html>


EOT;
}
function work_data()
{
    global $user, $pass, $result, $link, $tablename01, $tablename02, $finish;

    echo <<<EOT

    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8" />
        <title>勤務データ</title>
    </head>
    
    <body>
EOT;
    if ($user == 'imai') {
        $result = mysqli_query($link, "select * from $tablename01");
        if (!$result) {
            exit("Select error on table ($tablename01)!");
        }

        $ary_of_fieldinfo = mysqli_fetch_fields($result);

        echo '<table border="1">';
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>" . htmlspecialchars($ary_of_fieldinfo[$key]->name) . "  : ";
                echo htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        mysqli_free_result($result);
    }
    if ($user == 'kimura') {
        $result = mysqli_query($link, "select * from $tablename02");
        if (!$result) {
            exit("Select error on table ($tablename02)!");
        }

        $ary_of_fieldinfo = mysqli_fetch_fields($result);

        echo '<table border="1">';
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>" . htmlspecialchars($ary_of_fieldinfo[$key]->name) . "  : ";
                echo htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        mysqli_free_result($result);
    }
    if ($finish == "1") {
        echo <<<EOT
    <p>勤務データ</p>
    <form method="POST" action="WebApp.php">
        
        <button type="submit" name="btn01" value="btn01">出退勤画面に戻る</button>
        <input type="hidden" name="trans" value="start">
    </form>
EOT;
    }

    if ($finish == "0") {
        echo <<<EOT
        <p>勤務データ</p>
        <form method="POST" action="WebApp.php">
            
            <button type="submit" name="btn01" value="btn01">出退勤画面に戻る</button>
            <input type="hidden" name="trans" value="finish">
        </form>
EOT;
    }

    echo <<<EOT
    </body>
    </html>


EOT;
}
