<!-- Detail Model -->
    <div class="modal fade" id="detail<?php echo $row['DRUG_CODE']; ?>" tabindex="-1" 
         role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog>
    <div class="modal-content">
    <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3> Profile Details </h3>
    </div>
    <div class="modal-body">    
    <?php
                //$edit=$mysqli->query("select * from employee_basics where id=".$row['id']);
                //$erow=$edit->fetch_assoc();
                $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
                $query = "select substr(old_cat_no,7,11) drug_code, med_Desc, med_gen_name,bname  
                from bgh_med_master where substr(old_cat_no,7,11)=".$row['DRUG_CODE'];       
                $s = oci_parse($c, $query);    
                oci_define_by_name($s, 'DRUG_CODE',    $drug_code);
                oci_define_by_name($s, 'MED_DESC',     $med_desc);
                oci_define_by_name($s, 'MED_GEN_NAME', $med_gen_name);
                oci_define_by_name($s, 'BNAME',        $bname);
                oci_execute($s);
                oci_fetch($s);
    ?>
    
    <div class="container-fluid">
            
            <form method="POST" action="update.php?id=<?php echo $erow['id'];?>" 
            enctype="multipart/form-data">
            
    </div>
    <div style="height:10px;"></div>
    <div class="row">
            <div class="col-lg-4" align="left">
                <label style="position:relative; top:7px;">Drug Code:</label>
            </div>
            <div class="col-lg-8" align="left">
                <?php echo $drug_code; ?>
            </div>
    </div>
    
    <div style="height:10px;"></div>
    <div class="row">
            <div class="col-lg-4" align="left">
                <label style="position:relative; top:7px;">Drug Desc:</label>
            </div>
            <div class="col-lg-8" align="left">
                <?php echo $med_desc; ?>
            </div>
    </div>
    
    <div style="height:10px;"></div>
    <div class="row">
            <div class="col-lg-4" align="left">
                <label style="position:relative; top:7px;">Med Name:</label>
            </div>
            <div class="col-lg-8" align="left">
                <?php echo $med_gen_name; ?>
            </div>
    </div>
    
    <div style="height:10px;"></div>
    <div class="row">
            <div class="col-lg-4" align="left">
                <label class="control-label" style="position:relative; top:7px;">Brand Name:</label>
            </div>
            <div class="col-lg-8" align="left">
                <?php echo $bname; ?>
            </div>
    </div>
        
    </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
        </div>
    </form> 
    </div>
    </div>
    </div>
</div>
<!-- /.modal -->