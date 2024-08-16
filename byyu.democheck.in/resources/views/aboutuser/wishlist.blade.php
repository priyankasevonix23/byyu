@include('layout.header')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>


<div class="middle_box width100 wishlist_mainbox">
<section class="mt-5 mb-5" id="top" style="min-height: 400px;">
    <div class="container" style="position: relative;">
        <div class="row">
            <div class="col-12 mb-2 black_heading">Wishlist</div>
        </div>
        
        <div class="row">
            <div class="col-lg-12" >

                <p class="alert alert-info alert-message d-none"></p>

                @if(!empty($wishListItems))
                @foreach($wishListItems as $wishListItem)
                <div class="about_product_listing">
                    <div class="home_product_list">
                        @php
                            $product_slug = \Str::slug($wishListItem['product_name'],'+').'-'.$wishListItem['product_id'];
                        @endphp
                        <a href="{{url('product-details/'.$product_slug)}}">
                            <div class="home_product_img mb-2">
                                    <img src="{{ENV('BUNNY_NET_URL')}}{{$wishListItem['product_image']}}?width=500&height=500" class="img-fluid" />                          
                            </div>
                            <div class="width100 text-center">
                                
                                <div class="row">
                                    <div class="col-lg-12 text_18_black mb-1 home_product_name">{{$wishListItem['product_name']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-2">
                                        <div class="home_product_price"><div class="currency_text">AED</div>{{$wishListItem['price']}}</div>
                                    </div>
                                </div>                        
                                
                                <div class="product_wishlist" data-product-id="{{$wishListItem['varient_id']}}">
                                    <a  style="opacity: 1;background-color: #e9dcb7;padding: 7px 7px 15px 15px;">                                        
                                        <img  src="assets/images/product_wishlist_active.png" alt="wishliated" style="max-width:20px">
                                    </a>
                                </div>
                            </div>
                        </a>
                        
                        
                    </div>
                </div>
                @endforeach
                @endif
                
            </div>            
        </div>
    </div>
</section>
</div>


@include('layout.footer')
