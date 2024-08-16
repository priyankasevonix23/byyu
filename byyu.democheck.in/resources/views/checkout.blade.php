@include('layout.header')
<style>
.hidden {
visibility: hidden;
opacity: 0;
pointer-events: none;
}
</style>
<script>
   //   ADD-MESSAGE-POPUP-START
   function addmessage() {
         var x = document.getElementById("addmessage_popupbox");
         if (x.className === "addmessage_popupbox") {
             x.className += " addmessage_popupbox_open";
         } else {
             x.className = "addmessage_popupbox";
         }
     }
   //   ADD-MESSAGE-POPUP-START
</script>
<div class="middle_box width100 checkout_mainbox">
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
                                    </div>
                                    <div class="col-lg-3 text-center mb-3">
                                       <!-- <img src="assets/images/cart/cart_quantity.png" style="max-height: 27px;" class="img-fluid"> -->
                                       <div class="addcard_btn d-flex align-items-baseline quantity_box" style="max-width: 110px;margin: 0 auto;">
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
               <form method="post" action="{{url('load-payment')}}">
                  @csrf  
                  <div class="pb-4" style="height:auto;">
                     <div class="row mb-2 mt-3 text_24_black">
                        <div class="col-lg-12 text-center">Payment Method  </div>
                     </div>
                     
                     <div class="row mb-3">
                        <div class="col-lg-1"></div>
                         <div class="col-lg-10">
                                <span class="text-danger coupon_message" style="text-align: center;float: left;width: 100%;font-size: 13px;"></span>
                                <input type="text" placeholder="Enter coupon code" style="border: 1px solid #424242;border-radius: 10px;padding: 6px 14px;width: 70%;outline: none;background: no-repeat;" class="txt_coupon_code" name="txt_coupon_code" value="<?php echo @$_GET['coupon_code'];?>">
                                <input type="button" value="Redeem" class="btn_coupon_apply red_button btn_redeem" style="float: right;width: auto;padding: 7px 13px;margin: 3px 9px 0 0;font-size: 13px;">
                                <input type="button" value="Remove" class="btn_coupon_remove d-none red_button" style="float: right;width: auto;padding: 7px 13px;margin: 3px 9px 0 0;font-size: 13px;">
                                <input type="hidden" value="{{$_GET['address_id']}}" id="address_id" name="address_id">
                                <a href="{{url('coupons')}}?address_id={{$_GET['address_id']}}" style="font-size: 12px;color: #f03613;margin: 4px 0 0 15px;float: left;">View Coupons</a>
                                
                        </div>
                     </div>
                     
                     <div class="row mb-3">
                        <div class="col-1"></div>
                        <div class="col-10">
                           @if(!empty($app_info['userwallet']))
                           <div class="row">
                              <div class="col-lg-12 wallet_box">
                                 <input type="checkbox" name="wallet" value="1" id="wallet" style="display: none;">
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
                                    <div class="wallet_amount_box">
                                       <p class="text-danger d-none" style="font-size:12px;"></p>
                                       <div class="col-lg-12 mt-2">
                                          <input type="text" class="wallet_txt" placeholder="Enter wallet amount" style="border: 1px solid #424242;border-radius: 10px;padding: 6px 14px;width: 67%;outline: none;background: no-repeat;">
                                          <input type="button" value="Use" class="red_button btn-wallet-apply" style="float: right;width: auto;padding: 7px 13px;margin: 3px 9px 0 0;font-size: 13px;">
                                          <input type="button" value="Remove" class="btn_wallet_remove d-none red_button" style="float: right;width: auto;padding: 7px 11px;margin: 3px 9px 0 0;font-size: 13px;">
                                       </div>
                                    </div>
                                 </label>
                                 
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
                     
                     
                     <div class="row mb-3" *ngIf="!isProcessing">
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
                     <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10 mb-2">
                           
                           <div class="coupons_box" style="background-color: #e9f2c7;border: 0;">
                              <span style="margin: 6px 0 0 0;float: left;font-size: 13px;">Add Special Message Card</span>
                              <input type="hidden" name="selectmessagenameinput" id="selectmessagenameinput">
                              <span  style="float: right;border: 0;padding: 6px 20px;border-radius: 100px;background-color: #e5dda8;font-size: 13px; cursor:pointer" onclick="addmessage()">Add</span>
                           </div>
                           <div style="position: relative;float: left;width: 100%;">
                              <div class="coupons_box" style="border: 0; font-size:13px;text-align: center;padding: 10px 0 10px 0;" id="selectmessagename"></div>
                              <span class="hidden" id="closebuton" style="position: absolute;top: 0;background-color: #ef3410;line-height: normal;padding: 1px 5px;border-radius: 100px;color: #fff;font-size: 12px;cursor:pointer;" onclick="removeMessage()">x</span>
                           </div>
                           <!-- ADD-MESSAGE-POPUP-STAR -->                                                        
                           <div class="addmessage_popupbox" id="addmessage_popupbox">
                              <span onclick="addmessage()" class="addmessage_close">x</span>
                              <div class="row">
                                 <div class="col-lg-12 mb-4">
                                    <div class="available_box" style="border-radius: 0;">
                                       <div class="row">
                                          <div class="col-lg-12 mb-3 text_25_black">Add Message:</div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 mb-4">
                                             <div class="addmessage_box">
                                                 <?php $j=1;?>
                                                @foreach($getmessages['data'] as $getmessage)
                                                <div class="addmessage_list" id="{{$getmessage['event_name']}}">
                                                   <input type="radio" name="addmessagetitle" onclick="changeMessage('<?php echo $getmessage['event_name'];?>')" id="{{$getmessage['event_name']}}-1" <?php if($j == 1) { ?> checked <?php } ?>>
                                                   <label for="{{$getmessage['event_name']}}-1">
                                                      <div>{{$getmessage['event_name']}}</div>
                                                   </label>
                                                </div>
                                                <?php $j=$j+1;?>
                                                @endforeach
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 mb-3">
                                              <?php $i=1;?>
                                             @foreach($getmessages['data'] as $getmessag)
                                             <div class="addmessage_box messageclass"  id="{{$getmessag['event_name']}}-2" <?php if($i == 1){ ?> style="display:block;" <?php }else{?> style="display:none;" <?php }?>>
                                                 <?php $datamessage=$getmessag['events_message'];$k=1;?>
                                                @foreach($datamessage as $dmessage)
                                                
                                                <?php
                                                $messages="";
                                                $messages=$dmessage['message'];
                                                $idName=$getmessag['event_name']."_m".$k;
                                                ?>
                                                <div class="addmessage_list2">
                                                   <input type="radio" id="{{$getmessag['event_name']}}_m{{$k}}" name="addmessage" value="{{$dmessage['message']}}" onclick='messagevaluesList("<?php echo $idName ?>")'>
                                                   <label for="{{$getmessag['event_name']}}_m{{$k}}">
                                                   {{$dmessage['message']}}
                                                   </label>
                                                </div>
                                                <?php $k=$k+1;?>
                                                @endforeach
                                             </div>
                                              <?php $i=$i+1;?>
                                             @endforeach
                                          </div>
                                       </div>
                                       <div class="row details_message_select" style="align-items: center;">
                                          <div class="col-lg-12 mb-2" style="font-weight: bold;">Personalized Message:</div>
                                          <div class="col-lg-12">
                                             <textarea name="message" id="messageData" cols="30" rows="2" placeholder="Type here.."
                                                style="background-color: #fff;width: 100%;"  maxlength="250"></textarea>
                                             <div style="font-size: 10px;float: right;">up to 250 characters</div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <a onclick="messagesData();" class="red_button">Add Message</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- ADD-MESSAGE-POPUP-STAR -->
                        </div>
                     </div>
                     
                     @if($cartDetail['delivery_charge'] > 0)
                     <div class="row mb-2 total_text">
                        <div class="col-1"></div>
                        <div class="col-6">Subtotal</div>
                        <div class="col-5"  >: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['total_price']-$cartDetail['delivery_charge']}} (+)</span></div>
                     </div>
                     <div class="row mb-2 total_text">
                        <div class="col-1"></div>
                        <div class="col-6"  *ngIf="cartDataList.delivery_charge_discount>0">Delivery Fee</div>
                        <div *ngIf="cartDataList.delivery_charge_discount>0" class="col-5">: <span style="color: #e20312;font-family: Metropolis-Bold;">AED {{$cartDetail['delivery_charge']}}  (+)</span></div>
                     </div>
                     @else
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
                     @endif
                     
                     <!-- <div class="row mb-2 total_text">
                        <div class="col-1"></div>
                        <div class="col-6">Discount</div>
                        <div class="col-5"  >: <span style="color: #26b312;font-family: Metropolis-Bold;">AED {{$cartDetail['discountonmrp']}} (-)</span></div>
                        </div>  -->
                    @if($cartDetail['order_coupon_amount'])    
                     <div class="row mb-2 total_text coupon-div @if($cartDetail['order_coupon_amount'] == 0) d-none @endif">
                        <div class="col-1"></div>
                        <div class="col-6">Coupon Discount</div>
                        <div class="col-5" >: <span style="color: #26b312;font-family: Metropolis-Bold;" class="coupon_amount"> AED {{$cartDetail['order_coupon_amount']}} (-)</span></div>
                    </div> 
                    @else
                    <?php
                    $coupon_amt=0;
                    ?>
                    @if($apply_coupon) 
                    <div class="row mb-2 total_text coupon-div">
                        <div class="col-1"></div>
                        <div class="col-6">Coupon Discount (<b>{{$apply_coupon['data']['coupon_code']}}</b>)</div>
                        <div class="col-5" >: <span style="color: #26b312;font-family: Metropolis-Bold;" class="coupon_amount"> AED {{$apply_coupon['data']['save_amount']}} (-)</span></div>
                    </div>
                    <?php 
                    $coupon_amt=$apply_coupon['data']['save_amount'];
                    ?>
                    @endif
                    
                    @endif
                    
                    

                     <div class="row mb-2 total_text d-none wallet-div">
                        <div class="col-1"></div>
                        <div class="col-6">Wallet Amount</div>
                        <div class="col-5"  >: <span class="wallet_used_balance" style="color: #26b312;font-family: Metropolis-Bold;">AED {{$cartDetail['wallet_used_balance']}} (-)</span></div>
                     </div>
                     @if($cartDetail['delivery_charge_discount'] > 0 && $cartDetail['delivery_charge'] == 0)
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
                           <input type="hidden" name="old_remaining_total_amount" class="old_remaining_total_amount" value="<?php echo $cartDetail['total_price'] - $coupon_amt;?>">
                           <input type="hidden" name="remaining_total_amount" class="remaining_total_amount" value="<?php echo $cartDetail['total_price'] - $coupon_amt;?>">
                           <input type="hidden" name="hd_coupon_amount" class="hd_coupon_amount" value="{{$coupon_amt}}">

                           <div class="col-5" >: AED <span class="total_amount_lbl"><?php echo $cartDetail['total_price'] - $coupon_amt;?></span></div>
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


