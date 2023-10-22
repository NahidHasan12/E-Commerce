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
                                    <a href="#">Warehouse</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">index</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="card">
        <div class="warehouse_table_alert"> </div>
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Warehouse Data Table</h3>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#warehouse_create">Add New</button>
        </div>
        <div class="card-body">
            <table id="warehouse_table" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>Id</th>
                        <th>Warehouse Name</th>
                        <th>Warehouse Address</th>
                        <th>Warehouse Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="brand_data">

                </tbody>

            </table>
        </div>
    </div>



   <!-- Store Modal -->
   @include('admin.warehouse.modal.create')

   <!-- Edit Modal -->
   @include('admin.warehouse.modal.edit')



</section>

@endsection

@push('scripts')
    <script>
        let _token = "{{ csrf_token() }}";
        //DataTable
        let table = $('#warehouse_table').DataTable({
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
                url: "{{ route('warehouse.fatch_warehouse') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'warehouse_name'},
                {data: 'warehouse_address'},
                {data: 'warehouse_phone'},
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
        //warehouse Create
        $(document).on('submit', 'form.warehouse_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('warehouse.store') }}",
                type: "POST",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    if(response.status == 'success'){
                        //alert('ok');
                        table.draw();
                        $("form")[0].reset();
                        $("div.warehouse_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                    }else{
                        $("div.warehouse_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

                }
            });
        });

        // Edit Warehouse data
        $(document).on('click', 'button.edit-btn', function(){
        let data_id = $(this).data('id');
        $('form.edit_warehouse_form input[name="update"]').val(data_id);
            $.ajax({
                url:"{{ route('warehouse.edit') }}",
                type: "post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    $('form.edit_warehouse_form input[name="warehouse_name"]').val(response.warehouse_name);
                    $('form.edit_warehouse_form input[name="warehouse_address"]').val(response.warehouse_address);
                    $('form.edit_warehouse_form input[name="warehouse_phone"]').val(response.warehouse_phone);
                }
            });
        });

        // Update Warehouse Data
        $(document).on('submit', 'form.edit_warehouse_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('warehouse.update') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    if(response.status == 'success'){
                        $("form")[0].reset();
                        table.draw();
                        $(".edit_brand_alert_sms").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                        fatchData();
                    }else{
                        $(".edit_brand_alert_sms").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

                }
            });
        });

        // Delete Warehouse Data
        $(document).on('click','button.delete-btn', function(){
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('warehouse.delete') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    table.draw();
                    $(".warehouse_table_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                }
            });
        });

    </script>
@endpush
