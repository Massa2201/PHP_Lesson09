<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ページタイトル</title>
    </head>
    <body>
        <table>
            <tr>
<?php
for($j = 1; $j <= 10; $j++)
{
    echo "<td>$j * $i</td>";
}
    for($i = 1; $i  <= 9; $i++) {
    echo "<td>$i</td>";
}
?>
            </tr>
        </table>
    </body>
</html>