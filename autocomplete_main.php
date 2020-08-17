<html>
<head>
 <link rel="stylesheet" type="text/css" href="autocomplete_style.css" />
 <script type="text/javascript" src="jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="jquery.autocomplete.js"></script>
 
<script> 
    jQuery(function(){ 
    $("#search").autocomplete("autocomplete_search.php");
    });
 </script>

</head>
<body>
 <form action="autocomplete_get_form.php">
 Book Name : <input type="text" name="q" id="search" placeholder="Enter Sraff Number Here">
 <input type="submit" value="Submit"/>
 </form> 
</body>
</html>