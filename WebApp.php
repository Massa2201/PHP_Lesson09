<?php

$passlist = array('member' => 'memberpass');
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

if ((!isset($passlist[$user])) || $passlist[$user] != $pass) {
    login("パスワードが存在しないか違っています");
    exit;
}

if (isset($_POST['trans'])) {

    if ($_POST['trans'] == "login") {
        login("");
        exit;
    } else if ($_POST['trans'] == "start") {
        start();
        exit;
    } else if ($_POST['trans'] == "finish") {
        finish();
        exit;
    }
} else {
    login("");
    exit;
}

function start()
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

    <p>2020年11月07日(土)</p>
    <p>20:00</p>
    
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
