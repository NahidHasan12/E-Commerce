@extends('layouts.app')
@section('title', 'Product Details')

@section('main_nav_css_link')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">
@endsection

@section('content')

    {{-- main nav --}}
    @include('layouts.frontend_partial.main_nav')
    {{-- main nav --}}

    <div class="single_product">
		<div class="container">
			<div class="row">
                @php
                    $images = json_decode($product_details->images, true);
                    $color = explode(',',$product_details->color);
                    $size = explode(',',$product_details->size);
                @endphp
				<!-- Images -->
				<div class="col-lg-1 order-lg-1 order-2">
					<ul class="image_list">
                        @foreach ($images as $key=>$img)
                            <li data-image="{{ asset('admin/product_img/'.$img) }}">
                                <img src="{{ asset('admin/product_img/'.$img) }}" alt="{{ $product_details->name }}">
                            </li>
                        @endforeach
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-3 order-lg-2 order-1">
					<div class="image_selected"><img src="{{ asset('admin/product_img/'.$product_details->thumbnail) }}" alt="{{ $product_details->name }}"></div>
				</div>

                @php
                    $review_5 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',5)->count();
                    $review_4 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',4)->count();
                    $review_3 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',3)->count();
                    $review_2 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',2)->count();
                    $review_1 = DB::table('reviews')->where('product_id',$product_details->id)->where('rating',1)->count();

                    $sum_rating=DB::table('reviews')->where('product_id',$product_details->id)->sum('rating');
                    $count_rating=DB::table('reviews')->where('product_id',$product_details->id)->count('rating');
                @endphp

				<!-- Description -->
				<div class="col-lg-4 order-3">
					<div class="product_description">
						<div class="product_category">{{ $product_details->category->category_name }} > {{ $product_details->subcategory->subcategory_name }}</div>
						<div class="product_name" style="font-size: 25px">{{ $product_details->name }}</div>
                        <div class="product_category"> <b>Brand: {{ $product_details->brand->brand_name }}</b> </div>
                        <div class="product_category"> <b>Stock: {{ $product_details->stock_quantity }}</b> </div>
                        <div class="product_category"> <b>Unit: {{ $product_details->unit }}</b> </div>
						    @if($sum_rating !=NULL)
                                @if(intval($sum_rating/$count_rating) == 5)
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star "></span>
                                @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star text-warning"></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                @else
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                @endif
                            @endif

                        @if ($product_details->discount_price == NULL)
                            <div class="product_price" style="margin-top: 25px">{{ $web_settings->currency }}{{ $product_details->selling_price }}</div>
                        @else
                            <div class="product_price" style="margin-top: 25px"><del class="text-danger">{{ $web_settings->currency }}{{ $product_details->discount_price }}</del> {{ $web_settings->currency }}{{ $product_details->selling_price }}</div>
                        @endif

						{{-- <div class="product_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p></div> --}}
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div class="clearfix" style="z-index: 1000;">
                                    <div class="row mb-3">
                                        <!-- Product Size -->
                                        <div class="col-6">
                                            @isset($product_details->size)
                                                <label for="size" class="form-label">Size</label>
                                                <select name="size" id="size" class="form-control">
                                                    @foreach ($size as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            @endisset
                                        </div>
                                        <!-- Product Color -->
                                        <div class="col-6">
                                            @isset($product_details->color)
                                                <label for="color" class="form-label">Color</label>
                                                <select name="color" id="color" class="form-control">
                                                    @foreach ($color as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            @endisset
                                        </div>
                                    </div>
									<!-- Product Quantity -->
									<div class="product_quantity clearfix" style="margin-left:10px">
										<span>Quantity: </span>
										<input id="quantity_input" type="text" pattern="[0-9]*" value="1">
										<div class="quantity_buttons">
											<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>

								</div>

								<div class="button_container">
									<button type="submit" class="button cart_button">Add to Cart</button>
                                    <a href="{{ route('wishlist.add',$product_details->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-heart"></i> </a>
								</div>

							</form>
						</div>
					</div>
				</div>
                <div class="col-lg-4 order-3">
                    <p><b>pickup point of this product</b> <br>
                        <i class="fa fa-map pr-1"></i>{{ $product_details->pickup_point->pickup_point_name }}</p>

                        <p><b>Home Delivery</b> <br>
                            >> (3-5) days after the order placed. <br>
                            >> Cash On Delivery Avalible. <br>
                        </p>

                        <div>
                            @isset($product_details->video)
                                <p><b>Product Video</b></p>
                                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="250" height="150" type="text/html" src="https://www.youtube.com/embed/{{ $product_details->video }}?autoplay=0&fs=0&iv_load_policy=3&showinfo=0&rel=0&cc_load_policy=0&start=0&end=0&origin=http://youtubeembedcode.com"><div><small><a href="https://youtubeembedcode.com/es/">youtubeembedcode.com/es/</a></small></div><div><small><a href="https://sms-lån-direkt-utbetalning.se/">sms-lån-direkt-utbetalning.se</a></small></div></iframe>
                            @endisset
                        </div>
                </div>

			</div>

            <div class="row mt-5">
                <div class="col-lg-12">
                 <div class="card">
                  <div class="card-header">
                    <h4>Product details of {{ $product_details->name }}</h4>
                  </div>
                    <div class="card-body">
                            {!! $product_details->description !!}
                    </div>
                 </div>
                </div>
            </div><br>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Review Of {{ $product_details->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">

                                    <p style="margin-bottom: 5px">Avarage Review of  {{ $product_details->name }} </p>

                                    @if($sum_rating !=NULL)
                                        @if(intval($sum_rating/$count_rating) == 5)
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star "></span>
                                        @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star text-warning"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        @else
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star "></span>
                                        @endif
                                    @endif


                                </div>

                                <div class="col-md-4">
                                    <p>Total Review of the product</p>

                                    <div style="margin-top: -10px">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <span> Total {{ $review_5 }} </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star"></i>
                                        <span>total {{ $review_4 }} </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>total {{ $review_3 }} </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>total {{ $review_2 }}</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>total {{ $review_1 }}</span>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <form action="{{ route('product.review.store') }}" method="post">
                                        @csrf
                                        <input name="product_id" type="hidden" value="{{ $product_details->id }}">
                                        <p style="margin-bottom: 5px">Write your review </p>
                                        <textarea class="p-2" name="review" cols="30" rows="2" placeholder="write a review for this product" required></textarea>

                                        <p>
                                            select your rating
                                            <select class="custom-select" name="rating" id="" style="min-width: 30px" required>
                                                <option value="">please select rating</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </p>
                                        @if (Auth::check())
                                            <button type="submit" class="btn btn-primary "> <i class="fa fa-star text-warning"></i> Submit review</button>
                                        @else
                                            <p class="text-danger">Please at first login to your account for review.</p>
                                        @endif
                                    </form>

                                </div>
                            </div>
                            <strong class="ml-3">All Reveiw of {{ $product_details->name }}</strong>
                            <div class="row">
                                @foreach ($review as $item)
                                    <div class="col-5 mr-4 mb-3 ml-3">
                                        <div class="card">
                                        <div class="card-header">
                                            <h5>{{ $item->user->name }} ({{ date('d F ,Y'),strtotime($item->review_data) }}) </h5>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $item->review }}</p>
                                            @if ($item->rating==1)
                                                <div>
                                                    <i class="fas fa-star text-warning"></i>
                                                </div>
                                            @elseif ($item->rating==2)
                                                <div>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </div>
                                            @elseif ($item->rating==3)
                                                <div>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </div>
                                            @elseif ($item->rating==4)
                                                <div>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </div>
                                            @elseif ($item->rating==5)
                                                <div>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </div>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="viewed mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="viewed_title_container">
                                <h3 class="viewed_title">Related Product</h3>
                                <div class="viewed_nav_container">
                                    <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                    <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                                </div>
                            </div>

                            <div class="viewed_slider_container">

                                <!-- Recently Viewed Slider -->

                                <div class="owl-carousel owl-theme viewed_slider">

                                    <!-- Recently Viewed Item -->
                                    @foreach ($related_product as $item)
                                        <div class="owl-item">
                                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="viewed_image"><img src="{{ asset('admin/product_img/'.$item->thumbnail) }}" alt="{{ $item->name }}"></div>
                                                <div class="viewed_content text-center">
                                                    @if ($product_details->discount_price == NULL)
                                                        <div class="viewed_price" style="margin-top: 25px; color:rgb(43, 42, 42)">{{ $web_settings->currency }}{{ $item->selling_price }}</div>
                                                    @else
                                                        <div class="viewed_price" style="margin-top: 25px; color:rgb(32, 32, 32)"><del class="text-danger">{{ $web_settings->currency }}{{ $item->discount_price }}</del> {{ $web_settings->currency }}{{ $item->selling_price }}</div>
                                                    @endif
                                                    <div class="viewed_name"><a href="{{ route('product.details',$item->slug) }}">{{ Str::limit($item->name, 50, '...') }}</a></div>
                                                </div>
                                                <ul class="item_marks">
                                                    <li class="item_mark item_discount">New</li>
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


		</div>
	</div>


@endsection

@section('main_nav_js_link')
    <script src="{{ asset('frontend') }}/js/product_custom.js"></script>
@endsection
