<div class="modal fade" id="detail<?php echo $row['DRUG_CODE'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                //$edit=$mysqli->query("select * from employee_basics where id=".$row['id']);
                //$erow=$edit->fetch_assoc();
                $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
                $query2 = "select substr(old_cat_no,7,11) drug_code, med_Desc, med_gen_name,bname  
                from bgh_med_master where substr(old_cat_no,7,11)=".$row['DRUG_CODE'];       
                $s1 = oci_parse($c, $query2);    
                oci_define_by_name($s1, 'DRUG_CODE',    $drug_code);
                oci_define_by_name($s1, 'MED_DESC',     $med_desc);
                oci_define_by_name($s1, 'MED_GEN_NAME', $med_gen_name);
                oci_define_by_name($s1, 'BNAME',        $bname);
                oci_execute($s1);
                oci_fetch($s1);
    ?>
<!--        <form> -->
        <div style="height:10px;"></div>
        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Drug Code:</label>
            </div>
            <div class="col-lg-8" alignment="left">
                <?php echo $drug_code; ?>
            </div>
      </div>

      <div style="height:10px;"></div>
        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Drug Desc:</label>
            </div>
            <div class="col-lg-8" alignment="left">
                <?php echo $med_desc; ?>
            </div>
      </div>

      <div style="height:10px;"></div>
        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Med Name:</label>
            </div>
            <div class="col-lg-8" alignment="left">
                <?php echo $med_gen_name; ?>
            </div>
      </div>

      <div style="height:10px;"></div>
        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Brand Name:</label>
            </div>
            <div class="col-lg-8" alignment="left">
                <?php echo $bname; ?>
            </div>
      </div>
<!--      
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
