<!-- Modal -->
<div class="modal fade" id="form_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form_brand_add" name="form_brand_add" onsubmit="return false">
                <div class="form-group">
                    <label>Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" id="brand_name" aria-describedby="emailHelp" placeholder="Enter brand name">
                    <small id="brand_error" class="form-text text-muted"></small>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>