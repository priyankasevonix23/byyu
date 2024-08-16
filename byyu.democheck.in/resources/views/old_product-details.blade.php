@include('layout.header')
<link href="{{ENV('APP_URL')}}assets/xzoom.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .xzoom-source img, .xzoom-preview img, .xzoom-lens img {
  display: block;
  max-width: none;
  max-height: none;
  -webkit-transition: none;
  -moz-transition: none;
  -o-transition: none;
  transition: none;
}
#social-links ul{
      padding-left: 0;
 }
 #social-links ul li {
      display: inline-block;
 } 
 #social-links ul li a {
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin: 1px;
      font-size: 25px;
 }
 #social-links .fa-facebook{
       color: #0d6efd;
 }
 #social-links .fa-twitter{
       color: deepskyblue;
 }
 #social-links .fa-linkedin{
       color: #0e76a8;
 }
 #social-links .fa-whatsapp{
      color: #25D366
 }
 #social-links .fa-reddit{
      color: #FF4500;;
 }
 #social-links .fa-telegram{
      color: #0088cc;
 }
</style>
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@php
    $productDetail = $product['detail'];
@endphp
<div class="middle_box width100">
        <section class="mb-5 product_details_mainbox">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-5 mb-2 mt-4 left-section">

                        <div class="row">
                            <div class="col-lg-11">

        
                                
                                <div class="row">
                                    <div class="col-lg-12 " style="position: relative;">
        
                                        <p class="alert alert-info alert-message d-none"></p>
                                        <div class="product-details-leftbox">
        
                                            <!-- <div id="lens" style="display: none; width: 250px; height: 250px; top: 8px; left: 258px;"></div> -->
        
                                            <div id="slideshow-items-container" class="product_details_imagebox mb-4">
                                                <!-- <img src="{{ENV('BUNNY_NET_URL')}}{{$productDetail['images'][0]['image']}}?width=800&height=800" alt="{{$productDetail['product_name']}}" class="slideshow-items active">
                                             -->
                                                <img class="xzoom" id="xzoom-default"  src="{{ENV('BUNNY_NET_URL')}}{{$productDetail['images'][0]['image']}}?width=800&height=800" alt="{{$productDetail['product_name']}}" xoriginal="{{ENV('BUNNY_NET_URL')}}{{$productDetail['images'][0]['image']}}?width=800&height=800" />

                                                <div class="product_wishlist" data-product-id="{{$productDetail['product_id']}}" style="z-index: 500;">
                                                    <a>                                        
                                                        @if($productDetail['isFavourite'] == "true")
                                                        <div><img  src="{{ENV('APP_URL')}}assets/images/product_wishlist_active.png" alt="wishliated" style="max-width:20px"></div>
                                                        @endif
                                                        
                                                        @if($productDetail['isFavourite'] == "false")
                                                        <div><img  src="{{ENV('APP_URL')}}assets/images/product_wishlist.png" alt="wishliated" style="max-width:20px"></div>
                                                        @endif
                                                    </a>
                                                </div>
        
                                            </div>
        
                                           <!--  <div id="result"
                                                style="display: none; width: 500px; height: 500px; top: 8px; left: 518px; background-size: 1000px 1000px; background-position: -500px 0px;">
                                            </div>
         -->
                                            
        
                                            <div class="slideshow-items-list">
                                                <div class="row">
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="thumbnail_images_list">
                                                        <div class="xzoom-thumbs">    
                                                        @if(!empty($productDetail['images']))
                                                        @foreach($productDetail['images'] as $image)
                                                            <!-- <label class="thumbnail_images_box">
                                                                <img (click)="thumbnailimageclick(i)" src="{{ENV('BUNNY_NET_URL')}}{{$image['image']}}?width=200&height=200" class="slideshow-thumbnails" alt="{{$productDetail['product_name']}}" >
                                                            </label> -->

                                                            <a href="{{ENV('BUNNY_NET_URL')}}{{$image['image']}}?width=800&height=800">
                                                                <img class="xzoom-gallery" width="80" src="{{ENV('BUNNY_NET_URL')}}{{$image['image']}}?width=200&height=200"  xpreview="{{ENV('BUNNY_NET_URL')}}{{$image['image']}}?width=500&height=500" alt="{{$productDetail['product_name']}}">
                                                            </a>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                        </div>
        
                                        
        
                                    </div>
                                </div>
        
                            </div>
                        </div>
        
                    </div>
                    <div class="col-lg-7 right-section">
                        <div class="row details_heading_desktop mb-4">
                            <div class="col-lg-12 text_24_black" style="border-bottom: 1px solid #ccc;">
                                <div class="details_heading" style="font-family: Metropolis-Bold;">{{$productDetail['product_name'] ?? ''}}</div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="">{!! $productDetail['description'] ?? '' !!}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="details_price_box text_24_black">

                                    <!-- <div class="home_product_price">
                                        {{$productDetail['base_price'] ?? '0'}}
                                        <span>{{$productDetail['base_mrp'] ?? '0'}}</span>
                                        <div class="discount_text">{{$productDetail['discountper'] ?? ''}}% Off
                                        </div>
                                        <div class="currency_text">AED</div>
                                    </div> -->
                                    @if(!empty($productDetail['varients']))
                                    @foreach($productDetail['varients'] as $key=>$varient)
                                    
                                     <div class="home_product_price @if($key != 0) d-none @endif" id="home_product_price_{{$varient['varient_id']}}">
                                        {{$varient['price'] ?? '0'}}
                                        <span>{{$varient['mrp'] ?? '0'}}</span>
                                        <div class="discount_text">{{$varient['discountper'] ?? ''}}% Off
                                        </div>
                                        <div class="currency_text">AED</div>
                                    </div> 
                                                              
                                    @endforeach
                                    @endif
                                                                       
                                                                 
                                    <div class="earliest_text">
                                        Earliest Delivery:&nbsp;
                                        @if(!empty($productDetail['delivery']))
                                            @if($productDetail['delivery'] == 1) 
                                               <b>Express</b>  
                                            @elseif($productDetail['delivery'] == 2)    
                                                <b>Today</b>
                                            @elseif($productDetail['delivery'] == 3)    
                                                <b>Tomorrow</b>
                                            @endif    
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(!empty($productDetail['varients']) && count($productDetail['varients'])> 1)
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="available_box" style="background-color: #fff; padding: 20px 30px 20px 30px; position: relative;border: 1px solid #ccc;">
                                    <div class="row">
                                        <div class="col-lg-12 text_25_black mb-2">Select Varient:</div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if(!empty($productDetail['varients']))
                                             @foreach($productDetail['varients'] as $key=>$varient)
                            @php
                                $varient_slug = \Str::slug($productDetail['product_name'],'+').'-'.$varient['varient_id'];
                            @endphp
                                            <div class="select_varient_list">
                                                <input type="radio" name="varient22" class="varients_dd" value="{{$varient['varient_id']}}" id="varient{{$varient['varient_id']}}">
                                                <label for="f1">
                                                    <div class="varient_img"><img src="{{ENV('APP_URL')}}assets/images/varient_cake.png" alt=""></div>
                                                    <div class="varient_text">{{$varient['quantity']}} {{$varient['unit']}}</div>
                                                    <div class="varient_price"> {{$varient['price'] ?? '0'}} AED</div>
                                                </label>
                                            </div>
                                            @endforeach
                                            @endif 
                                            <!-- <div class="select_varient_list">
                                                <input type="radio" name="varient22" id="f2">
                                                <label for="f2">
                                                    <div class="varient_img"><img src="{{ENV('APP_URL')}}assets/images/varient_flower.png" alt=""></div>
                                                    <div class="varient_text">Birthday</div>
                                                    <div class="varient_price">300 AED</div>
                                                </label>
                                            </div>
                                            <div class="select_varient_list">
                                                <input type="radio" name="varient22" id="f3">
                                                <label for="f3">
                                                    <div class="varient_img"><img src="{{ENV('APP_URL')}}assets/images/varient_flower.png" alt=""></div>
                                                    <div class="varient_text">For Father</div>
                                                    <div class="varient_price">300 AED</div>
                                                </label>
                                            </div>
                                            <div class="select_varient_list">
                                                <input type="radio" name="varient22" id="f4">
                                                <label for="f4">
                                                    <div class="varient_img"><img src="{{ENV('APP_URL')}}assets/images/varient_flower.png" alt=""></div>
                                                    <div class="varient_text">For Couple</div>
                                                    <div class="varient_price">300 AED</div>
                                                </label>
                                            </div>
                                            <div class="select_varient_list">
                                                <input type="radio" name="varient22" id="f5">
                                                <label for="f5">
                                                    <div class="varient_img"><img src="{{ENV('APP_URL')}}assets/images/varient_flower.png" alt=""></div>
                                                    <div class="varient_text">For Mother</div>
                                                    <div class="varient_price">300 AED</div>
                                                </label>
                                            </div> -->
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endif     


                        @if(!empty($productDetail['varients']) && count($productDetail['varients'])> 1)
                        <!-- <div class="row" id="top">
                            <div class="col-lg-12 mb-4">
                                <div class="available_box"
                                    style="background-color: #f9f8ee; padding: 20px 30px 20px 30px; position: relative;">
                                    <div class="row">
                                        <div class="col-lg-12 text_25_black mb-2">Select Varient:</div>
                                    </div>
                                    <div class="row ">
                                   
                                        <div class="col-lg-12">        
                                            <div class="delivery_box">
                                                <!-- <input type="radio" id="nextday" name="delivery"> -->
                                              <!--   <label for="nextday">
                                                    <div class="whitebox_main">
                                                        <div class="row">
                                                            <div class="col-lg-12" style="position: relative;"> -->
                                                                <?php //print_r($productDetail['varients']); ?>
                                                                @if(!empty($productDetail['varients']))
                                                               <!--  <select name="varients_dd" class="varients_dd">
                                                                    <option value="" disabled>Select Variant</option> -->
                                                                    @foreach($productDetail['varients'] as $key=>$varient)
                                                                    @php
                                $varient_slug = \Str::slug($productDetail['product_name'],'+').'-'.$varient['varient_id'];
                            @endphp
                                                                        <!-- <option value="{{$varient['varient_id']}}" data-slug="{{url('product-details') .'/'.$varient_slug}}" @if($key==0) selected @endif>{{$varient['quantity']}} {{$varient['unit']}}</option> -->
                                                                    @endforeach
                                                                <!-- </select> -->
                                                                @endif
                                                            <!-- </div> -->
                                                        <!-- </div> -->
                                                    <!-- </div> -->
                                                <!-- </label> -->
                                            <!-- </div> -->
        
                                        <!-- </div> -->
                                        
                                    <!-- </div> -->
        
                                <!-- </div> -->
                            <!-- </div> -->
                        <!-- </div>   -->
                        @endif      
        
                        <form method="post" action="{{url('add-to-cart')}}">

                        <input type="hidden" name="_token" value="{{csrf_token()}}" />    
                        <input type="hidden" name="product_id" class="product_id" value="{{$productDetail['product_id'] ?? ''}}">
                        <input type="hidden" name="product_delivery_type" class="product_delivery_type" value="{{$productDetail['delivery'] ?? ''}}">
                        <input type="hidden" name="delivery_date" class="delivery_date" value="">
                        <input type="hidden" name="delivery_time" class="delivery_time" value="">
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <input type="hidden" name="currentpage" value="{{\URL::current()}}">

                        <div class="row mb-5">
                            <div class="col-lg-12">
                                <div class="available_box" style="background-color: #f9f8ee; padding: 20px 30px 20px 30px; position: relative;">
                                    <div class="row">
                                        <div class="col-lg-12 text_25_black mb-2">Choose Delivery Type:</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12 choose_delivery_mainbox">
                                            @if($productDetail['delivery'] == 1) 
                                            <div class="detail_type_box_list">
                                                <input type="radio" id="Express" name="delivery" value="1" @if($productDetail['delivery'] == 1) checked="checked" @endif>
                                                <label class="detail_type_box" for="Express">
                                                    <img src="{{ENV('APP_URL')}}assets/images/product-details/express_icon.png" alt="">
                                                    <div class="detail_type_text">Express Delivery</div>
                                                    <span></span>
                                                </label>
                                            </div>
                                            @endif

                                            @if($productDetail['delivery'] == 1 || $productDetail['delivery'] == 2) 
                                            <div class="detail_type_box_list">
                                                <input type="radio" id="Same" name="delivery" value="2" @if($productDetail['delivery'] == 2) checked="checked" @endif>
                                                <label class="detail_type_box" for="Same">
                                                    <img src="{{ENV('APP_URL')}}assets/images/product-details/standard_icon.png" alt="">
                                                    <div class="detail_type_text">Same Day</div>
                                                    <span></span>
                                                </label>
                                            </div>
                                            @endif

                                            @if($productDetail['delivery'] == 1 || $productDetail['delivery'] == 2 || $productDetail['delivery'] == 3) 
                                            <div class="detail_type_box_list">
                                                <input type="radio" id="Scheduled" name="delivery" value="3" @if($productDetail['delivery'] == 3) checked="checked" @endif>
                                                <label class="detail_type_box" for="Scheduled">
                                                    <img src="{{ENV('APP_URL')}}assets/images/product-details/nextday_icon.png" alt="" style="margin: 0 10px 0 -20px;">
                                                    <div class="detail_type_text">Scheduled delivery</div>
                                                    <span></span>
                                                </label>
                                            </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="row" style="font-size: 12px;">
                                        <div class="col-3 delivery_datebox">
                                            <div class="col-lg-12">Delivery Date:</div>
                                            <div class="col-lg-12"><input type="date" id="datePicker2" required value="{{$productDetail['cart_delivery_date']}}" style="font-size: 12px;min-height: inherit;padding: 5px 10px 6px 10px;"></div>
                                        </div>
                                        <div class="col-3 delivery_timebox">
                                            <div class="row">
                                                <div class="col-lg-12">Time Slot:</div>
                                                <div class="text-danger timeslot-error"></div>
                                                <div class="col-lg-12">
                                                    <select name="timeslot" class="ptimeslot" required oninvalid="this.setCustomValidity('Please select Timeslot')" oninput="setCustomValidity('')" data-time-slot="{{$productDetail['cart_delivery_time']}}"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product_details_addtocartfix_mobile">

                            @if($product['other_details'] && count($product['other_details'])>0)
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach($product['other_details'] as $cdetail)
                                    <?php //echo "<pre>";print_r($cdetail);echo "</pre>"; ?>
                                        @if($cdetail['field_type'] == "Image")

                                        <div class="row" id="top">
                                            <div class="col-lg-12 mb-4">
                                                <div class="available_box"
                                                    style="background-color: #f9f8ee; padding: 20px 30px 20px 30px; position: relative;">
                                                    <div class="row">
                                                        <div class="col-lg-12 text_25_black mb-2">{{$cdetail['field_value']}} <small>(Maximum File Size {{$cdetail['character_limt']}}  MB )</small>:</div>
                                                    </div>
                                                          
                                                    <div class="row">
                                                        <div class="col-lg-12" >
                                                            <input type="file" name="image">
                                                            <input type="button" class="related_pro_viewbox" name="Upload">
                                                        </div>
                                                    </div>
                                                                    
                                                     
                                                </div>
                                            </div>
                                        </div>  

                                        @endif

                                        @if($cdetail['field_type'] == "Text")
                                        <div class="row" id="top">
                                            <div class="col-lg-12 mb-4">
                                                <div class="available_box"
                                                    style="background-color: #f9f8ee; padding: 20px 30px 20px 30px; position: relative;">
                                                    <div class="row">
                                                        <div class="col-lg-12 text_25_black mb-2">{{$cdetail['field_value']}} <small>(Maximum Character Limit {{$cdetail['character_limt']}})</small>:</div>
                                                    </div>
                                                    <div class="whitebox_main">
                                                        <div class="row">
                                                            <div class="col-lg-12" style="position: relative;">
                                                                
                                                                <textarea  name="message" max="{{$cdetail['character_limt']}}" cols="35"></textarea>
                                                                <!-- <input type="button" class="" name="Upload"> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                           
                                                </div>
                                            </div>
                                        </div>  

                                        @endif
                                    @endforeach
                                </div>
                            </div>        
                            @endif
        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product_quantity_heading text_25_black">Quantity:</div>
                                    <div class="addcard_btn d-flex align-items-baseline quantity_box">
                                        <button class="btn btn-theme-round btn-number btn-de-qty" type="button">-</button>
                                       <span class="quantity">@if($productDetail['cart_qty'] > 0){{$productDetail['cart_qty']}} @else 1 @endif</span>
                                        <button class="btn btn-theme-round btn-number btn-in-qty" type="button">+</button>
                                    </div>
                                    <input type="submit" name="addtoCart" class="red_button" value="Add to Cart" />
                                </div>
                            </div>
        
                        </div>
        
                        </form>
        
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 text_25_black pb-2 mt-2">
                        Similar Products:
                    </div>
                </div>
                <div class="related_pro_listbox mb-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="owl-carousel_similar">
                                @if(!empty($product['similar_product'] ))
                                @foreach($product['similar_product'] as $sproduct)
                                @php
                                    $product_slug = \Str::slug($sproduct['product_name'],'+').'-'.$sproduct['product_id'];
                                @endphp
                                <div class="item">
                                    <div class="related_pro_list_mainbox">
                                        <div class="related_pro_list">
                                            <div class="imgshow">
                                                <img src="{{ENV('BUNNY_NET_URL')}}{{$sproduct['product_image']}}?width=500&height=500" class="img-fluid" alt="{{$sproduct['product_name']}}">
                                                <a href="{{url('product-details/'.$product_slug)}}" class="related_pro_viewbox"><span>View Details</span></a>
                                            </div>
                                            <div class="related_pro_head">{{$sproduct['product_name']}}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text_25_black pb-2 mt-2">
                        Frequently Bought Together:
                    </div>
                </div>
                <div class="related_pro_listbox mb-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="owl-carousel_frequent">
                                @if(!empty($product['frequentlyboughttogether_product'] ))
                                @foreach($product['frequentlyboughttogether_product'] as $fproduct)
                                @php
                                    $product_slug = \Str::slug($fproduct['product_name'],'+').'-'.$fproduct['product_id'];
                                @endphp
                                <div class="item">
                                    <div class="related_pro_list_mainbox">
                                        <div class="related_pro_list">
                                            <div class="imgshow">
                                                <img src="{{ENV('BUNNY_NET_URL')}}{{$fproduct['product_image']}}??width=500&height=500" class="img-fluid" alt="{{$fproduct['product_name']}}">
                                                <a href="{{url('product-details/'.$product_slug)}}" class="related_pro_viewbox"><span>View Details</span></a>
                                            </div>
                                            <div class="related_pro_head">{{$fproduct['product_name']}}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
