<!DOCTYPE html>
<html lang="en">

<head>

    <title>Ristorante Con Fusion: About Us</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css"> -->
<!--    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css"> -->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    
    
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>

 <!--   <link href="css/styles.css" rel="stylesheet"> -->


<style>
    h3{
        text-align: center;
    }

</style>
    
    
    
</head>

<body>
    
    
    <div class="container">
        
        
<!--        <div class="row row-content">  -->
           
        <div class="row">
           <div class="col-10">
              <h3>Details of the Self Declaration Form</h3>
           </div>
               
            <div class="col-2">
                <input type="button" name="help" class="btn btn-success" value="Help" id="buthelp">                            
            </div>
        </div>    
            
<div class="col-12 col-md-12">
	

    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>                                                
    <form id="fupForm" name="form1" method="post">                                
            <div class="form-group row">
                 <label for="bslemp" class="col-md-2 col-form-label">BSL On Roll Employee</label>
                        <div class="col-md-3">
                            <select name="bslemp" id="bslemp" class="form-control">       
                               <option value="O">On Roll</option>";
                               <option value="E">Ex Employee</option>";
                               <option value="X">Others</option>";
                            </select>
                        </div>
            </div>
    

            <div class="form-group row">
                        <label for="staffno" class="col-md-2 col-form-label">Staff No.</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="staffno" name="staffno" maxlength="12" placeholder="Staff No">
                        </div>
                
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="reportedby" name="reportedby" maxlength="30" placeholder="Reported By Name">                     
                        </div>
                        
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="orgname" name="orgname" maxlength="20" placeholder="Organization Name">
                        </div>                                        
            </div>


            <div class="form-group row">
                        <label for="areacode" class="col-12 col-md-2 col-form-label">Contact Tel.</label>
                        <div class="col-5 col-md-3">
                            <input type="text" class="form-control" id="areacode" name="areacode" maxlength="2" placeholder="Area code">
                        </div>
                        <div class="col-7 col-md-7">
                            <input type="text" class="form-control" id="telnum" name="telnum" maxlength="10" placeholder="Tel. number">
                        </div>
            </div>

                
			<div class="form-group row">
                        <label for="emailid" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" id="emailid" name="emailid" maxlength="30" placeholder="Email">
                        </div>
            </div>
                
                
