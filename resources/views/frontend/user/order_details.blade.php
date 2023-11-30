@extends('layouts.app')
@section('title', 'User Dashboard')
@section('web_style')
    <style type="text/css" media="screen">
        .profile-image{
        position: relative;
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
        }

        .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 23%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

        /*.text:hover {
        opacity: 0.3;
        }*/

        .middle:hover {
        opacity: 0.8;
        }

        .text {
        background-color: #04AA6D;
        color: white;
        font-size: 16px;
        padding: 16px 32px;
        }
        .list li{
            border-top:2px sloid rgb(14, 13, 13);
        }
    </style>
@endsection

    @section('navbar')
        {{-- @include('website.include.navbar') --}}
    @endsection

@section('content')



  <div class="container mt-4">

    @include('frontend.include.user.header')



    <div class="row">
      <div class="col-md-4">

        @include('frontend.include.user.profile')

      </div>
      <div class="col-md-8">

        <div class="card">
          <div class="card-body">
            <div class="row my-3">

                <h4 class="card-title ml-2"> My Order Details</h4>
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Product</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Price</th>
                    <th scope="col">SubTotal</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($order_details as $key=>$item)
                            <tr>
                                <th>{{ ++$key }}</th>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->color }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td><b class="text-primary">{{ $web_settings->currency }}</b> {{ $item->single_price }}</td>
                                <td><b class="text-primary">{{ $web_settings->currency }}</b> {{ $item->subtotal_price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Oder</h4>
            </div>
            <div class="card-body">
                <b>Name : </b>{{ $order->c_name }} <hr>
                <b>Phone : </b> {{ $order->c_name }} <hr>
                <b>Status : </b>
                    @if($order->status == 0)
                        <span class="badge badge-warning">Order Pending</span>
                    @elseif ($order->status == 1)
                        <span class="badge badge-info">Order Received</span>
                    @elseif ($order->status == 2)
                        <span class="badge badge-primary">Order Shipped</span>
                    @elseif ($order->status == 3)
                        <span class="badge badge-success">Order Complete</span>
                    @elseif ($order->status == 4)
                        <span class="badge badge-warning">Order Return</span>
                    @elseif ($order->status == 5)
                        <span class="badge badge-danger">Order Cancel</span>
                    @endif
                <hr>
                <b>Date : </b>{{ date('d-M-Y', strtotime($order->date)) }} <hr>
                <b>SubTotal : </b> <b class="text-primary">{{ $web_settings->currency }}</b> {{ $order->subtotal }} <hr>
                <b>Total : </b><b class="text-primary">{{ $web_settings->currency }}</b>  {{ $order->total }} <hr>
            </div>
        </div>
    </div>
  </div>

@endsection

@push('web_script')
    <script>


    </script>

@endpush
