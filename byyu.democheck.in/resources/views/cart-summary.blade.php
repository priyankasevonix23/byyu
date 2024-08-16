@include('layout.header')
<div class="middle_box width100 cartsummary_mainbox">
        <section class="" style="position: relative;min-height: 500px;">

                <div class="container">
                       @if(!empty($cartDetail)) 
                        <div class="row">
                        <div class="col-lg-8 pt-4 mb-3">
                                
                                <div class="row">
                                <div class="col-lg-12 mb-2 black_heading">
                                        Cart
                                </div>
                                </div>
                                
                                @if($is_time_valid_data == 2)
                                <div class="row">
                                <div class="col-lg-11 mb-4 alert alert-danger">Please Select correct Delivery Date</div>
                                </div>
                                @endif
                                
                                @php 
                                    $cartItems = !empty($cartDetail['data'])?$cartDetail['data']:[];
                                @endphp
                                <div style="min-height: 200px; width: 100%;" class="">
                                    <div class="row">
                                        <input type="hidden" name="user_id" class="user_id" value="{{$user_id}}">
                                        @if(!empty($cartItems))
                                        @foreach($cartItems as $cartItem)
@php
    $product_slug = \Str::slug($cartItem['product_name'],'+').'-'.$cartItem['product_id'];

    $is_time_valid = 1;
    if($cartItem['delivery_type'] == 1){
        if(date('Y-m-d',strtotime($cartItem['delivery_date'])) < date('Y-m-d') && date('H:i',strtotime($cartItem['delivery_time'])) < date('H:i')){
            $is_time_valid = 0;
        }
    }elseif($cartItem['delivery_type'] == 2 || $cartItem['delivery_type'] == 3){
    
        $delivery_time = explode('-',$cartItem['delivery_time']);

        $start_time = date("h:i A", strtotime($delivery_time[0]));   
        $end_time = date("h:i A", strtotime($delivery_time[1]));
        $currentTime =date('h:i A', time()); 

        if(date('Y-m-d',strtotime($cartItem['delivery_date'])) < date('Y-m-d') && date('H:i',strtotime($cartItem['delivery_time'])) < date('H:i') && (strtotime($currentTime) >= strtotime($start_time)) && (strtotime($currentTime) <= strtotime($end_time))){
            $is_time_valid = 0;
        }
    }

