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
                                    <a href="#">Brand</a>
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
        <div class="brand_table_alert"> </div>
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Brand Data</h3>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#brand">Add New</button>
        </div>
        <div class="card-body">
            <table id="brand_table" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>Id</th>
                        <th>Brand Logo</th>
                        <th>Brand Name</th>
                        <th>Brand Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="brand_data">

                </tbody>

            </table>
        </div>
    </div>



   <!-- Store Modal -->
   @include('admin.category.brand.modal.store')

   <!-- Edit Modal -->
   @include('admin.category.brand.modal.edit')



</section>

@endsection

@push('scripts')
    <script>
        let _token = "{{ csrf_token() }}";
        let table = $('#brand_table').DataTable({
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
            url: "{{ route('brand.fatch') }}",
            type: "POST",
            dataType: "JSON",
            data: function(d) {
                d._token = _token
            }
        },
        columns: [
            {data: 'id'},
            {data: 'brand_logo'},
            {data: 'brand_name'},
            {data: 'brand_slug'},
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

        //Brand Get Data
        function brand_data_fatch(){
            $.ajax({
                url:"",
                type:"post",
                dataType:"json",
                data:{_token:_token},
                success: function(response){
                    $("tbody#brand_data").html(response);
                }

            });
        }
        brand_data_fatch();

        //Brand Store
        $(document).on('submit', 'form.brand_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('brand.store') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    //Form Validation Code start
                    $('form.brand_form').find('.error_msg').remove();
                    if(response.status == false){
                        $.each(response.errors, function(key,value){
                        // console.log(response.errors);
                            $('form.brand_form #'+key).parent().append('<span class="text-danger error_msg">'+value+'</span>');
                        });
                            //Form Validation Code end
                        }else{

                        if(response.status == 'success'){
                            table.draw();
                            $("form")[0].reset();
                            $(".brand_alert_sms").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                        }else{
                            $(".brand_alert_sms").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                        }
                    }
                }
            });
        });

        //Brand Edit
        $(document).on('click','button.edit-btn', function(){
            let brand_id = $(this).data('id');
            $('form.edit_brand_form input[name="update"]').val(brand_id);
            $.ajax({
                url:"{{ route('brand.edit') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token, brand_id:brand_id},
                success: function(response){
                    let img_src = "{{ asset('admin/brand_img/') }}/"+response.brand_logo;
                    $('form.edit_brand_form input[name="brand_name"]').val(response.brand_name);
                    $('form.edit_brand_form input[name="brand_slug"]').val(response.brand_slug);
                    $('form.edit_brand_form #brand_logo').html('<img src="'+img_src+'" alt="'+response.brand_name+'" width="60px">');
                }
            });
        });

        //Brand Update
        $(document).on('submit', 'form.edit_brand_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('brand.update') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    //Form Validation Code start
                    $('form.edit_brand_form').find('.error_msg').remove();
                    if(response.status == false){
                        $.each(response.errors, function(key,value){
                        // console.log(response.errors);
                            $('form.edit_brand_form #'+key).parent().append('<span class="text-danger error_msg">'+value+'</span>');
                        });
                            //Form Validation Code end
                        }else{

                        if(response.status == 'success'){
                            table.draw();
                            $("form")[0].reset();
                            $(".edit_brand_alert_sms").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                        }else{
                            $(".edit_brand_alert_sms").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                        }
                    }
                }
            });
        });

        //Brand Delete
        $(document).on('click','button.delete-btn', function(){
            let brand_id = $(this).data('id');
            $.ajax({
                url:"{{ route('brand.delete') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,brand_id:brand_id},
                success:function(response){
                    $(".brand_table_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                    table.draw();
                }
            });
        });
    </script>
@endpush
