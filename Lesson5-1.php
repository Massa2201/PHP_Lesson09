<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ページタイトル</title>
    </head>
    <body>
        <table border='1'>
            
<?php 
$price['apple']=150;
$price['orange']=120;
$price['pinapple']=300;
foreach($price as $a => $b)
{
    echo "<tr><td>$a : $b</td><br></tr> ";
}
?>
            
        </table>
    </body>
</html>