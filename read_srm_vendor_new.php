<?php
//use Phppot\DataSource;

//require_once 'DataSource.php';
//$db = new DataSource();
//$conn = $db->getConnection();
$c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
          $vendor           =      'X'.$column[0];
          $name1            =        $column[1];
          $name2            =        $column[2];
          $city             =        $column[3];
          $pin              =        $column[4];
          $tel1             =        $column[5];
          $tel2             =        $column[6];
          $email            =        $column[7];
          $firstname        =        $column[8];
          $lname            =        $column[9];
          $pan              =        $column[10];
          $resend           =        'N';
          $rp1              =        'N';
            
          $query = "insert into srm_mail(v_code, v_name, v_mobile, v_email, newv_code, resend_initail_mail, rp1_updated,
          recd_from_pur) 
          values(:vendor, :name1, :tel2, :email, :vendor, :resend, :rp1, trunc(sysdate))";
          $s = oci_parse($c, $query);
          oci_bind_by_name($s, ':vendor'        ,$vendor);
          oci_bind_by_name($s, ':name1'         ,$name1);
          oci_bind_by_name($s, ':tel2'          ,$tel2);
          oci_bind_by_name($s, ':email'         ,$email);
          oci_bind_by_name($s, ':vendor'        ,$vendor);
          oci_bind_by_name($s, ':resend'        ,$resend);
          oci_bind_by_name($s, ':rp1'           ,$rp1);

          $u = oci_execute($s);
                                  
          if ($u) 
          {
                $type = "success";
                $message = "CSV Data Imported into the Database";
          } else 
          {
                $type = "error";
                $message = "Problem in Importing CSV Data";
          }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
    font-family: Arial;
    width: 550px;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () 
    {
	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file into Oracle using PHP</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>


    </div>

</body>

</html>