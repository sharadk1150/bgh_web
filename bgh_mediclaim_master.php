<!DOCTYPE html>
<html>

<head>

    <title>Ristorante Con Fusion: About Us</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

<style>
    h3{
        text-align: center;
    }

</style>   
<!-- THE SCRIPT FOR XHR -->
<script type="text/javascript" language="javascript">
// Need to make an object of XMLHttpRequest Type.

function handle(e, e1val){
        if(e.keyCode == 13){
            e.preventDefault(); // Ensure it is only this code that rusn
            alert("Enter Key Was Pressed");
            sendRequest(e1val);

        }
    }

function createRequestObject() {
    var ro;
    if (navigator.appName == "Microsoft Internet Explorer") {
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        ro = new XMLHttpRequest();
    }
    return ro;
}
        
var http = createRequestObject();

// Function that calls the PHP script:
function sendRequest(mainminno) {
	// Call the script.
	// Use the GET method.
	// Pass the email address in the URL.
    http.open('get', 'ajax_mediclaim.php?mainminno=' + encodeURIComponent(mainminno));
    http.onreadystatechange = handleResponse;
    http.send(null);
}

// Function handles the response from the PHP script.
function handleResponse() {
    
	// If everything's okay:
    if(http.readyState == 4){
        console.log(this.responseText);
         
    	// Assign the returned value to the document object.
        //document.getElementById('email_label').innerHTML = http.responseText;
        //document.getElementById('first_name').value = http.responseText;
        //document.getElementById('email_label').innerHTML = http.responseText[0];
        //document.getElementById('first_name').value = http.responseText[1];

        var jsonText = http.responseText;
        var jsonObject= eval('('+jsonText+')');

        console.log(jsonObject.statusCode);
        if (jsonObject.statusCode==200) {
/*
        var firstName=jsonObject.name;
        var middleName=jsonObject.midno;
        document.getElementById('email_label').innerHTML = firstName;
*/
    document.getElementById('mainminno_help').innerText = '** FOUND  GETTING DATA **';
    document.getElementById('minno').value = jsonObject.MINNO;
    document.getElementById('name').value = jsonObject.NAME;    
    document.getElementById('add1').value = jsonObject.ADD1;    
    document.getElementById('pin').value = jsonObject.PINCODE1;
    document.getElementById('ind').value = jsonObject.IND;
    document.getElementById('stno').value = jsonObject.STNO;
    document.getElementById('dob').value = jsonObject.DOB;
    document.getElementById('dos').value = jsonObject.DATE_SEP;
    document.getElementById('doe').value = jsonObject.DATE_ENROL;
    document.getElementById('sex').value = jsonObject.SEX;
    document.getElementById('contactno').value = jsonObject.CONTACT_NO;   
    console.log(document.getElementById('doe').value);  
        }
        else {
            document.getElementById('mainminno_help').innerText = '** NOT FOUND **';
            document.getElementById('minno').value = document.getElementById('mainminno').value;

        }
    
}
    else {
        document.getElementById('mainminno_help').innerText = 'Min Number Not Found in The DataBase of BGH';
        document.getElementById('minno').value = document.getElementById('mainminno').value;
        
        
    }
}
</script>
<!-- THE SCRIPT IS UPTTO HERE -->
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-warning">
        <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
        <h2>Mediclaim Master</h2>
    </nav>
<br><br><br>
    
<div class="container">
        
        
<!--        <div class="row row-content">  -->
           
        <div class="row">
           <div class="col-10">
              <h3>Mediclaim Master Updation Form</h3>
           </div>
               
            <div class="col-2">
                <input type="button" name="help" class="btn btn-success" value="Help" id="buthelp">                            
            </div>
        </div>    
            
<div class="col-12 col-md-12">
	

    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    </div>

    <form id="fupForm"  action="#" name="form1" method="post">                                
<!-- Medicliam Master Update Starts Here  -->    
            <div class="form-group row">
                <label for="mainminno" class="col-md-2 col-form-label">Min Number</label>
                <div class="col-md-3">

<!--                
                  <input type="text" class="form-control" id="mainminno" name="mainminno" maxlength="12" 
                    onkeypress="sendRequest(this.form.mainminno.value)" placeholder="Min Number">
-->

               
                    <input type="text" class="form-control" id="mainminno" name="mainminno" maxlength="12"   
                    onkeypress="handle(event, this.form.mainminno.value )" placeholder="Min Number">


                </div>
