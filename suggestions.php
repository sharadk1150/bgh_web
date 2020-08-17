<?php
    $existingNames = array("Sharad", "Sudhir", "Satish", "Sameer", "Sujata");

    if (isset($_POST['suggestion'])){
        $name = $_POST['suggestion'];


        if (!empty($name)){
        foreach ($existingNames as $value) {
            if (strpos($value, $name)  !== false) {
                echo $value;
                echo "<br>";
            }
        }
    }
    }

?>
