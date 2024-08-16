@include('layout.header')
<div class="middle_box width100">
        <section class="" style="position: relative;">
          <div class="container">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">

                        <div class="col-lg-8 pt-4 mb-3">

                                @if(!empty($cartItems))
                                <div class="row">
                                <div class="col-lg-12 mb-2 black_heading">
                                        Order Summary
                                </div>
                                </div>
                                 @endif
                                <div style="min-height: 200px; width: 100%;" class="">
                                <div class="row">
                                        
                                                @php 
                                                    $cartItems = !empty($cartDetail['data'])?$cartDetail['data']:[];
                                               
                                                @endphp
                                                @if(!empty($cartItems))
                                                    @foreach($cartItems as $cartItem)
@php
    $product_slug = \Str::slug($cartItem['product_name'],'+').'-'.$cartItem['product_id'];
@endphp
                                        <div class="col-lg-11 mb-4">
                                        <div class="cart_list cart_list2 pb-0">
                                                <div class="row">
                                                <div class="col-lg-2 text-center">
                                                        <a class="text_24_black" href="{{url('product-details/'.$product_slug)}}">
                                                        <img src="{{ENV('ADMIN_APP_URL').$cartItem['product_image']}}?width=200&height=200" class="img-fluid">
                                                        </a>
                                                </div>

                                                
                                                <div class="col-lg-10">
                                                    <div class="row pt-1 pb-1 mb-2" style="border-bottom: 1px solid #ccc;">
                                                    <div class="col-lg-8">
                                                            <a class="text_24_black" [routerLink]="'/product-details/product/' + data.product_id+'-'+data.product_name">  {{$cartItem['product_name']}}</a>
                                                    </div>
                                                    <div class="col-lg-4">
                                                            <div class="home_product_price" style="justify-content:right">
                                                            {{$cartItem['price']}}
                                                            <span>{{$cartItem['mrp']}}</span>
                                                            <div class="currency_text">AED</div>
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
                                                                <div class="col-lg-12 mb-3"><b>Delivery Time:</b> {{$cartItem['delivery_time']}}</div>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 text-center mb-3">
                                                                <!-- <img src="assets/images/cart/cart_quantity.png" style="max-height: 27px;" class="img-fluid"> -->
                                                                <div class="addcard_btn d-flex align-items-baseline quantity_box" style="max-width: 140px;margin: 0 auto;">
                                                               <button class="btn btn-theme-round btn-number btn-csde-qty"
                                                                 data-product-id="{{$cartItem['product_id']}}"
                                                                 data-delivery-type="{{$cartItem['delivery_type']}}"
                                                                 data-delivery-date="{{$cartItem['delivery_date']}}"
                                                                 data-delivery-time="{{$cartItem['delivery_time']}}"
                                                                  type="button" >-</button>
                                                                <span class="quantity">{{$cartItem['cart_qty']}}</span>
                                                                <button class="btn btn-theme-round btn-number btn-csin-qty" 
                                                                data-product-id="{{$cartItem['product_id']}}" 
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

                       
                        @if(!empty($cartDetail))
                        <div class="col-lg-4" style="background-color: #fffce9;">
                        <form method="post" action="{{url('payment-process')}}">  
                            @csrf  
                                <div class="left-section pb-4" style="height:auto;">

                                <div class="row mb-2 mt-4 text_24_black">
                                        <div class="col-lg-12 text-center">Payment Method</div>
                                </div>
                                
                                <div class="row mb-3">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                                <div class="coupons_box" style="background-color: #e9f2c7;border: 0;">
                                                        <span style="margin: 6px 0 0 0;float: left;font-size: 13px;">Add Special Message Card </span>
                                                        <span style="float: right;border: 0;padding: 6px 20px;border-radius: 100px;background-color: #e5dda8;font-size: 13px;">Add</span>
                                                </div>
                                        </div>
                                </div>
                                <div class="row mb-3">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                                <p class="text-danger coupon_message"></p>
                                                <input type="text" placeholder="Enter coupon code" style="border: 1px solid #424242;border-radius: 10px;padding: 6px 14px;width: 70%;outline: none;background: no-repeat;" class="txt_coupon_code" value="{{Session::get('coupon')}}">
                                                <input type="button" value="Redeem" class="btn_coupon_apply red_button btn_redeem" style="float: right;width: auto;padding: 7px 13px;margin: 3px 9px 0 0;font-size: 13px;">
                                                <a href="{{url('coupons')}}" style="font-size: 12px;color: #f03613;margin: 4px 0 0 15px;float: left;">View Coupons</a>
                                                
                                        </div>
                                </div>

                                <div class="row mb-2">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                         @if(!empty($app_info['userwallet']))
                                        <div class="row">
                                        <div class="col-lg-12 wallet_box">
                                        <input type="checkbox" name="wallet" value="1" id="wallet">
                                        <label for="wallet" class="coupons_box" style="background-color: #fffce9;border: 1px solid #454545; padding:12px 10px; cursor:pointer">
                                            <div class="details_message_select" style="align-items: center;">
                                                <div class="row">                                                                        
                                                <div class="col-lg-12">
                                                    <img src="assets/images/checkout/wallet_icon.png" class="img-fluid">
                                                    <div class="apply_text" style="color: #000; text-shadow: none;">Wallet: <b style="color: #26b312; font-weight: normal;">{{$app_info['userwallet'] ?? 0}} AED</b></div>
                                                    <div class="tick"></div>
                                                </div>                                                                        
                                                                        </div>
                                                                </div>
                                        </label>                                                
                                        </div>
                                        <p class="text-danger d-none">Entered amount should not be more than wallet balance</p>
                                        <div class="col-lg-12 mt-2 mb-2 d-none wallet-amount-box">
                                            
                                            <input type="text" class="wallet_txt" placeholder="Enter wallet amount" style="border: 1px solid #424242;border-radius: 10px;padding: 6px 14px;width: 70%;outline: none;background: no-repeat;">
                                            <input type="button" value="apply" class="red_button btn-wallet-apply" style="float: right;width: auto;padding: 7px 13px;margin: 3px 9px 0 0;font-size: 13px;">
                                        </div>
                                        </div>
                                        @endif
                                        </div>
                                </div>

                                <div style="display:none">
                                        <div class="row mb-2">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                                <div class="row">
                                                

                                                <div class="col-lg-12">
                                                        <div class="coupons_box">
                                                        <div class="details_message_select" style="align-items: center;">
                                                                <div class="row">
                                                                        <div class="col-lg-12">
                                                                        <img src="assets/images/checkout/coupons_icon.png" class="img-fluid">
                                                                        <div class="apply_text">Apply Coupon</div>
                                                                        <a routerLink="/applycoupon">Apply</a>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        </div>
                                                        
                                                </div>


                                                
                                                </div>
                                        </div>
                                        </div>
                                </div>
                                

                             <!--    <div>
                                        <div class="row mb-2">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                                <div class="row">
                                                

                                                <div class="col-lg-12">
                                                        <div class="coupons_box">
                                                        <div class="details_message_select" style="align-items: center;">
                                                                <div class="row">
                                                                        <div class="col-lg-12">
                                                                        <img src="assets/images/checkout/coupons_icon.png" class="img-fluid">
                                                                        <div class="apply_text">Apply Coupon</div>
                                                                        <a routerLink="/applycoupon">Apply</a>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        </div>
                                                        
                                                </div>


                                                
                                                </div>
                                        </div>
                                        </div>
                                </div> -->
                                


                                <!-- <div class="row mb-2">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                <div class="coupons_box" style="background-color: #fffce9;border: 1px solid #454545;">
                                                        <div class="details_message_select" style="align-items: center;">
                                                                <div class="row">
                                                                
                            <div class="col-lg-12">
                                    <img src="assets/images/checkout/wallet_icon.png" class="img-fluid">
                                    <div class="apply_text" style="color: #000; text-shadow: none;">Wallet: <b style="color: #26b312; font-weight: normal;">0.00 AED</b></div>
                            </div>
                                                                
                                                                </div>
                                                        </div>
                                                </div>
                                                
                                                </div>
                                        </div>
                                        </div>
                                </div> -->
                                
                                
                                
                                <div class="row mb-4" *ngIf="!isProcessing">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                        <div class="row">
                                                <div class="col-lg-12" >                                                

                                                
                                                <div class="coupons_box cashondelivery_box onlinepayment_box" *ngIf="totalOrderPrice!=0">
                                                        <div class="row details_message_select" style="align-items: center;">
                                                        <input type="radio" id="card2" style="display: none;" name="point" (change)="onChange(2)"checked >
                                                        <label for="card2">
                                                                <span></span>
                                                                <div class="row">
                                                                <div class="col-lg-12">
                                                                        <img src="assets/images/checkout/card_icon.png" class="img-fluid" style="max-height: 24px;">
                                                                        <div class="apply_text">Card Payment</div>
                                                                </div>
                                                                </div>
                                                        </label>
                                                        </div>
                                                        
                                                </div>



                                                </div>
                                        </div>
                                        </div>
                                </div>

                                <div class="row mb-2 total_text">
                                        <div class="col-1"></div>
                                        <div class="col-6">Subtotal</div>
                                        <div class="col-5"  >: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['total_price']}} (+)</span></div>
                                </div> 

                                <div class="row mb-2 total_text">
                                        <div class="col-1"></div>
                                        
                                        <div class="col-6"  *ngIf="cartDataList.delivery_charge_discount>0">Delivery Fee</div>
                                        <div *ngIf="cartDataList.delivery_charge_discount>0" class="col-5">: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['delivery_charge_discount']}}  (+)</span></div>
                                        
                                </div>
                                <!-- <div class="row mb-2 total_text">
                                        <div class="col-1"></div>
                                        <div class="col-6">Discount</div>
                                        <div class="col-5"  >: <span style="color: #26b312;font-family: Metropolis-Bold;">AED {{$cartDetail['discountonmrp']}} (-)</span></div>
                                </div>  -->
                                
                                @if($cartDetail['order_coupon_amount']>0)
                                <div class="row mb-2 total_text">
                                        <div class="col-1"></div>
                                        <div class="col-6">Coupon Discount</div>
                                        <div *ngIf="isCouponApplied" class="col-5" >: <span style="color: #26b312;font-family: Metropolis-Bold;"> AED {{$cartDetail['order_coupon_amount']}} (-)</span></div>
                                </div> 
                                @endif

                                
                                <div class="row mb-2 total_text d-none wallet-div">
                                        <div class="col-1"></div>
                                        <div class="col-6">Wallet Amount</div>
                                        <div class="col-5"  >: <span class="wallet_used_balance" style="color: #26b312;font-family: Metropolis-Bold;">AED {{$cartDetail['wallet_used_balance']}} (-)</span></div>
                                </div> 
                                
                                
                                @if($cartDetail['delivery_charge_discount'] > 0)
                                <div class="row mb-2 total_text">
                                        <div class="col-1"></div>

                                        <div class="col-6" *ngIf="cartDataList.delivery_charge==0">Delivery Fee Discount</div>
                                        <div *ngIf="cartDataList.delivery_charge==0" class="col-5">: <span style="color: #26b312;font-family: Metropolis-Bold;">AED {{$cartDetail['delivery_charge_discount']}} (-)</span></div>
                                </div>
                                @endif

                                <hr>
                                <div class="cardetails_rightbox_total_desktop">
                                        <div class="row mb-4 text_24_black" style="color: #e20312;">
                                        <div class="col-1"></div>
                                        <div class="col-6">Total Amount</div>   

                                        <input type="hidden" name="wallet_amount" class="wallet_amount" value="{{$app_info['userwallet'] ?? 0}}">                     
                                        <input type="hidden" name="total_amount" class="total_amount" value="{{$cartDetail['total_price']}}">

                                        <input type="hidden" name="used_wallet_amount" class="used_wallet_amount" value="0">                     
                                        <input type="hidden" name="remaining_total_amount" class="remaining_total_amount" value="{{$cartDetail['total_price']}}">


                                        <div class="col-5" >: AED <span class="total_amount_lbl">{{$cartDetail['total_price']}}</span></div>

                                        </div>
                                        <div class="row mb-3" *ngIf="!isProcessing">
                                        <div class="col-lg-12 text-center">
                                                <button class="red_button placeorder_btn" style="text-transform: uppercase; padding: 13px 30px 13px 60px;">Proceed to Payment</button>
                                        </div>
                                        </div>
                                </div>
                                
                                <!-- MOBILE-VIEW-START -->
                                <div class="row">
                                        <div class="col-lg-12">
                                        <div class="product_details_addtocartfix_mobile cartdetails_rightbox_totalbox_mobile" style="padding: 10px 10px 18px 10px;">
                                                <div class="total_pricebox_mobile mb-2">
                                                Total:
                                                <span *ngIf="!isCouponApplied">: {{$cartDetail['total_price']}} AED</span>
                                                </div>
                                                <div>
                                                <button class="red_button placeorder_btn" style="text-transform: uppercase; padding: 13px 30px 13px 60px;">Proceed to Payment</button> 
                                                </div>
                                        </div>
                                        </div>
                                </div>
                                <!-- MOBILE-VIEW-END -->

                                </div>
                             </form>       
                        </div>
                         @endif
                </div>
          </div>
        </section>
</div>
@include('layout.footer')
