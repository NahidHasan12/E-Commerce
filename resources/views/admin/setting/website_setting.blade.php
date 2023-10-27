@extends('layouts.admin')
@section('title','Super Admin')
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
                                <li class="list-inline-item">Website Setting</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- STATISTIC-->
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Website Setting</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('web_setting.update',$web_setting->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="currency" class="form-label">currency</label>
                                            <select name="currency" id="currency" class="form-control">
                                                <option value="$" {{ $web_setting->currency == "$" ? "selected" : ''}}>USD ($)</option>
                                                <option value="৳" {{ $web_setting->currency == "৳" ? "selected" : ''}}>TAKA (৳)</option>
                                                <option value="₹" {{ $web_setting->currency == "₹" ? "selected" : ''}}>Rupee (₹)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_one" class="form-label">Phone One</label>
                                            <input type="text" name="phone_one" value="{{ $web_setting->phone_one }}" id="phone_one" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_two" class="form-label">Phone Two</label>
                                            <input type="text" name="phone_two" value="{{ $web_setting->phone_two }}" id="phone_two" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="main_email" class="form-label">Main Email</label>
                                            <input type="text" name="main_email" value="{{ $web_setting->main_email }}" id="main_email" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="support_mail" class="form-label">Support EMail</label>
                                            <input type="text" name="support_mail" value="{{ $web_setting->support_mail }}" id="support_mail" class="form-control">
                                        </div>
                                        <div class="mb-0">
                                            <label for="logo" class="form-label">Logo</label>
                                            <input type="file" name="logo" id="logo" class="form-control">
                                            <img class="mt-1" src="{{ asset('admin/logo_favicon/'.$web_setting->logo) }}" alt="" width="60" height="55">
                                        </div>
                                        <div class="mb-0">
                                            <label for="favicon" class="form-label">Favicon</label>
                                            <input type="file" name="favicon" id="favicon" class="form-control">
                                            <img class="mt-1" src="{{ asset('admin/logo_favicon/'.$web_setting->favicon )}}" alt="" width="60" height="55">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-primary py-1"> --- Others Option ---</div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" name="address" value="{{ $web_setting->address }}" id="address" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input type="text" name="facebook" value="{{ $web_setting->facebook }}" id="facebook" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="twitter" class="form-label">Twitter</label>
                                            <input type="text" name="twitter" value="{{ $web_setting->twitter }}" id="twitter" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="linkedin" class="form-label">Linkedin</label>
                                            <input type="text" name="linkedin" value="{{ $web_setting->linkedin }}" id="linkedin" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="youtube" class="form-label">Youtube</label>
                                            <input type="text" name="youtube" value="{{ $web_setting->youtube }}" id="youtube" class="form-control">
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-sm btn-primary">Update & Change</button>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
    {{-- <script>
        let _token = "{{ csrf_token() }}";

        $(document).on('click', 'button.edit-btn', function(){
        let data_id = $(this).data('id');
        $('form.cat_form_edit input[name="update"]').val(data_id);
        $.ajax({
            url:"{{ route('category.edit') }}",
            type: "post",
            dataType:"json",
            data:{_token:_token,data_id:data_id},
            success:function(response){
                $('form.cat_form_edit input[name="category_name"]').val(response.category_name);
                $('form.cat_form_edit input[name="category_slug"]').val(response.category_slug);
            }
        });

    });
    </script> --}}
@endpush

