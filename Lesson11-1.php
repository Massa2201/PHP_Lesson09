<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>メイン画面</title>
    </head>
    <body>

<?php
$passlist=array( 'hogehoge' => 'hogepass', 'hoge2' => 'hoge2pass');

if(!isset($_POST['user']))
{
    echo_auth_page("ログインしてください");
    exit;
}
$user=$_POST['user'];
$pass=$_POST['pass'];

if( (!isset($passlist[$user])) || $passlist[$user] != $pass)
{
    echo_auth_page("パスワードが違います");
    exit;
}

if(isset($_POST['transition']))
{
    next_page("遷移に成功しました");
    exit;
}

echo_hello_page($user);


////////////////////////////////////////////////////////////////////////
function echo_auth_page($msg)
{
    echo <<<EOT
    $msg
    <form method="POST" action="Lesson11-1.php">
        username <input type="text" name="user" value=""><br>
        password <input type="password" name="pass" value=""><br>
        <button type="submit" name="login" value="login">Login</button>
    </form>
EOT;
}
////////////////////////////////////////////////////////////////////////
function echo_hello_page($who)
{
    global $user, $pass;

echo <<<EOT

こんにちは $who さん
    <form method="POST" action="Lesson11-1.php">
        <button type="submit" name="btn01" value="btn01">遷移page</button>
        <input type="hidden" name="transition" value="">
        <input type="hidden" name="user" value="$user">
        <input type="hidden" name="pass" value="$pass">
    </form>
EOT;
}

function next_page($text)
{
    global $user, $pass;

echo <<<EOT

$text
    <form method="POST" action="Lesson11-1.php">
        <button type="submit" name=btn01" value="btn01">戻る</button>
        <input type="hidden" name="user" value="$user">
        <input type="hidden" name="pass" value="$pass">
EOT;
}

?>
</body>
</html>