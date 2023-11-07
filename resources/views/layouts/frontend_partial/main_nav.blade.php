@php
    $category = DB::table('categories')->get()
@endphp

<nav class="main_nav">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="main_nav_content d-flex flex-row">

                    <!-- Categories Menu -->
                    <div class="cat_menu_container">
                        <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                            <div class="cat_burger"><span></span><span></span><span></span></div>
                            <div class="cat_menu_text">categories</div>
                        </div>

                        <ul class="cat_menu">
                          @foreach ($category as $cat)
                            @php
                                $sub_category = DB::table('sub_categories')->where('category_id',$cat->id)->get();
                            @endphp
                            <li class="hassubs">
                                <a href="{{ route('category_wise.product',$cat->id) }}">{{ $cat->category_name }}<i class="fas fa-chevron-right"></i></a>
                                <ul>
                                  @foreach ($sub_category as $sub_cat)
                                    @php
                                        $child_cat = DB::table('childcategories')->where('subcategory_id',$sub_cat->id)->get();
                                    @endphp
                                    <li class="hassubs">
                                        <a href="{{ route('subCategory_wise.product',$cat->id) }}">{{ $sub_cat->subcategory_name }}<i class="fas fa-chevron-right"></i></a>
                                        <ul>
                                            @foreach ($child_cat as $child_cat)
                                                <li><a href="{{ route('childCategory_wise.product',$child_cat->id) }}">{{ $child_cat->childcategory_name }}<i class="fas fa-chevron-right"></i></a></li>
                                            @endforeach

                                        </ul>
                                    </li>
                                  @endforeach
                                </ul>
                            </li>
                          @endforeach

                        </ul>
                    </div>

                    <!-- Main Nav Menu -->

                    <div class="main_nav_menu ml-auto">
                        <ul class="standard_dropdown main_nav_dropdown">
                            <li><a href="#">Home<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="#">Campaing<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="#">Contact<i class="fas fa-chevron-down"></i></a></li>
                            <li><a href="#">HelpLine<i class="fas fa-chevron-down"></i></a></li>
                        </ul>
                    </div>

                    <!-- Menu Trigger -->

                    <div class="menu_trigger_container ml-auto">
                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                            <div class="menu_burger">
                                <div class="menu_trigger_text">menu</div>
                                <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
