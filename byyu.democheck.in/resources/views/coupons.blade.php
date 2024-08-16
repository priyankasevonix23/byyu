@include('layout.header')
<div class="middle_box width100">
        <section class="" style="min-height: 400px;">
        <div class="container">
                <div class="row">
                <div class="col-lg-12 pt-4 mb-3">
                        <div class="row">
                        <div class="col-6 mb-3 black_heading">
                                My Coupons
                        </div>
                        <div class="col-6 mb-3">
                                <a href="{{{url('checkout')}}}?address_id={{$_GET['address_id']}}"  class="red_button" style="float: right; padding: 8px 15px; font-weight: normal;  background-color: #f1e6a6; color: #000; font-size: 12px;">Back to checkout</a>
                        </div>

                        </div>
                        <div class="row">
                        <div class="col-lg-12 mb-4">
                                <form method="post" action="{{url('select-coupons')}}">
                                     @csrf     
                                     <div class="applycoupon_box">
                                        <input type="text" name="coupontext" id="coupontext" placeholder="Enter coupon code" required>
                                        <input type="submit" value="Apply" class="applybtn" >
                                     </div>
                                </form>
                        </div>
                        </div>
                        <div class="row">
                                @if(!empty($couponList))
                                @foreach($couponList as $coupon)
                                <div class="col-lg-4 col-md-4 mb-4">
                                        <div class="mycoupons_list" style="padding: 0px; min-height: inherit;">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                <a onclick="apply_coupon('<?php echo $coupon['coupon_code'];?>','<?php echo $_GET['address_id'];?>')" style="position: relative;">
                                                        <img src="{{ENV('APP_URL')}}assets/images/checkout/coupon_bg.png" class="img-fluid">
                                                        <div style="position: absolute;top: 0;margin: 10px 0 0 50%;">
                                                                <div style="text-transform: uppercase;">{{$coupon['coupon_code']}}</div>
                                                                <div style="font-size: 19px;min-height: 67px;color: #a3a19e;">{{$coupon['coupon_description']}}</div>
                                                                
                                                        </div>
                                                        <div style="font-size: 12px;margin: -22px 0 0 45%;text-decoration: none;position: absolute;font-weight: normal;font-family: Metropolis-Regular;">Expiry Date: {{$coupon['end_date']}}</div>
                                                        <span style="margin: -24px 0 0 50px;position: absolute;color: #fff;text-decoration: none;font-size: 13px; bottom:0; left:0">Click here</span>
                                                </a>
                                                </div>
                                                <div class="col-lg-9">
                                                        
                                                        <div class="row">
                                                                <div class="col-lg-12">
                                                                <div class="coupon_tandc">
                                                                        T&C
                                                                </div>
                                                                </div>
                                                        </div>
                                                
                                                </div>
                                        </div>
                                        <div class="coupon_tandc_popup">
                                                
                                                <div [innerHTML]="data.term_and_conditions"></div>
                                        </div>
                                        </div>
                                </div>
                                @endforeach
                                @endif
                                <!-- <div class="col-lg-4 col-md-4 mb-4">
                                        <div class="mycoupons_list" style="padding: 0px; min-height: inherit;">
                                        <div class="row">
                                                <div class="col-lg-12">
                                                <div style="position: relative;">
                                                        <img src="{{ENV('APP_URL')}}assets/images/checkout/coupon_bg.png" class="img-fluid">
                                                        <div style="position: absolute;top: 0;margin: 20px 0 0 200px;">
                                                                <div style="text-transform: uppercase;">Gift 50 aed off</div>
                                                                <div style="font-size: 19px;min-height: 67px;color: #a3a19e;">Gift voucher</div>
                                                                <div style="font-size: 12px;margin: 4px 0 0 0;">Expiry Date: 2024-08-29</div>
                                                        </div>
                                                </div>
                                                </div>
                                                <div class="col-lg-9">
                                                        
                                                
                                                        <div class="row">
                                                                <div class="col-lg-12">
                                                                <div class="coupon_tandc">
                                                                        T&C
                                                                </div>
                                                                </div>
                                                        </div>
                                                
                                                </div>
                                        </div>
                                        <div class="coupon_tandc_popup">
                                                
                                                <div [innerHTML]="data.term_and_conditions"></div>
                                        </div>
                                        </div>
                                </div> -->
                        </div>


                </div>

                </div>
        </div>
        </section>
</div>
@include('layout.footer')
