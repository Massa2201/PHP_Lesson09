<?php

$passlist = array('member' => 'memberpass');


if (!isset($_POST['user'])) {
    login("ログインしてください");
    exit;
}
$user = $_POST['user'];
$pass = $_POST['pass'];

if ((!isset($passlist[$user])) || $passlist[$user] != $pass) {
    login("パスワードが存在しないか違っています");
    exit;
} else {
    start();
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

    echo <<<EOT
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>メイン画面</title>
</head>

<body>

    <header>

    <h1>メイン画面</h1>

    </header>

    <main>

    <p>2020年11月07日(土)</p>
    <p>20:00</p>
    
    <form method="POST" action="WebApp.php">
        <button type="submit" name="btn02" value="btn02">出勤</button>
        <input type="hidden" name="trans" value="finish">
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
        <title>メイン画面</title>
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
        <title>トップ画面</title>
    </head>
    
    <body>
    
        <h1>トップ画面</h1>
        <p>finish</p><br>
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
