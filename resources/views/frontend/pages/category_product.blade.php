@extends('layouts.app')
@section('title', 'Product Details')

@section('main_nav_css_link')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_responsive.css">
@endsection

@section('content')

    {{-- main nav --}}
    @include('layouts.frontend_partial.main_nav')
    {{-- main nav --}}

    <!-- Home -->
    <div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">{{ $categoryItem->category_name }}</h2>
		</div>
	</div>

    <!-- brands -->
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">
                        <!-- Brands Slider -->
                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach ($brand as $all_brands)
                                <div class="owl-item">
                                    <div class="brands_item d-flex flex-column justify-content-center">
                                        <a href=""><img src="{{ asset('admin/brand_img/'.$all_brands->brand_logo) }}" alt="{{ $all_brands->brand_logo }}" width="60" height="50"></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">SubCategories</div>
                        <ul class="sidebar_categories">
                            @foreach ($subcategory as $categories)
                                <li><a href="{{ route('subCategory_wise.product',$categories->id) }}">{{ $categories->subcategory_name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle color_subtitle">Color</div>
                        <ul class="colors_list">
                            <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                            <li class="color"><a href="#" style="background: #000000;"></a></li>
                            <li class="color"><a href="#" style="background: #999999;"></a></li>
                            <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                            <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                            <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span>{{ count($products) }}</span> products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid row">
                        <div class="product_grid_border"></div>
                        <!-- Product Item -->
                        @foreach ($products as $item)

                            <div class="product_item discount col-lg-2">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ asset('admin/product_img/'.$item->thumbnail) }}" alt="{{ $item->name }}" height="120px">
                                </div>
								<div class="product_content">
									<div class="product_price">
                                        @if ($item->discount_price == null)
                                            {{ $web_settings->currency }} {{ $item->selling_price }}
                                        @else
                                            {{ $web_settings->currency }} {{ $item->discount_price }}
                                            <span>
                                                {{ $web_settings->currency }} {{ $item->selling_price }}
                                            </span>
                                        @endif
                                    </div>
									<div class="product_name"><div><a href="{{ route('product.details',$item->slug) }}" tabindex="0">{{ $item->name }}</a></div></div>
								</div>
								<a href="{{ route('wishlist.add',$item->id) }}">
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </a>
								<ul class="product_marks">
									<a data-toggle="modal" class="quick_modal" id="{{ $item->id }}" data-target=".bd-example-modal-lg">
                                        <li class="product_mark product_discount"> <i class="fa fa-eye"></i></li>
                                    </a>
								</ul>
							</div>
                        @endforeach


                    </div>

                    <!-- Shop Page Navigation -->

                    <div class="shop_page_nav d-flex flex-row">
                        <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                        <ul class="page_nav d-flex flex-row">
                            {{ $products->links() }}
                        </ul>
                        <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
                    </div>

                </div>



            </div>
        </div>
    </div>
</div>


	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Recently Viewed</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">

						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">

                            @foreach ($random_product as $random_products)
                                <!-- Recently Viewed Item -->
                                <div class="owl-item">
                                    <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img src="{{ asset('admin/product_img/'.$random_products->thumbnail) }}" alt="{{ $random_products->name }}" height="80%"></div>
                                        <div class="viewed_content text-center">
                                            @if ($random_products->discount_price==null)
                                                <div class="product_price" style="margin-top: 20px">{{ $web_settings->currency }} {{ $random_products->selling_price }}</div>
                                            @else
                                                <div class="product_price" style="margin-top: 20px">
                                                    <del class="text-danger">{{ $web_settings->currency }}{{ $random_products->selling_price }}</del>
                                                    {{ $web_settings->currency }}{{ $random_products->discount_price }}
                                                </div>
                                            @endif
                                            <div class="viewed_name"><a href="{{ route('product.details',$random_products->slug) }}">{{ Str::substr($random_products->name, 0, 30) }}</a></div>
                                        </div>
                                        <ul class="item_marks">
                                            <a data-toggle="modal" class="quick_modal" id="{{ $random_products->id }}" data-target=".bd-example-modal-lg">
                                                <li class="item_mark item_discount">
                                                    <i class="fa fa-eye"></i>
                                                </li>
                                            </a>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




    {{-- quick view modal  --}}

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Quick view</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="quick_view_body">

                </div>

            </div>
        </div>
    </div>

@endsection

@section('main_nav_js_link')
    <script src="{{ asset('frontend') }}/js/product_custom.js"></script>
    <script src="{{ asset('frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="{{ asset('frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="{{ asset('frontend') }}/js/shop_custom.js"></script>
@endsection

@push('web_script')
    <script>

        let _token = "{{ csrf_token() }}";
        $(document).on('click',".quick_modal",function (e) {
            e.preventDefault();
             let button_id = $(this).attr("id");
            //alert(button_id);
            $.ajax({
                url: "{{ route('quick.view') }}",
                type: "GET",
                data: {_token:_token,button_id:button_id},
                success: function (response) {
                    //alert('ok');
                    $("#quick_view_body").html(response);

                }
            });

        });


        $(document).on("submit",'form#cartForm',function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ route('add.to.cart.quickview') }}",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success: function(response) {
                    toastr.success(response);
                    $('form#cartForm')[0].reset();
                    cardCount();

                },
                error: function (response) {
                    toastr.error('Opps! cart not add');
                }
            });
        });

        function cardCount(){
			$.ajax({
				type: "post",
				url: "{{ route('cart.reload') }}",
                data: {_token:_token},
				success: function (response) {
                    $('#cartLoad').html(response.cartLoad);
                    $('#cartCount').html(response.cartCount);

				}
			});
		}


    </script>
@endpush
