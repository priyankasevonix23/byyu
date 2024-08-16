<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ENV('APP_URL')}}assets/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ENV('APP_URL')}}assets/images/favicon.ico">

    <title>Byyu Online Gifts Dubai | Byyu Online Gift Store | Byyu Dubai</title>

<script>
//   HOMEPAGE-DOWNLOADAPP-START
function downloadapp() {
      var x = document.getElementById("downloadapp_mainbox");
      if (x.className === "downloadapp_mainbox") {
          x.className += " downloadapp_close";
      } else {
          x.className = "downloadapp_mainbox";
      }
  }
//   HOMEPAGE-DOWNLOADAPP-START
</script>

</head>
<body>
    <header id="header_top" class="top_header" [class.scrolled]="isScrolled">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="logo mt-1 mb-1">
                <a href="/"><img src="https://byyu.b-cdn.net/images/other_images/BYYU_Logo.png" class="img-fluid"></a>
              </div>

              <div class="top_othermenu_box">
                  <a routerLink="/wishlist">
                    <div class="top_othermenu_imgbox"><img src="assets/images/top_wishlist_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Wishlist</div>
                  </a>
                  <a routerLink="/wishlist">
                    <div class="top_othermenu_imgbox"><img src="assets/images/top_cart_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Cart</div>
                  </a>
                  <a routerLink="/wishlist">
                    <div class="top_othermenu_imgbox"><img src="assets/images/top_profile_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">My Profile</div>
                  </a>
                  @if(session()->has('userdata'))
                  <a href="{{ url('/logout') }}">
                    <div class="top_othermenu_imgbox"><img src="assets/images/top_logout_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Sign Out</div>
                  </a>

                  @else
                  <a href="{{ url('/login') }}">
                    <div class="top_othermenu_imgbox"><img src="assets/images/top_login_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Sign In</div>
                  </a>

                  @endif


              </div>
              <div class="search_box" id="search_top">
                <div class="searchyourgift_img"><img src="assets/images/search_gift_text.gif" class="img-fluid"></div>
                <input type="text" (input)="onChangephone($event)" name="text" (keyup.enter)="onSearch()">
                <input type="submit" value="submit" class="gobtn" (click)="onNavigateTosearchinner()">
                <div onclick="search_top()" class="search_close_mobile">x</div>
              </div>

            </div>
          </div>
        </div>
    </header>
    <div class="middle_box width100">
        <section class="downloadapp_mainbox" id="downloadapp_mainbox">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="downloadapp_box">
                            <div class="downloadapp_heading">Download Our App</div>
                            <div class="downloadapp_buttonbox">
                                <a href="https://play.google.com/store/apps/details?id=com.byyu" target="_blank"><img src="https://byyu.b-cdn.net/images/other_images/playstore_icon.png" class="img-fluid"></a>
                                <a href="https://apps.apple.com/us/app/byyu-gifts-flowers-cakes/id6474729123" target="_blank"><img src="https://byyu.b-cdn.net/images/other_images/appstore_icon.png" class="img-fluid"></a>
                            </div>
                            <div class="downloadapp_closebtn" onclick="downloadapp()">x</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="home_banner_mainbox">
            <div class="owl-carousel_homebanner">
                @foreach($data['events'] as $events)
                <div class="item">
                    <a href="{{url('event-product-list/specialdays-'.$events['id'])}}"><img src="{{ENV('BUNNY_NET_URL')}}{{$events['event_banner_img']}}" class="img-fluid"></a>
                </div>
                @endforeach
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="occassion_whitebox">
                            @foreach($data['events'] as $events)
                            <a href="{{url('event-product-list/specialdays-'.$events['id'])}}" class="occassion_list">
                                <div class="occassion_list_img"><div class="occassion_list_img_inner"><img src="{{ENV('BUNNY_NET_URL')}}{{$events['event_image']}}" class="img-fluid"></div></div>
                                <div class="occassion_list_head">{{$events['event_name']}}</div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-5">
            <div class="container" style="position: relative;">
                <div class="row">
                    <div class="col-9 mb-2 "><h1 class="black_heading">Categories</h1></div>
                    <div class="col-3 mb-2 pt-3 viewall_btn"><a href="/category-listing">View All</a></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 home_catbox_mainlist">
                        @foreach($data['top_cat'] as $top_cat)
                        <div class="home_catbox_list">
                            <div class="cat_right_list">
                                @php
                            $category_slug = \Str::slug($top_cat['title'],'+').'-'.$top_cat['cat_id'];
                        @endphp
                                <a href="{{'product-list/'.$category_slug}}">
                                    <img src="{{ENV('BUNNY_NET_URL')}}{{$top_cat['image']}}" class="img-fluid">
                                    <div class="cat_shadow_box"><span>{{$top_cat['title']}}</span></div>
                                </a>
                            </div>
                        </div>
                       @endforeach
                    </div>
                </div>
                <div class="teddybear_img"><img src="assets/images/teddybear.png" class="img-fluid"></div>
            </div>
        </section>
        <section class="home_product_section mb-5" id="top">
            <div class="container" style="position: relative;">
                <div>
                    <!-- OBJECT-0-FLOWER-HEADING-START -->
                    <div class="row">
                        <div class="col-9 mb-2 black_heading">{{$data['recentselling'][0]['cat_name']}}</div>
                        @php
                            $category_slug = \Str::slug($data['recentselling'][0]['cat_name'],'+').'-'.$data['recentselling'][0]['cat_id'];
                        @endphp
                        <div class="col-3 mb-2 pt-3 viewall_btn"><a href="{{'product-list/'.$category_slug}}">View All</a></div>
                    </div>
                    <div class="row home_flower_section">
                        <div class="owl-carousel_flower">
                            @foreach($data['recentselling'][0]['product_list'] as $product_list)
                            @php
                                $product_slug = \Str::slug($product_list['product_name'],'+').'-'.$product_list['product_id'];
                            @endphp
                            <div class="item">
                                <div class="home_product_box">
                                    <div class="home_product_list">
                                        <div class="home_product_img mb-2">
                                            <a href="{{url('product-details/'.$product_slug)}}">
                                                <img src="{{ENV('BUNNY_NET_URL')}}{{$product_list['product_image']}}?width=500&height=500" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="width100 text-center">
                                            <div class="row">
                                                <div class="col-lg-12 text_18_black mb-1 home_product_name">{{$product_list['product_name']}} </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <div class="home_product_price">
                                                        <div class="currency_text">AED</div>
                                                        {{$product_list['price']}}
                                                        @if($product_list['price'] != $product_list['mrp'])
                                                        <span>{{$product_list['mrp']}}</span>
                                                        <div class="discount_text">{{$product_list['discountper']}}% Off</div>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 pb-4 earliest_text">
                                                    Earliest Delivery:
                                                    @if($product_list['delivery'])
                                                    <b>Tomorrow</b>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row" *ngIf="data.stock> 0">
                                                <div class="col-lg-12">
                                                    <a href="{{url('product-details/'.$product_slug)}}" class="red_button">View Detail</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product_wishlist" data-product-id="$product_list['product_id']">
                                            <a (click)="addtowishlist(data.varient_id)">
                                                <div *ngIf="data.isFavourite=='false'"><img  src="assets/images/product_wishlist.png" alt="wishliated" style="max-width:20px"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-0 mb-0 pt-4 pb-4" id="top" style="background-color: #f3e2b3;">
            <div class="container" style="position: relative;">
                <div>
                    <!-- OBJECT-0-PLANTS-HEADING-START -->
                    <div class="row">
                        <div class="col-9 mb-2 black_heading">{{$data['recentselling'][1]['cat_name']}}</div>
                        <div class="col-3 mb-2 pt-3 viewall_btn"><a (click)="onNavigateToPayment()">View All</a></div>
                    </div>
                    <div class="row home_flower_section">
                        <div class="owl-carousel_flower">
                            @foreach($data['recentselling'][1]['product_list'] as $product_list)
                            @php
                                $product_slug = \Str::slug($product_list['product_name'],'+').'-'.$product_list['product_id'];
                            @endphp
                            <div class="item">
                                <div class="home_product_box">
                                    <div class="home_product_list">
                                        <div class="home_product_img mb-2">
                                            <a href="{{url('product-details/'.$product_slug)}}">
                                                <img src="{{ENV('BUNNY_NET_URL')}}{{$product_list['product_image']}}?width=500&height=500" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="width100 text-center">
                                            <div class="row">
                                                <div class="col-lg-12 text_18_black mb-1 home_product_name">{{$product_list['product_name']}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <div class="home_product_price">
                                                        <div class="currency_text">AED</div>
                                                        {{$product_list['price']}}
                                                        @if($product_list['price'] != $product_list['mrp'])
                                                        <span>{{$product_list['mrp']}}</span>
                                                        <div class="discount_text">{{$product_list['discountper']}}% Off</div>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 pb-4 earliest_text">
                                                    Earliest Delivery:
                                                    @if($product_list['delivery'])
                                                    <b>Tomorrow</b>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="row" *ngIf="data.stock> 0">
                                                <div class="col-lg-12">
                                                    <a href="{{url('product-details/'.$product_slug)}}" class="red_button">View Detail</a>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="product_wishlist" data-product-id="$product_list['product_id']">
                                            <a href="">
                                                <div *ngIf="data.isFavourite=='false'"><img  src="assets/images/product_wishlist.png" alt="wishliated" style="max-width:20px"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="girls_banner_section mb-5">
            <div class="container" style="position: relative; z-index: 5;">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="gift_banner_box">
                            <div class="row" style="align-items: center;">
                                <div class="col-lg-4 text-center">
                                    <img src="https://byyu.b-cdn.net/images/other_images/girls_banner_text.png" style="max-height: 210px;" class="img-fluid"><br><br>
                                    <div class="gift_left_sendnow" (click)="giftlistclick()">Gift Now</div>
                                </div>
                                <div class="col-lg-8">

                                    <div class="gift-image">
                                        <div class="row">
                                            <div class="col-lg-12 text-center"><img src="https://byyu.b-cdn.net/images/other_images/gift_cake_img.png" style="max-height: 298px;" class="img-fluid"></div>
                                        </div>
                                    </div>

                                    <form method="post" class="productFilterForm" action="{{url('product-filter')}}">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                        <div class="d-none filter1">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="gift_choose_heading">Choose Recipient</div>
                                                </div>
                                                <div class="col-lg-8 gift_rightlist choose_recipient_mobilebox">
                                                    @if(!empty($searchfilters['search_gender']))
                                                        @foreach($searchfilters['search_gender'] as $key=>$searchfilter)
                                                            <div class="recipient-main-box">
                                                                <input type="radio" name="gender_id" value="gender-{{$searchfilter['id']}}">
                                                                <label class="gift_leftlist recipient_box" data-gender="{{$searchfilter['name']}}">
                                                                    <div class="gift_leftlist_img"><img src="{{ENV('ADMIN_APP_URL')}}{{$searchfilter['icon']}}" class="img-fluid"></div>
                                                                    <span>{{$searchfilter['name']}}</span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-none filter2">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="gift_choose_heading">Choose Relation</div>
                                                </div>
                                                <div class="col-lg-8 gift_rightlist choose_recipient_mobilebox">
                                                    @if(!empty($searchfilters['search_relationship']))
                                                        @foreach($searchfilters['search_relationship'] as $searchfilter)
                                                            <div class="relation-main-box">
                                                                <input type="radio" name="relationship_id" value="relationship-{{$searchfilter['id']}}">
                                                                <label class="gift_leftlist relation-box {{$searchfilter['type']}}-relation-box ">
                                                                    <div class="gift_leftlist_img"><img src="{{ENV('ADMIN_APP_URL')}}{{$searchfilter['icon']}}"  class="img-fluid"></div>
                                                                    <span>{{$searchfilter['name']}}</span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-none filter3">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="gift_choose_heading">Choose Age</div>
                                                </div>
                                                <div class="col-lg-8 gift_rightlist choose_recipient_mobilebox">
                                                    <div class="age_box">
                                                        <div class="age_arrow"><img src="assets/images/home_age_arrow.png" class="img-fluid"></div>
                                        
                                                        <div class="middle">
                                                            @if(!empty($searchfilters['search_age']))
                                                                @foreach($searchfilters['search_age'] as $searchfilter)
                                                                    <span class="age-main-box">
                                                                        <input type="radio" name="age_id" id="a" value="age-{{$searchfilter['min_age']}}-{{$searchfilter['max_age']}}" data-min-age="{{$searchfilter['min_age']}}" data-max-age="{{$searchfilter['max_age']}}">
                                                                        <label for="a" class="age_list">
                                                                            {{$searchfilter['name']}}
                                                                        </label>
                                                                    </span>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <input type="hidden" name="max_age" class="max_age" value="" />
                                                        <input type="hidden" name="min_age" class="min_age" value="" />
                                        
                                                        <div class="age_arrow age_arrow_right" (click)="scrollRight()"><img src="assets/images/home_age_arrow.png" class="img-fluid" style="transform: rotate(180deg);"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-none filter4">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="gift_choose_heading">Choose Occassion</div>
                                                </div>
                                                <div class="col-lg-8 gift_rightlist choose_recipient_mobilebox">
                                                    @if(!empty($searchfilters['search_occasion']))
                                                        @foreach($searchfilters['search_occasion'] as $searchfilter)
                                                        <div class="occassion-main-box">
                                                            <input type="radio" name="occasion_id" value="occasion-{{$searchfilter['id']}}">
                                                            <label class="gift_leftlist occassion_box">
                                                                <div class="gift_leftlist_img"><img src="{{ENV('ADMIN_APP_URL')}}{{$searchfilter['icon']}}" class="img-fluid"></div>
                                                                <span>{{$searchfilter['name']}}</span>
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="mb-5" id="top">
            <div class="container" style="position: relative;">
                <div>
                    <!-- OBJECT-0-FLOWER-HEADING-START -->
                    <?php $i=1;?>
                    @foreach($data['recentselling'] as $recentselling)
                    @if($i > 2)
                    <div class="row">
                        <div class="col-9 mb-2 black_heading">{{$recentselling['cat_name']}}</div>
                        @php
                            $category_slug = \Str::slug( $recentselling['cat_name'],'+').'-'. $recentselling['cat_id'];
                        @endphp
                        <div class="col-3 mb-2 pt-3 viewall_btn"><a href="{{'product-list/'.$category_slug}}">View All</a></div>
                    </div>
                    <div class="row home_flower_section">
                        <div class="owl-carousel_flower">
                            @foreach($recentselling['product_list'] as $product_list)
                            @php
                                $product_slug = \Str::slug($product_list['product_name'],'+').'-'.$product_list['product_id'];
                            @endphp
                            <div class="item">
                                <div class="home_product_box">
                                    <div class="home_product_list">
                                        <div class="home_product_img mb-2">
                                            <a href="{{url('product-details/'.$product_slug)}}">
                                                <img src="{{ENV('BUNNY_NET_URL')}}{{$product_list['product_image']}}?width=500&height=500" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="width100 text-center">
                                            <div class="row">
                                                <div class="col-lg-12 text_18_black mb-1 home_product_name">{{$product_list['product_name']}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <div class="home_product_price">
                                                      <div class="currency_text">AED</div>
                                                       {{$product_list['price']}}
                                                        @if($product_list['price'] != $product_list['mrp'])
                                                        <span>{{$product_list['mrp']}}</span>
                                                        <div class="discount_text">{{$product_list['discountper']}}% Off</div>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 pb-4 earliest_text">
                                                    Earliest Delivery:
                                                    @if($product_list['delivery'])
                                                    <b>Tomorrow</b>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="row" *ngIf="data.stock> 0">
                                                <div class="col-lg-12">
                                                    <a href="{{url('product-details/'.$product_slug)}}" class="red_button">View Detail</a>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="product_wishlist" data-product-id="$product_list['product_id']">
                                            <a (click)="addtowishlist(data.varient_id)">
                                                <div *ngIf="data.isFavourite=='false'"><img  src="assets/images/product_wishlist.png" alt="wishliated" style="max-width:20px"></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                     @endif
                    <?php $i++ ?>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <footer class="pt-4 pb-4 footer_mainbox" style="background-color: #f03613;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_col_box50 footer_column1">
                        <div class="footer90">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="footer_link_box">
                                        <li><a routerLink="/">Home</a></li>
                                        <li><a routerLink="privacypolicy">Privacy Policy</a></li>
                                        <li><a routerLink="offers">Offers</a></li>
                                        <li><a routerLink="termsconditions">Terms & conditions</a></li>
                                        <li><a routerLink="contactus">Contact Us</a></li>
                                        <li><a routerLink="comingsoon">Corporate Gifts</a></li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_col_box50 footer_column3" style="min-height: inherit;">
                        <div class="footer90 mb-0">

                            <div class="row">

                                <div class="col-lg-12 text-center footer_playstore_icon">
                                    <a href="https://play.google.com/store/apps/details?id=com.byyu" target="_blank"><img src="assets/images/playstore_icon.png" class="img-fluid"></a>
                                    <a href="https://apps.apple.com/us/app/byyu-gifts-flowers-cakes/id6474729123" target="_blank"><img src="assets/images/appstore_icon.png" class="img-fluid"></a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="footer_col_box50 footer_column4" style="min-height: inherit">
                        <div class="footer90 mb-0" style="border: 0;">
                            <div class="row">

                                <div class="col-lg-12 text-center footer_social_icon">
                                        <a href="https://www.facebook.com/profile.php?id=61552755963187" target="_blank"><img src="assets/images/footer_facebook.png" class="img-fluid"></a>
                                        <a href="https://twitter.com/byyu_com" target="_blank"><img src="assets/images/footer_twitter.png" class="img-fluid"></a>
                                        <a href="https://www.linkedin.com/company/byyu2/about/" target="_blank"><img src="assets/images/footer_linkedin.png" class="img-fluid"></a>
                                        <a href="https://www.instagram.com/byyu.ae/" target="_blank"><img src="assets/images/footer_instagram.png" class="img-fluid"></a>
                                        <a href="https://www.tiktok.com/@byyu.ae/" target="_blank"><img src="assets/images/footer_tiktok.png" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!--  PRODUCT-SLIDER-START -->
<link rel="stylesheet" href="assets/js/product_slider/owl.carousel.min.css">
<script src="assets/js/product_slider/jquery-1.12.4.min.js"></script>
<script src="assets/js/product_slider/owl.carousel.min.js"></script>
<script src="{{ENV('APP_URL')}}assets/js/allcommon-script.js"></script>
<script>

    $('.owl-carousel_homebanner').owlCarousel({
        autoplay: true,
        center: true,
        loop: true,
        nav: true,
        dots: true,
        navigationText: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1
            },
            1200: {
                items: 1
            },
            1300: {
                items: 1
            }
        }
    });

    $('.owl-carousel_flower').owlCarousel({
        autoplay: false,
        center: true,
        loop: true,
        nav: true,
        dots: false,
        items: 5,
        navigationText: false,
        responsive: {

            1300: {
                items: 5
            }
        }
    });

   $('.gift_left_sendnow').on('click',function(){
        $('.gift-image').addClass('d-none');
        $('.filter1').removeClass('d-none');
    });

    $('.recipient_box').on('click',function() {
        $('.recipient_box').css('opacity','0.4');
        $(this).css('opacity','1');
        
        $(this).parent().find('input:radio').attr('checked',true);
        console.log($(this).parent().find('input:radio').val());

        $('.filter2').removeClass('d-none');
        if($(this).data('gender') == 'Male'){
            $('.f-relation-box').addClass('d-none');
            $('.m-relation-box').removeClass('d-none');
        }
        if($(this).data('gender') == 'Female'){
            $('.f-relation-box').removeClass('d-none');
            $('.m-relation-box').addClass('d-none');
        }
        if($(this).data('gender') == 'Other'){
            $('.f-relation-box').removeClass('d-none');
            $('.m-relation-box').removeClass('d-none');
        }
        
    });

    $('.relation-box').on('click',function() {
        $('.relation-box').css('opacity','0.4');
        $(this).css('opacity','1');
        $('.filter3').removeClass('d-none');
        $('.filter4').removeClass('d-none');
        $('.occassion_box').css('opacity','1');

        $(this).parent().find('input:radio').attr('checked',true);
    });

    $('.age_list').on('click',function() {
        $('.age_list').css('opacity','0.4');
        $(this).css('opacity','1');

        $('.min_age').val($(this).parent().find('input:radio').data('min-age'));
        $('.max_age').val($(this).parent().find('input:radio').data('max-age'));
        console.log($(this).parent().find('input:radio').data('min-age'),$(this).parent().find('input:radio').data('max-age'));
        $(this).parent().find('input:radio').attr('checked',true);
    });    

    $('.occassion_box').on('click',function() {
        $(this).parent().find('input:radio').attr('checked',true);
        // window.location.href="{{url('product-list')}}";
        $('.productFilterForm').submit();
    });

</script>
<!--  PRODUCT-SLIDER-END -->
</body>

</html>
