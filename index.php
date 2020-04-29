<html>
<head>
<title>My Index Page</title>
<h1>Bokaro General Hospital</h1>
</head>
<body>
   
    <?php
        session_start();
        extract($_POST);
        echo $_SESSION['login'];
    ?>
    
</body>
</html>
