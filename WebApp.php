<?php

if (isset($_POST['trans'])) {

    if ($_POST['trans'] == "login") {
        login();
    }
} else {
    main();
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

    <h1>勤務管理システム</h1>



</body>
</html>

EOT;
}


?>

</body>

</html>