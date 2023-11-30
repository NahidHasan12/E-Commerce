@extends('layouts.app')
@section('title', 'Product Details')

@section('main_nav_css_link')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_responsive.css">
@endsection

@section('nav')
    {{-- main nav --}}
    @include('layouts.frontend_partial.main_nav')
    {{-- main nav --}}
@endsection

@section('content')

    <!-- Home -->
    <div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
		    <h2 class="home_title">Track Your Order Now</h2>
		</div>
	</div>


<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">My Order Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row my-3">
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
            </div>
            <div class="col-4">
                <div class="card">
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
    </div>
</div>

<hr>


@endsection

@section('main_nav_js_link')
    <script src="{{ asset('frontend') }}/js/product_custom.js"></script>
    <script src="{{ asset('frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="{{ asset('frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="{{ asset('frontend') }}/js/shop_custom.js"></script>
@endsection

