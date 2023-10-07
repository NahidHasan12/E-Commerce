


<div class="modal fade" id="subCategoryEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="alert-message">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Sub Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="edit_subcat_form" action="" method="post">
            @csrf
            <input type="hidden" name="update">
            <div class="modal-body">
            <div class="mb-3">
                <label for="sub_cat_name" class="form-label">Sub Category Name</label>
                <input type="text" name="sub_cat_name" id="sub_cat_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="sub_cat_slug" class="form-label">Sub Category Slug</label>
                <input type="text" name="sub_cat_slug" id="sub_cat_slug" class="form-control">
            </div>
            <div class="mb-3 catSelect">


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
