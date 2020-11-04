<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>メイン画面</title>
    </head>
    <body>

<?php
    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'dbpass';
                
    $dbname = 'community';
    $tablename = 'table';
    
    $link = mysqli_connect($hostname,$username,$password);
    if(! $link){ exit("Connect error!");}

if(isset($_POST['transition'])){
    if($_POST['transition'] == "new"){
        input(); 
    }elseif($_POST['transition'] == "confirm"){
        if($_POST['text01']=="" || $_POST['text02']==""){
            error();
        }else{
            confirm();
        }
    }elseif($_POST['transition']== "top"){
        insert();
        main();
    }else{
        echo "Internal Error!"; // あり得ないエラー
    }
}else{
    main();
}
function input()
{
    if(isset($_POST['modify01'])){
        $name=$_POST['modify01'];
    }else {
        $name="";
    }    
    if(isset($_POST['modify02'])){
        $content=$_POST['modify02'];
    }else {
        $content="";
    }
    echo <<<EOT
        <h1> 投稿記事入力画面 </h1>
        <form method="post" action="Lesson10-2c.php">
            名前<input type="text01" name="text01" value="$name">
            <br>
            本文<textarea name="text02" rows="5" cols="30" >$content</textarea>
            <br>
          
            <button type="submit" name="btn01" value="btn01">投稿</button>
            <input type="hidden" name="transition" value="confirm">
        </form>
        <form action="10_2.php">
            <button type="submit" name="btn02" value="btn02">取り消し</button>
        </form>
EOT;
}
function confirm()
{
    $name=$_POST['text01'];
    $content=$_POST['text02'];
    echo <<<EOT
    <h1> 確認画面 </h1>
    名前 $name  <br>
    $content <br>
    <form method="post" action="Lesson10-2c.php">
            <input type="hidden" name="list1" value="$name">
            <input type="hidden" name="list2" value="$content">
            <button type="submit" name="btn01" value="btn01">投稿</button>
            <input type="hidden" name="transition" value="top">
    </form>
    <form method="post" action="Lesson10-2.php">          
            <input type="hidden" name="modify01" value="$name">
            <input type="hidden" name="modify02" value="$content">
            <button type="submit" name="btn02" value="btn02">修正</button>
            <input type="hidden" name="transition" value="new">
    </form>
EOT;

}

function main()
{
    global $hostname, $username, $password, $dbname, $tablename, $link;
    
    $result = mysqli_query($link,"USE $dbname");
    if(!$result) { exit("USE failed!"); }
    $result=mysqli_query($link,"select * from $tablename");
    if(!$result){ exit("Select error on table ($tablename)!"); } 

    $ary_of_fieldinfo=mysqli_fetch_fields($result);

    echo '<table border="1">';
    while($row = mysqli_fetch_row($result))
    {
        echo "<tr>";
        foreach($row as $key => $value)
        {
            echo "<td>" .htmlspecialchars($ary_of_fieldinfo[$key]->name)."  : ";
            echo htmlspecialchars($value) . "</td>";
        }
         echo "</tr>";
    }
    mysqli_free_result($result);

    mysqli_close($link);
echo "</pre>";

    echo <<<EOT
        <h1> メイン画面 </h1>
        <form method="post" action="10_2.php">
            <button type="submit" name="Btn3" value="Btn3">新規投稿</button>
            <input type="hidden" name="transition" value="sinki">
        </form>
EOT;
}
function insert(){
    global $hostname, $username, $password, $dbname, $tablename, $link;

    $result = mysqli_query($link,"USE $dbname");
    if(!$result) { exit("USE failed!"); }

    if(isset($_POST['list1'])){
        $name=$_POST['list1'];
    }else {
        $name="";
    }   
    if(isset($_POST['list2'])){
        $content=$_POST['list2'];
    }else {
        $content="";
    }
    $escaped_name = mysqli_real_escape_string($link, $name);
    $escaped_content = mysqli_real_escape_string($link, $content);

    $result = mysqli_query($link,"INSERT INTO $tablename SET name='$escaped_name', content='$escaped_content'");
    if(! $result){ exit("INSERT error(1)!"); }

    $result=mysqli_query($link,"select * from $tablename");
    if(!$result){ exit("Select error on table ($tablename)!"); } 
}
function error(){
echo <<<EOT
    <p>名前と内容の両方を入力してください</p>
    <form method="post" action="10_2.php"> 
        <button type="submit" name="Btn2" value="Btn2">戻る</button>
        <input type="hidden" name="transition" value="sinki">
    </form>    
EOT;
}
?>
    </body>
</html>