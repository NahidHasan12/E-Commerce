@extends('layouts.admin')
@section('title','SuperAdmin- Category')
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
                                    <a href="#">Category</a>
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
        <div class="pages_table_alert"> </div>
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Category Data</h3>
            <button class="btn btn-sm btn-primary" onclick="addBtn()" data-toggle="modal" data-target="#pageCreateModal">Add New</button>
        </div>
        <div class="card-body">
            <table id="page-create" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>Id</th>
                        <th>Page Name</th>
                        <th>Page Title</th>
                        <th>Page slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="page_data">

                </tbody>

            </table>
        </div>
    </div>



<!-- Store Modal -->
   @include('admin.setting.pages.modal.create')
<!-- Edit Modal -->
   @include('admin.setting.pages.modal.edit')
</section>

@endsection

@push('scripts')
    <script>
        let _token = "{{ csrf_token() }}";
    //Fatch Data With DataTable
    let table = $('#page-create').DataTable({
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
            url: "{{ route('pages.fatch_pages') }}",
            type: "POST",
            dataType: "JSON",
            data: function(d) {
                d._token = _token
            }
        },
        columns: [
            {data: 'id'},
            {data: 'page_name'},
            {data: 'page_title'},
            {data: 'page_slug'},
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

    $(document).on('submit', 'form.pageCreate_form', function(e){
        e.preventDefault();

        $.ajax({
            url: "{{ route('pages.store_pages') }}",
            type: "post",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                    if(response.status == 'success'){
                        $("form")[0].reset();
                        $(".page_create_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                        table.draw();
                    }else{
                        $(".page_create_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

            }
        });
    });

    $(document).on('click', 'button.edit-btn', function(){
        let data_id = $(this).data('id');
        $('form.pageEdit_form input[name="update"]').val(data_id);
        $.ajax({
            url:"{{ route('pages.edit_pages') }}",
            type: "post",
            dataType:"json",
            data:{_token:_token,data_id:data_id},
            success:function(response){
                category_select(response.id);
                $('form.pageEdit_form input[name="page_name"]').val(response.page_name);
                $('form.pageEdit_form input[name="page_title"]').val(response.page_title);
                $('form.pageEdit_form textarea[name="page_description"]').val(response.page_description);
            }
        });

    });
    function category_select(page_id){
        //alert(cat_id);
        $.ajax({
            url:"{{ route('pages.select_page_position') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token,page_id:page_id},
            success:function(response){
                if(response){
                    $('.page_position').html(response);
                }
            }
        });
    }

    $(document).on('submit', 'form.pageEdit_form', function(e){
        e.preventDefault();

        $.ajax({
            url: "{{ route('pages.update_page') }}",
            type: "post",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                    if(response.status == 'success'){
                        $(".pageEdit_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                        table.draw();
                    }else{
                        $(".pageEdit_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

            }
        });
    });


    $(document).on('click','button.delete-btn', function(){
        let brand_id = $(this).data('id');
        $.ajax({
            url:"{{ route('pages.delete') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token,brand_id:brand_id},
            success:function(response){
                $(".pages_table_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                table.draw();
            }
        });
    });



    </script>
@endpush