<!--            <form>   -->
                    <div class="form-group row">
                        <label for="repfor" class="col-md-2 col-form-label">Reporting For</label>
                        <div class="col-md-5">
                                <select name="repfor" id="repfor" class="form-control">                                                                 
                                    <?php 
                                    $conn = oci_connect("ward", "hpv185e", "10.143.55.53/BGHWARD");
                                    $sql = 'select rep_for_code, rep_for_value from covid_report_for';
                                    $stid = oci_parse($conn, $sql);
                                    oci_execute($stid);
                                    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC))
                                    { 
                                        echo $row['REP_FOR_CODE']; 
                                        echo "<option value=" . $row['REP_FOR_CODE'] . ">" . $row['REP_FOR_VALUE'] . "</option>";
                                    }
                                    ?>
                                </select>    
                        </div>
                        
                        <div class="col-md-5">
                             <input type="text" class="form-control" id="repforother" name="repforother" maxlength="15" placeholder="Others">
                        </div>
                        
                    </div>
                
                
                    <div class="form-group row">
                        <!--
                        <label for="reptype" class="col-md-2 col-form-label">Reporting Type</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="reptype" name="reptype" placeholder="Reporting Type">
                        </div>
                        -->
                        
                        <label for="reptype" class="col-md-2 col-form-label">Reporting Type</label>
                        <div class="col-md-5">
                                <select name="reptype" id="reptype" class="form-control">
                                    <?php 
                                    $conn = oci_connect("ward", "hpv185e", "10.143.55.53/BGHWARD");
                                    $sql = 'select rep_typ_code, rep_typ_value from COVID_REPORT_TYPE';
                                    $stid = oci_parse($conn, $sql);
                                    oci_execute($stid);
                                    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC))
                                    { 
                                        echo $row['REP_TYP_CODE']; 
                                        echo "<option value=" . $row['REP_TYP_CODE'] . ">" . $row['REP_TYP_VALUE'] . "</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                        
                        <div class="col-md-5">
                             <input type="text" class="form-control" id="reptypother" name="reptypother" maxlength="15" placeholder="Others">
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">Name Of Person.</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="name" name="name" maxlength="30" placeholder="Name of Person">
                        </div>
                
                        <div class="col-md-2">
                            <!-- <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">  -->
                                <select name="gender" id="gender" class="form-control">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                        </div>                        
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="age" name="age" min="1" max="150" placeholder="Age in Years">
                        </div>                                        
                    </div>
<!--                 
                 <p><label for="anna">Anna's score:</label>
                <meter id="anna" min="0" low="40" high="90" max="100" value="95"></meter></p>
-->
                 
                    <div class="form-group row">
                        <label for="curradd1" class="col-md-2 col-form-label">Current Address.</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="curradd1" name="curradd1" maxlength="30" placeholder="Address-Sector">
                        </div>
                
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="curradd2" name="curradd2" maxlength="30" placeholder="Locality-QtrNo>">
                        </div>                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="curradd3" name="curradd3" maxlength="30" placeholder="Address">
                        </div>                                        
                    </div>

                
                
                
                
                    <div class="form-group row">
                        <label for="arrstate" class="col-md-2 col-form-label">Arrival Details.</label>
                        <div class="col-md-2">
                            <!-- <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">  -->
                                <select name="arrstate" id="arrstate" class="form-control">                                                                        
                                    <?php 
                                    $conn = oci_connect("ward", "hpv185e", "10.143.55.53/BGHWARD");
                                    $sql = 'select state_code, state_name from PMJAY_STATE_MASTER';
                                    $stid = oci_parse($conn, $sql);
                                    oci_execute($stid);
                                    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC))
                                    { 
                                        echo $row['STATE_CODE']; 
                                        echo "<option value=" . $row['STATE_CODE'] . ">" . $row['STATE_NAME'] . "</option>";
                                    }
                                    ?>
                                    
                                </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="arrcity" name="arrcity" maxlength="30" placeholder="Arrival City">
                        </div>
                
                        
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="arrdate" name="arrdate" placeholder="Arrival Date">
                        </div>                                        
                    </div>
                
                    <div class="form-group row">
                        <label for="sympcode" class="col-md-2 col-form-label">Symptom Details.</label>
                        <div class="col-md-2">
                            <!-- <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">  -->
                                <select name="sympcode" id="sympcode" class="form-control">                                                                        
                                    <?php 
                                    $conn = oci_connect("ward", "hpv185e", "10.143.55.53/BGHWARD");
                                    $sql = 'select symp_code, symp_value from COVID_SYMPTOMS_TYPE';
                                    $stid = oci_parse($conn, $sql);
                                    oci_execute($stid);
                                    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC))
                                    { 
                                        echo $row['SYMP_CODE']; 
                                        echo "<option value=" . $row['SYMP_CODE'] . ">" . $row['SYMP_VALUE'] . "</option>";
                                    }
                                    ?>                                    
                                </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="sympdays" name="sympdays" min="1" max="30" placeholder="Symptoms Since Days">
                        </div>
                        
                         
                
                        
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="sampdate" name="sampdate" placeholder="Sample Given Date">
                        </div>                                        
                    </div>
                
                    <div class="form-group row">
                        <label for="hospi" class="col-md-2 col-form-label">Hospitalization?</label>
                        <div class="col-md-2">
                            <!-- <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">  -->
                                <select name="hospi" id="hospi" class="form-control">
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                        </div>
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="hospname" name="hospname" maxlength="20" placeholder="Hospital Name">
                        </div>
                
                        
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="remarks" name="remarks" maxlength="30" placeholder="Remarks">
                        </div>                                        
                    </div>
                
                
					
				 <div class="form-group row">
                        <label for="feedback" class="col-md-2 col-form-label">Details if Any</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="feedback" name="feedback" maxlength="100" rows="2"></textarea>
                        </div>
                 </div>

				<div class="form-group row">
                        <div class="offset-md-2 col-md-4">
