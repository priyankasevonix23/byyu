@include('layout/header')


<div class="middle_box width100">
        <section class="mt-5 mb-5" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-2 black_heading mobile_center_heading">Offers</div>
                </div>
                <div style="width: 100%; min-height: 500px;" class="product_listing_loading">
                    <div class="row" style="background-color: #fff;">            
                        <div class="col-lg-12">
                            @if(!empty($categories))
                            @foreach($categories as $category)
                             @php
                                $category_slug = \Str::slug($category['title'],'+').'-'.$category['cat_id'];
                            @endphp
                            <div class="about_product_listing">
                                <div class="home_product_list" style="box-shadow: none; border: 0;">
                                    <div class="home_product_img mb-2">
                                        <a href="{{ENV('APP_URL')}}product-list/{{$category_slug}}">
                                            <img src="{{ENV('ADMIN_APP_URL')}}{{$category['image']}}" class="img-fluid" alt="{{$category['title']}}">
                                        </a>
                                    </div>
                                    <div class="width100 text-center">    
                                        <div class="row">
                                            <div class="col-lg-12 text_18_black mb-1 home_product_name">{{$category['title']}}</div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                            @endif
                            
                        </div>                
                    </div>
                </div>
                
        
            </div>
        </section>
</div>
@include('layout/footer')