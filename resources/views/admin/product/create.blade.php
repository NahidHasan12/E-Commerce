
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
                                <li class="list-inline-item">Create Product </li>
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
                            <h4 class="card-title">Add New Product</h4>
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
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row ${1| ,row-cols-2,row-cols-3, auto,justify-content-md-center,|}">
                                    <div class="col-md-9">
                                        <div class="ibox">

                                            <div class="ibox-body">

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Product Name</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="write product name">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Product Code</label>
                                                        <input type="text" class="form-control" name="code" value="" placeholder="write product code">
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
                                                                    <option value="{{ $item->id }}">{{ $item->subcategory_name }}</option>
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Child Category</label>
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
                                                                <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="">Pickup Point</label>
                                                        <select id="" name="pickup_point_id" class="form-control @error('pickup_point_id') is-invalid @enderror">
                                                            <option value=""> -- choose Pickup point --</option>
                                                            @foreach ($pickup_point as $item)
                                                                <option value="{{ $item->id }}">{{ $item->pickup_point_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Tags</label>
                                                        <input type="text" name="tags" value="" class="form-control" id="tags" data-role="tagsinput" >
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="">Unit</label>
                                                        <input type="text" name="unit" value="" class="form-control @error('unit') is-invalid @enderror">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label for="">Purchase Price</label>
                                                        <input type="number" name="purchase_price" value="" class="form-control">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Selling Price</label>
                                                        <input type="number" name="selling_price" value="" class="form-control @error('selling_price') is-invalid @enderror">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Discount Price</label>
                                                        <input type="number" name="discount_price" value="" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Warehouse</label>
                                                        <select id="" name="warehouse" class="form-control">
                                                            <option value="">-- Choose Warehouse --</option>
                                                            @foreach ($warehouse as $item)
                                                                <option value="{{ $item->id }}">{{ $item->warehouse_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Stock</label>
                                                        <input type="number" name="stock" value=""  class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="">Color</label>
                                                        <input type="text" name="color" value=""  class="form-control @error('color') is-invalid @enderror" id="tags" data-role="tagsinput">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Size</label>
                                                        <input type="number" name="size" class="form-control" id="tags" data-role="tagsinput">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="summernote">Description</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="summernote" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="summernote">Video Embaded Code</label>
                                                        <textarea class="form-control" name="video"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 bg-white">
                                        <div class="form-group">
                                            <label for="">Main Thumbnail</label>
                                            {{-- <input type="file" name="thumbnail" data-height="150" class="form-control dropify"> --}}
                                            <input type="file" name="thumbnail_image" data-height="150" class="form-control dropify" placeholder="Write Category Slug" required>

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
                                            <h6>Featured Product</h6>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="featured" value="1" id="featured" class="input-status" checked data-toggle="toggle" data-onstyle="success" data-offstyle="outline-danger">
                                            </div>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2">Today Deal</h6>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="today_deal" value="1" id="today_deal" class="input-status" checked data-toggle="toggle" data-onstyle="success" data-offstyle="outline-danger">
                                            </div>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2">Status</h6>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="status" value="1" id="status" class="input-status" checked data-toggle="toggle" data-onstyle="success" data-offstyle="outline-danger">
                                            </div>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2">Slider Show Switch</h6>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="slider_show" value="1" id="slider_show" class="input-status" checked data-toggle="toggle" data-onstyle="success" data-offstyle="outline-danger">
                                            </div>
                                            <small class="mt-5"> If you on this switch then This product show on website top slider </small>
                                        </div>

                                        <div class="card p-5">
                                            <h6 class="mb-2">Trendy Show Switch</h6>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="trendy" value="1" id="trendy_show" class="input-status" checked data-toggle="toggle" data-onstyle="success" data-offstyle="outline-danger">
                                            </div>
                                            <small class="mt-5"> If you on this switch then product show on website Trendy </small>
                                        </div>


                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success" value="submit">
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
