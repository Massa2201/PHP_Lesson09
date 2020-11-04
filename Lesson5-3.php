<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ページタイトル</title>
    </head>
    <body>
<?php
if(isset($_GET['a']) && $_GET['a']>=0 )
{
   $a=$_GET['a'];
}
else
{
   $a=0;
}

if(isset($_GET['b']) && $_GET['b']>=0 )
{
   $a=$_GET['b'];
}
else
{
   $b=0;
}

if(isset($_GET['c']) && $_GET['c']>=0 )
{
   $a=$_GET['c'];
}
else
{
   $c=0;
}

if($a>0) {
    echo "<p> リンゴの個数が $a 個</p>";
}

if($b>0) {
    echo "<p> リンゴの個数が $b 個</p>";
}

if($c>0) {
    echo "<p> リンゴの個数が $c 個</p>";
}

echo '<a href="http://localhost'
    . ($a+1) . '&b=' . $b . '&c=' . $c . ">リンゴを1個追加</a> ';

echo '<a href="http://localhost'
    . $a . '&b=' . ($b+1) . '&c=' . $c . ">バナナを1個追加</a> ';
echo '<a href="http://localhost'
    . $a . '&b=' . $b . '&c=' . ($c+1) . ">パイナップルを1個追加</a> ';

?>
    </body>
</html>