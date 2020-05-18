<?php
// Start the session
session_start();
?>

<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS and internal CSS -->        
        <link rel="stylesheet" href="bgh_main_style.css">
        <link rel="stylesheet "href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            /*
            .dropdown {list-style: none; background: green; padding: 10px; display: inline-block;}
            .dropdown .nav-link {color:#fff; text-decoration: none;}
            .dropdown .dropdown-menu a{color: #000; text-decoration: none;}
            .dropdown .btn {background: green; color:#fff;}
            .dropdown .btn:hover {background: cyan; color:#000;}
            .dropdown .btn:active {background: cyan; color:#000;}
            .dropdown .btn:focus {background: cyan; color:#000;}
            .dropdown-menu .dropdown-item {display: inline-block; width: 100%; padding: 10px 5px;}
            */
            
            .dropdown .dropdown-menu a:hover
            {    
              color: #fff;
              background-color: #b91773;
              border-color: #fff;
            }
        </style>
        <title> Bokaro General Hospital, Bokaro</title>

    </head>
    <body>
      <!-- Checking the Session Variable for Login from the login page -->
      
      <?php
          
         $login_name = $_SESSION["login"];
        
//        echo $_SESSION["login"];
//        echo $_SESSION['loggedIn'];
        
//          print_r($_SESSION);
//        on the second page you check if that session is true, else redirect to the login page  
//        if (!isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]="")
        if (!isset($_SESSION["loggedIn"]))
        {  
            header('Location:/login_bgh.php'); 
        }
        else
        {
            ;
//            echo "all Good";
            
        }
    ?>
    
      
        
    <!--    <h1 class="display-6"> Bokaro General Hospital </<h1> -->
    <!-- Drop Down Menus from Bootstrap-->
    <!-- Example single danger button -->
<!--
    <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" col-sm-2 data-toggle="dropdown">
      OPD
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>

    <button type="button" class="btn btn-primary dropdown-toggle" col-sm-2 data-toggle="dropdown">
        IPD
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Separated link</a>
      </div>
</div>
-->
    <!-- NAVBAR FROM BOOTSTRAP -->
    <!-- class="navbar navbar-dark bg-primary" -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
        <nav class="navbar  sticky-top navbar-expand-lg navbar-dark bg-primary justified"> 
        <a class="navbar-brand" href="#">BGH</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            
          <ul class="navbar-nav">
           
           
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                OPD
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="opd_status_01.php">OPD Dashboard</a>
                <a class="dropdown-item" href="#">OPD Schedule</a>
                <a class="dropdown-item" href="#">................</a>
              </div>
            </li>
                        
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                IPD/WARD
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Admissions Dashboard</a>
                <a class="dropdown-item" href="get_adm_date.php">All Admissions</a>
                <a class="dropdown-item" href="get_adm_employee.php">ON Roll Employee</a>
                <a class="dropdown-item" href="adm_cat_wise.php">Category Wise Admission</a>
                <a class="dropdown-item" href="adm_unit_wise.php">Unit Wise Admission</a>
                <a class="dropdown-item" href="adm_source_wise.php">Source Wise Admission</a>
                <a class="dropdown-item" href="adm_diag_wise.php">Diagnosis Wise Admission</a>
                <a class="dropdown-item" href="adm_census_data.php">Census Daily Data</a>
                
                
              </div>
            </li>
            
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Billing
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Billing Dashboard</a>
                <a class="dropdown-item" href="bill_cat_wise.php">Category Wise Billing</a>
                <a class="dropdown-item" href="bill_cat_wise_01.php">Group Wise Billing</a>
                <a class="dropdown-item" href="bill_cat_wise_02.php">Group/Cat Wise Billing</a>
                <a class="dropdown-item" href="bill_cat_wise_03.php">Third Party Billing</a>
                <a class="dropdown-item" href="bill_collection_01.php">IPD Cash Collection</a>
                <a class="dropdown-item" href="bill_refund_01.php">IPD Refunds</a>
                <a class="dropdown-item" href="bill_refund_02.php">Misc. Refunds</a>
                
                
                
                
                
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>

            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  BloodBank
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
            
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pharmacy
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Pharmacy DashBoard</a>
                  <a class="dropdown-item" href="pharma_med_master.php">OPD Med Master</a>
                  <a class="dropdown-item" href="pharma_med_master_wms.php">WMS Med Master</a>
                  <a class="dropdown-item" href="pharma_allctr_stock.php">All Counter Stock</a>
                  <a class="dropdown-item" href="pharma_substore_stock.php">SubStore Stock</a>
                                   
                                    
                  <a class="dropdown-item" href="pharma_expiry_01.php">Pharma Expired Drug (Counter)</a>
                  <a class="dropdown-item" href="pharma_expiry_02.php">Pharma Expired Drug (All)</a>
                  
                </div>
              </li>  

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  ISO
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>  

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Statistics
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Radiology
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Radiology DashBoard</a>
                  <a class="dropdown-item" href="radiology_report_02.php">Radiology Report</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Investigation
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Misc Reports
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <a class="dropdown-item" href="medissue_csr_13.php">CSR-Medicine Issued to Medical Camps</a>
                  <a class="dropdown-item" href="medissue_csr_20.php">CSR-Medicine Issued to SSK(HC-5)</a>
                </div>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="#">PMJAY <span class="sr-only">(current)</span></a>
              </li>
              
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  PACS
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="http://10.143.55.35">Pacs System</a>
                  <a class="dropdown-item" href="#">About PACS System</a>
                  <a class="dropdown-item" href="#">Work Order PACS</a>
                  <a class="dropdown-item" href="#">AMC PACS</a>
                  
                </div>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="#">BGH-MIS <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="http://bokarosteel.com">BokaroSteel.com <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="bgh_complaints.html">Complaints <span class="sr-only">(current)</span></a>
              </li>  

              <li class="nav-item active">
                <a class="nav-link" href="bgh_com_escalation.html"><i class="fa fa-phone"></i><span class="sr-only">(current)</span></a>
              </li>



          </ul>
        </div>
      </nav>
    <!-- NVBAR FROM BOOTSTRAP  UPTO HERE -->
