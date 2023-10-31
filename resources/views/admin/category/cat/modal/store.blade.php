<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="alert-message">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="cat_form" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
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
                <label for="icon" class="form-label">Category Icon</label>
                <input type="file" name="icon" id="icon" data-height="100" class="form-control dropify">
                @error('icon')
                <span class="text-danger">{{ $message }}</span></span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="home_page" class="form-label">Category Show Home Page</label>
                <select name="home_page" id="home_page" class="form-control">
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                </select>
                <small>If yes, it will be show your website home page</small>
                @error('home_page')
                <span class="text-danger">{{ $message }}</span></span>
                @enderror
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
