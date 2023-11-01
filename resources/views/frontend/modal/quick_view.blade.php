
@php
$color=explode(',',$product->color);
$size=explode(',',$product->size);
@endphp


<div class="row p-3 mt-3">
<div class="col-lg-4 ml-3">
    <img src="{{ asset('admin/product_img/'.$product->thumbnail) }}" alt="{{ $product->name }}" height="70%" width="70%">
</div>

<div class="col-lg-6">
    <h4 class="quick_product_name"> {{ $product->name }}</h4>
    <div class="d-flex">
        <p> {{ $product->category->category_name }}</p>
        <p class="px-2">></p>
        <p> {{ $product->subcategory->subcategory_name }} </p>
    </div>
    <p style="margin-top:-13px;margin-bottom: 5px;">brand: {{ $product->brand->brand_name }} </p>

    @if ($product->stock_quantity < 1)
        <div class="badge badge-danger" style="margin-top:-8px"> Stock out </div>
    @else
        <div class="badge badge-success" style="margin-top:-8px"> Stock Available </div>
    @endif


    @if ($product->discount_price==null)
        <h4 class="text-danger" style="margin:7px 0;">{{ $web_settings->currency }} {{ $product->selling_price }}</h4>

    @else
        <div class="product_price" style="margin-top:7px 0">
            <del class="text-danger">{{ $web_settings->currency }}{{ $product->selling_price }}</del>
            {{ $web_settings->currency }} {{ $product->discount_price }}
        </div>
    @endif

    <form action="{{ route('add.to.cart.quickview') }}" method="post" id="cartForm">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        @if ($product->discount_price==null)
            <input type="hidden" name="price" value="{{ $product->selling_price }}">
        @else
            <input type="hidden" name="price" value="{{ $product->discount_price }}">
        @endif

        <label for="qty">Product Quantity</label>
        <input type="number" min="1" max="100" id="qty" name="qty" value="1" class="form-control py-2" style="width: 200px">

        <div class="row py-2">
            @isset($product->size)
                <div class="col-lg-4">
                    <span for="size">Pick Size</span>
                    <select name="size" class="custom-select" style="min-width: 100px;margin: 5px 0;">
                        @foreach ($size as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset


            @isset($product->color)
                <div class="col-lg-4">
                    <span for="color">Pick Color</span>
                    <select name="color" class="custom-select" style="min-width: 100px;margin: 5px 0;">
                        @foreach ($color as $colors)
                            <option value="{{ $colors }}">{{ $colors }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
        </div>
        @if ($product->stock_quantity < 1)
            <span class="text-danger"> Stock Out</span>
        @else
            <button type="submit" class="btn btn-sm btn-outline-info my-3"> add to Cart</button>
        @endif
    </form>



</div>

</div>



<script>




</script>
