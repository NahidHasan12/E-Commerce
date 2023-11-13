@extends('layouts.app')
@section('title', 'Product Details')

@section('main_nav_css_link')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
@endsection

@section('content')

    {{-- main nav --}}
    @include('layouts.frontend_partial.main_nav')
    {{-- main nav --}}

    <div class="cart_section">
		<div class="container">
            <h3 class="text-center"> Checkout Here </h3>
            <div class="card">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header"><h4 class="card-title">Billing Address</h4></div>
                            <div class="card-body">
                                <form action="{{ route('order.place') }}" method="post">
                                    @csrf
                                    <div class="row p-4">
                                        <div class="form-group col-lg-6">
                                            <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                                            <input type="text" name="c_name" id="customer_name" value="{{ Auth::user()->name }}" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_phone" class="form-label" >Customer Phone <span class="text-danger">*</span></label>
                                            <input type="text" name="c_phone" id="customer_phone" value="{{ Auth::user()->phone }}" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_country" class="form-label">Country <span class="text-danger">*</span> </label>
                                            <input type="text" name="c_country" id="customer_country" class="form-control" placeholder="country.." required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_address" class="form-label">Shipping Address <span class="text-danger">*</span></label>
                                            <input type="text" name="c_address" id="customer_address" class="form-control" placeholder="address.." required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="c_email" id="customer_email" class="form-control" placeholder="example@gmail.com.." required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_zipCode" class="form-label">Zip Code <span class="text-danger">*</span></label>
                                            <input type="text" name="c_zipCode" id="customer_zipCode" class="form-control" placeholder="zip code.." required>
                                        </div>
                                    </div>
                                    <strong class="text-primary">--Payment Type--</strong>
                                    <div class="d-block my-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="payment_type" value="paypal" class="form-check-input" id="payment_type">
                                            <label class="form-check-label" for="payment_type"> Paypal </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="payment_type" value="amarpay" class="form-check-input" id="payment_type">
                                            <label class="form-check-label" for="payment_type"> Bikas/Nagad/Roket/Upay </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="payment_type" value="Hand Cash" checked class="form-check-input" id="payment_type">
                                            <label class="form-check-label" for="payment_type"> Hand Cash </label>
                                        </div>
                                    </div>
                                    <span>Prograssing....</span>
                                    <div class="card-footer">
                                        <button style="float: right; cursor:pointer" type="submit" class="btn btn-sm btn-outline-info">Order Place</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-4">
                        <!-- Order Total -->
                        <div class="card">
                            <div class="card-header"><h4 class="card-title">Payment Area</h4></div>
                            <div class="card-body">
                                <div class="pl-4 pt-2">
                                    <p style="color: black">
                                        <b>Subtotal : </b>
                                        <span style="float: right"> {{ Cart::subtotal() }} <b style="color: chocolate">{{ $web_settings->currency }}</b> </span>
                                    </p>
                                    {{-- Coupon Apply --}}
                                    @if (Session::has('coupon'))
                                        <p style="color: black">
                                            <b>Coupon : </b> ({{ Session::get('coupon')['name'] }})
                                            <a title="Click to Coupon Removed" class="btn btn-sm btn-outline-warning ml-1" href="{{ route('remove.coupon') }}">x</a>
                                            <span style="float: right"> {{ Session::get('coupon')['discount'] }} <b style="color: chocolate">{{ $web_settings->currency }}</b> </span>
                                        </p>
                                    @else
                                        <p style="color: black">
                                            <b>Coupon : </b>
                                            <span style="float: right"> (Coupon Name) </span>
                                        </p>
                                    @endif

                                    <p style="color: black">
                                        <b>Tax : </b> <span style="float: right">0.00 %</span>
                                    </p>
                                    <p style="color: black">
                                        <b>Shipping : </b>  <span style="float: right">0.00 <b style="color: chocolate">{{ $web_settings->currency }}</b></span>
                                    </p>
                                    {{-- Coupon Apply --}}
                                    @if (Session::has('coupon'))
                                        <p style="color: black">
                                            <b>Total : </b> <span style="float: right">{{ Session::get('coupon')['main_balance'] }} <b style="color: chocolate">{{ $web_settings->currency }}</b></span>
                                        </p>
                                    @else
                                        <p style="color: black">
                                            <b>Total : </b> <span style="float: right">{{ Cart::total() }} <b style="color: chocolate">{{ $web_settings->currency }}</b></span>
                                        </p>
                                    @endif

                                </div>
                                <hr>
                                @if (!Session::has('coupon'))
                                    <form action="{{ route('apply.coupon') }}" method="post">
                                        @csrf
                                        <div class="p-4">
                                            <div class="form-group">
                                                <label for="cupon_apply" class="form-label">Cupon Apply</label>
                                                <input type="text" name="cupon_apply" id="cupon_apply" class="form-control" placeholder="cupon code.." required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-info">Apply Cupon</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                            <div class="card-footer">
                                <a style="float: right" type="submit" href="" class="btn btn-sm btn-outline-info">Payment Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>


@endsection

@section('main_nav_js_link')
    <script src="{{ asset('frontend') }}/js/cart_custom.js"></script>
@endsection

@push('web_script')

<script>
    let _token = "{{ csrf_token() }}";



</script>
@endpush
