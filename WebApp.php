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
    main();
    exit;
}
if (isset($_POST['trans'])) {

    if ($_POST['trans'] == "login") {
        login("");
        exit;
    } else if ($_POST['trans'] == "main") {
        main();
        exit;
    }
} else {
    login("");
    exit;
}

function main()
{

    echo <<<EOT
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>メイン画面</title>
</head>

<body>

    <h1>勤務管理</h1>

    



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
        <form method="POST" action="WebApp.php">
            <button type="submit" name="btn01" value="btn01">ログイン</button>
            <input type="hidden" name="trans" value="main">
    
    
    
    </body>
    </html>

EOT;
}
