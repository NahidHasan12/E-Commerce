
<div class="modal fade" id="childCategoryEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="edit_alert_sms">  </div>
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Child Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form class="edit_childcat_form" action="{{ route('child_cat.update') }}" method="post">
            @csrf
            <input type="hidden" name="update">
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
                <label for="category_id" class="form-label">Select Sub Category</label>
                <select name="subcategory_id" class="form-control" id="category_id">
                    <option value="">--Select Category--</option>
                    @foreach ($category as $item)
                    <option class="text-primary" disabled="">--{{ $item->category_name }}--</option>
                    @php
                    $subcategory = DB::table('sub_categories')->where('category_id',$item->id)->get();
                    @endphp
                    @foreach ($subcategory as $item)
                        <option value="{{ $item->id }}">{{ $item->subcategory_name }}</option>
                    @endforeach
                    @endforeach
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