<script>
    
function changeMessage(val)
{
var divsToHide = document.getElementsByClassName("messageclass"); //divsToHide is an array
for(var i = 0; i < divsToHide.length; i++){
divsToHide[i].style.display = "none"; // depending on what you're doing
}

document.getElementById(val+"-2").style.display="block";
document.getElementById("messageData").value="";
}

function messagevaluesList(val)
{

var message=document.getElementById(val).value;
document.getElementById("messageData").value=message;
}

function messagesData()
{
var messageData=document.getElementById("messageData").value;
document.getElementById("selectmessagenameinput").value=messageData;   
document.getElementById("selectmessagename").textContent=messageData;  
addmessage()
$('#closebuton').removeClass('hidden');
}

function removeMessage()
{
document.getElementById("selectmessagenameinput").value="";   
document.getElementById("selectmessagename").textContent="";  
$('#closebuton').addClass('hidden');   
}


document.addEventListener('DOMContentLoaded', (event) => {
// Get the checkbox and container elements
const toggleCheckbox = document.getElementById('toggleCheckbox');
const walletContainer = document.getElementById('walletContainer');

// Add event listener to the checkbox
toggleCheckbox.addEventListener('change', function() {
if (this.checked) {
walletContainer.classList.remove('hidden');
} else {
walletContainer.classList.add('hidden');
}
});
});

</script>