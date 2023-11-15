@extends('layouts.admin')
@section('title','SuperAdmin- Suport Ticket')
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
                                    <a href="#">Ticket</a>
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
    <div class="card mt-2">
        <div class="card-header p-3">
            <h4> All Ticket </h4>
        </div>

        <div class="row p-2">
            <div class="form-group col-4">
                <label for="">Ticket Type</label>
                <select name="type" class="form-control submitable" id="type">
                    <option value="">All</option>
                    <option value="technical">Technical</option>
                    <option value="payment">Payment</option>
                    <option value="affiliate">Affiliate</option>
                    <option value="return">Return</option>
                    <option value="refund">Refund</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="date">Date</label>
                <input type="date" class="form-control submitable" id="date">
            </div>

            <div class="form-group col-4">
                <label for="">Status</label>
                <select name="status" class="form-control submitable" id="status">
                    <option value="">All</option>
                    <option value="0">Pending</option>
                    <option value="1">Replied</option>
                    <option value="2">Closed</option>
                </select>
            </div>

        </div>

        <div class="card-body">
            <table class="table table-sm" id="ticket_table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>User</th>
                        <th>Subject</th>
                        <th>Service</th>
                        <th>Priority</th>
                        <th>Date</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</section>

@endsection

@push('scripts')
    <script>
         let _token = "{{ csrf_token() }}";
        //Fatch Data With DataTable
        let table = $('#ticket_table').DataTable({
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
                url: "{{ route('ticket.get_ticket') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'subject'},
                {data: 'service'},
                {data: 'priority'},
                {data: 'date'},
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

        // Filtering
        $(document).on('change','.submitable',function () {
            $('#ticket_table').DataTable().ajax.reload();
        });

    </script>
@endpush

