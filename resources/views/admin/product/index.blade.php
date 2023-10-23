
@extends('layouts.admin')
@section('title','SuperAdmin- SubCategory')
@section('admin_content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header p-3">
                    <h4 class=" d-flex justify-content-between"> Product List
                        <a href="{{ route('product.create') }}" id=""  class="btn btn-outline-primary">Add</a>
                    </h4>
                </div>

                <div class="row p-2">
                    <div class="form-group col-3">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control submitable" id="category_id">
                            <option value="">All</option>
                            {{-- @foreach ($category as $categorys)
                                <option value="{{ $categorys->id }}">{{ $categorys->category_name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select name="brand_id" class="form-control submitable" id="brand_id">
                            <option value="">All</option>
                            {{-- @foreach ($brand as $brands)
                                <option value="{{ $brands->id }}">{{ $brands->brand_name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="warehouse_id" class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-control submitable" id="warehouse_id">
                            <option value="">All</option>
                            {{-- @foreach ($warehouse as $warehouses)
                                <option value="{{ $warehouses->id }}">{{ $warehouses->warehouse_name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control submitable" id="status">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-sm" id="product-datatables">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Brand</th>
                                <th>Featured</th>
                                <th>Today Deal</th>
                                <th>status</th>
                                <th>created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
