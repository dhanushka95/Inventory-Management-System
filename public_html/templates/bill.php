<div class="modal" id ="form_bill_show" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="box-shadow:0 0 25px 0 lightgrey;">
        
        
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <a class="navbar-brand" href="#">Bill No : </a>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                     
                        <form class="form-inline my-2 my-lg-0" id ="form_bill_search" name ="form_bill_search" onsubmit="return false" >
                            <input class="form-control mr-sm-2" type="search" id="search_bill_no" name="search_bill_no" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>

                    </div>
                </nav>
        
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Category name</th>
                            <th scope="col">Brand name</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Toatal Price(Rs)</th>
                            </tr>
                        </thead>
                        <tbody id="getBillManage">
                            <!-- <tr>
                            <th scope="row">1</th>
                            <td>Y3 2</td>
                            <td>phone</td>
                            <td>huawei</td>
                            <td>123</td>
                            <td>1</td>
                            <td>20000</td>
                            </tr> -->
                        </tbody>
                    </table>
                    </div>

                    <div class="card" style="box-shadow:0 0 35px 0 lightgrey; width: 100%;">
            
                    <div class="card-body border-secondary">
                    <h5 class="card-title text-secondary">Other details</h5>
                    <p id= "getBillOtherDetailsManage" class="card-text">
                    
                     </p>
                    
                    </div>
                    </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>