<!--                <div id="mainminno_help"><p> </p></div> -->
                <span id="mainminno_help"></span><br />   

            </div>  
            
            <div class="form-group row">
                        <label for="minno" class="col-md-2 col-form-label">Min No:</label>
                        <div class="col-md-3">
                            <input type="text"  class="form-control" id="minno" name="minno" required maxlength="9" readonly placeholder="Min No">
                        </div>
                        <label for="minno" class="col-md-2 col-form-label">Full Name:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="name" name="name" required maxlength="50" placeholder="Full Name of Person">                     
                        </div>
            </div>

            <div class="form-group row">
                        <label for="stno" class="col-md-2 col-form-label">Staff Number.</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="stno" name="stno" maxlength="9" placeholder="Staff NUmber">
                        </div>   

                        
                        <label for="sex" class="col-md-2 col-form-label">Gender</label>  
                        <div class="col-md-4">
                                <select name="sex" id="sex" class="form-control">       
                                    <option value="M">Male</option>";
                                    <option value="F">Female</option>";
                                </select>
                        </div>    
            </div>                                

            <div class="form-group row">
                    <label for="dob" class="col-md-2 col-form-label">Date Of Birth.</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="dob" name="dob" maxlength="9" placeholder="Date of Birth">
                        </div>       
            </div>            

            <div class="form-group row">
                    <label for="dos" class="col-md-2 col-form-label">Date Of Separation.</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="dos" name="dos" maxlength="9" placeholder="Date of Separation">
                        </div>       
            </div>            

            <div class="form-group row">
                    <label for="doe" class="col-md-2 col-form-label">Date Of Enrollment.</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="doe" name="doe" maxlength="9" placeholder="Date of Enrollment">
                        </div>       
            </div>            

            <div class="form-group row">                        
                            <label for="ind" class="col-md-2 col-form-label">Indicator</label>  
                        <div class="col-md-3">    
                            <select name="ind" id="ind" class="form-control" maxlength="9">       
                               <option value="E">Enrollment</option>";
                               <option value="R">Renewal</option>";
                            </select>
                        </div>                        
            </div>


            <div class="form-group row">
                        <label for="add1" class="col-md-2 col-form-label">Full Address</label>
                        <div class="col-md-3">
                        <!--    <input type="text" class="form-control" id="add1" name="add1" maxlength="60" placeholder="Full Address"> -->
                            <textarea class="form-control" id="add1" name="add1" maxlength="50" rows="4"></textarea>
                        </div>    
                        <label for="pin" class="col-md-2 col-form-label">PIN</label>                   
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="pin" name="pin" maxlength="9" placeholder="PIN Code">
                        </div>                                        
            </div>

            <div class="form-group row">
                            <label for="contactno" class="col-md-2 col-form-label">Contact Number</label>
                            <div class="col-md-3">
                                <input type="tel" class="form-control" id="contactno" name="contactno" maxlength="10" placeholder="Contact Number">
                            </div>                                        
            </div>



            <!-- Mediclaim Master Updates Ends Here  -->    


				<div class="form-group row">
                        <div class="offset-md-2 col-md-4">
                            <input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">                            
                        </div>                        
                        <div class="col-md-2">
                            <input type="button" name="view" class="btn btn-success" value="View Data" id="butview">                            
                        </div>                    
                </div>	
    </form>
                
</div>
</div>

    
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script></body>

    
    

<script>

/* Data being sent to save_mediclaim.php for saving the data in the database */

$(document).ready(function() 
{
	    $('#butsave').on('click', function() 
    {
		$("#butsave").attr("disabled", "disabled");
        var mainminno   = $('#mainminno').val();
        var minno       = $('#minno').val();
        var name        = $('#name').val();
        var sex         = $('#sex').val();
        var dob         = $('#dob').val();
        var stno        = $('#stno').val();
        var dos         = $('#dos').val();
        var doe         = $('#doe').val();
        var ind         = $('#ind').val();
        var add1        = $('#add1').val();
        var pin         = $('#pin').val();
        var contactno   = $('#contactno').val();

        console.log ('step-1');

		if(minno!="" && name!="" && sex!="" && stno!="")
        {
            
            console.log ('minno');
            $.ajax({
		    url: "save_mediclaim.php",
		    type: "POST",
		    data: {
                mainminno :mainminno,
                minno     :minno,
                name      :name,
                sex       :sex,
                dob       :dob,
                stno      :stno,
                dos       :dos,
                doe       :doe,
                ind       :ind,
                add1      :add1,
                pin       :pin,
                contactno :contactno        
                },
            }).done(dataResult);

function dataResult(dataresponse)
{
		var dataresponse = JSON.parse(dataresponse);
        console.log(this.resposeText);
		if(dataresponse.statusCode==200)
        {
            alert("Saving Data.... !");
			$("#butsave").removeAttr("disabled");
			$('#fupForm').find('input:text').val('');
			$("#success").show();
			$('#success').html('Data added successfully !'); 						
		}
		else if(dataresponse.statusCode==201)
        {
					   alert("Error occured !");
		}
}



}
else{
			alert('Please fill all the Required field !');
	}
});
});

</script>

<script>
    function callpage(){
        alert('am in the call page function');
        window.location.replace("https://www.tutorialrepublic.com/");
    }           
    const element = document.querySelector('#butview');
    element.addEventListener('click', callpage, false);
</script>        
</body>
</html>
