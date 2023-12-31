
@extends('layouts.admin')
@section('title','SuperAdmin- SubCategory')
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
                                <li class="list-inline-item"> Product List </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="product_alert"></div>
            <div class="card">
                <div class="card-header p-3">
                    <h4 class="d-flex justify-content-between"> Product List
                        <a href="{{ route('product.create') }}" id=""  class="btn btn-outline-primary">Add</a>
                    </h4>
                </div>

                <div class="row p-2">
                    <div class="form-group col-3">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control submitable" id="category_id">
                            <option value="">All</option>
                            @foreach ($category as $categorys)
                                <option value="{{ $categorys->id }}">{{ $categorys->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select name="brand_id" class="form-control submitable" id="brand_id">
                            <option value="">All</option>
                            @foreach ($brand as $brands)
                                <option value="{{ $brands->id }}">{{ $brands->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="warehouse_id" class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-control submitable" id="warehouse_id">
                            <option value="">All</option>
                            @foreach ($warehouse as $warehouses)
                                <option value="{{ $warehouses->id }}">{{ $warehouses->warehouse_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control submitable" id="status">
                            <option value="">All</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-sm" id="product_datatables">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Brand</th>
                                <th>Featured</th>
                                <th>TodayDeal</th>
                                <th>ProductStatus</th>
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

@push('scripts')
    <script>
        let _token = "{{ csrf_token() }}";
        let table = $('#product_datatables').DataTable({
            processing: true,
            serverSide: true,
            order: [], //Initial no order
            bInfo: true, //TO show the total number of data
            bFilter: false, //For datatable default search box show/hide
            responsive: true,
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100, 1000, 10000, -1],
                [5, 10, 15, 25, 50, 100, 1000, 10000, "All"]
            ],
            pageLength: 25, //number of data show per page
            ajax: {
                url: "{{ route('product.getData') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                    d.category_id = $("#category_id").val(); //#category_id value going to controller request
                    d.brand_id = $("#brand_id").val();      //#brand_id value going to controller request
                    d.warehouse_id = $("#warehouse_id").val();
                    d.status = $("#status").val();
                }
            },
            columns: [
                {data: 'id'},
                {data: 'thumbnail'},
                {data: 'name'},
                {data: 'code'},
                {data: 'category_id'},
                {data: 'subcategory_id'},
                {data: 'brand_id'},
                {data: 'featured'},
                {data: 'today_deal'},
                {data: 'status'},
                {data: 'created_at'},
                {data: 'action'}
            ],
            language: {
                processing: '<img src="{{ asset('/table_loader.gif') }}">',
                emptyTable: '<strong class="text-danger">No Data Found</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                oPaginate: {
                    sPrevious: "Previous", // This is the link to the previous page
                    sNext: "Next", // This is the link to the next page
                },
                lengthMenu: "_MENU_"
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6' <'float-right pr-15'B>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'<'float-right pr-15'p>>>",
            buttons: {
                buttons: [
                    {
                        text: '<i class="fa fa-refresh" aria-hidden="true"></i> Reload',
                        className: 'btn btn-sm btn-primary',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Role List',
                        filename: 'roles_{{ date("d-m-Y") }}',
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
                        className: 'pdfButton btn btn-sm btn-primary',
                        orientation: "landscape",
                        pageSize: "A3",
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.alignment = 'center';
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Role List',
                        filename: 'roles_{{ date("d-m-Y") }}',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
                        className: 'excelButton btn btn-sm btn-primary',
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> Print',
                        className: 'printButton btn btn-sm btn-primary',
                        orientation: "landscape",
                        pageSize: "A3",
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        }
                    }
                ]
            }
        });

        // filtering
        $(document).on('change','.submitable',function () {
            $('#product_datatables').DataTable().ajax.reload();
        });

        // Delete Product
        $(document).on('click','button.delete-btn', function(){
            let product_id = $(this).data('id');
            $.ajax({
                url:"{{ route('product.delete') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,product_id:product_id},
                success:function(response){
                    $(".product_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                    table.draw();
                }
            });
        });

         // Featured active
         $(document).on("click",'.active_featured',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('product.featured_active') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    table.draw();
                }
            });
        });
        // Featured deactivate
        $(document).on("click",'.deactive_featured',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('product.featured_deactivate') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    table.draw();
                }
            });
        });
         // Today Deal active
         $(document).on("click",'.active_todayDeal',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('product.todayDeal_active') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    table.draw();
                }
            });
        });
        // Today Deal deactivate
        $(document).on("click",'.deactive_todayDeal',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('product.todayDeal_deactivate') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    table.draw();
                }
            });
        });
         // Today Deal active
         $(document).on("click",'.active_status',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('product.status_active') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    table.draw();
                }
            });
        });
        // Today Deal deactivate
        $(document).on("click",'.deactive_status',function(e) {
            e.preventDefault();
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('product.status_deactivate') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    table.draw();
                }
            });
        });


    </script>
@endpush
