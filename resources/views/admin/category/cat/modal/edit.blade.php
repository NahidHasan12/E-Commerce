

<div class="modal fade" id="catEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="edit_alert">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Category Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="cat_form_edit" action="{{ route('category.edit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="update">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" id="category_name" class="form-control">
                    @error('category_name')
                    <span class="text-danger">{{ $message }}</span></span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="category_slug" class="form-label">Category Slug</label>
                    <input type="text" name="category_slug" id="category_slug" class="form-control">
                    @error('category_slug')
                    <span class="text-danger">{{ $message }}</span></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div id="select_home_status">

                    </div>
                    <small>If yes, it will be show your website home page</small>
                    @error('home_page')
                    <span class="text-danger">{{ $message }}</span></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Category Icon</label>
                    <input type="file" name="icon" id="icon" data-height="100" class="form-control dropify">
                    @error('icon')
                    <span class="text-danger">{{ $message }}</span></span>
                    @enderror
                </div>
                <div class="mb-3" id="cat_icon">

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
