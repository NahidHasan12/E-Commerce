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
                                    <a href="#">Child Category</a>
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
        <div class="childcat_alert"> </div>
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Child Category Data</h3>
            <button class="btn btn-sm btn-primary" onclick="addBtn()" data-toggle="modal" data-target="#childCategoryStore">Add New</button>
        </div>
        <div class="card-body">
            <table id="childcat_table" class="table table-bordered table-striped">
               <thead>
                    <tr>
                        <th>Id</th>
                        <th>Childcategory Name</th>
                        <th>Childcategory Slug</th>
                        <th>Category Name</th>
                        <th>SubCategory Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="childCatData">

                </tbody>

            </table>
        </div>
    </div>



   <!-- Store Modal -->
   @include('admin.category.child_cat.modal.store')

   <!-- Edit Modal -->
   @include('admin.category.child_cat.modal.edit')



</section>

@endsection


@push('scripts')

    <script>

        //Get Sub Category Data with DataTables
        let _token = "{{ csrf_token() }}";


        //Fatch Child Category
        function fatch_childCat(){
            $.ajax({
                url:"{{ route('child_cat.fatchData') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token},
                success: function(response){
                    //alert('ok')
                    $('tbody#childCatData').html(response);
                }
            });
        }
        fatch_childCat();

        //Category wise Sub Category select
        $(document).ready(function(){
            $('#category_id').on('change', function(){
                var category_id =$(this).val();
                //alert(category_id)
                if(category_id){
                    $.ajax({
                        url:"sub_cat/"+category_id,
                        type:"get",
                        dataType:"json",
                        success:function(data){
                            $('#subcategory_id').empty().prop('disabled', false);
                            $.each(data, function(key,subCategory){
                                $('#subcategory_id').append('<option value="'+subCategory.id+'">'+subCategory.subcategory_name+'</option>');
                            });
                        },
                        error:function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }else{
                    $('#subcategory_id').empty().prop('disabled', true);
                }
            });
        });

        //Store Child Category
        $(document).on('submit', 'form.childcat_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('child_cat.store') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){
                    //Form Validation Code start
                    $('form.childcat_form').find('.error_msg').remove();
                    if(response.status == false){
                        $.each(response.errors, function(key,value){
                        // console.log(response.errors);
                            $('form.childcat_form #'+key).parent().append('<span class="text-danger error_msg">'+value+'</span>');
                        });
                            //Form Validation Code end
                        }else{

                        if(response.status == 'success'){
                            $("form")[0].reset();
                            $(".child_cat_store_alert").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                            fatch_childCat();
                        }else{
                            $(".child_cat_store_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                        }
                    }


                }
            });
        });


        //Edit Child Category
        $(document).on('click','button.edit-btn', function(){
             let data_id = $(this).data('id');
            $('form.edit_childcat_form input[name="update"]').val(data_id);
            $.ajax({
                url:"{{ route('child_cat.edit') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    //category_select(response.id);
                    $('form.edit_childcat_form input[name="child_cat_name"]').val(response.childcategory_name);
                    $('form.edit_childcat_form input[name="child_cat_slug"]').val(response.childcategory_slug);
                }
            });
        });


        //Update Child Category
        $(document).on('submit', 'form.edit_childcat_form', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('child_cat.update') }}",
                type: "post",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success: function(response){

                    if(response.status == 'success'){
                        $("form")[0].reset();
                        $(".edit_alert_sms").append('<span class="alert alert-success d-block">'+response.message+'</span>');
                        fatch_childCat();
                    }else{
                        $(".edit_alert_sms").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    }
                }
            });
        });

        // Delete Child Category
        $(document).on('click','button.delete-btn', function(){
            let data_id = $(this).data('id');

            $.ajax({
                url:"{{ route('child_cat.delete') }}",
                type:"post",
                dataType:"json",
                data:{_token:_token,data_id:data_id},
                success:function(response){
                    $(".childcat_alert").append('<span class="alert alert-danger d-block">'+response.message+'</span>');
                    fatch_childCat();
                }
            });
        });

    </script>

@endpush
