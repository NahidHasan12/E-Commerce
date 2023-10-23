
<div class="modal fade" id="pickup_point_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="pickup_edit_alert">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Pickup Point</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="pickup_edit_form" action="{{ route('pickup_point.update') }}" method="post">
            @csrf
            <input type="hidden" name="update">
            <div class="modal-body">
            <div class="mb-3">
                <label for="pickup_point_name" class="form-label">Pickup Point Name</label>
                <input type="text" name="pickup_point_name" id="pickup_point_name" class="form-control" required placeholder="pickup point name">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="textphone" name="address" id="address" class="form-control" placeholder="address..">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="phone..">
            </div>
            <div class="mb-3">
                <label for="another_phone" class="form-label">Another Phone</label>
                <input type="text" name="another_phone" id="another_phone" class="form-control" placeholder="another phone..">
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

