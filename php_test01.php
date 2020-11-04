<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ページタイトル</title>
    </head>
    <body>
        <?php
            $a['16']=2;
            $a['020']=030;
            $a['0x10']=0x10;
            $a[9.5]=9.5;
            $a[19.5]=19.5;
            echo "<pre>" . htmlspecialchars(print_r($a,true)) . "</pre>";
        ?>
    </body>
</html>