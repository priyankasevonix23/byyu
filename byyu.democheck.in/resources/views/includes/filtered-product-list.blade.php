<div class="row">    

                            <div class="col-lg-12" style="background-color: #fff;">

                                <p class="alert alert-info alert-message d-none"></p>

                                @if(!empty($categoryProducts))



                                @foreach($categoryProducts as $categoryProduct)



                                @php

                                    $product_slug = \Str::slug($categoryProduct['product_name'],'-').'-'.$categoryProduct['product_id'];

                                @endphp

                                <div class="about_product_listing">

                                    

                                        <div class="home_product_list">
                                            <a href="{{url('product-details/'.$product_slug)}}">
                                            <div class="home_product_img mb-2">                                        

                                                <img src="{{ENV('BUNNY_NET_URL')}}{{$categoryProduct['product_image']}}?width=500&height=500" class="img-fluid" alt="{{$categoryProduct['product_name']}}" >

                                            </div>
                                            </a>

                                            <div class="width100 text-center">
                                                
                                                    <div class="row">

                                                        <div class="col-lg-12 text_18_black mb-1 home_product_name">{{$categoryProduct['product_name']}}</div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-lg-12 mb-2">

                                                            <div class="home_product_price">                      
                                                            <div class="currency_text">AED</div>
                                                                {{$categoryProduct['price']}} 

                                                                @if($categoryProduct['price'] < $categoryProduct['mrp'])

                                                                <span>{{$categoryProduct['mrp']}}</span>

                                                                <div class="discount_text">{{$categoryProduct['discountper']}}% Off</div>

                                                                @endif

                                                                

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-lg-12 pb-4 earliest_text">

                                                            Earliest Delivery: 

                                                            @if(!empty($categoryProduct['delivery']))

                                                            @if($categoryProduct['delivery'] == 1) 

                                                            <b>Express</b>  

                                                            @elseif($categoryProduct['delivery'] == 2)    

                                                                <b>Today</b>

                                                            @elseif($categoryProduct['delivery'] == 3)    

                                                                <b>Tomorrow</b>

                                                            @endif    

                                                        @endif

                                                        </div>

                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{url('product-details/'.$product_slug)}}" class="red_button">View Detail</a>
                                                        </div>
                                                    </div>
                                                

                                                <div class="product_wishlist" data-product-id="{{$categoryProduct['product_id']}}">

                                                    <div class="wishlist_icon_box" >                                        

                                                        @if($categoryProduct['isFavourite'] == "true")

                                                        <div><img  src="{{ENV('APP_URL')}}assets/images/product_wishlist_active.png" alt="wishliated" style="max-width:20px"></div>

                                                        @endif

                                                        

                                                        @if($categoryProduct['isFavourite'] == "false")

                                                        <div><img  src="{{ENV('APP_URL')}}assets/images/product_wishlist.png" alt="wishliated" style="max-width:20px"></div>

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>

                                        </div>                                

                                    

                                </div>

                                @endforeach



                                @else

                                <div class="row">

                                    <div class="col-lg-12 text_18_black mb-1 home_product_name">No Products Found</div>

                                </div>

                                @endif

                                

                            </div>

                        </div>