<?php

$passlist = array('imai' => 'imaipass', 'kimura' => 'kimurapass');
$time_now = date('H:i:s');

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
        if ($user == 'imai') {
            start("imai");
            exit;
        } else if ($user == 'kimura') {
            start("kimura");
            exit;
        } else {
            start("ユーザ認証に失敗しました。エラーコード0001");
        }
    } else if ($_POST['trans'] == "finish") {
        finish();
        exit;
    } else if ($_POST['trans'] == "work_data") {
        work_data();
        exit;
    }
} else {
    login("");
    exit;
}

function start($name_text)
{
    global $user, $pass;
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
    <p>2020年11月07日(土)</p>
    <p>20:00</p>
EOT;
    if ($name_text == "imai") {

        echo <<<EOT
    <form method="POST" action="WebApp.php">
        <button type="submit" name="btn03" value="btn03">勤務データ</button>
        <input type="hidden" name="trans" value="work_data">
        <input type="hidden" name="user" value="$user">
        <input type="hidden" name="pass" value="$pass">
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
EOT;
    }

    echo <<<EOT
    <form method="POST" action="WebApp.php">
        <button type="submit" name="btn02" value="btn02">出勤</button>
        <input type="hidden" name="trans" value="finish">
        <input type="hidden" name="user" value="$user">
        <input type="hidden" name="pass" value="$pass">
    </form>

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

function finish()
{
    global $user, $pass;

    echo <<<EOT

    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8" />
        <title>出勤完了画面</title>
    </head>
    
    <body>
    
        <h1>出勤完了画面</h1>
        <p>出勤いたしました。</p><br>
        <form method="POST" action="WebApp.php">
            
            <button type="submit" name="btn01" value="btn01">退勤</button>
            <input type="hidden" name="trans" value="start">
        </form>
    
    
    
    </body>
    </html>


EOT;
}
function work_data()
{
    global $user, $pass;

    echo <<<EOT

    <!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8" />
        <title>勤務データ</title>
    </head>
    
    <body>
    
        <p>勤務データ</p>
        <form method="POST" action="WebApp.php">
            
            <button type="submit" name="btn01" value="btn01">退勤</button>
            <input type="hidden" name="trans" value="start">
        </form>
    
    
    
    </body>
    </html>


EOT;
}
