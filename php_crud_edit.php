<div class="modal fade" id="edit<?php echo $row['DRUG_CODE'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
                $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
                $query3 = "select substr(old_cat_no,7,11) drug_code, med_Desc, med_gen_name,bname  
                from bgh_med_master where substr(old_cat_no,7,11)=".$row['DRUG_CODE'];       
                $s3 = oci_parse($c, $query3);    
                oci_define_by_name($s3, 'DRUG_CODE',    $drug_code);
                oci_define_by_name($s3, 'MED_DESC',     $med_desc);
                oci_define_by_name($s3, 'MED_GEN_NAME', $med_gen_name);
                oci_define_by_name($s3, 'BNAME',        $bname);
                oci_execute($s3);
                oci_fetch($s3);
    ?>

    <form method="POST" action="php_crud_update.php?id=<?php echo $drug_code; ?>" enctype="multipart/form-data">

        <div style="height:10px;"></div>
        <div class="row">
            <div class="col-lg-4" align="left">
                <label style="position:relative; top:7px;">Drug Code:</label>
            </div>
            <div class="col-lg-8" align="left">
                <?php echo $drug_code; ?>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Med Desc:</label>
            </div>
            <div class="col-lg-8">
                <input type="text" name="med_desc" id = "med_desc" class="form-control" value="<?php echo $med_desc; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Med Gen Name:</label>
            </div>
            <div class="col-lg-8">
                <input type="text" name="med_gen_name" id="med_gen_name" class="form-control" value="<?php echo $med_gen_name; ?>">
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Brand Name:</label>
            </div>
            <div class="col-lg-8">
                <input type="text" name="bname" id="bname" class="form-control" value="<?php echo $bname; ?>">
            </div>
        </div>







    </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel</button>
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-check"></span> Save</button>
        </div>      
        </form>


    </div>
  </div>
</div>