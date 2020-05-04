<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<body onload="document.getElementById('id01').style.display='block'">


<div class="w3-container">
  <h2>Bokaro General Hospital(Authorised Users Only)</h2>

<!--
<button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Login</button>
-->



  <div id="id01"  style.display="block" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal"></span>
<!--        <img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">-->

        <i class='fas fa-clinic-medical' style='font-size:108px;color:red'></i>
        <br>
        <h2> Login to BGH Information System</h2>
      </div>

      <form class="w3-container" action="/action_page.php" method="post">
        
        <div class="w3-section">
          <label><b>uname</b></label>
          <input minlength="5" maxlength="12" size="12" class="w3-input w3-border w3-margin-bottom" type="text"  placeholder="Enter Username" name="uname" required>
          
          <label><b>psw</b></label>
          <input minlength="4" maxlength="12" size="12" class="w3-input w3-border" type="password"  placeholder="Enter Password" name="psw" required>
          
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="submit" id="submit">Login</button>
<!--          <input class="w3-check w3-margin-top" type="checkbox" checked="checked">Remember me> -->
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