
<div class="modal fade" id="coupon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="coupon_alert_sms">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="coupon_form" action="{{ route('coupon.store') }}" method="post">
            @csrf
            <div class="modal-body">
            <div class="mb-3">
                <label for="coupon_code" class="form-label">Coupon Code</label>
                <input type="text" name="coupon_code" id="coupon_code" class="form-control" required placeholder="coupon Code..">
            </div>
            <div class="mb-3">
                <label for="valid_date" class="form-label">Valid Date</label>
                <input type="date" name="valid_date" id="valid_date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Coupon Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="1">Fixed</option>
                    <option value="2">Percentage</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="coupon_amount" class="form-label">Coupon Ammount</label>
                <input type="text" name="coupon_amount" id="coupon_amount" class="form-control" placeholder="coupon ammount..">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Coupon Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="0">Pending</option>
                    <option value="1">Active</option>
                </select>
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

