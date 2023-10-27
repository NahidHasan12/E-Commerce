
@extends('layouts.admin')
@section('title','CreateProduct')
@section('admin_content')
 <!-- BREADCRUMB-->
 <section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="{{ route('admin.home') }}">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Edit Product </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- STATISTIC-->
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-flex justify-content-between">Edit Product
                                <a href="{{ route('product.index') }}" id=""  class="btn btn-outline-danger">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('product.update',$product_edit->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                    <div class="col-md-8">
                                        <div class="ibox">

                                            <div class="ibox-body">

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Product Name</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product_edit->name }}" placeholder="write product name">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Product Code</label>
                                                        <input type="text" class="form-control" name="code" value="{{ $product_edit->code }}" placeholder="write product code">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Category/Subcategory</label>
                                                        <select id="subcategory_id" name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror">
                                                            <option value=""> -- choose Category --</option>
                                                            @foreach ($category as $item)
                                                                <option class="text-primary" disabled="">--{{ $item->category_name }}--</option>
                                                                @php
                                                                    $subcategory = DB::table('sub_categories')->where('category_id',$item->id)->get();
                                                                @endphp

                                                                @foreach ($subcategory as $item)
                                                                    <option value="{{ $item->id }}" {{ $product_edit->subcategory_id == $item->id ? 'selected' : '' }}>{{ $item->subcategory_name }}</option>
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="child_category_id">Child Category</label>
                                                        <select name="child_category_id" id="child_category_id" class="form-control">

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Brand</label>
                                                        <select id="" name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                                            <option value=""> -- select Brand --</option>
                                                            @foreach ($brand as $item)
                                                                <option value="{{ $item->id }}" {{ $product_edit->brand_id == $item->id ? 'selected' : '' }}>{{ $item->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="">Pickup Point</label>
                                                        <select id="" name="pickup_point_id" class="form-control @error('pickup_point_id') is-invalid @enderror">
                                                            <option value=""> -- choose Pickup point --</option>
                                                            @foreach ($pickup_point as $item)
                                                                <option value="{{ $item->id }}" {{ $product_edit->pickup_point_id == $item->id ? 'selected' : '' }}>{{ $item->pickup_point_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Tags</label>
                                                        <input type="text" name="tags" value="{{ $product_edit->tags }}" class="form-control" id="tags" data-role="tagsinput" >
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="">Unit</label>
                                                        <input type="text" name="unit" value="{{ $product_edit->unit }}" class="form-control @error('unit') is-invalid @enderror">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Purchase Price</label>
                                                        <input type="number" name="purchase_price" value="{{ $product_edit->purchase_price }}" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Selling Price</label>
                                                        <input type="number" name="selling_price" value="{{ $product_edit->selling_price }}" class="form-control @error('selling_price') is-invalid @enderror">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Discount Price</label>
                                                        <input type="number" name="discount_price" value="{{ $product_edit->discount_price }}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Warehouse</label>
                                                        <select id="" name="warehouse" class="form-control">
                                                            <option value="">-- Choose Warehouse --</option>
                                                            @foreach ($warehouse as $item)
                                                                <option value="{{ $item->id }}" {{ $product_edit->warehouse == $item->id ? 'selected' : '' }}>{{ $item->warehouse_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Stock</label>
                                                        <input type="number" name="stock" value="{{ $product_edit->stock_quantity }}"  class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Color</label>
                                                        <input type="text" name="color" value="{{ $product_edit->color }}"  class="form-control @error('color') is-invalid @enderror" id="tags" data-role="tagsinput">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Size</label>
                                                        <input type="text" name="size" value="{{ $product_edit->size }}" class="form-control" id="tags" data-role="tagsinput">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="summernote">Description</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"  id="summernote" cols="30" rows="10">{{ $product_edit->description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="summernote">Video Embaded Code</label>
                                                        <input type="text" class="form-control" name="video" value="{{ $product_edit->video }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 bg-white">
                                        <div class="form-group">
                                            <img class="ml-5" src="{{ $product_edit->thumbnail != null ? asset('admin/product_img/'.$product_edit->thumbnail)  : 'https://via.placeholder.com/80' }}" width="150" height="110" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Main Thumbnail</label>
                                            {{-- <input type="file" name="thumbnail" data-height="150" class="form-control dropify"> --}}
                                            <input type="file" name="thumbnail_image" data-height="150" class="form-control dropify" placeholder="Write Category Slug">

                                        </div>
                                        <div class="form-group">
                                            <small class="text-secondary py-1">More images:(click add more image)</small>
                                            <table class="table table-bordered" id="dynamicAddRemove">
                                                <tr>
                                                    <td><input type="file" name="images[]" placeholder="Enter subject" class="form-control" multiple />
                                                    </td>
                                                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add</button></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2 mx-auto">Featured Product</h6>
                                            @php
                                                $checked_featured = $product_edit->featured == 1 ? 'checked':'' ;
                                            @endphp
                                            <div class = "toggle-switch mx-auto">
                                                <label class="switch-label" for="featured">
                                                <input type = "checkbox" name="featured" value="1" class="input-feature" id="featured" {{ $checked_featured }}>
                                                    <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                                                    <span class = "switch_slider">ON</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2 mx-auto">Today Deal</h6>
                                            @php
                                                $checked_today_deal = $product_edit->today_deal == 1 ? 'checked':'' ;
                                            @endphp
                                            <div class = "toggle-switch mx-auto">
                                                <label class="switch-label" for="todaydeal">
                                                <input type = "checkbox" name="today_deal"  value="1" class="input-todaydeal" id="todaydeal" {{ $checked_today_deal }}>
                                                    <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                                                    <span class = "switch_slider">ON</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2 mx-auto">Status</h6>
                                            @php
                                                $checked_status = $product_edit->status == 1 ? 'checked':'' ;
                                            @endphp
                                            <div class = "toggle-switch mx-auto">
                                                <label class="switch-label" for="status">
                                                <input type = "checkbox" name="status"  value="1" class="input-status" id="status" {{ $checked_status }}>
                                                    <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                                                    <span class = "switch_slider">ON</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2 mx-auto">Slider Show Switch</h6>
                                            @php
                                                $checked_slider_show = $product_edit->slider_show == 1 ? 'checked':'' ;
                                            @endphp
                                            <div class = "toggle-switch mx-auto">
                                                <label class="switch-label" for="slider_show">
                                                <input type = "checkbox" name="slider_show"  value="1" class="input-status" id="slider_show" {{ $checked_slider_show }}>
                                                    <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                                                    <span class = "switch_slider">ON</span>
                                                </label>
                                            </div>
                                            <small class="mt-5 text-center"> If you on this switch then This product show on website top slider </small>
                                        </div>

                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success" value="Update & Change">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>




        let _token = "{{ csrf_token() }}";
        $(document).on('change','#subcategory_id',function (e) {
            e.preventDefault();
            //alert('ok')
            var categoryId = $(this).val();
            $.ajax({
                url: "{{ route('product.select_childCat') }}",
                type: "post",
                data: {_token:_token,data_id:categoryId},
                dataType: 'json',
                success: function (response) {
                    $('#child_category_id').html(response);
                }
            });

        });



        // Dynamic file Button
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="file" name="images[]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Remove</button></td></tr>'
                );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
