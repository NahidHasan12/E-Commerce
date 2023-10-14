<div class="modal fade" id="pageEditeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="pageEdit_alert">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="pageEdit_form" action="" method="post">
            @csrf
            <input type="hidden" name="update">
            <div class="modal-body">
            <div class="mb-3 page_position">

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
                <label for="page_description" class="form-label">Page Description</label>
                <textarea name="page_description" class="form-control" id="page_description" cols="5" rows="5"></textarea>
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
