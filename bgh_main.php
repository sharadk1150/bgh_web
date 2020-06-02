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
        <link rel="stylesheet" href="bgh_main_style.css">
        <link rel="stylesheet "href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>                      
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
        if (!isset($_SESSION["loggedIn"]))
        {  
            header('Location:/login_bgh.php'); 
        }
        else
        {
            ;
            
        }
?>
   
   

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
                OPD
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="opd_status_01.php">OPD Dashboard</a>
                <a class="dropdown-item" href="opd_status_02.php">Daily OPD Stats</a>
                <a class="dropdown-item" href="opd_daily_status_gr01.html">Daily OPD Stats Graph</a>
                <a class="dropdown-item" href="#">Department Wise OPD Visit</a>
                <a class="dropdown-item" href="#">Entitled OPD Visits</a>                
                <a class="dropdown-item" href="#">Non-Entitled OPD Visits</a>
                <a class="dropdown-item" href="#">Gender Wise OPD Visits</a>
                <a class="dropdown-item" href="#">Third Party OP Billing</a>
                <a class="dropdown-item" href="#">OP Billing of Mediclaim</a>
                <a class="dropdown-item" href="#">Inv. Billing of Mediclaim</a>
                <a class="dropdown-item" href="opd_daily_cash_coll_01.php">Daily OPD Cash Collection</a>
                
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
                <a class="dropdown-item" href="adm_wrkacdt_case.php">Work Accident Cases</a>
                <a class="dropdown-item" href="adm_ml_case.php">Medico Legal Cases</a>
                <a class="dropdown-item" href="adm_genderwise_adm.php">Gender Wise Admissions</a>
                <a class="dropdown-item" href="#">Entitled/Non-Entitled Admissions</a>
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
                <a class="dropdown-item" href="billing_ccat_claims.php">Third Party Claims/Receipt</a>               
                <a class="dropdown-item" href="bill_collection_01.php">IPD Cash Collection</a>
                <a class="dropdown-item" href="bill_refund_01.php">IPD Refunds</a>
                <a class="dropdown-item" href="bill_refund_02.php">Misc. Refunds</a>                                
                <a class="dropdown-item" href="#">Guarantor Bill Details</a>
                <a class="dropdown-item" href="bill_grntr_pending_01.php">Guarantor Bill Pending</a>
                <a class="dropdown-item" href="wardbill_recovery_statement_01.php">Guarantor Recovery Statement</a>
                <a class="dropdown-item" href="wardbill_headwise_billing_01.php">Bills Under Different Heads</a>

 
                                                
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
                  <a class="dropdown-item" href="#">WMS-Store Stock</a>                  
                  <a class="dropdown-item" href="pharma_na_order.php">LP-NA Medicines</a>
                  <a class="dropdown-item" href="pharma_nl_order.php">LP-NL Medicines</a>
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
                  <a class="dropdown-item" href="iso_adm_death_01.php">ISO Admission/Mortality Data</a>
                </div>
              </li>  

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Statistics
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Stats Cloud System</a>
                  <a class="dropdown-item" href="stat_mortality_01.php">Mortality Data</a>
                  <a class="dropdown-item" href="stat_mortality_02.php">Mortality DepartmentWise</a>                 
                  <a class="dropdown-item" href="labour_room_br_01.php">Birth Report Summary</a>
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
                  <a class="dropdown-item" href="wardlab_status_rep_01.php">WardLab Tests Report</a>
                  <a class="dropdown-item" href="wardlab_non_conformity_01.php">WardLab Non Conformity Report</a>
                  <a class="dropdown-item" href="wardlab_inv_fy_wise.php">FY Year Wise Ward Lab Summary</a>
                </div>
              </li>

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Misc Reports
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="list_doctor_01.php">List of Doctor's</a>
                  <a class="dropdown-item" href="list_bgh_or_employees.php">List of BGH Staff</a>
                  <a class="dropdown-item" href="misc_party_wise_entitled_01.php">Party Wise Entitled Patient</a>
                  <a class="dropdown-item" href="grnt_list_for_admin.php">BSL Guarantor for Admin</a>
                  <a class="dropdown-item" href="medissue_csr_13.php">CSR-Medicine Issued to Medical Camps</a>
                  <a class="dropdown-item" href="medissue_csr_20.php">CSR-Medicine Issued to SSK(HC-5)</a>
                  <a class="dropdown-item" href="misc_bgh_mid_employee_01.php">View Details of Entitled Person</a>

                  

                </div>
              </li>

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  PMJAY
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="https://hospitals.pmjay.gov.in/">About PMJAY</a>
                  <a class="dropdown-item" href="pmjay_adm_01.php">PMJAY Admissions</a>
                  <a class="dropdown-item" href="pmjay_claims_manual_01.php">PMJAY Claims and Receipt</a>  
                  <a class="dropdown-item" href="https://pmjay.gov.in/">National Health Mission(NHA)</a>  
                  <a class="dropdown-item" href="https://pmjay.qcin.org/faq-page">PMJAY-FAQ</a> 
                  <a class="dropdown-item" href="https://nabh.co/">NABH</a> 
                </div>
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

              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  BGH-MIS
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">BGH-MIS-Server-1</a>
                  <a class="dropdown-item" href="#">BGH-MIS-Server-2</a>
                </div>
              </li>

             
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Links
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="http://bokarosteel.com">BokaroSteel.com</a>
                  <a class="dropdown-item" href="https://email.sail.in">E-Mail</a>
                  <a class="dropdown-item" href="http://10.143.2.143:8024/Forms/LogIn.aspx">Attendance System</a>
                  <a class="dropdown-item" href="sail.co.in">SAIL Corporate Web Site</a>
                  <a class="dropdown-item" href="india.gov.in">Govt. of India</a>
                  <a class="dropdown-item" href="steel.gov.in">Steel Ministry</a>
                  <a class="dropdown-item" href="who.int/classifications/ied/en/">WHO ICD Codification</a>
                  <a class="dropdown-item" href="www.mohfw.gov.in">Ministry of Health </a>


                </div>
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
              <p class="card-text">Message From DMS I/c (M and HS).</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>

      <div class="card border-success mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-success">Header</div>
        <div class="card-body text-success">
          <h5 class="card-title">Covid-19</h5>
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
