 <!--shop by brands start-->
 <div id="shopbybrandsection">
    <div class="siteheading">
    <h6>
        Shop By Authorized Brands
    </h6>
    </div>
    <div class="headingunderline"></div>

    <div id="shopbybrands">
        @foreach ($brands as $brand)
            <div class="shopbybranditem" onclick="location.href='{{ route('brands.show', $brand->slug) }}'">
                <img src="{{ asset('images/'.$brand->image) }}" alt="{{ $brand->name }}" />
            </div>
        @endforeach
    </div>

</d>
<!--shop by brands end-->