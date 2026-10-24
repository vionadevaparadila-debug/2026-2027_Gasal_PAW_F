<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Proses Data: </h3>
    <?php
    require 'validate.inc';
    $errors= array();
    validateName($errors, $_POST, 'surname');
    if ($errors) {
        echo 'Errors:<br/>';
        foreach ($errors as $field => $error)
            echo "$field $error</br>";
    } else
        echo 'Data OK!';

    foreach ($_POST as $key => $value) {
        echo "($key) => ($value)<br>";
    }
    ?>
</body>

</html>