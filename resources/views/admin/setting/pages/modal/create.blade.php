<div class="modal fade" id="pageCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="page_create_alert">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="pageCreate_form" action="{{ route('pages.store_pages') }}" method="post">
            @csrf
            <div class="modal-body">
            <div class="mb-3">
                <label for="page_position" class="form-label">Page Position</label>
                <select name="page_position" class="form-control" id="page_position">
                    <option value="1">Line One</option>
                    <option value="2">Line Two</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="page_name" class="form-label">Page Name</label>
                <input type="text" name="page_name" id="page_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="page_title" class="form-label">Page Title</label>
                <input type="text" name="page_title" id="page_title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="summernote" class="form-label">Page Description</label>
                <textarea name="page_description" class="form-control" id="summernote" cols="5" rows="5"></textarea>
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