<!-- OLD STYLE MENU     
        <div class="menu-bar">
        <ul>
            <li class="active"><a href="#"><i class="fa fa-home"></i>Home</a></li>
            
            <li><a href="#"><i class="fa fa-hospital-o"></i></a>About Us</a>
                <div class="sub-menu-1">
                    <ul>
                        <li><a href="#">OPD List</a></li>
                        <li><a href="#">OPD Doctor</a></li>
                        <li><a href="#">OPD Schedule</a></li>
                        <li><a href="#">4.</a></li>
                        <li><a href="#">5.</a></li>
                        <li><a href="#">6.</a></li>
                        <li><a href="#">7.</a></li>
                    </ul>
                </div>  
            </li>

            <li><a href="#"></a>OPD</a>
                <div class="sub-menu-1">
                    <ul>
                        <li><a href="#">OPD List</a></li>
                        <li><a href="#">OPD Doctor</a></li>
                        <li><a href="#">OPD Schedule</a></li>
                        <li><a href="#">4.</a></li>
                        <li><a href="#">5.</a></li>
                        <li><a href="#">6.</a></li>
                        <li><a href="#">7.</a></li>
                    </ul>
                </div>              
            </li>

            <li><a href="#"></a>IPD</a>
                <div class="sub-menu-1">
                    <ul>
                        <li><a href="#">IPD List</a></li>
                        <li><a href="#">IPD Unit</a></li>
                        
                        <li class="hover-me"><a href="#">IPD Reports</a><i class="fa fa-angle-right"></i>
                            <div class="sub-menu-2">
                                <ul>
                                    <li><a href="#">Daily Adm Report </a></li>
                                    <li><a href="#">Monthly Adm Report  </a></li>
                                    <li><a href="#">Yearly Adm Report    </a></li>
                                </ul>
                            </div>
                        </li>
                        
                        <li><a href="#">4.</a></li>
                        <li><a href="#">5.</a></li>
                        <li><a href="#">6.</a></li>
                        <li><a href="#">7.</a></li>
                    </ul>
                </div>                          
            </li>

            <li><a href="#"></a>Billing</a></li>
            <li><a href="#"></a>Blood Bank</a></li>
            <li><a href="#"></a>Pharmacy</a></li>
            <li><a href="#"></a>ISO</a></li>
            <li><a href="#"></a>Reports</a></li>
           <li><a href="#"><i class="fa fa-phone"></i></a>Contact</a></li>
        </ul>
    </div>
 OLD STYLE MENU IS UPTO HERE -->

<!-- Caraousel Entry has to be done Here  -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="bgh_2.jpg" height="400px" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="bgh_3.jpg" height="400px" class="d-block w-100" alt="...">
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

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="draksingh1.jpg" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Dr. A K Singh</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Header</div>
        <div class="card-body text-success">
          <h5 class="card-title">Success card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
      </div>



      <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Header</div>
        <div class="card-body text-success">
          <h5 class="card-title">Success card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
      </div>


    <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Header</div>
        <div class="card-body text-success">
          <h5 class="card-title">Success card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <div class="card-footer bg-transparent border-success">Footer</div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="draksingh1.jpg" class="card-img" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Dr. A K Singh</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
        <div class="footer">
            <footer>Developed by C and IT in Consultation With Bokaro General Hospital, Bokaro</footer>
        </div>
      
<!-- CARD LAYOUT FROM THE BOOTSTRAP GOES UPTO HERE -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
    </body>
</html>
