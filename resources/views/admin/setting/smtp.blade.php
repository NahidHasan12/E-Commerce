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
                                <li class="list-inline-item">SMTP Setting</li>
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
                <div class="col-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">SMTP Setting</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('smtp.update',$smtpData->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="mailer" class="form-label">Mailer</label>
                                    <input type="text" name="mailer" value="{{ $smtpData->mailer }}" id="mailer" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="host" class="form-label">Host</label>
                                    <input type="text" name="host" value="{{ $smtpData->host }}" id="host" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="port" class="form-label">Port</label>
                                    <input type="text" name="port" value="{{ $smtpData->port }}" id="port" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="user_name" class="form-label">User Name</label>
                                    <input type="text" name="user_name" value="{{ $smtpData->user_name }}" id="user_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" name="password" value="{{ $smtpData->password }}" id="password" class="form-control">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
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


