<!-- Modal -->
<div class="modal fade" id="form_brand_m" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Category update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <form id="form_brand_update" name="form_brand_update" onsubmit="return false">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="hidden" name ="bid" id="bid" value =""/>
                    <input type="text" class="form-control" name="update_brand_name" id="update_brand_name" aria-describedby="emailHelp" placeholder="Enter category name">
                    <small id="brand_error" class="form-text text-muted"></small>
                </div>
              
                <button type="submit" class="btn btn-success"><i class="fa fa-spinner">&nbsp;</i>Update</button>
             </form>



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
    </div>