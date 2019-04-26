<!-- Modal -->
<div class="modal fade" id="form_u_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change User Name</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form_user_update" name="form_user_update" onsubmit="return false">
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" class="form-control" name="u_name" id="u_name" aria-describedby="emailHelp" placeholder="Enter user name">
                    <small id="u_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="ph" id="ph" aria-describedby="emailHelp" placeholder="Enter phone number">
                    <small id="ph_error" class="form-text text-muted"></small>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input checkChangeP" unchecked id="checkChangeP">
                <label class="custom-control-label" for="checkChangeP">Change password</label>
                </div>
                <div class="form-group">
                    <label>Current password</label>
                    <input type="text" class="form-control" name="u_password" id="u_password" aria-describedby="emailHelp" placeholder="Enter password">
                    <small id="u_c_p_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>New password</label>
                    <input type="text" class="form-control" name="u_new_password" id="u_new_password" aria-describedby="emailHelp" placeholder="Enter new password">
                    <small id="u_n_p_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>verfy password</label>
                    <input type="text" class="form-control" name="u_verfy_password" id="u_verfy_password" aria-describedby="emailHelp" placeholder="Enter new password">
                    <small id="u_v_p_error" class="form-text text-muted"></small>
                </div>
                
                <button type="submit" class="btn btn-primary">Change</button>
             </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
        </div>
        </div>
    </div>
    </div>