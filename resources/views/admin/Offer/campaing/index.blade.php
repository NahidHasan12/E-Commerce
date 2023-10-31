@extends('layouts.admin')
@section('title','SuperAdmin- Campaing')
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
                                        <a href="#">Campaing</a>
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
            <div class="campaing_table_alert"> </div>
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Campaing Data</h3>
                <button class="btn btn-sm btn-primary" onclick="addBtn()" data-toggle="modal" data-target="#campaingModal">Add New</button>
            </div>
            <div class="card-body">
                <table id="campaing_table" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Id</th>
                            <th>Start Date</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Disscount(%)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>



        <!-- Store Modal -->
        @include('admin.Offer.campaing.modal.create')
        <!-- Edit Modal -->
        @include('admin.Offer.campaing.modal.edit')
    </section>

@endsection

@push('scripts')

<script>
    let _token = "{{ csrf_token() }}";
    //Fatch Data With DataTable
    let table = $('#campaing_table').DataTable({
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
            url: "{{ route('campaing.getData') }}",
            type: "POST",
            dataType: "JSON",
            data: function(d) {
                d._token = _token
            }
        },
        columns: [
            {data: 'id'},
            {data: 'start_date'},
            {data: 'title'},
            {data: 'image'},
            {data: 'discount'},
            {data: 'status'},
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

        //Store Data
    $(document).on('submit', 'form.campaing_form', function(e){
        e.preventDefault();

        $.ajax({
            url: "{{ route('campaing.store') }}",
            type: "post",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                if(response.status == 'success'){
                    $("form")[0].reset();
                    $(".campaing_create_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                    table.draw();
                }else{
                    $(".campaing_create_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                }

            }
        });
    });

        //Edit Cat Data
    $(document).on('click', 'button.edit-btn', function(){
        let data_id = $(this).data('id');
        $('form.campaing_form_edit input[name="update"]').val(data_id);
        $.ajax({
            url:"{{ route('campaing.edit') }}",
            type: "post",
            dataType:"json",
            data:{_token:_token,data_id:data_id},
            success:function(response){
                let img_src = "{{ asset('admin/campaing_img') }}/"+response.image;
                $('form.campaing_form_edit input[name="title"]').val(response.title);
                $('form.campaing_form_edit input[name="start_date"]').val(response.start_date);
                $('form.campaing_form_edit input[name="end_date"]').val(response.end_date);
                $('form.campaing_form_edit input[name="discount"]').val(response.discount);
                $('form.campaing_form_edit #campaing_img').html('<img src="'+img_src+'" alt="'+response.name+'" width="100%">');
                student_status(response.id)
            }
        });

    });

    // Select Status
    function student_status(id){
        //alert(id);
        $.ajax({
            url:"{{ route('campaing.select_campaingStatus') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token,campaing_id:id},
            success: function(response){
                    // alert('ok');
                if(response){
                    $("#select_campaing_status").html(response);
                }
            }
        })
    }

        //student data update
    $(document).on('submit', 'form.campaing_form_edit', function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ route('campaing.update') }}",
            type: "post",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){

                if(response.status == 'success'){
                    $("form")[0].reset();
                    $(".campaing_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                    table.draw();
                }else{
                    $(".campaing_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                }
            }
        });
    });

    //Student data delete
    //==================
    $(document).on('click','button.delete-btn', function(){
        let campaing_id = $(this).data('id');
        $.ajax({
            url:"{{ route('campaing.delete') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token,campaing_id:campaing_id},
            success:function(response){
                $(".campaing_table_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                table.draw();
            }
        });
    });

</script>

@endpush
