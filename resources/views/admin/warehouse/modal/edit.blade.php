
<div class="modal fade" id="warehouse_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="edit_brand_alert_sms">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Warehouse</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="edit_warehouse_form" action="{{ route('warehouse.update') }}" method="post">
            @csrf
            <input type="hidden" name="update">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="warehouse_name" class="form-label">Warehouse Name</label>
                    <input type="text" name="warehouse_name" id="warehouse_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="warehouse_address" class="form-label">Warehouse Address</label>
                    <input type="text" name="warehouse_address" id="warehouse_address" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="warehouse_phone" class="form-label">Warehouse Phone</label>
                    <input type="text" name="warehouse_phone" id="warehouse_phone" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
</div>

