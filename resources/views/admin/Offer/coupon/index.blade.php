@extends('layouts.admin')
@section('title','SuperAdmin- Coupon')
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
                                    <a href="#">Coupon</a>
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
        <div class="coupon_table_alert"> </div>
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Coupon Data</h3>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#coupon">Add New</button>
        </div>
        <div class="card-body">
            <table id="coupon_table" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>Id</th>
                        <th>Coupon Code</th>
                        <th>Valid Date</th>
                        <th>Coupon Type</th>
                        <th>Coupon Ammount</th>
                        <th>Coupon Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>



   <!-- Store Modal -->
   @include('admin.Offer.coupon.modal.create')

   <!-- Edit Modal -->
   @include('admin.Offer.coupon.modal.edit')



</section>

@endsection

@push('scripts')
    <script>
        let _token = "{{ csrf_token() }}";
        let table = $('#coupon_table').DataTable({
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
            url: "{{ route('coupon.fatch_coupon') }}",
            type: "POST",
            dataType: "JSON",
            data: function(d) {
                d._token = _token
            }
        },
        columns: [
            {data: 'id'},
            {data: 'coupon_code'},
            {data: 'valid_date'},
            {data: 'type'},
            {data: 'coupon_amount'},
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

        $(document).on('submit', 'form.coupon_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('coupon.store') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    if(response.status == 'success'){
                        table.draw();
                        $("form")[0].reset();
                        $(".coupon_alert_sms").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                    }else{
                        $(".coupon_alert_sms").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

                }
            });
        });

        $(document).on('click','button.edit-btn', function(){
            let coupon_id = $(this).data('id');
            $('form.coupon_edit_form input[name="update"]').val(coupon_id);
            $.ajax({
                url:"{{ route('coupon.edit') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token, coupon_id:coupon_id},
                success: function(response){
                    $('form.coupon_edit_form input[name="coupon_code"]').val(response.coupon_code);
                    $('form.coupon_edit_form input[name="valid_date"]').val(response.valid_date);
                    $('form.coupon_edit_form input[name="coupon_amount"]').val(response.coupon_amount);
                    selectType(response.id);
                    selectStatus(response.id);
                }
            });
        });

        function selectType(type){
            $.ajax({
                url:"{{ route('coupon.selectType') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,type:type},
                success:function(response){
                    if(response){
                    $('.coupon_type').html(response);
                    }
                }
            });
        }

        function selectStatus(status){
            $.ajax({
                url:"{{ route('coupon.selectStatus') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,status:status},
                success:function(response){
                    if(response){
                    $('.coupon_status').html(response);
                    }
                }
            });
        }

        $(document).on('submit', 'form.coupon_edit_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('coupon.update') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    if(response.status == 'success'){
                        table.draw();
                        $("form")[0].reset();
                        $(".coupon_edit_alert_sms").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                    }else{
                        $(".coupon_edit_alert_sms").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

                }
            });
        });

        $(document).on('click','button.delete-btn', function(){
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('coupon.delete') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    //toastr.success(response);
                    $(".coupon_table_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                    table.draw();
                }
            });
        });
    </script>
@endpush