@endphp
                                        <div class="col-lg-11 mb-4">
                                            <div class="cart_list cart_list2 pb-0 @if($is_time_valid==0) invalid @endif">
                                                <div class="row">
                                                    <div class="col-lg-2 text-center">
                                                            <a class="text_24_black" href="{{url('product-details/'.$product_slug)}}">
                                                            <img class="img-fluid" src="{{ENV('ADMIN_APP_URL').$cartItem['product_image']}}?width=200&height=200">
                                                            </a>
                                                    </div>
                                                    <div class="col-lg-10">
                                                            <div class="row pt-1 pb-1 mb-2" style="border-bottom: 1px solid #ccc;">
                                                            <div class="col-lg-8">
                                                                    <a class="text_24_black" href="{{url('product-details/'.$product_slug)}}">{{$cartItem['product_name']}} </a>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                    <div class="home_product_price" style="justify-content:right">
                                                                    <div class="currency_text">AED</div>
                                                                    {{$cartItem['price']}}
                                                                    <span>{{$cartItem['mrp']}}</span>
                                                                    
                                                                    </div>
                                                            </div>
                                                            </div>

                                                            @if(!empty($cartItem['personalized_text']))
                                                            <div class="row">
                                                                <div class="col-lg-12 pb-3">{{$cartItem['personalized_text']}}</div>
                                                            </div>
                                                            @endif
                                                            
                                                            <div class="row">
                                                            <div class="col-lg-9">
                                                                    <div class="row">
                                                                    <div class="col-lg-12"><b>Delivery Date:</b> {{$cartItem['delivery_date']}}</div>
                                                                    
                                                                    @if($cartItem['delivery_type'] != 1)
                                                                    <div class="col-lg-12 mb-3"><b>Delivery Time:</b> {{$cartItem['delivery_time']}}</div>
                                                                    @else
                                                                    <div class="col-lg-12 mb-3">Delivery within 90-120 minutes</div>
                                                                    @endif
                                                                    </div>
                                                                    
                                                                    @if($cartItem['is_time_valid'] == 1 && $cartItem['delivery_type'] == 3)
                                                                    <div class="col-lg-12 mb-3" style="color:#f03613"><b>Please Select correct Delivery Date</b></div>
                                                                    @endif
                                                                    
                                                                    @if($cartItem['is_time_valid'] == 1 && $cartItem['delivery_type'] == 1)
                                                                    <div class="col-lg-12 mb-3" style="color:#f03613"><b>Please order before 5:00PM for express delivery</b></div>
                                                                    @endif
                                                            </div>
                                                            <div class="col-lg-3 text-center mb-3">
                                                            <!-- <img src="assets/images/cart/cart_quantity.png" style="max-height: 27px;" class="img-fluid"> -->
                                                            
                                                            <div class="addcard_btn d-flex align-items-baseline quantity_box" style="max-width: 110px;margin: 0 auto;">
                                                            <button class="btn btn-theme-round btn-number btn-csde-qty"
                                                            data-product-id="{{$cartItem['varient_id']}}"
                                                            data-delivery-type="{{$cartItem['delivery_type']}}"
                                                            data-delivery-date="{{$cartItem['delivery_date']}}"
                                                            data-delivery-time="{{$cartItem['delivery_time']}}"
                                                            type="button" >-</button>
                                                            <span class="quantity">{{$cartItem['cart_qty']}}</span>
                                                            <button class="btn btn-theme-round btn-number btn-csin-qty" 
                                                            data-product-id="{{$cartItem['varient_id']}}" 
                                                            data-delivery-type="{{$cartItem['delivery_type']}}"
                                                            data-delivery-date="{{$cartItem['delivery_date']}}"
                                                            data-delivery-time="{{$cartItem['delivery_time']}}"
                                                            type="button">+</button>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            
                                                                
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif



                                    </div>
                                </div>

                                
                                
                        </div>
                        <div class="col-lg-4" style="background-color: #fffce9;">
                        <div class="left-section pb-4" style="height:auto;">
                            <div class="row">
                                        <div class="col-lg-12 pt-3 black_heading text-center">
                                        Shopping Cart 
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-12 text-center mb-3 mt-2">
                                        <img src="assets/images/cart/cart_img.png" class="img-fluid" style="max-height: 120px;">
                                        </div>
                                </div>
                            
                            <div class="row mb-2 text_24_black">
                                <div class="col-1"></div>
                                <div class="col-10">Price Details</div>
                            </div>
                            
                            @if($cartDetail['delivery_charge'] > 0)
                            <div class="row mb-2 total_text">
                                <div class="col-1"></div>
                                <div class="col-6">Subtotal</div>
                                <div class="col-5">: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['total_price']-$cartDetail['delivery_charge']}} (+)</span></div>
                            </div>
                            
                            <div class="row mb-2 total_text">
                                <div class="col-1"></div>
                                
                                <div class="col-6"  *ngIf="cartDataList.delivery_charge_discount>0">Delivery Fee:</div>
                                <div class="col-5">: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['delivery_charge']}} (+)</span></div>
                                
                            </div>
                            @else
                            <div class="row mb-2 total_text">
                                <div class="col-1"></div>
                                <div class="col-6">Subtotal</div>
                                <div class="col-5">: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['total_price']}} (+)</span></div>
                            </div>
                            <div class="row mb-2 total_text">
                                <div class="col-1"></div>
                                
                                <div class="col-6"  *ngIf="cartDataList.delivery_charge_discount>0">Delivery Fee:</div>
                                <div class="col-5">: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['delivery_charge_discount']}} (+)</span></div>
                                
                            </div>
                            @endif
                           
                            <!-- @if($cartDetail['discountonmrp'] > 0)
                            <div class="row mb-2 total_text">
                                <div class="col-1"></div>
                                <div class="col-6">Discount</div>
                                <div class="col-5">: <span style="color: #26b312;font-family: Metropolis-Bold;">AED {{$cartDetail['discountonmrp']}} (-)</span></div>
                            </div>
                            @endif
 -->
                            @if($cartDetail['delivery_charge_discount'] > 0 && $cartDetail['delivery_charge'] == 0)
                            <div class="row mb-2 total_text">
                                <div class="col-1"></div> 
                                <div class="col-6">Delivery Fee Discount:</div>
                                <div class="col-5">: <span style="color: #26b312;font-family: Metropolis-Bold;">AED {{$cartDetail['delivery_charge_discount']}} (-)</span></div>
                            </div>
                            @endif
                            
                            <div class="cardetails_rightbox_total_desktop">
                                <div class="row mb-4 text_24_black" style="color: #f03613;">
                                    <div class="col-1"></div>
                                    <div class="col-6">Total:</div>
                                    <div class="col-5">: AED {{$cartDetail['total_price']}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-12 text-center">
                                        <a href="{{url('address')}}"  class="red_button">Select Recipients Address</a>
                                    </div>

                                </div>
                            </div>

        
                        </div>
                    </div>
                        </div>
                    @else
                    <div class="row cart_empty_box">
                        <div class="col-lg-12 text-center"> Make every moment magical. <br> Add more unique finds to your cart and create a lasting impression.<br><br><a href="{{url('category-listing')}}" class="red_button mt-3" style="text-decoration: none;">Explore Gifts</a>
                        </div>
                    </div>
                    @endif    
                </div>
        </section>
</div>
@include('layout.footer')