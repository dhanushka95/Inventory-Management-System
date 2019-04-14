<!-- Modal -->
<div class="modal fade" id="form_items_m" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Items Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <div class="modal-body">


        <form id ="form_items_update" name ="form_items_update" onsubmit ="return false">

                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label>Stock Date</label>
                    <input type="date" class="form-control" id="stock_date_update" name="stock_date_update"  value="<?php echo date("Y-m-d"); ?>" >
                    <small id="iu_date_error" class="form-text text-muted"></small>

                    </div>
                    <div class="form-group col-md-6">

                    <label>GRN</label>
                    <input type="hidden" name ="iu_barcode" id="iu_barcode" value =""/>
                    <input type="hidden" name ="iu_pid" id="iu_pid" value =""/>
                    <input type="hidden" name ="iu_qtyi" id="iu_qtyi" value =""/>
                    <input type="text" class="form-control" id="items_grn_update" name="items_grn_update">
                    <small id="iu_grn_error" class="form-text text-muted"></small>
                    
                 
                    </div>

                </div>
                
                <div class="form-group">
                    <label >Category</label>
                    <select class="form-control" id="items_select_category_update" name="items_select_category_update">
                    
                    
                    </select>
                    <small id="iu_cat_error" class="form-text text-muted"></small>

                </div>
                <div class="form-group">
                    <label >Brand</label>
                    <select class="form-control" id="items_select_brand_update" name="items_select_brand_update">
                    
                    
                    </select>
                    <small id="iu_brand_error" class="form-text text-muted"></small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label >product</label>
                        <select class="form-control" id="items_select_product_update" name="items_select_product_update">
                        
                        
                        </select>
                        <small id="iu_prduct_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Current Quantity</label>
                        <input type="text" class="form-control c_qty_u" id="c_qty_u" name="c_qty_u" readonly/>
                    
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Get price</label>
                    <input type="text" class="form-control" id="get_price_update" name="get_price_update">
                    <small id="iu_price_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" id="items_quantity_update" name="items_quantity_update">
                    <small id="iu_quntity_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Exp date</label>
                    <input type="date" class="form-control" id="items_exp_date_update" name="items_exp_date_update">
                    <small id="iu_exp_date_error" class="form-text text-muted"></small>
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