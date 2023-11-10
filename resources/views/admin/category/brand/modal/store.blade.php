
<div class="modal fade" id="brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="brand_alert_sms">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="brand_form" action="{{ route('brand.store') }}" method="post">
            @csrf
            <div class="modal-body">
            <div class="mb-3">
                <label for="brand_name" class="form-label">Brand Name</label>
                <input type="text" name="brand_name" id="brand_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="brand_slug" class="form-label">Brand Slug</label>
                <input type="text" name="brand_slug" id="brand_slug" class="form-control">
            </div>
            <div class="mb-3">
                <label for="front_page" class="form-label">Brand Show Front Page</label>
                <select name="front_page" id="front_page" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">NO</option>
                </select>
                <small>If you select yes, it will be show home page</small>
            </div>
            <div class="mb-3">
                <label for="brand_logo" class="form-label">Brand Logo</label>
                <input type="file" name="brand_logo" id="brand_logo" class="form-control dropify">
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

