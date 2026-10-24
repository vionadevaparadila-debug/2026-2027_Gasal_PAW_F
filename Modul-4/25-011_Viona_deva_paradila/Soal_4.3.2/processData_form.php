<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $errors = array();
    if (isset($_POST['surname'])) {
       
    require 'validate.inc';
        validateName($errors, $_POST, 'surname');
        if ($errors) {
            echo '<h1>Invalid, correct the following errors:</h1>';
            foreach ($errors as $field => $error)
                echo "$field $error</br>";
            // tampilkan kembali form
            include 'form.inc';

        } else {
            echo 'Form submitted successfully with no errors';
        }

    } else
        // tampilkan kembali form
        include 'form.inc';
    ?>
</body>

</html>