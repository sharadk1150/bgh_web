<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

    <form method="POST" action="php_crud_insert.php" enctype="multipart/form-data">

        <div style="height:10px;"></div>
        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Drug Code:</label>
            </div>
            <div class="col-lg-8" alignment="left">
            <input type="text"  name="drug_code" id="drug_code" class="form-control">
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Med Desc:</label>
            </div>
            <div class="col-lg-8">
                <input type="text" name="med_desc" id="med_desc" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Med Gen Name:</label>
            </div>
            <div class="col-lg-8">
                <input type="text" name="med_gen_name" id="med_gen_name" class="form-control">
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-4" alignment="left">
                <label style="position:relative; top:7px;">Brand Name:</label>
            </div>
            <div class="col-lg-8">
                <input type="text" name="bname" id="bname" class="form-control">
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