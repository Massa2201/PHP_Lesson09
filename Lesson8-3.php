<!DOCTYPE html>
<html>
    <head>
            <meta charset="UTF-8"/>
            <title>確認画面</title>
            <style>
            .box {
                
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            


            .center {
                margin: 40px;
            }

            .flex {
                display: flex;
                margin: 15px;
            }

            .block {
                margin-right: 10px;
            }
        </style>
    </head>
    <body>
    <?php

$dbname = 'testdb1';
$tablename = 'deposit';

    $link = mysqli_connect('127.0.0.1','root','dbpass',$dbname);
    if(! $link){ exit("Connect error!"); }

    $result = mysqli_query($link,"SELECT * FROM $tablename");
    if(!$result){ exit("Select error on table ($tablename)!"); } 
    
    echo '<table border="1">';

    while($row = mysqli_fetch_row($result))
    {
        echo "<tr>";
        foreach($row as $key => $value)
        {
            echo "<td>";
            echo htmlspecialchars($key) . "  : ";
            
            echo htmlspecialchars($value);
            echo "</td>";
            
        }
        echo "</tr>";
    }
    echo "</table>";

    mysqli_free_result($result);

    mysqli_close($link);

?>


    </body>
</html>