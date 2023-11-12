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
                                <form action="" method="">
                                    <div class="row p-4">
                                        <div class="form-group col-lg-6">
                                            <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                                            <input type="text" name="customer_name" id="customer_name" value="{{ Auth::user()->name }}" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_phone" class="form-label" >Customer Phone <span class="text-danger">*</span></label>
                                            <input type="text" name="customer_phone" id="customer_phone" value="{{ Auth::user()->phone }}" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_country" class="form-label">Country <span class="text-danger">*</span> </label>
                                            <input type="text" name="customer_country" id="customer_country" class="form-control" placeholder="country.." required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_address" class="form-label">Shipping Address <span class="text-danger">*</span></label>
                                            <input type="text" name="customer_address" id="customer_address" class="form-control" placeholder="address.." required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="customer_email" id="customer_email" class="form-control" placeholder="example@gmail.com.." required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_zipCode" class="form-label">Zip Code <span class="text-danger">*</span></label>
                                            <input type="text" name="customer_zipCode" id="customer_zipCode" class="form-control" placeholder="zip code.." required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_extraAddress" class="form-label">Extra Address</label>
                                            <input type="text" name="customer_extraAddress" id="customer_extraAddress" class="form-control" placeholder="extra address..">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="customer_extraPhone" class="form-label">Extra Phone</label>
                                            <input type="text" name="customer_extraPhone" id="customer_extraPhone" class="form-control" placeholder="extra phone.." required>
                                        </div>
                                    </div>
                                    <strong class="text-primary">--Payment Type--</strong>
                                    <div class="d-block my-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="payment_type" class="form-check-input" id="payment_type">
                                            <label class="form-check-label" for="payment_type"> Paypal </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="payment_type" class="form-check-input" id="payment_type">
                                            <label class="form-check-label" for="payment_type"> Bikas/Nagad/Roket/Upay </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="payment_type" checked class="form-check-input" id="payment_type">
                                            <label class="form-check-label" for="payment_type"> Hand Cash </label>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a style="float: right" type="submit" href="{{ route('checkout') }}" class="btn btn-sm btn-outline-info">Order Place</a>
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
                                <form action="" method="">
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
                            </div>
                            <div class="card-footer">
                                <a style="float: right" type="submit" href="{{ route('checkout') }}" class="btn btn-sm btn-outline-info">Payment Now</a>
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

    $(document).on('click',".cart_remove",function (e) {
        e.preventDefault();
        let button_id = $(this).attr("id");

        $.ajax({
            url: "{{ route('cart.remove') }}",
            type: "POST",
            async:false,
            data: {_token:_token,button_id:button_id},
            success: function (response) {
                location.reload();
                toastr.success(response);
            }
        });
    });

     // cart qty
    $(document).on('blur','.qty',function() {
        let qty = $(this).val();
        let cartId = $(this).data('id');
        $.ajax({
            url: "{{ route('cart.qty.update') }}",
            type: "POST",
            data: {_token:_token,qty:qty,cartId:cartId},
            success: function (response) {
                location.reload();
                toastr.success(response);
            }
        });
    })
    // cart color
    $(document).on('change','.color',function() {
        let color = $(this).val();
        let cartId = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.color.update') }}",
            type: "POST",
            data: {_token:_token,color:color,cartId:cartId},
            success: function (response) {
                location.reload();
                toastr.success(response);
            }
        });
    })

     // cart size
     $(document).on('change','.size',function() {
        let size = $(this).val();
        let cartId = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.size.update') }}",
            type: "POST",
            data: {_token:_token,size:size,cartId:cartId},
            success: function (response) {
                location.reload();
                toastr.success(response);
            }
        });
    })

</script>
@endpush
