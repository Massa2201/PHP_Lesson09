<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ページタイトル</title>
    </head>
    <body>
        <table border='1'>
            
<?php 
$a[0]['date']='2010/4/1';
$a[0]['temperature']=20.3;
$a[0]['pressure']=980;
$a[0]['humidity']=60;

$a[1]['date']='2010/4/2';
$a[1]['temperature']=22.3;
$a[1]['pressure']=970;
$a[1]['humidity']=50;

$a[2]['date']='2010/4/4';
$a[2]['temperature']=18.3;
$a[2]['pressure']=950;
$a[2]['humidity']=70;

for($i=0;$i<=2;$i++) {
    
    foreach($a[$i] as $c => $b)
    {
       echo "<tr>
           
                <td>$c</td>
                <th>$b</th>
             </tr>";
    }
}
?>
            
        </table>
    </body>
</html>