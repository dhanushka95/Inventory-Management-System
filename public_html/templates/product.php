<!-- Modal -->
<div class="modal fade" id="form_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Products Add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <div class="modal-body">


        <form id ="form_product_add" name ="form_product_add" onsubmit ="return false">
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label>Date</label>
                    <input type="date" class="form-control" id="added_date" name="added_date"  value="<?php echo date("Y-m-d"); ?>" >
                    <small id="date_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6">
                    <label>Product Name</label>
                    <input type="text" class="form-control" id="product_name_add" name="product_name_add" placeholder="Enter product name" >
                    <small id="p_name_error" class="form-text text-muted"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label >Category</label>
                    <select class="form-control" id="select_category_add" name="select_category_add">
                    
                    
                    </select>
                    <small id="p_cat_error" class="form-text text-muted"></small>
                </div>

                <div class="form-group">
                    <label >Brand</label>
                    <select class="form-control" id="select_brand" name="select_brand">
                    
                    
                    </select>
                    <small id="p_brand_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Product price</label>
                    <input type="text" class="form-control" id="product_price" name="product_price">
                    <small id="p_price_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Minimum Quantity</label>
                    <input type="text" class="form-control" id="product_quantity" name="product_quantity">
                    <small id="p_quntity_error" class="form-text text-muted"></small>
                </div>
            
        
                <button type="submit" class="btn btn-success"><i class="fa fa-level-down">&nbsp;</i>Add</button>
    </form>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           
        </div>

        </div>
    </div>
    </div>