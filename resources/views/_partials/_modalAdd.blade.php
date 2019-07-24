<!-- Modal For Delivery -->
<div class="modal fade" id="modalDelivery" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Add Delivery</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form method="POST" action="{{ route('home') }}">
            {!! csrf_field() !!}
            <div class="modal-body">
              <div class="btn-group btn-group-toggle d-block mb-4 w-100 text-center" data-toggle="buttons">
                <label class="btn btn-primary btn-lg p-5" style="width: 49%">
                  <input type="radio" name="amount" id="5" autocomplete="off" value="5"> <h1>5</h1>
                </label>
                <label class="btn btn-primary btn-lg p-5" style="width: 49%">
                  <input type="radio" name="amount" id="3" autocomplete="off" value="3"> <h1>3</h1>
                </label>
              </div>                
              <input type="hidden" name="type" value="1">
                <div class="form-label-group">
                  <input type="text" class="form-control" id="Note" placeholder="Note" name="note">
                  <label for="Note">Note</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-lg">Add</button>
            </div>
          </form>
        </div>
    </div>
</div>

<!-- Modal For Purchase -->
<div class="modal fade" id="modalPurchase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Add Purchase</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form method="POST" action="{{ route('home') }}">
            {!! csrf_field() !!}
            <div class="modal-body">
              <input type="hidden" name="type" value="2">
              <div class="form-label-group">
                <input type="text" class="form-control" id="invoice" placeholder="Invoice" name="invoice">
                <label for="Note">Invoice</label>
              </div>
              <div class="form-label-group">
                <input type="text" class="form-control" id="company" placeholder="Company" name="company">
                <label for="company">Company</label>
              </div>
              <div class="form-label-group">
                <input type="number" class="form-control" id="amount" placeholder="Amount" name="amount">
                <label for="Note">Amount</label>
              </div>
              <div class="form-label-group">
                <input type="text" class="form-control" id="Note" placeholder="Note" name="note">
                <label for="Note">Note</label>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-lg">Add</button>
            </div>
          </form>
        </div>
    </div>
</div>