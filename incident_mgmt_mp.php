
<!DOCTYPE HTML>
<html>
  <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body></body>
</html>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Incident Management System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- owl carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.red.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div id="all">
	      
      <!-- Navbar Start-->
      <header class="nav-holder make-sticky">
        <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
          <div class="container"><a href="index.php" class="navbar-brand home"><img src="img/logo.png" height="65" alt="SAIL logo" class="d-none d-md-inline-block"><img src="img/logo.png" height="35" alt="SAIL logo" class="d-inline-block d-md-none"><span class="sr-only">SAIL - go to homepage</span></a>
            <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <div id="navigation" class="navbar-collapse collapse">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item"><a href="index.php">Home</a></li>
				<li class="nav-item active"><a href="form.php">New Ticket</a></li>
				<li class="nav-item"><a href="view_ticket.php">View Ticket</a></li>
				<!--<li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="dropdown-toggle">C&IT Job Requests<b class="caret"></b></a>
                  <ul class="dropdown-menu megamenu">
                    <li>
                      <div class="row">
                        <div class="col-lg-6"><img src="img/1.jpg" height="350" width="350" alt="" class="img-fluid d-none d-lg-block"></div>
                        <div class="col-lg-6 col-md-6">
                          
                          <ul class="list-unstyled mb-6">
                            <li class="nav-item"><a href="formdomain.php" class="nav-link"><b>Domain Password Creation</b></a></li>
							<li class="nav-item"><a href="#" class="nav-link"><b>Domain Password Reset</b></a></li>
                            <li class="nav-item"><a href="formvpn.php" class="nav-link"><b>VPN ID Creation Request (HoD/CGM Aprroval Required Hardcopy to be sent to C&IT)</b></a></li>
							<li class="nav-item"><a href="formvideoconf.php" class="nav-link"><b>Video Conferencing/Presentation Request(NON-WORKS)</b></a></li>
                            <li class="nav-item"><a href="formwebupload.php" class="nav-link"><b>Uploading Request on Intranet Website (bokarosteel.com)  (HoD/CGM Aprroval Required Hardcopy to be sent to C&IT)</b></a></li>
                            
                          </ul>
                        </div>
                        
                      </div>
                    </li>
                  </ul>
                </li>-->
				<li class="nav-item"><a href="feedback_main.php">Feedback</a></li>
				<li class="nav-item"><a href="../logout.php">Logout</a></li>
              </ul>
            </div>
            <div id="search" class="collapse clearfix">
              <form role="search" class="navbar-form">
                <div class="input-group">
                  <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </header>
	        <!-- Navbar End-->      
      <div id="heading-breadcrumbs" class="brder-top-0 border-bottom-0">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2">New Ticket</h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-end">
                <li class="breadcrumb-item"><a href="form.php">New Ticket</a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
	  <div id="mybg">
      <div id="content">
        <div id="contact" class="container">
          <section class="bar pt-0" >
            <div class="row">
              <div class="col-md-12">
                <div class="heading text-center">
                  <h2>Raise Your Ticket</h2>
                </div>
				<h6><span style="color:red"><i class="fa fa-exclamation-circle"></i><i>(Fields marked with * are Mandatory)</i></span></h6>
              </div>
              <div class="col-md-12 mx-auto">
                <form id="new_tkt" name="new_tkt" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate action="action.php">
				    <table class="table table-bordered table-sm">
						<thead>
							<tr>
								<th>Staff No./User Group<span style="color:red">*</span></th>
								<th>Name<span style="color:red">*</span></th>
								<th>Department<span style="color:red">*</span></th>
								<th>Designation<span style="color:red">*</span></th>
								<th>Mobile<span style="color:red">*</span></th>
								<th>E-mail<span style="color:red">*</span></th>
							</tr>
						</thead>
						<tbody>
						
							<tr>
								<td><input type="text" class="form-control input-sm" id="stno" autofocus placeholder="Enter number" name="stno"  onkeyup="showHint(this.value)" onchange="showHint(this.value)" onblur="showHint(this.value)" required list="usergroup">
								<datalist id="usergroup">
								<option value='CISF'><option value='AUDITOR'><option value='BGH'><option value='RDCIS'><option value='CET'><option value='CO-OP'><option value='OTHERS'> 
								</datalist>
								</td>
								<td><input type="text" class="form-control input-sm" id="uname"  name="uname" maxlength="75" required></td>
								<td><input type="text" class="form-control input-sm" id="dept"  name="dept" maxlength="50" readonly required list="userdept">
								<datalist id="userdept">
								<option value='CISF'><option value='AUDITOR'><option value='BGH'><option value='RDCIS'><option value='CET'><option value='CO-OP'><option value='OTHERS'> 
								</datalist>
								</td>
								<td><input type="text" class="form-control input-sm" id="desig" maxlength="30" name="desig" required></td>
								<td><input type="text"  id="mob" name="mob" pattern="[0-9]{10}" maxlength="10" class="form-control" required></td>
								<td><input type="email" id="email" name="email" maxlength="25" class="form-control" required></td>
								
							</tr>
						</tbody>
					</table>
					<div class="row">
					  <div class="col"><div class="form-group"> <!-- Department Button -->
							<label for="lbl_loc" class="control-label"><b>Location<span style="color:red">*</span>:</b></label>
							<input type="text" class="form-control" id="loc" maxlength="75" placeholder="Enter Exact Location" name="loc" required>	
						</div></div>
						<div class="col"><div class="form-group"> <!-- Department Button -->
							<label for="lbl_maxno" class="control-label"><b>Max No.:</b></label>
							<input type="text" class="form-control" id="maxno" maxlength="12" placeholder="Enter MAX number ,if any" name="maxno">	
							<input type="text" class="form-control" id="ip_addr" name="ip_addr" value="10.143.11.195" hidden>
						</div></div>
					</div> 
				<div class="row">
						<div class="col">
							<div class="form-group"> <!-- type Button -->
								<label for="lbl_area" class="control-label"><b>Select Area<span style="color:red">*</span></b></label>
								<select class="form-control" id="area" name="area" required>
									<option value="">-------Select an option----</option>
									<option value="W">Works</option>
									<option value="N">Non-Works</option>
								</select>
							</div>
						</div>
					<div class="col">
						<div class="form-group"> <!-- type Button -->
							<label for="lbl_sapyn" class="control-label"><b>SAP Installed on system<span style="color:red">*</span></b></label>
								<select class="form-control" id="sapyn" name="sapyn" required>
									<option value="">-------Select an option----</option>
									<option value="Y">Yes</option>
									<option value="N">No</option>
									
								</select>
						</div>
					</div>
					<div class="col">
						<div class="form-group"> <!-- type Button -->
							<label for="lbl_domainyn" class="control-label"><b>Whether in domain or not?<span style="color:red">*</span></b></label>
							<select class="form-control" id="domainyn" name="domainyn" required>
								<option value="">-------Select an option----</option>
								<option value="Y">Yes</option>
								<option value="N">No</option>
							</select>
						</div>
					</div>
					<div class="col">
						<div class="form-group"> <!-- type Button -->
							<label for="lbl_avyn" class="control-label"><b>Antivirus installed or not?<span style="color:red">*</span></b></label>
							<select class="form-control" id="avyn" name="avyn" required>
								<option value="" selected disabled>-------Select an option----</option>
								<option value="Y">Yes</option>
								<option value="N">No</option>
							</select>
						</div>
					</div>
 
				</div>
				<div class="row">
					<div class="col"><div class="form-group"> 
						<label for="lbl_prob_cat" class="control-label"><b>Select Problem Category<span style="color:red">*</span></b></label>
							<select class="form-control" id="main_cat" name="main_cat"  required onchange="fetch_make(this.value); fetch_select(this.value); ">
								<option value="">-------Select an option----</option>
								<option value='2'>DESKTOP PC- SOFTWARE/HARDWARE/SAP RELATED</option><option value='3'>NETWORK RELATED PROBLEMS</option><option value='4'>PRINTER</option><option value='5'>SCANNER</option><option value='6'>UPS</option><option value='7'>Data center Equipment</option> 
							</select>
					</div></div>
					
					<div class="col"><div class="form-group"> 
						<label for="lbl_sub_cat" class="control-label"><b>Select Problem Sub-Category<span style="color:red">*</span></b></label>
							<select class="form-control" id="sub_cat" name="sub_cat" required>
							</select>
					</div></div>
					<div class="col"><div class="form-group" id="div_make"> 
						<label for="lbl_make" class="control-label"><b>Select Make<span style="color:red">*</span></b></label>
							<select class="form-control" id="make" name="make" required>
							</select>
					</div></div>
					<div class="col"><div class="form-group" id="div_os"> <!-- Department Button -->
							<label for="lbl_loc" class="control-label"><b>Installed OS<span style="color:red">*</span></b></label>
							<select class="form-control" id="os_type" name="os_type" required>
								<option value="">-------Select an option----</option>
								<option value='WINDOWS XP'>WINDOWS XP</option><option value='WINDOWS VISTA'>WINDOWS VISTA</option><option value='WINDOWS 7'>WINDOWS 7</option><option value='WINDOWS 8'>WINDOWS 8</option><option value='WINDOWS 8.1'>WINDOWS 8.1</option><option value='WINDOWS 10'>WINDOWS 10</option><option value='OTHERS'>OTHERS</option> 
							</select>	
						</div></div>
				</div>



				<div class="form-group">
				  <label for="description"><b>Brief Description of Problem(max 50characters)<span style="color:red">*</span>:</b></label>
				  <textarea class="form-control" rows="5" id="description"  name="description" maxlength="50" required></textarea>
				 <span id='remainingC_desc' style="color:red"></span>
				</div>

					<div class="col-sm-12 text-center">
									  <button type="submit" name="submit"  id="submit_form" class="btn btn-template-outlined"><i class="fa fa-arrow-circle-right fa-lg"></i> Submit</button>
									</div>
			</form>
                    
                  
             
          </section>
     </div>
	 </div>
	 
      <!-- FOOTER -->
      <footer class="main-footer">
        <div class="copyrights">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 text-center-md">
                <p>&copy; 2020  Shweta Roy, C&IT Department </p>
              </div>
              <div class="col-lg-8 text-right text-center-md">
				<p> Template design by Bootstrapious &  Fity</a> </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
	</div>

	<!-- Javascript files-->
	<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
	  
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
		  swal({
			title: 'Error!',
			text: 'Please fill all the required fields.',
			type: 'Error'
			})
        }
        form.classList.add('was-validated');
      }, false);
    });
	$('#description').keypress(function(){

    if(this.value.length > 50){
        return false;
    }
    $("#remainingC_desc").html("Remaining characters : " +(50 - this.value.length));
});
$('#div_make').hide();
$('#div_os').hide();
 $('#main_cat').change(function(){
		document.getElementById("make").required = false;
		document.getElementById("os_type").required = false;
        if(document.getElementById("main_cat").value == '2') {
            $('#div_make').show();
			$('#div_os').show();
			document.getElementById("make").required = true;
			document.getElementById("os_type").required = true;			
        }else if($('#main_cat').val() == '3') {
			$('#div_make').hide();
			$('#div_os').hide();
        }else if($('#main_cat').val() == '4') { 
			$('#div_make').show();
			$('#div_os').hide();
			document.getElementById("make").required = true;
			document.getElementById("os_type").required = false;	
		}else if($('#main_cat').val() == '5') { 
			$('#div_make').show();
			$('#div_os').hide();
			document.getElementById("make").required = true;
			document.getElementById("os_type").required = false;	
		}
		else if($('#main_cat').val() == '6') { 
			$('#div_make').show();
			$('#div_os').hide();
			document.getElementById("make").required = true;
			document.getElementById("os_type").required = false;	
		}
		else {
			
        } 
    });






  }, false);
})();
</script>


<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'fetch_data.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("sub_cat").innerHTML=response; 
 }
 });
}</script>
<script type="text/javascript">
function fetch_make(val)
{
 $.ajax({
 type: 'post',
 url: 'fetch_make.php',
 data: {
  get_make:val
 },
 success: function (response) {
  document.getElementById("make").innerHTML=response; 
 }
 });
}
</script>


   
      
  
<script>
function showHint(str) {
	
    if (str.length == 0) { 
        document.getElementById("uname").value = "";
		document.getElementById("dept").value = "";
		document.getElementById("desig").value = "";
		document.getElementById("mob").value = "";
		document.getElementById("email").value = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				var result = this.responseText.split("/");
                document.getElementById("uname").value = result[0];
				document.getElementById("dept").value = result[1];
				document.getElementById("desig").value = result[2];
				document.getElementById("mob").value = result[3];
				document.getElementById("email").value = result[4];
            }
        };
        xmlhttp.open("GET", "getname.php?q=" + str, true);
        xmlhttp.send();
    }

}
</script>
    <script src="vendor/jquery/jquery.min.js"></script>
	 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
    <script src="vendor/jquery.counterup/jquery.counterup.min.js"> </script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
    <!-- LeafletJS CDN-->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="js/map.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>