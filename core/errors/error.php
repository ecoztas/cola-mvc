<!DOCTYPE html>
<html>
<head>
    <title>Error!</title>
    <meta charset="utf-8">

    <style type="text/css">
        h1 {
            padding-top: 5%;
            color: #FF0000;
            text-align: center;
        }
    </style>

</head>
<body>

    <h1>
        <?php
            if (isset($message)) {
                echo($message);
            } else {
                echo('<h1>Error!</h1>');
            }
        ?>
    </h1>

</body>
</html>