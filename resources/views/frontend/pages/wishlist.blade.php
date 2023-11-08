@extends('layouts.app')
@section('title', 'Product Details')

@section('main_nav_css_link')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
@endsection

@section('nav')
    {{-- main nav --}}
    @include('layouts.frontend_partial.main_nav')
    {{-- main nav --}}
@endsection

@section('content')

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Wishlist</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($products as $wish_product)

                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image">
                                            <img src="{{ asset('admin/product_img/'.$wish_product->product->thumbnail) }}" alt="{{ $wish_product->product->name }}" width="80" height="80">
                                        </div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_text">{{ Str::substr($wish_product->product->name, 0, 30) }}</div>
                                            </div>




                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_text">
                                                    @if ($wish_product->product->discount_price == null)
                                                        {{ $web_settings->currency }} {{ $wish_product->product->selling_price }}
                                                    @else
                                                    {{ $web_settings->currency }} {{ $wish_product->product->discount_price }} </div>
                                                    @endif
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_text"> {{ $wish_product->product->created_at->format('d/m/Y') }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_text">
                                                    <a href="{{ route('product.details',$wish_product->product->slug) }}" class="btn btn-danger btn-sm text-white px-2 "> Add to cart </a>
                                                </div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_text">
                                                    <a href="{{ route('wishlist.product.remove',$wish_product->id) }}" class="btn btn-danger btn-sm text-white px-2"> x </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">{{ $web_settings->currency }} {{ Cart::total() }} </div>
                            </div>
                        </div>

                        <div class="cart_buttons">
                            <a href="{{ route('wishlist.empty') }}" type="button" class="btn btn-outline-danger">Clear Wishlist</a>
                            <a href="{{ url('/') }}" type="button" class="btn btn-outline-info">Back to home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('main_nav_js_link')
    <script src="{{ asset('frontend') }}/js/product_custom.js">
    </script><script src="{{ asset('frontend') }}/js/cart_custom.js"></script>
@endsection

@push('web_script')
<script>

</script>
@endpush
