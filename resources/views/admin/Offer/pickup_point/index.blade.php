@extends('layouts.admin')
@section('title','SuperAdmin- Pickup Point')
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
                                    <a href="#">Pickup Point</a>
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
        <div class="pickup_table_alert"> </div>
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Pickup Point Data</h3>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#pickup_point">Add New</button>
        </div>
        <div class="card-body">
            <table id="pickup_table" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>Id</th>
                        <th>Pickup Point Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Another Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>



   <!-- Store Modal -->
   @include('admin.Offer.pickup_point.modal.create')

   <!-- Edit Modal -->
   @include('admin.Offer.pickup_point.modal.edit')



</section>

@endsection
@push('scripts')
    <script>
        let _token = "{{ csrf_token() }}";
        let table = $('#pickup_table').DataTable({
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
                url: "{{ route('pickup_point.getData') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'pickup_point_name'},
                {data: 'address'},
                {data: 'phone'},
                {data: 'another_phone'},
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

        $(document).on('submit', 'form.pickup_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('pickup_point.store') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    if(response.status == 'success'){
                        table.draw();
                        $("form")[0].reset();
                        $(".pickup_alert_sms").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                    }else{
                        $(".pickup_alert_sms").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

                }
            });
        });

        $(document).on('click','button.edit-btn', function(){
            let pickup_id = $(this).data('id');
            $('form.pickup_edit_form input[name="update"]').val(pickup_id);
            $.ajax({
                url:"{{ route('pickup_point.edit') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token, pickup_id:pickup_id},
                success: function(response){
                    $('form.pickup_edit_form input[name="pickup_point_name"]').val(response.pickup_point_name);
                    $('form.pickup_edit_form input[name="address"]').val(response.address);
                    $('form.pickup_edit_form input[name="phone"]').val(response.phone);
                    $('form.pickup_edit_form input[name="another_phone"]').val(response.another_phone);
                }
            });
        });

        $(document).on('submit', 'form.pickup_edit_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('pickup_point.update') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    if(response.status == 'success'){
                        table.draw();
                        $("form")[0].reset();
                        $(".pickup_edit_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');

                    }else{
                        $(".pickup_edit_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }

                }
            });
        });

        $(document).on('click','button.delete-btn', function(){
            let data_id = $(this).data('id');
            $.ajax({
                url:"{{ route('pickup_point.delete') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    //toastr.success(response);
                    $(".pickup_table_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                    table.draw();
                }
            });
        });

    </script>
@endpush
