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
                                <li class="list-inline-item">Payment Gateway Setting</li>
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
                <div class="col-4 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">AamarPay Payment Gateway</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('payment.update.aamarpay') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $aamarpay->id }}">
                                <div class="mb-3">
                                    <label for="mailer" class="form-label">Store ID</label>
                                    <input type="text" name="store_id" value="{{ $aamarpay->store_id }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="host" class="form-label">Signature Key</label>
                                    <input type="text" name="signature_key" value="{{ $aamarpay->signature_key }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="amarpayckeckbox" name="status" value="1" @if($aamarpay->status==1) checked @endif >
                                    <label for="amarpayckeckbox"> LIVE</label> <br>
                                    <small>if checkbox are not check it work for sendbox </small>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">ShurjoPay Payment Gateway</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('payment.update.shurjopay') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $shurjopay->id }}">
                                <div class="mb-3">
                                    <label for="mailer" class="form-label">Store ID</label>
                                    <input type="text" name="store_id" value="{{ $shurjopay->store_id }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="host" class="form-label">Signature Key</label>
                                    <input type="text" name="signature_key" value="{{ $shurjopay->signature_key }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="amarpayckeckbox" name="status" value="1" @if($shurjopay->status==1) checked @endif >
                                    <label for="amarpayckeckbox"> LIVE</label> <br>
                                    <small>if checkbox are not check it work for sendbox </small>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">SSL Commerz Payment Gateway</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $ssl->id }}">
                                <div class="mb-3">
                                    <label for="mailer" class="form-label">Store ID</label>
                                    <input type="text" name="store_id" value="{{ $ssl->store_id }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="host" class="form-label">Signature Key</label>
                                    <input type="text" name="signature_key" value="{{ $ssl->signature_key }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="amarpayckeckbox" name="status" value="1" @if($ssl->status==1) checked @endif >
                                    <label for="amarpayckeckbox"> LIVE</label> <br>
                                    <small>if checkbox are not check it work for sendbox </small>
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






