<?php
// Start the session
session_start();
?>

<html>
    <head>

    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS and internal CSS -->        
        <link rel="stylesheet"    href="bgh_main_style.css">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <!--
        <link rel="stylesheet"    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        -->
        <link rel="stylesheet" href="node_modules/fas-web/css/all.min.css">
        <link rel="icon" type="image/png" href="sail-logo.jpg"/>

        <style>    
            .dropdown-menu
            {    
              color: #fff;
              background-color: #ffbf4c;
              border-color: #fff;
            }
            .dropdown .dropdown-menu a:hover
            {    
              color: #fff;
              background-color: #b91773;
              border-color: #fff;
            }

            .dropdown-submenu 
            {
            position: relative;
            }

            .dropdown-submenu a::after 
            {
              transform: rotate(-90deg);
              position: absolute;
              right: 6px;
              top: .8em;
            }

            .dropdown-submenu .dropdown-menu 
            {
              top: 0;
              left: 100%;
              margin-left: .1rem;
              margin-right: .1rem;
            }
            .navbar-brand {
              display: inline-block;
              padding-top: .3125rem;
              padding-bottom: .3125rem;
              margin-right: 0rem;
              font-size: 1.25rem;
              line-height: inherit;
              white-space: nowrap;
            }

            .container-fluid-nav div{
            display: flex;
            justify-content: space-around;
}
            

        </style>
        <title> SRM Vendor Management System for SRM, Bokaro</title>
    </head>
    <body>
      <!-- Checking the Session Variable for Login from the login page -->      
<?php
          
         $login_name = $_SESSION["login"];
        if (!isset($_SESSION["loggedIn"]))
        {  
            header('Location:/login_bgh.php'); 
        }
        else
        {
            ;
            
        }
?>
<!-- <div class="container"> -->
<div class="container-fluid-nav">
<h5 style="color:blue;text-align:center; background-color: orange">SRM Vendor Management System (Internal)</h5>
<!--
<nav style="color:blue;text-align : center" class="navbar navbar-expand-lg navbar-dark bg-warning">
-->
<!--  <span class="navbar-text" style="color:blue;text-align:center">Bokaro General Hospital</span> -->
      
</nav> 
</div>


    <!-- NAVBAR FROM BOOTSTRAP -->
    <!-- class="navbar navbar-dark bg-primary" -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
        <nav class="navbar  sticky-top navbar-expand-lg navbar-dark bg-primary justified"> 
        <a class="navbar-brand" href="#"><img src="bgh_logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="SAIL"></a>               
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        


        <div class="collapse navbar-collapse" id="navbarNavDropdown">            
          <ul class="navbar-nav">
            
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Vendor Enablement
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="read_srm_vendor_new.php">Upload CSV File</a>
              </div>
            </li>

            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                View SRM Vendor Data
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="srm_mail_listing.php">View SRM Vendors</a>
              </div>
            </li>

            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Activation Mail With Login Credentials
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="mail_gmail.php">Initial Activation Mail</a>
              </div>
            </li>

            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ZMVENDACT UPDATION
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="zmvendact_put.php">Initial Activation Mail</a>
              </div>
            </li>



              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">(current)</span>
                <?php echo $_SESSION["login"]; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
          </ul>
        </div>
      </nav>


<!-- Caraousel Entry has to be done Here  -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="bgh_2.jpg" height="350px"  class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="bgh_3.jpg" height="350px" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>     
<!-- Caraousel Entry is upto Here         -->

<!-- CARD LAYOUT FROM THE BOOTSTRAP GOES HERE -->

<div class="card-deck">

<div class="card mb-6 bg-primary" style="max-width: 540px;">
            <div class="row no-gutters">
                    <div class="col-md-4">
                      <img src="vkpandey.jpg" class="card-img" alt="...">
                    </div>

                    <div class="col-md-8">
                        <div class="card-body">            
                            <h5 class="card-title">Sri V K Pandey</h5>
                            <p class="card-text">Access of Information to the concerned person without any dependency will help in monitoring the system.</p>
                            <p class="card-text"><small class="text-muted">Sri V K. Pandey, Executive Director(MM), SAIL, BSL</small></p>
                        </div>
                    </div>
            </div>
</div>       

      
<!-- CARD LAYOUT NUMBER -->
      <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Header</div>
        <div class="card-body text-success">
          <h5 class="card-title">Important Message</h5>
          <p class="card-text">Some Important Message Will Go Here.</p>

        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
      </div>

    <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Header</div>
        <div class="card-body text-success">
          <h5 class="card-title">Important Message</h5>
          <p class="card-text">Some Important Message Will Go Here.</p>
        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
    </div>

    <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Header</div>
        <div class="card-body text-success">
          <h5 class="card-title">Important Message</h5>
          <p class="card-text">Some Important Message Will Go Here.</p>
        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
    </div>


</div>






	<!-- copyright -->

  

	<!-- //copyright -->

  <div class="copyright">
      <div class="row justify-content-center">
		    <h6>&copy; 2020 BSL, SAIL, Bokaro Steel Plant. All rights reserved | Developed by C&IT Department</a>
			  </h6>
      </div>  
  
		</div>
		<!-- //copyright -->

<!-- CARD LAYOUT FROM THE BOOTSTRAP GOES UPTO HERE -->
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
      $('.dropdown-menu a.dropdown-toggle').on('click', function(e) 
      {
      if (!$(this).next().hasClass('show')) {
      $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass('show');
      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
      $('.dropdown-submenu .show').removeClass("show");
      });
  return false;
});  

</script>

</body>
</html>