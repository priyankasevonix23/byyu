@include('layout.header')

<div class="middle_box width100">

        <section class="">

            <div class="container">

                <form method="get" action="{{url('checkout')}}">

                <div class="row">

                    

                    <div class="col-lg-8 pt-4 mb-3">

                        <div class="row">

                            <div class="col-lg-12 mb-4 black_heading">

                                Select Recipients Address

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-12 mb-5">

                                <div class="row">

                                  

                                    @if(!empty($userAddresses))

                                    @foreach($userAddresses as $key=>$userAddress)

                                    <div class="col-lg-6 mb-5">

                                        <div class="current_address_box_list">

                                            <input type="radio" id="{{$userAddress['address_id']}}" name="address_id" class="address" value="{{$userAddress['address_id']}}" @if($key==0)checked @endif>

                                            

                                            <label for="{{$userAddress['address_id']}}" class="current_address_box">

                                                <div class="edit_icon_box">

                                                <a href="{{ route('deleteaddress', ['id' => $userAddress['address_id']]) }}" class="edit_address_icon">

                                                    <img src="{{ asset('assets/images/profile/delete_icon.png') }}" class="img-fluid">

                                                </a>

                                                    <a href="{{ route('addressnew', ['addresstype'=>'cart','id' => $userAddress['address_id']]) }}" class="edit_address_icon"><img src="assets/images/profile/edit_icon.png" class="img-fluid"></a>

                                                </div>                                      

                                                <div class="address_heading"> {{ $userAddress['type'] }}</div>

                                                <div style="float: left; width: 100%; margin: 0 0 5px 0; color: #f03613; font-weight: bold; font-size: 15px;">

                                                   {{$userAddress['receiver_name']}}

                                                </div>

        

                                                <b>Address:</b>

                                                {{$userAddress['city']}}<br>

                                                <b>Community/Building Name: </b>{{$userAddress['house_no']}} <br>

                                                <b>Villa/Apartment Number: </b>{{$userAddress['building_villa']}}  <br>

                                                <b>Street/Locality Name: </b>{{$userAddress['society']}}  <br>

                                                <b>Landmark: </b>{{$userAddress['landmark']}}  <br>

                                                <b>Emirate: </b>{{$userAddress['emirates'] ?? 'Dubai'}} 

                                                <br><br>

                                                <div style="float: left;width: 100%;margin: 0 0 10px 0;"><b>Mobile No:</b>  {{$userAddress['country_code']}} {{$userAddress['receiver_phone']}}</div>

                                            </label>

                                        </div>

                                    </div>

                                    @endforeach

                                    @else

                                    <div class="row">

                                        <div class="col-lg-12 mb-5">

                                            <div class="row"><!---->

                                                <div class="col-lg-12 mt-3 ng-star-inserted">

                                                    <div  class="row">

                                                        <div class="col-lg-12 mb-2" style="font-size: 21px; color: #d1b759; font-family: Metropolis-Bold;"> Just one step closer! </div></div>

                                                        <div class="row"><div class="col-lg-12"> To surprise your loved one with a fantastic gift, you'll need to add their delivery address. <br>Click below to get started! </div></div></div></div></div></div>

                                    @endif

                                    

                                    

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-11 text-center mb-5">

                                <a href="{{url('getmap/cart/'.$user_id)}}" class="red_button new_address_btn" style="padding: 9px 20px 9px 40px;">Add Delivery Address</a>&nbsp;

                                <!-- <a routerLink="/googlemap" class="red_button new_address_btn">Edit Address</a> -->

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

                            <div class="row" >

                                <div class="col-lg-1"></div>

                                <div class="col-lg-10 mb-3 mt-3">

                                    @php 

                                        $cartItems = !empty($cartDetail['data'])?$cartDetail['data']:[];

                                    @endphp

                                    @if(!empty($cartItems))

                                        @foreach($cartItems as $cartItem)

                                    <div class="address_right_productshow_box">

                                        <div class="address_right_productshow_img"><img src="{{ENV('ADMIN_APP_URL').$cartItem['product_image']}}?width=200&height=200?width=100&height=100" class="img-fluid"></div>

                                        <div class="address_right_productshow_heading">{{$cartItem['product_name']}}</div>

                                        <div class="address_right_productshow_qyt">Qty: {{$cartItem['cart_qty']}}</div>

                                    </div>

                                    @endforeach

                                    @endif

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

                                        <a href="{{url('cart-summary')}}"  class="red_button" style="background-color: #e5d36a; color: #000; background-image: url(assets/images/left_arrow_black.png);background-repeat: no-repeat;background-size: 13px;background-position: 11px center;padding: 9px 10px 9px 30px;">Back</a>&nbsp;

                                        <button type="submit" class="red_button proceed_to_checkout">Proceed to Checkout</button>

                                    </div>



                                </div>

                            </div>

                            

        

                        </div>

                    </div>

                   

                </div>

                 </form>

            </div>

        </section>

</div>

@include('layout.footer')