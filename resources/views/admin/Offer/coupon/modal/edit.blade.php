
<div class="modal fade" id="coupon_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="coupon_edit_alert_sms">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="coupon_edit_form" action="{{ route('coupon.update') }}" method="post">
            @csrf
            <input type="hidden" name="update">
            <div class="modal-body">
            <div class="mb-3">
                <label for="coupon_code" class="form-label">Coupon Code</label>
                <input type="text" name="coupon_code" id="coupon_code" class="form-control" required placeholder="coupon Code..">
            </div>
            <div class="mb-3">
                <label for="valid_date" class="form-label">Valid Date</label>
                <input type="date" name="valid_date" id="valid_date" class="form-control">
            </div>
            <div class="mb-3 coupon_type">

            </div>
            <div class="mb-3">
                <label for="coupon_amount" class="form-label">Coupon Ammount</label>
                <input type="text" name="coupon_amount" id="coupon_amount" class="form-control" placeholder="coupon ammount..">
            </div>
            <div class="mb-3 coupon_status">

            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update & Change</button>
            </div>
        </form>
    </div>
    </div>
</div>

