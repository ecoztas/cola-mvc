<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error!</title>

    <style>
        h1,
        h3{
            text-align: center;
        }
    </style>

</head>
<body>
    
    <h1>
        <?php
            if (!is_null($errorType)) {
                echo($errorType);
            } else {
                echo('Error!');
            }
        ?>
    </h1>

    <h3>
        <small>
            <?php
                if (!is_null($description)) {
                    echo($description);
                } else {
                    echo('Description not found!');
                }
            ?>
        </small>
    </h3>

</body>
</html>