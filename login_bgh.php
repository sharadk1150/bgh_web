<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<title>Bokaro General Hospital, Bokaro</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="node_modules/w3-css/w3.css">
<link rel="stylesheet" href="node_modules/fas-web/css/all.min.css">
<!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
<link rel="icon" type="image/png" href="sail-logo.jpg"/>
<body onload="document.getElementById('id01').style.display='block'">
<style>
         body {
                background-image:   url("bgh_bg_04.jpg");
                background-repeat:  no-repeat;
                background-size:    1600px 800px;
              }
          h1 {
              text-align: center;
              background-color: white; 
            }    
</style>
</head>
<body>
<h1> Bokaro General Hospital </h1>  
<div class="w3-container">

  <div id="id01"  style.display="block" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom"  style="max-width:300px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal"></span>

        <i class='fas fa-clinic-medical' style='font-size:108px;color:red'></i>
        <br>
        <h5>Login</h5>
        <h5>BGH Information System</h5>
      </div>

      <form class="w3-container" action="/action_page.php" method="post">        
        <div class="w3-section">
          <label><b>UserName</b></label>
          <input minlength="5" maxlength="12" size="12" class="w3-input w3-border w3-margin-bottom" type="text"  placeholder="Enter Username" name="uname" required>
          
          <label><b>PassWord</b></label>
          <input minlength="4" maxlength="12" size="12" class="w3-input w3-border" type="password"  placeholder="Enter Password" name="psw" required>
          
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="submit" id="submit">Login</button>
<!--      <input class="w3-check w3-margin-top" type="checkbox" checked="checked">Remember me> -->
        </div>             
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>

    </div>
  </div>
</div>
            
</body>
</html>