<!--                        <button type="submit" class="btn btn-primary">Save Data</button> -->
                            <input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">                            
                        </div>
                        <div class="col-md-4">
                            <input type="button" name="view" class="btn btn-success" value="View Data" id="butview">                            
                        </div>
                        <div class="col-md-2">
                            <input type="button" name="view" class="btn btn-success" value="View Data" id="butview">                            
                        </div>                    
                </div>	
                </form>
                
				
<!--
                
				<div class="form-group row">
                        <div class="col-md-6 offset-md-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="approve" id="approve" value="">
                                <label class="form-check-label" for="approve">
                                    <strong>May we contact you?</strong>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 offset-md-1">
                            <select class="form-control">
                                <option>Tel.</option>
                                <option>Email</option>
                            </select>
                        </div>
                </div>

					
				 <div class="form-group row">
                        <label for="feedback" class="col-md-2 col-form-label">Your Feedback</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="feedback" name="feedback" rows="12"></textarea>
                        </div>
                 </div>

				<div class="form-group row">
                        <div class="offset-md-2 col-md-10">
                            <button type="submit" class="btn btn-primary">Send Feedback</button>
                        </div>
                </div>		
								
				</div>
             <div class="col-12 col-md">
            </div>
-->
                
       </div>

    </div>

    
    <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    
    

<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var bslemp      = $('#bslemp').val();
		var staffno     = $('#staffno').val();
		var orgname     = $('#orgname').val();
		var reportedby  = $('#reportedby').val();
		var areacode    = $('#areacode').val();        
		var telnum      = $('#telnum').val();
		var repfor      = $('#repfor').val();
		var reptype     = $('#reptype').val();
		var emailid     = $('#emailid').val();
		var repforother = $('#repforother').val();
		var reptypother = $('#reptypother').val();
		var gender      = $('#gender').val();
		var age         = $('#age').val();
		var curradd1    = $('#curradd1').val();
		var curradd2    = $('#curradd2').val();
		var curradd3    = $('#curradd3').val();
		var arrstate    = $('#arrstate').val();
		var arrcity     = $('#arrcity').val();
		var arrdate     = $('#arrdate').val();
        
		var sympcode     = $('#sympcode').val();
		var sympdays     = $('#sympdays').val();
		var hospi        = $('#hospi').val();
		var hospname     = $('#hospname').val();
		var remarks      = $('#remarks').val();
		var feedback     = $('#feedback').val();
        
        
        
        
		if(bslemp!="" && staffno!="" && orgname!="" && reportedby!=""){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
                    bslemp    	:bslemp,
                    staffno   	:staffno,
                    orgname   	:orgname,
                    reportedby	:reportedby,
                    areacode    :areacode,
                    telnum      :telnum,
                    repfor      :repfor,
                    reptype     :reptype,
                    emailid     :emailid,
                    repforother :repforother,
                    reptypother :reptypother,
                    gender      :gender,
                    age         :age,
                    curradd1    :curradd1,
                    curradd2    :curradd2,
                    curradd3    :curradd3,
                    arrstate    :arrstate,
                    arrcity     :arrcity,
                    arrdate     :arrdate,
                    sympcode    :sympcode,
                    sympdays    :sympdays,
                    hospi       :hospi,
                    hospname    :hospname,
                    remarks     :remarks,
                    feedback    :feedback
                },
				cache: false,
                
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
                        alert("Saving Data.... !");
						$("#butsave").removeAttr("disabled");
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
</script>
    
 
    
    
    
</body>
</html>




                    
                    
                    