</div>

@include('layout.footer')

<script src="{{ENV('APP_URL')}}assets/js/xzoom.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
        $(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15,fadeIn:true,smoothZoomMove:3,smoothLensMove:3,scroll:true,hover:true,lens:'#DEDEDE',lensOpacity:0.4});

        // $('.varients_dd').on('change',function(){
        //     $('.home_product_price').addClass('d-none');
        //     $('#home_product_price_'+$(this).val()).removeClass('d-none');
        //     $('.product_id').val($(this).val());
        //     // console.log("{{url('product-details/')}}"+$(this).data('slug'));
        //     // var selected = $(this).find('option:selected');
        //     // var url = selected.data('slug'); 
        //     // console.log(slug);
        //     // window.location.href = url;
        // });

        $('.select_varient_list').on('click',function(){
            $('.select_varient_list').find('input:radio').removeAttr('checked');
            $(this).find('input:radio').attr('checked',true);
            $(this).find('input:radio').prop('checked',true);
            $('.home_product_price').addClass('d-none');
            $('#home_product_price_'+$(this).find('input:radio').val()).removeClass('d-none');
            $('.product_id').val($(this).find('input:radio').val());
        });

        $('body').on('click',function(){
            $('.xzoom-preview').remove();
            $('.xzoom-source').remove();
        });

       var delivery_type = "{{$productDetail['delivery']}}";
       if(delivery_type == "1"){
            $('#datePicker2').attr('disabled',true);
            $('.ptimeslot').attr('disabled',true);
            loadDeliveryData(delivery_type);
       }else{
            if(delivery_type != "2"){
                $('#datePicker2').removeAttr('disabled');
            }
            $('.ptimeslot').removeAttr('disabled');
            loadDeliveryData(delivery_type); 
            if($('#datePicker2').val() != '') {
                fetchTimeSlot($('#datePicker2').val()); 
            }
       }
       

       function loadDeliveryData(dtype){
        console.log(dtype);
        if(dtype == 1 ){
            console.log(dtype,"if");
              // if($('.product_delivery_type').val() != $(this).val()){
              //   $('.express-message').removeClass('d-none');  
              // }
              
              var d = new Date();
              var month = d.getMonth()+1;
              var day = d.getDate();

              var todayDate = d.getFullYear() + '-' +
                  ((''+month).length<2 ? '0' : '') + month + '-' +
                  ((''+day).length<2 ? '0' : '') + day;

              $('.delivery_date').val(todayDate);
              $('.delivery_time').val(formatAMPM(new Date));

              console.log($('.delivery_date').val(),$('.delivery_time').val());
            }

            if(dtype == 2){
               // $('#datePicker2').atrr('disabled',false);
               // $('.ptimeslot').atrr('disabled',false);

               var dtToday = new Date();
            
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();
                
                var maxDate = year + '-' + month + '-' + day;
                
                $('#datePicker2').attr('min', maxDate);
                $('#datePicker2').val(maxDate);
                fetchTimeSlot(maxDate);
                
            }

            if(dtype == 3 ){
               // $('#datePicker2').atrr('disabled',false);
               // $('.ptimeslot').atrr('disabled',false);
               var dtToday = new Date();
            
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate() + 1;
                var year = dtToday.getFullYear();
                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();
                
                var maxDate = year + '-' + month + '-' + day;
                
                $('#datePicker2').attr('min', maxDate);
                $('#datePicker2').val(maxDate);
                fetchTimeSlot(maxDate);
                
            }
       }
        
    });  
</script>