

<div class="modal fade" id="campaing_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="campaing_alert">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Category Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="campaing_form_edit" action="{{ route('campaing.update') }}" method="post">
            @csrf
            <input type="hidden" name="update">
            <div class="modal-body">
                <div class="py-2">
                    <label for="title"> Campaign Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Write campaign Title" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="py-2">
                            <label for="start_date"> Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="py-2">
                            <label for="end_date"> End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="py-2" id="select_campaing_status">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="py-2">
                            <label for="discount"> Discount</label>
                            <input type="text" name="discount" id="discount" class="form-control custom-select" required>
                            <small class="text-danger">Dscount percentage are apply for all product selling price.</small>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <label for="image"></label>
                    <input type="file" name="image" id="image" data-height="100" class="form-control dropify" placeholder="Write Category Slug">
                </div>
                <div class="py-2" id="campaing_img">

                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    </div>
</div>
