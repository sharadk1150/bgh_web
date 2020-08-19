<?php
    session_start();
?>

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


<?php

if ($_SESSION["login"]=='bgh1234') {

   if(isset($_FILES['image'])){
      
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $temp_ext=explode('.',$_FILES['image']['name']);
     
      //$file_ext=strtolower(end(explode('.',$file_type)));
      $file_ext=end($temp_ext);
    
      
      $expensions= array("jpeg","jpg","png", "pdf");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be less than 2 MB';
      }
      

      // Check if file already exists
      if (file_exists("uploaded_files/".$file_name)) {
         $errors[]='File already exists';
      }


      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploaded_files/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }

//   $tmp = explode('.', $file_name);
//   $file_extension = end($tmp);
}
else {
   print "You are Not Allowed to Upload Files....";
}

?>

<html>
<head>
<link rel="stylesheet "href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
   <body>
   <nav class="navbar navbar-dark fixed-top bg-warning">
  <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <div class="container"> 
<form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
  
  <div class="form-row">
    <!-- First Row -->
    <div class="col-md-6 mb-3">
      <label for="validationCustom01">File Type</label>
      <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    
    <div class="col-md-6 mb-3">
      <label for="validationCustom02">File Category</label>
      <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
  </div>
  <!-- Second Row -->
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">File SubCategory</label>
      <input type="text" class="form-control" id="validationCustom03" required>
      <div class="invalid-feedback">
        Please provide a valid SubCategory.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">Min Category</label>
      <select class="custom-select" id="validationCustom04" required>
        <option selected disabled value="">Choose...</option>
        <option>...</option>
      </select>
      <div class="invalid-feedback">
        Please select a Min Category.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">UpLoad By</label>
      <input type="text" class="form-control" id="validationCustom05" value=<?php echo $_SESSION["login"] ?> readonly>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>

  <div class="form-row">
      <div class="form-group">
         <label for="image">Select File To Upload(PDF only)</label>
         <input type="file" class="form-control-file" id="image" name="image"/>
      </div>
   </div>


  <button class="btn btn-primary" type="submit">Submit form</button>
</form>
</div>


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>


   <!--     -->














   </body>
</html>