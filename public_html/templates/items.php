<!-- Modal -->
<div class="modal fade" id="form_items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Items Add</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <div class="modal-body">


        <form id ="form_items_add" name ="form_items_add" onsubmit ="return false">

                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label>Stock Date</label>
                    <input type="date" class="form-control" id="stock_date" name="stock_date"  value="<?php echo date("Y-m-d"); ?>" >
                    <small id="i_date_error" class="form-text text-muted"></small>

                    </div>
                    <div class="form-group col-md-6">

                    <label>GRN</label>
                    <input type="text" class="form-control" id="items_grn" name="items_grn">
                    <small id="i_grn_error" class="form-text text-muted"></small>
                    
                 
                    </div>

                </div>
                
                <div class="form-group">
                    <label >Category</label>
                    <select class="form-control" id="items_select_category_add" name="items_select_category_add">
                    
                    
                    </select>
                    <small id="i_cat_error" class="form-text text-muted"></small>

                </div>
                <div class="form-group">
                    <label >Brand</label>
                    <select class="form-control" id="items_select_brand" name="items_select_brand">
                    
                    
                    </select>
                    <small id="i_brand_error" class="form-text text-muted"></small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label >product</label>
                        <select class="form-control" id="items_select_product_add" name="items_select_product_add">
                        
                        
                        </select>
                        <small id="i_prduct_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Current Quantity</label>
                        <input type="text" class="form-control c_qty" id="c_qty" name="c_qty" readonly/>
                    
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Get price</label>
                    <input type="text" class="form-control" id="get_price" name="get_price">
                    <small id="i_price_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" id="items_quantity" name="items_quantity">
                    <small id="i_quntity_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Exp date</label>
                    <input type="date" class="form-control" id="items_exp_date" name="items_exp_date">
                    <small id="i_exp_date_error" class="form-text text-muted"></small>
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