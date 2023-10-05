<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="{{ asset('admin') }}/css/font-face.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <!-- DataTables CSS-->
 <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet">

</head>
<body>


   <div class="container mt-5">
    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-sm btn-primary click-btn">Ajax</button>
                    <h1 id="h1"></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="alert"></div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-flex justify-content-between">Students Data
                    <button type="button" class="btn btn-sm btn-primary add_new" onclick="save_btn('New Student','Save & Changes')">Add New</button>
                </h4>
            </div>
            <div class="card-body">
                <div class="col-12 mb-3">
                <div class="table-responsive mx-auto">
                    <table id="student_table" class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Roll</th>
                                <th>Registration</th>
                                <th>Board</th>
                                <th>session</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="stu_data">

                        </tbody>
                    </table>
                </div>
                </div>
        </div>
    </div>

    </div>
   </div>

   @include('ajax.curd.modal')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

     {{-- =================== Datatables Script ================== --}}
     <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

<script>

//=========DataTable Code Start =======//


let _token = "{{ csrf_token() }}";
let table = $('#student_table').DataTable({
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
                url: "{{ route('ajax.getData') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'avater'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'roll'},
                {data: 'reg'},
                {data: 'board'},
                {data: 'session'},
                {data: 'action'},
            ],
            language: {
                processing: '<img src="{{ asset('/table-loader.gif') }}">',
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









//======DataTable Code End=============//


    //Modal Show
    $(document).on('click','button.add_new', function(){
        $('#student_modal').modal('show');

    });
    //Modal Hide
    $(document).on('click','button.close', function(){
        $('#student_modal').modal('hide')

    });

    //Modal Title  and submit Button text dynamic
    function save_btn(modal_title,save_btn_text){
        $('form.ajax_form').find('.error_msg').remove();

        $('form.ajax_form input[name="update"]').val('');
        $('form.ajax_form').removeClass('update_form');

        $("form.ajax_form")[0].reset();
        $('form.ajax_form #pro_img').html("");
        $("#select_board").html(`
            <label for="board" class="form-label">Board</label>
            <select name="board" class="form-control form-control-sm">
                <option value="">Select Please</option>
                <option value="dhaka">Dhaka</option>
                <option value="rajshahi">Rajshahi</option>
                <option value="rangpur">Rangpur</option>
            </select>
        `);
        $("h5#modal-title").text(modal_title);
        $("button#save-btn").text(save_btn_text);
    }



    //Curd Operation
    //Student Data Store
    //===================


    $(document).on('submit', 'form.ajax_form', function(e){
        e.preventDefault();

        //let form = document.getElementById('ajax_form');
        //let form_data = new FormData(form);
         //console.log(form_data);
        $.ajax({
            url: "{{ route('ajax.store') }}",
            type: "post",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                 //Form Validation Code start
                 $('form.ajax_form').find('.error_msg').remove();
                 if(response.status == false){
                    $.each(response.errors, function(key,value){
                       // console.log(response.errors);
                        $('form.ajax_form #'+key).parent().append('<span class="text-danger error_msg">'+value+'</span>');
                    });
                         //Form Validation Code end
                    }else{

                       if(response.status == 'success'){
                            $("form")[0].reset();
                            $(".alert-message").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                            stu_data_fatch();
                        }else{
                            $(".alert-message").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                        }
                    }


            }
        });
    });

     //Student Data fatch
    //===================
    function stu_data_fatch(){
        $.ajax({
            url:"{{ route('ajax.getData') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token},
            success: function(response){
                $("tbody#stu_data").html(response);
            }

        });
    }
    stu_data_fatch();


    //Student data edit
    //==================
    $(document).on('click','button.edit-btn', function(){
        //modal code start
        $("h5#modal-title").text('Student Data Edit');
        $("button#save-btn").text('Save & Change');
        $('form.ajax_form').addClass('update_form');
        $('form.update_form').removeClass('ajax_form');

        // modal code end
        let student_id = $(this).data('id');
        $('form.update_form input[name="update"]').val(student_id);
        $.ajax({
            url:"{{ route('ajax.editData') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token, student_id:student_id},
            success: function(response){
                let img_src = "{{ asset('ajax/img') }}/"+response.avater;
                $('form.update_form input[name="name"]').val(response.name);
                $('form.update_form input[name="email"]').val(response.email);
                $('form.update_form input[name="phone"]').val(response.phone);
                $('form.update_form input[name="roll"]').val(response.roll);
                $('form.update_form input[name="reg"]').val(response.reg);
                $('form.update_form input[name="session"]').val(response.session);
                $('form.update_form #pro_img').html('<img src="'+img_src+'" alt="'+response.name+'" width="60px">');
                student_board(response.id);

            }

        });
        $('#student_modal').modal('show');
    });

    // Select Student Board
    function student_board(id){
        //alert(id);
        $.ajax({
            url:"{{ route('ajax.selectBoard') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token,student_id:id},
            success: function(response){
                    // alert('ok');
                if(response){
                    $("#select_board").html(response);
                }
            }
        })
    }

    //student data update

    $(document).on('submit', 'form.update_form', function(e){
        e.preventDefault();
        //let form = document.getElementById('ajax_form');
        //let form_data = new FormData(form);
         //console.log(form_data);
        $.ajax({
            url: "{{ route('ajax.updateData') }}",
            type: "post",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                 //Form Validation Code start
                 $('form.ajax_form').find('.error_msg').remove();
                 if(response.status == false){
                    $.each(response.errors, function(key,value){
                       // console.log(response.errors);
                        $('form.ajax_form #'+key).parent().append('<span class="text-danger error_msg">'+value+'</span>');
                    });
                         //Form Validation Code end
                    }else{

                       if(response.status == 'success'){
                            $("form")[0].reset();
                            $(".alert-message").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                            stu_data_fatch();
                        }else{
                            $(".alert-message").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                        }
                    }


            }
        });
    });



    //Student data delete
    //==================
    $(document).on('click','button.delete-btn', function(){
        let student_id = $(this).data('id');
        alert(student_id);
        $.ajax({
            url:"{{ route('ajax.delete') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token,student_id:student_id},
            success:function(response){
                $(".alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                stu_data_fatch();
            }
        });
    });



</script>







   <script>
    let para = $("#para").text();
   $(document).on("click",".click-btn",function() {
    //alert(para);
        $.ajax({
            url:"{{ route('ajax.request') }}",
            type: "get",
            data:{para_text:para},
            success: function(response){
                $("#h1").text(response.data);
            }
        });
    });

   </script>



</body>
</html>
