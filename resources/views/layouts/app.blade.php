<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}- @yield('title')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/bootstrap4/bootstrap.min.css">
    <link href="{{ asset('frontend') }}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/responsive.css">

    {{-- summernote link --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    {{-- drofify link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    @yield('web_style')

    @yield('main_nav_css_link')

    </head>


    <div class="super_container">

        <!-- Header -->
        @include('frontend.modal.login_modal')
        <header class="header">

            <!-- Top Bar -->

            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend') }}images/phone.png" alt=""></div>+38 068 005 3570</div>
                            <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend') }}images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
                            <div class="top_bar_content ml-auto">
                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="#">English<i class="fas fa-chevron-down"></i></a>
                                            <ul>
                                                <li><a href="#">Italian</a></li>
                                                <li><a href="#">Spanish</a></li>
                                                <li><a href="#">Japanese</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
                                            <ul>
                                                <li><a href="#">EUR Euro</a></li>
                                                <li><a href="#">GBP British Pound</a></li>
                                                <li><a href="#">JPY Japanese Yen</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                @guest()
                                    <div class="top_bar_user">
                                        <div class="user_icon"><img src="{{ asset('frontend') }}/images/user.svg" alt=""></div>
                                        <div><a href="{{ route('register') }}">Register</a></div>
                                        <div><a style="cursor: pointer" data-toggle="modal" data-target="#login_modal">Sign in</a></div>
                                    </div>
                                @else
                                    <div class="top_bar_user">
                                        <ul class="standard_dropdown top_bar_dropdown">
                                            <li>
                                                <a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
                                                <ul>
                                                    <li><a href="{{ route('customer.dashboard') }}">Profile</a></li>
                                                    <li><a href="{{ route('profile.setting') }}">Setting</a></li>
                                                    <li><a href="#">Order List</a></li>
                                                    <li><a href="{{ route('customer.logout') }}">Log Out</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                @endguest

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Main -->

            <div class="header_main">
                <div class="container">
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo"><a href="#">OneTech</a></div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="#" class="header_search_form clearfix">
                                            <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                    <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        <li><a class="clc" href="#">All Categories</a></li>
                                                        <li><a class="clc" href="#">Computers</a></li>
                                                        <li><a class="clc" href="#">Laptops</a></li>
                                                        <li><a class="clc" href="#">Cameras</a></li>
                                                        <li><a class="clc" href="#">Hardware</a></li>
                                                        <li><a class="clc" href="#">Smartphones</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <button type="submit" class="header_search_button trans_300" value="Submit"><img src="images/search.png" alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        @php
                            $wishlist = DB::table('wishlists')->where('user_id', Auth::id())->count();
                        @endphp
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    <div class="wishlist_icon"><img src="{{ asset('frontend') }}/images/heart.png" alt=""></div>
                                    <div class="wishlist_content">
                                        <div class="wishlist_text"><a href="{{ route('wishlist') }}">Wishlist</a></div>
                                        <div class="wishlist_count ml-4">{{ $wishlist }}</div>
                                    </div>
                                </div>

                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        <div class="cart_icon">
                                            <img src="{{ asset('frontend') }}/images/cart.png" alt="">
                                            <div class="cart_count"><span>{{ Cart::count() }}</span></div>
                                        </div>
                                        <div class="cart_content">
                                            <div class="cart_text"><a href="{{ route('my.cart') }}">Cart</a></div>
                                            <div class="cart_price">{{ $web_settings->currency }}{{ Cart::total() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('nav')
        </header>
        {{-- header end --}}

        @yield('content')

        <!-- Footer -->

        @php
            $pages_one = DB::table('pages')->where('page_position',1)->get();
            $pages_two = DB::table('pages')->where('page_position',2)->get();
        @endphp
        <footer class="footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 footer_col">
                        <div class="footer_column footer_contact">
                            <div class="logo_container">
                                <div class="logo"><a href="#">OneTech</a></div>
                            </div>
                            <div class="footer_title">Got Question? Call Us 24/7</div>
                            <div class="footer_phone">+38 068 005 3570</div>
                            <div class="footer_contact_text">
                                <p>17 Princess Road, London</p>
                                <p>Grester London NW18JR, UK</p>
                            </div>
                            <div class="footer_social">
                                <ul>
                                    <li><a href="{{ $web_settings->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{ $web_settings->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{ $web_settings->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                    <li><a href="{{ $web_settings->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="{{ $web_settings->facebook }}" target="_blank"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 offset-lg-2">
                        <div class="footer_column">
                            <div class="footer_title">Find it Fast</div>
                            <ul class="footer_list">
                                @foreach ($pages_one as $item)
                                    <li><a href="{{ route('view.pages',$item->page_slug) }}">{{ $item->page_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="footer_column">
                            <ul class="footer_list footer_list_2">
                                @foreach ($pages_two as $item)
                                    <li><a href="#">{{ $item->page_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="footer_column">
                            <div class="footer_title">Customer Care</div>
                            <ul class="footer_list">
                                <li><a href="{{ route('customer.dashboard') }}">My Account</a></li>
                                <li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
                                <li><a href="#">Wish List</a></li>
                                <li><a href="#">Our Blog</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Become a vendeo</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- Copyright -->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                            <div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    </div>
                            <div class="logos ml-sm-auto">
                                <ul class="logos_list">
                                    <li><a href="#"><img src="{{ asset('frontend') }}/images/logos_1.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('frontend') }}/images/logos_2.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('frontend') }}/images/logos_3.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('frontend') }}/images/logos_4.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('frontend') }}/styles/bootstrap4/popper.js"></script>
    <script src="{{ asset('frontend') }}/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/greensock/TweenMax.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/greensock/TimelineMax.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/greensock/animation.gsap.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="{{ asset('frontend') }}/plugins/slick-1.8.0/slick.js"></script>
    <script src="{{ asset('frontend') }}/plugins/easing/easing.js"></script>
    <script src="{{ asset('frontend') }}/js/custom.js"></script>

    {{-- Dropify link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- summer note js link --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>



    @yield('main_nav_js_link')

    @stack('web_script')


    </body>

    </html>
