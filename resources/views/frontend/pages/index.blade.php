
@extends('layouts.app')
@section('title', 'Home Page')
@section('content')

     <!-- Home Navigation -->
     @include('layouts.frontend_partial.home_nav')
     <!-- Menu -->

    <!-- Banner -->
    <div class="banner">
        <div class="banner_background" style="background-image:url({{ asset('frontend') }}/images/banner_background.jpg)"></div>
        <div class="container fill_height">
            <div class="row fill_height">
                {{-- <div class="banner_product_image"><img src="{{ asset('admin/product_img/'.$product->thumbnail.'') }}" alt="{{ $product->name }}"></div> --}}
                <div class="banner_product_image"><img src="{{ asset('admin/product_img/'.$slider_product->thumbnail) }}" alt="{{ $slider_product->name }}"></div>
                <div class="col-lg-5 offset-lg-4 fill_height">
                    <div class="banner_content">
                        <h1 class="banner_text">new era of smartphones</h1>
                        @if ($slider_product->discount_price == NULL)
                           <div class="banner_price">{{ $web_settings->currency }}{{ $slider_product->selling_price }}</div>
                        @else
                           <div class="banner_price"><span>{{ $web_settings->currency }}{{ $slider_product->discount_price }}</span>{{ $web_settings->currency }}{{ $slider_product->selling_price }}</div>
                        @endif

                        <div class="banner_product_name">{{ $slider_product->name }}</div>
                        <div class="button banner_button"><a href="{{ route('product.details',$slider_product->slug) }}">Shop Now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach ($brand as $brand)
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <img width="70" height="50" src="{{ asset('admin/brand_img/'.$brand->brand_logo) }}" alt="{{ $brand->brand_name }}">
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


    <!-- Deals of the week -->

    <div class="deals_featured">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                    <!-- Deals -->

                    <div class="deals">
                        <div class="deals_title">Deals of the Week</div>
                        <div class="deals_slider_container">

                            <!-- Deals Slider -->
                            <div class="owl-carousel owl-theme deals_slider">

                                <!-- Deals Item -->
                              @foreach ($today_deal as $deal)
                                <div class="owl-item deals_item">
                                    <div class="deals_image"><img src="{{ asset('admin/product_img/'.$deal->thumbnail) }}" alt="{{ $deal->name }}"></div>
                                    <div class="deals_content">
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_category">{{ $deal->category->category_name }} > {{ $deal->subcategory->subcategory_name }}</div>
                                            @if ($deal->discount_price==null)
                                                <div class="deals_item_price_a ml-auto mt-1">{{ $web_settings->currency }} {{ $deal->selling_price }}</div>
                                            @else
                                                <div class="deals_item_price_a ml-auto mt-1">
                                                    <del class="text-danger">{{ $web_settings->currency }}{{ $deal->selling_price }}</del>
                                                    {{ $web_settings->currency }}{{ $deal->discount_price }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <a href="{{ route('product.details',$deal->slug) }}">
                                                <div class="deals_item_name">{{ substr($deal->name,0,30)  }}..</div>
                                            </a>
                                        </div>
                                        <div class="available">
                                            <div class="available_line d-flex flex-row justify-content-start">
                                                <div class="available_title">Available: <span>{{ $deal->stock_quantity }}</span></div>
                                                <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                                            </div>
                                            <div class="available_bar"><span style="width:50%"></span></div>
                                        </div>
                                        <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                            <div class="deals_timer_title_container">
                                                <div class="deals_timer_title">Hurry Up</div>
                                                <div class="deals_timer_subtitle">Offer ends in:</div>
                                            </div>
                                            <div class="deals_timer_content ml-auto">
                                                <div class="deals_timer_box clearfix" data-target-time="">
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="deals_slider_nav_container">
                            <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                            <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="featured">
                        <div class="tabbed_container">
                            <div class="tabs">
                                <ul class="clearfix">
                                    <li class="active">Featured</li>
                                    <li>Popular</li>
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="featured_slider slider">

                                    @foreach ($featured as $item)
                                        <!-- Slider Item -->
                                        <div class="featured_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                    <img src="{{ asset('admin/product_img/'.$item->thumbnail) }}" alt="{{ $item->name }}" height="70%" width="60%">
                                                </div>
                                                <div class="product_content">
                                                    @if ($item->discount_price==null)
                                                        <div class="product_price" style="margin-top: 20px">{{ $web_settings->currency }} {{ $item->selling_price }}</div>
                                                    @else
                                                        <div class="product_price" style="margin-top: 20px">
                                                            <del class="text-danger">{{ $web_settings->currency }}{{ $item->selling_price }}</del>
                                                            {{ $web_settings->currency }}{{ $item->discount_price }}
                                                        </div>
                                                    @endif
                                                    <div class="product_name"><div><a href="{{ route('product.details',$item->slug) }}">{{ substr($item->name,0,30)  }}..</a></div></div>
                                                    <div class="product_extras">
                                                        <a data-toggle="modal" class="quick_modal" id="{{ $item->id }}" data-target=".bd-example-modal-lg">quick view</a>
                                                        <div class="product_color">
                                                            <input type="radio" checked name="product_color" style="background:#b19c83">
                                                            <input type="radio" name="product_color" style="background:#000000">
                                                            <input type="radio" name="product_color" style="background:#999999">
                                                        </div>
                                                        <button class="product_cart_button">Add to Cart</button>
                                                    </div>
                                                </div>
                                                <a href="{{ route('wishlist.add',$item->id) }}">
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                </a>
                                                <ul class="product_marks">
                                                    <li class="product_mark product_discount">-25%</li>
                                                    {{-- <li class="product_mark product_new">new</li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                            <!-- Product Panel -->

                            <div class="product_panel panel">
                                <div class="featured_slider slider">

                                    <!-- Slider Item -->
                                    @foreach ($popular_product as $featured_item)
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{ asset('admin/product_img/'.$featured_item->thumbnail) }}" alt="" height="70%" width="60%">
                                            </div>
                                            <div class="product_content">
                                                @if ($featured_item->discount_price==null)
                                                    <div class="product_price" style="margin-top: 20px">{{ $web_settings->currency }} {{ $featured_item->selling_price }}</div>
                                                @else
                                                    <div class="product_price" style="margin-top: 20px">
                                                        <del class="text-danger">{{ $web_settings->currency }}{{ $featured_item->selling_price }}</del>
                                                        {{ $web_settings->currency }}{{ $featured_item->discount_price }}
                                                    </div>
                                                @endif

                                                {{-- <div class="product_price discount">$225<span>$300</span></div> --}}

                                                <div class="product_name"><div>
                                                    <a href="{{ route('product.details',$featured_item->slug) }}">{{ substr($featured_item->name,0,30)  }}..</a></div>
                                                </div>

                                                <div class="product_extras">
                                                    <a data-toggle="modal" class="quick_modal" id="{{ $featured_item->id }}" data-target=".bd-example-modal-lg">quick view</a>
                                                    <div class="product_color">
                                                        <input type="radio" checked name="product_color" style="background:#b19c83">
                                                        <input type="radio" name="product_color" style="background:#000000">
                                                        <input type="radio" name="product_color" style="background:#999999">
                                                    </div>
                                                    <button class="product_cart_button">Add to Cart</button>
                                                </div>
                                            </div>
                                            <a href="{{ route('wishlist.add',$featured_item->id) }}">
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                            </a>
                                            <ul class="product_marks">
                                                <li class="product_mark product_discount">new</li>
                                                {{-- <li class="product_mark product_new">new</li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->

    <div class="popular_categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title">Popular Categories</div>
                        <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                        <div class="popular_categories_link"><a href="#">full catalog</a></div>
                    </div>
                </div>

                <!-- Popular Categories Slider -->

                <div class="col-lg-9">
                    <div class="popular_categories_slider_container">
                        <div class="owl-carousel owl-theme popular_categories_slider">

                            <!-- Popular Categories Item -->
                            @foreach ($category as $item)
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="{{ asset('frontend') }}/images/popular_4.png" alt=""></div>
                                    <div class="popular_category_text">{{ $item->category_name }}</div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Category wise Product Show -->
    @foreach ($home_category as $category)
        @php
            $cat_product = DB::table('products')->where('category_id',$category->id)->orderBy('id', 'DESC')->limit(24)->get();
        @endphp
        <div class="new_arrivals">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="tabbed_container">
                            <div class="tabs clearfix tabs-right">
                                <div class="new_arrivals_title">{{ $category->category_name }}</div>
                                <ul class="clearfix">
                                    <li class="active">View More</li>
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="z-index:1;">

                                    <!-- Product Panel -->
                                    <div class="product_panel panel active">
                                        <div class="arrivals_slider slider">

                                            <!-- Slider Item -->
                                          @foreach ($cat_product as $item)

                                            <div class="arrivals_slider_item">
                                                <div class="border_active"></div>
                                                <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('admin/product_img/'.$item->thumbnail) }}" height="150px" alt="{{ $item->name }}"></div>
                                                    <div class="product_content">

                                                        @if ($item->discount_price==null)
                                                            <div class="product_price" style="margin-top: 20px">{{ $web_settings->currency }} {{ $item->selling_price }}</div>
                                                        @else
                                                            <div class="product_price" style="margin-top: 20px">
                                                                <del class="text-danger">{{ $web_settings->currency }}{{ $item->selling_price }}</del>
                                                                {{ $web_settings->currency }}{{ $item->discount_price }}
                                                            </div>
                                                        @endif

                                                        <div class="product_name"><div><a href="{{ route('product.details',$item->slug) }}">{{ $item->name }}</a></div></div>
                                                        <a data-toggle="modal" class="quick_modal" id="{{ $item->id }}" data-target=".bd-example-modal-lg">quick view</a>
                                                        <div class="product_extras mt-1">
                                                            <div class="product_color">
                                                                <input type="radio" checked name="product_color" style="background:#b19c83">
                                                                <input type="radio" name="product_color" style="background:#000000">
                                                                <input type="radio" name="product_color" style="background:#999999">
                                                            </div>
                                                            <button class="product_cart_button">Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('wishlist.add',$item->id) }}">
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    </a>
                                                </div>
                                            </div>
                                          @endforeach

                                        </div>
                                        <div class="arrivals_slider_dots_cover"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




    <!-- Adverts -->

    <div class="adverts">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_title"><a href="#">Trends 2018</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                        </div>
                        <div class="ml-auto"><div class="advert_image"><img src="{{ asset('frontend') }}/images/adv_1.png" alt=""></div></div>
                    </div>
                </div>

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_subtitle">Trends 2018</div>
                            <div class="advert_title_2"><a href="#">Sale -45%</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                        </div>
                        <div class="ml-auto"><div class="advert_image"><img src="{{ asset('frontend') }}/images/adv_2.png" alt=""></div></div>
                    </div>
                </div>

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_title"><a href="#">Trends 2018</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                        </div>
                        <div class="ml-auto"><div class="advert_image"><img src="{{ asset('frontend') }}/images/adv_3.png" alt=""></div></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Trends -->

    <div class="trends">
        <div class="trends_background" style="background-image:url({{ asset('frontend') }}/images/trends_background.jpg)"></div>
        <div class="trends_overlay"></div>
        <div class="container">
            <div class="row">

                <!-- Trends Content -->
                <div class="col-lg-3">
                    <div class="trends_container">
                        <h2 class="trends_title">Trends 2018</h2>
                        <div class="trends_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p></div>
                        <div class="trends_slider_nav">
                            <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Trends Slider -->
                <div class="col-lg-9">
                    <div class="trends_slider_container">

                        <!-- Trends Slider -->

                        <div class="owl-carousel owl-theme trends_slider">
                            <!-- Trends Slider Item -->
                            @foreach ($trendy_product as $trendy_products)
							    <div class="owl-item">
                                    <div class="trends_item is_new">
                                        <div class="trends_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{ asset('admin/product_img/'.$trendy_products->thumbnail) }}" alt="{{ $trendy_products->name }}" height="70%" width="60%">
                                        </div>
                                        <div class="trends_content">
                                            @if ($trendy_products->discount_price==null)
                                                <div class="product_price" style="margin-top: 20px">{{ $web_settings->currency }} {{ $trendy_products->selling_price }}</div>
                                            @else
                                                <div class="product_price" style="margin-top: 20px">
                                                    <del class="text-danger">{{ $web_settings->currency }}{{ $trendy_products->selling_price }}</del>
                                                    {{ $web_settings->currency }}{{ $trendy_products->discount_price }}
                                                </div>
                                            @endif
                                            <div class="trends_info clearfix">
                                                <div class="trends_name"><a href="{{ route('product.details',$trendy_products->slug) }}">{{ substr($trendy_products->name,0,50)  }}..</a></div>
                                            </div>
                                            <div class="trends_category"><a href="#">{{ $trendy_products->subcategory->subcategory_name }}</a></div>
                                        </div>
                                        <ul class="trends_marks">
                                            <a href="">
                                                <li class="trends_mark trends_new hover"> <i class="fa fa-eye"></i>  </li>
                                            </a>
                                        </ul>
                                        <a href="{{ route('wishlist.add',$trendy_products->id) }}">
                                            <div class="trends_fav"><i class="fas fa-heart"></i></div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Recently Viewed -->

    <div class="viewed mt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Product fo you</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                            <!-- Recently Viewed Item -->
                            @foreach ($random_product as $item)
                                <div class="owl-item">
                                    <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image">
                                            <img src="{{ asset('admin/product_img/'.$item->thumbnail) }}" alt="{{ $item->name }}">
                                        </div>
                                        <div class="viewed_content text-center">
                                            @if ($trendy_products->discount_price==null)
                                                <div class="viewed_price" style="margin-top: 20px">{{ $web_settings->currency }} {{ $item->selling_price }}</div>
                                            @else
                                                <div class="viewed_price" style="margin-top: 20px">
                                                    <del class="text-danger">{{ $web_settings->currency }}{{ $item->selling_price }}</del>
                                                    {{ $web_settings->currency }}{{ $item->discount_price }}
                                                </div>
                                            @endif
                                            <div class="viewed_name"><a href="{{ route('product.details',$item->slug) }}">{{ substr($item->name,0,30)  }}..</a></div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_new">new</li>
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





	<!-- Reviews -->

	<div class="reviews">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="reviews_title_container">
						<h3 class="reviews_title">Latest Reviews</h3>
						<div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
					</div>

					<div class="reviews_slider_container">

						<!-- Reviews Slider -->
						<div class="owl-carousel owl-theme reviews_slider">

							<!-- Reviews Slider Item -->
                            @foreach ($website_review as $item)
                                <div class="owl-item">
                                    <div class="review d-flex flex-row align-items-start justify-content-start">
                                        <div><div class="review_image"><img src="{{ asset('frontend/customer_profile_img/user.png') }}" alt="{{ $item->name }}-Profile img"></div></div>
                                        <div class="review_content">
                                            <div class="review_name">{{ $item->name }}</div>
                                            <div class="review_rating_container">
                                                <div class="rating_r rating_r_4 review_rating">
                                                    @if ($item->rating == 1)
                                                       <span class="fa fa-star text-warning"></span>
                                                       <span class="fa fa-star "></span>
                                                       <span class="fa fa-star "></span>
                                                       <span class="fa fa-star "></span>
                                                       <span class="fa fa-star "></span>
                                                    @elseif ($item->rating == 2)
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star "></span>
                                                        <span class="fa fa-star "></span>
                                                        <span class="fa fa-star "></span>
                                                    @elseif ($item->rating == 3)
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star "></span>
                                                        <span class="fa fa-star "></span>
                                                    @elseif ($item->rating == 4)
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star "></span>
                                                    @elseif ($item->rating == 5)
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star text-warning"></span>
                                                    @endif
                                                </div>
                                                <div class="review_time">2 days ago</div>
                                            </div>
                                            <div class="review_text"><p>{{ Str::limit($item->review, 100, '...') }}</p></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
						</div>
						<div class="reviews_dots"></div>
					</div>
				</div>
			</div>
		</div>
	</div>


    <!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="{{ asset('frontend') }}/images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form method="post" action="{{ route('store.newsletter') }}" class="newsletter_form">
                                @csrf
                                <input type="email" name="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                                <button class="newsletter_button" type="submit">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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



    </script>
@endpush
