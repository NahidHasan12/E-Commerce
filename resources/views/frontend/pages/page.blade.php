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
            @isset($page->page_title)
			    <h2 class="home_title">{{ $page->page_title }}</h2>
            @endisset
		</div>
	</div>


<div class="shop">
    <div class="container">
        <div class="row">
            {!! $page->page_description !!}
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

