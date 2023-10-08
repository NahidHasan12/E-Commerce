
<div class="modal fade" id="childCategoryStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="child_cat_store_alert">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Child Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="childcat_form" action="{{ route('child_cat.store') }}" method="post">
            @csrf
            <div class="modal-body">
            <div class="mb-3">
                <label for="child_cat_name" class="form-label">Child Category Name</label>
                <input type="text" name="child_cat_name" id="child_cat_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="child_cat_slug" class="form-label">Child Category Slug</label>
                <input type="text" name="child_cat_slug" id="child_cat_slug" class="form-control">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category Select</label>
                <select name="category_id" class="form-control" id="category_id">
                    <option value="">--Select Category--</option>
                    @forelse ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                    @empty
                    <option class="text-danger" value="">No data found</option>
                    @endforelse
                </select>
            </div>
            <div class="mb-3">
                <label for="subcategory_id" class="form-label">Sub Category Select</label>
                <select name="subcategory_id" class="form-control" id="subcategory_id">
                    <option value="">--Select SubCategory--</option>

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

