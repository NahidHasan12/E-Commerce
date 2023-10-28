{{-- @php
$color=explode(',',$product->color);
$size=explode(',',$product->size);
@endphp --}}


<div class="row p-3 mt-3">
<div class="col-lg-4 ml-3">
    <img src="{{ asset('frontend') }}/images/featured_1.png" alt="" height="70%" width="70%">
</div>

<div class="col-lg-6">
    <h4 class="quick_product_name"> Nahid Hasan</h4>
    <div class="d-flex">
        {{-- <p> {{ $product->category->category_name }}</p> --}}
        <p>Nahid</p>
        <p class="px-2">></p>
        <p>Hasan</p>
        {{-- <p> {{ $product->subcategory->subcategory_name }} </p> --}}
    </div>
    <p style="margin-top:-13px;margin-bottom: 5px;">brand:Nahid HAsan </p>


        <div class="badge badge-success" style="margin-top:-8px"> Stock Available </div>


        <h4 class="text-danger" style="margin:7px 0;">$555</h4>

        <div class="product_price" style="margin-top:7px 0">
            <del class="text-danger">$355</del>
            $255
        </div>

    <form action="" method="post" id="cartForm">
        @csrf
        <input type="hidden" name="id" value="">


        <input type="number" min="1" max="100" name="qty" value="1" class="form-control py-2" style="width: 200px">

        <div class="row py-2">
                <div class="col-lg-4">
                    <span for="size">Pick Size</span>
                    <select name="size" class="custom-select" style="min-width: 100px;margin: 5px 0;">
                        <option value="">A</option>
                        <option value="">B</option>
                        <option value="">C</option>
                        <option value="">D</option>
                    </select>
                </div>


                <div class="col-lg-4">
                    <span for="color">Pick Color</span>
                    <select name="color" class="custom-select" style="min-width: 100px;margin: 5px 0;">
                            <option value="">A</option>
                            <option value="">B</option>
                            <option value="">C</option>
                            <option value="">D</option>
                    </select>
                </div>
        </div>
            <button type="submit" class="btn btn-sm btn-outline-info my-3"> add to Cart</button>
    </form>



</div>

</div>



<script>




</script>
