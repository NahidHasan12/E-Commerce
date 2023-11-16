<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('admin/super_admin.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar2">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="{{ asset('frontend/customer_profile_img/user.png') }}" alt="John Doe" />
            </div>
            <h4 class="name">{{ Auth::user()->name }}</h4>
            <a href="{{ route('admin.logout') }}">
                {{ __('Logout') }}
            </a>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="inbox.html">
                        <i class="fas fa-chart-bar"></i>Inbox</a>
                    <span class="inbox-num">3</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-shopping-basket"></i>eCommerce</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Category
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('category.index') }}">
                                <i class="far fa-check-square"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{ route('sub_cat.index') }}">
                                <i class="far fa-check-square"></i>Sub Category</a>
                        </li>
                        <li>
                            <a href="{{ route('child_cat.index') }}">
                                <i class="far fa-check-square"></i>Child Category</a>
                        </li>
                        <li>
                            <a href="{{ route('brand.index') }}">
                                <i class="far fa-check-square"></i>Brand</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fa fa-cubes"></i>Product
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('product.index') }}">
                                <i class="far fa-check-square"></i>New Product</a>
                        </li>
                        <li>
                            <a href="">
                                <i class="far fa-check-square"></i>Manage Product</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fa fa-gift"></i>Offer
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('coupon.index') }}">
                                <i class="far fa-check-square"></i>Coupon</a>
                        </li>
                        <li>
                            <a href="{{ route('campaing.index') }}">
                                <i class="far fa-check-square"></i>Campaing</a>
                        </li>
                        <li>
                            <a href="{{ route('pickup_point.index') }}">
                                <i class="far fa-check-square"></i>Pickup Point</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('warehouse.index') }}">
                        <i class="fas fa-chart-bar"></i>Warehouse</a>
                    <span class="inbox-num">3</span>
                </li>
                <li>
                    <a href="{{ route('admin.ticket.index') }}">
                        <i class="fas fa-chart-bar"></i>Ticket</a>
                    <span class="inbox-num">3</span>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Settings
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('seo.seo') }}">
                                <i class="far fa-check-square"></i>SEO Setting</a>
                        </li>
                        <li>
                            <a href="{{ route('web_setting.web_setting') }}">
                                <i class="far fa-check-square"></i>Website Setting</a>
                        </li>
                        <li>
                            <a href="{{ route('pages.pages') }}">
                                <i class="far fa-check-square"></i>Page Management</a>
                        </li>
                        <li>
                            <a href="{{ route('smtp.smtp') }}">
                                <i class="far fa-check-square"></i>SMTP Setting</a>
                        </li>
                    </ul>
                </li>

                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-trophy"></i>Features
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Account
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('admin.logout') }}">
                                <i class="fas fa-sign-out-alt"></i>LogOut</a>
                        </li>
                        <li>
                            <a href="register.html">
                                <i class="fas fa-user"></i>Register</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.password.change') }}">
                                <i class="fas fa-unlock-alt"></i>Forget Password</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-desktop"></i>UI Elements
                        <span class="arrow">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="button.html">
                                <i class="fab fa-flickr"></i>Button</a>
                        </li>
                        <li>
                            <a href="badge.html">
                                <i class="fas fa-comment-alt"></i>Badges</a>
                        </li>
                        <li>
                            <a href="tab.html">
                                <i class="far fa-window-maximize"></i>Tabs</a>
                        </li>
                        <li>
                            <a href="card.html">
                                <i class="far fa-id-card"></i>Cards</a>
                        </li>
                        <li>
                            <a href="alert.html">
                                <i class="far fa-bell"></i>Alerts</a>
                        </li>
                        <li>
                            <a href="progress-bar.html">
                                <i class="fas fa-tasks"></i>Progress Bars</a>
                        </li>
                        <li>
                            <a href="modal.html">
                                <i class="far fa-window-restore"></i>Modals</a>
                        </li>
                        <li>
                            <a href="switch.html">
                                <i class="fas fa-toggle-on"></i>Switchs</a>
                        </li>
                        <li>
                            <a href="grid.html">
                                <i class="fas fa-th-large"></i>Grids</a>
                        </li>
                        <li>
                            <a href="fontawesome.html">
                                <i class="fab fa-font-awesome"></i>FontAwesome</a>
                        </li>
                        <li>
                            <a href="typo.html">
                                <i class="fas fa-font"></i>Typography</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
