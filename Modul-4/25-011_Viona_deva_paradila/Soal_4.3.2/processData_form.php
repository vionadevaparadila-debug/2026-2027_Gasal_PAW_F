<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // $errors = array();
    // if (isset($_POST['surname'])) {
    //     require 'validate.inc';
    //     validateName($errors, $_POST, 'surname');
    //     if ($errors) {
    //         echo '<h1>Invalid, correct the following errors:</h1>';
    //         foreach ($errors as $field => $error)
    //             echo "$field $error</br>";
    //         // tampilkan kembali form
    //         include 'form.inc';

    //     } else {
    //         echo 'Form submitted successfully with no errors';
    //     }

    // } else
    //     // tampilkan kembali form
    //     include 'form.inc';


    // Langkah 9 (4.3.2)
    $errors = array();
    require 'validate.inc';
    
    if (!empty($_POST)) {   
        validateName($errors, $_POST, 'surname');

        validateEmails($errors,$_POST,'email');
        if (empty($_POST['sex'])) {
            $errors['sex'] = 'invalid';
        }

        validatepassword($errors,$_POST,'passwd');

    
        if ($errors) {
            echo '<h1>Invalid, correct the following errors:</h1>';
            foreach ($errors as $field => $error)
                echo "$field $error</br>";
            // tampilkan kembali form
            include 'form.inc';
    
        } else {
            echo 'Form submitted successfully with no errors';
        }
    
    } else {
        include 'form.inc';
    }
    ?>
</body>

</html>