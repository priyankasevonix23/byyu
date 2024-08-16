<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="google-site-verification" content="W-ReOSL2ClWUpZW8_L5MQbJ7_bbjrQWi6EJiVqvF4oY" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $data_arr['description'] ?? 'Find the perfect gift at byyu Online Gift Store! Enjoy seamless online flowers delivery in Dubai. Explore our exquisite collection today.' }}">
    <link rel="canonical" href="{{ $data_arr['canonical'] ?? URL::current() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ENV('APP_URL')}}assets/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ENV('APP_URL')}}assets/images/favicon.ico">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GNNXG6LWWR"></script>
    <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-GNNXG6LWWR'); </script>

    <title>{{ $data_arr['title'] ?? 'byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai'}}</title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta property="og:title" content="{{ $data_arr['title'] ?? 'byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai'}}" />
    <meta property="og:site_name" content="byyu">
    <meta property="og:url" content="{{ $data_arr['canonical'] ?? 'https://www.byyu.com/' }}">
    <meta property="og:description" content="{{ $data_arr['description'] ?? 'Find the perfect gift at byyu Online Gift Store! Enjoy seamless online flowers delivery in Dubai. Explore our exquisite collection today.' }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.byyu.com/assets/images/whatsapp_show_logo.png">
    
    <meta name="msvalidate.01" content="FE3BEF2D2BE998845F81C82BE50156E8" />
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

// HEADER-SEARCH-START
function search_top() {
      var x = document.getElementById("search_top");
      if (x.className === "search_top") {
          x.className += " search_top_open";
      } else {
          x.className = "search_top";
      }
  }
// HEADER-SEARCH-END

// MAIN-MENU-START
function mainmenu() {
      var x = document.getElementById("menu_mainbox");
      if (x.className === "menu_mainbox") {
          x.className += " menu_mainbox_open";
      } else {
          x.className = "menu_mainbox";
      }
  }
// MAIN-MENU-END

</script>


<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '822673792778883');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=822673792778883&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->


</head>
<body>
    <script type=""application/ld+json"">
    {
      ""@context"": ""https://schema.org/"",
      ""@type"": ""WebSite"",
      ""name"": ""byyu"",
      ""url"": ""https://www.byyu.com/"",
      ""potentialAction"": {
        ""@type"": ""SearchAction"",
        ""target"": ""{search_term_string}"",
        ""query-input"": ""required name=search_term_string""
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ShoppingCenter",
      "name": "byyu",
      "image": "https://www.byyu.com/assets/images/BYYU_Logo.png",
      "@id": "",
      "url": "https://www.byyu.com",
      "telephone": "971526002661",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "EMAAR SOUTH - DUBAI WORLD CENTRAL URBANA2 BLOCK 21 G02",
        "addressLocality": "Dubai",
        "postalCode": "",
        "addressCountry": "AE"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "00:00",
        "closes": "23:59"
      },
      "sameAs": [
        "https://www.facebook.com/people/byyuae/61552755963187/",
        "https://www.instagram.com/byyu.ae/",
        "https://www.byyu.com/",
        "https://x.com/byyu_com"
      ] 
    }
    </script>
    <header id="header_top" class="top_header" [class.scrolled]="isScrolled">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="logo mt-1 mb-1">
                <a href="{{url('/')}}"><img src="{{ENV('APP_URL')}}assets/images/BYYU_Logo.png" alt="byyu logo" class="img-fluid"></a>
              </div>

              <div class="top_othermenu_box">
                   <a href="{{url('wishlist')}}" class="top_cart_box" >
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_wishlist_icon.png" class="img-fluid">
                    <div><span id="wishlist_total_count" class="@if(empty($summary['wishlist_count'])) d-none @endif ">{{$summary['wishlist_count'] ?? 0}}</span></div>                    </div>
                    <div class="top_othermenu_heading">Wishlist</div>
                  </a>
                  
                @if(session()->has('userdata'))  
                <a href="{{url('cart-summary')}}" class="top_cart_box">
                <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_cart_icon.png" class="img-fluid">
                @if(!empty($summary['cart_count']))
                <div><span id="cart_total_count">{{$summary['cart_count']}}</span></div>
                @endif
                </div>
                <div class="top_othermenu_heading">Cart</div>
                </a>               
                
	          
	            <a href="{{url('userprofile')}}">
                    <div class="top_othermenu_imgbox"><img src="assets/images/top_profile_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">My Profile</div>
                  </a>
                  
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

                  <a class="mobile_searchbox" onclick="search_top()">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_search_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Search</div>
                    </a>


              </div>
              <!--<form method="get" action="">-->
                <div class="search_box" id="search_top">
                  <div class="searchyourgift_img"><img src="{{ENV('APP_URL')}}assets/images/search_gift_text.gif" class="img-fluid @if(!empty(Request::get('search_text'))) d-none @endif"></div>
                  <input type="text" name="search_text" class="search_text" value="{{str_replace('-', ' ', Request::get('search_text'))}}">
                  <input type="button" value="submit" class="gobtn" disabled>
                  <div onclick="search_top()" class="search_close_mobile">x</div>
                </div>
              <!--</form>-->
            </div>
          </div>
        </div>
    </header>
    <div class="middle_box width100 homepage_middle_box">
        <section class="downloadapp_mainbox" id="downloadapp_mainbox">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="position: relative;">
                        <span onclick="mainmenu()" class="toggle_menu"><img src="{{ENV('APP_URL')}}assets/images/toggle_menu.png" alt="toggle_menu" style="max-height:16px" class="img-fluid"></span>
                        <div class="menu_mainbox" id="menu_mainbox">
                            <span onclick="mainmenu()" class="toggle_menu toggle_menu_close"><img src="{{ENV('APP_URL')}}assets/images/toggle_close.png" alt="toggle_menu" style="max-height:16px" class="img-fluid"></span>
                            <ul>
                                <li class="sub_menu_text">
                                    <a href="#">Flowers</a>
                                    <div class="sub_menubox">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="submenu_list">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12 submenu_headig pt-4 pb-2">By Occasion</div>
                                                        <div class="col-lg-12">                                                        
                                                            <a href="#">Birthday</a>
                                                            <a href="#">Anniversary</a>
                                                            <a href="#">Getwell Soon</a>
                                                            <a href="#">Sympathy</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="submenu_list">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12 submenu_headig pt-4 pb-2">By Recipient</div>
                                                        <div class="col-lg-6">                                                        
                                                            <a href="#">Wife</a>
                                                            <a href="#">Husband</a>
                                                            <a href="#">Her</a>
                                                            <a href="#">Him</a>
                                                            
                                                        </div>
                                                        <div class="col-lg-6">                                                        
                                                            
                                                            <a href="#">Boyfriend</a>
                                                            <a href="#">Girlfriend</a>
                                                            <a href="#">Mother</a>
                                                            <a href="#">Father</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="submenu_list">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12 submenu_headig pt-4 pb-2">By Type</div>
                                                        <div class="col-lg-12">                                                        
                                                            <a href="#">Birthday</a>
                                                            <a href="#">Anniversary</a>
                                                            <a href="#">Getwell Soon</a>
                                                            <a href="#">Sympathy</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-3"></div>
                                        </div>
                                        <div class="sub_menubox_cornerimg"><img src="{{ENV('APP_URL')}}assets/images/sub_menubox_flower.png" class="img-fluid"></div>
                                    </div>
                                </li>
                                <li class="sub_menu_text">
                                    <a href="#">Cakes</a>
                                    <div class="sub_menubox">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="submenu_list">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12 submenu_headig pt-4 pb-2">By Occasion</div>
                                                        <div class="col-lg-12">                                                        
                                                            <a href="#">Birthday</a>
                                                            <a href="#">Anniversary</a>
                                                            <a href="#">Getwell Soon</a>
                                                            <a href="#">Sympathy</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="submenu_list">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12 submenu_headig pt-4 pb-2">By Recipient</div>
                                                        <div class="col-lg-6">                                                        
                                                            <a href="#">Wife</a>
                                                            <a href="#">Husband</a>
                                                            <a href="#">Her</a>
                                                            <a href="#">Him</a>
                                                            
                                                        </div>
                                                        <div class="col-lg-6">                                                        
                                                            
                                                            <a href="#">Boyfriend</a>
                                                            <a href="#">Girlfriend</a>
                                                            <a href="#">Mother</a>
                                                            <a href="#">Father</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="submenu_list">
                                                    <div class="row mb-4">
                                                        <div class="col-lg-12 submenu_headig pt-4 pb-2">By Type</div>
                                                        <div class="col-lg-12">                                                        
                                                            <a href="#">Birthday</a>
                                                            <a href="#">Anniversary</a>
                                                            <a href="#">Getwell Soon</a>
                                                            <a href="#">Sympathy</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-3"></div>
                                        </div>
                                        <div class="sub_menubox_cornerimg"><img src="{{ENV('APP_URL')}}assets/images/sub_menubox_flower.png" class="img-fluid"></div>
                                    </div>
                                </li>
                                <li><a href="#">Combo</a></li>
                                <li><a href="#">Birthday</a></li>
                                <li><a href="#">Anniversary</a></li>
                                <li><a href="#">More gifts</a></li>
                            </ul>
                        </div>
                        <div class="downloadapp_box">
                            <div class="downloadapp_heading">Download Our App</div>
                            <div class="downloadapp_buttonbox">
                                <a href="https://play.google.com/store/apps/details?id=com.byyu" target="_blank">
                                    <!-- <img src="https://byyu.b-cdn.net/images/other_images/playstore_icon.png" class="img-fluid"> -->
                                    <img src="{{ENV('BUNNY_NET_URL')}}assets/playstore_icon.png?height=58" class="img-fluid">
                                </a>
                                <a href="https://apps.apple.com/us/app/byyu-gifts-flowers-cakes/id6474729123" target="_blank">
                                    <img src="{{ENV('BUNNY_NET_URL')}}assets/appstore_icon.png?height=58" class="img-fluid">
                                </a>
                            </div>
                            <div class="downloadapp_closebtn" onclick="downloadapp()">x</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FOR-DESKTOP-BANNER-START -->        
        <section class="home_banner_mainbox desktop_homebanner">
            <div id="banner_show" class="home_banner_mainbox">
                <div class="owl-carousel_homebanner">
                    @if(!empty($data['events']))
                    @foreach($data['events'] as $events)
                    <div class="item">
                        <a href="{{url('event-product-list/specialdays-'.$events['id'])}}"><img src="{{ENV('BUNNY_NET_URL')}}{{$events['event_banner_img']}}" class="img-fluid" alt="{{$events['event_name']}}"></a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>            
        </section>
        <!-- FOR-DESKTOP-BANNER-END -->

        <!-- FOR-MOBILE-BANNER-END -->
        <section class="mobile_homebanner">
            <div id="banner_show">
                <div class="owl-carousel_homebanner">
                    @if(!empty($data['events_details_app']))
                    @foreach($data['events_details_app'] as $events_details)
                    <div class="item">
                        <a href="{{url('event-product-list/specialdays-'.$events_details['id'])}}">
                            <img src="{{ENV('BUNNY_NET_URL')}}{{$events_details['event_banner_img']}}" class="img-fluid" alt="{{$events_details['event_name']}}">
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>            
        </section>
        <!-- FOR-MOBILE-BANNER-START -->


        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="occassion_whitebox">
                            @if(!empty($data['events']))
                            @foreach($data['events'] as $events)
                            <a href="{{url('event-product-list/specialdays-'.$events['id'])}}" class="occassion_list">
                                <div class="occassion_list_img"><div class="occassion_list_img_inner"><img src="{{ENV('BUNNY_NET_URL')}}{{$events['event_image']}}?height=60" class="img-fluid" alt="{{$events['event_name']}}"></div></div>
                                <div class="occassion_list_head">{{$events['event_name']}}</div>
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section class="mb-5 need_hidebox home_categories_box">
            <img src="{{ENV('BUNNY_NET_URL')}}assets/categories_content_img.jpg" class="img-fluid" alt="Online Gift Shops in Dubai">            
        </section> -->

        <div class="need_showbox_no">
            <section class="mb-5">
                <div class="container" style="position: relative;">
                    <div class="row">
                        <div class="col-9 mb-2 "><h1 class="black_heading">Categories</h1></div>
                        <div class="col-3 mb-2 viewall_btn"><a href="{{url('category-listing')}}">View All</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 home_catbox_mainlist">
                            @foreach($data['top_cat'] as $top_cat)
                            <div class="home_catbox_list">
                                <div class="cat_right_list">
                                    @php
                                $category_slug = \Str::slug($top_cat['title'],'-').'-'.$top_cat['cat_id'];
                            @endphp
                                    <a href="{{'product-list/'.$category_slug}}">
                                        <img src="{{ENV('ADMIN_APP_URL')}}{{$top_cat['image']}}" class="img-fluid" alt="{{$top_cat['title']}}">
                                        <div class="cat_shadow_box"><span>{{$top_cat['title']}}</span></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="teddybear_img"><img src="assets/images/teddybear.png" class="img-fluid" alt="Teddy Bear"></div>
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
                            <div class="col-3 mb-2 viewall_btn"><a href="{{'product-list/'.$category_slug}}">View All</a></div>
                        </div>
                        <div class="row home_flower_section" id="top">
                            <div class="owl-carousel_flower">
                                @foreach($data['recentselling'][0]['product_list'] as $product_list)
                                @php
                                    $product_slug = \Str::slug($product_list['product_name'],'-').'-'.$product_list['product_id'];
                                @endphp
                                <div class="item">
                                    <div class="home_product_box">
                                        <div class="home_product_list">
                                            <div class="home_product_img mb-2">
                                                <a href="{{url('product-details/'.$product_slug)}}">
                                                    <img src="{{ENV('BUNNY_NET_URL')}}{{$product_list['product_image']}}?width=500&height=500" alt="{{$product_list['product_name']}}" class="img-fluid">
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
                                                            <div class="discount_text"><b>{{$product_list['discountper']}}%</b> Off</div>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 pb-4 earliest_text">
                                                        Earliest Delivery:
                                                        @if(!empty($product_list['delivery']))
                                                        @if($product_list['delivery'] == 1) 
                                                           <b>Express</b>  
                                                        @elseif($product_list['delivery'] == 2)    
                                                            <b>Today</b>
                                                        @elseif($product_list['delivery'] == 3)    
                                                            <b>Tomorrow</b>
                                                        @endif    
                                                    @endif                                                    </div>
                                                </div>

                                                <div class="row" *ngIf="data.stock> 0">
                                                    <div class="col-lg-12">
                                                        <a href="{{url('product-details/'.$product_slug)}}" class="red_button">View Detail</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="product_wishlist" data-product-id="{{$product_list['product_id']}}">
                                                <div class="wishlist_icon_box" >
                                                    @if($product_list['isFavourite'] == "true")
                                                    <div><img  src="assets/images/product_wishlist_active.png" alt="wishlisted" style="max-width:20px"></div>
                                                    @endif
                                                    
                                                    @if($product_list['isFavourite'] == "false")
                                                    <div><img  src="assets/images/product_wishlist.png" alt="wishlisted" style="max-width:20px"></div>
                                                    @endif
                                                </div>
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
                            @php
                                $category_slug = \Str::slug($data['recentselling'][1]['cat_name'],'+').'-'.$data['recentselling'][1]['cat_id'];
                            @endphp
                            <div class="col-3 mb-2 viewall_btn"><a href="{{'product-list/'.$category_slug}}">View All</a></div>
                        </div>
                        <div class="row home_flower_section">
                            <div class="owl-carousel_flower">
                                @foreach($data['recentselling'][1]['product_list'] as $product_list)
                                @php
                                    $product_slug = \Str::slug($product_list['product_name'],'-').'-'.$product_list['product_id'];
                                @endphp
                                <div class="item">
                                    <div class="home_product_box">
                                        <div class="home_product_list">
                                            <div class="home_product_img mb-2">
                                                <a href="{{url('product-details/'.$product_slug)}}">
                                                    <img src="{{ENV('BUNNY_NET_URL')}}{{$product_list['product_image']}}?width=500&height=500" alt="{{$product_list['product_name']}}" class="img-fluid">
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
                                                            <div class="discount_text"><b>{{$product_list['discountper']}}%</b> Off</div>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 pb-4 earliest_text">
                                                        Earliest Delivery:
                                                        @if(!empty($product_list['delivery']))
                                                        @if($product_list['delivery'] == 1) 
                                                           <b>Express</b>  
                                                        @elseif($product_list['delivery'] == 2)    
                                                            <b>Today</b>
                                                        @elseif($product_list['delivery'] == 3)    
                                                            <b>Tomorrow</b>
                                                        @endif    
                                                    @endif                                                    </div>
                                                </div>


                                                <div class="row" *ngIf="data.stock> 0">
                                                    <div class="col-lg-12">
                                                        <a href="{{url('product-details/'.$product_slug)}}" class="red_button">View Detail</a>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="product_wishlist" data-product-id="{{$product_list['product_id']}}">
                                                <div class="wishlist_icon_box" >
                                                    @if($product_list['isFavourite'] == "true")
                                                    <div><img  src="assets/images/product_wishlist_active.png" alt="wishlisted" style="max-width:20px"></div>
                                                    @endif
                                                    
                                                    @if($product_list['isFavourite'] == "false")
                                                    <div><img  src="assets/images/product_wishlist.png" alt="wishlisted" style="max-width:20px"></div>
                                                    @endif
                                                </div>
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
                                        <img src="https://byyu.b-cdn.net/images/other_images/girls_banner_text.png" style="max-height: 210px;" alt="girls" class="img-fluid"><br><br>
                                        <div class="gift_left_sendnow" (click)="giftlistclick()">Gift Now</div>
                                    </div>
                                    <div class="col-lg-8">

                                        <div class="gift-image">
                                            <div class="row">
                                                <div class="col-lg-12 text-center"><img src="https://byyu.b-cdn.net/images/other_images/gift_cake_img.png" style="max-height: 298px;" class="img-fluid" alt="Gift Cake"></div>
                                            </div>
                                        </div>

                                        <form method="get" class="productFilterForm" action="{{url('product-gift-now')}}">

                                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                            <input type="hidden" name="occasion_name" class="occasion_name">

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
                                                                        <div class="gift_leftlist_img"><img src="{{ENV('ADMIN_APP_URL')}}{{$searchfilter['icon']}}" class="img-fluid" alt="{{$searchfilter['name']}}"></div>
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
                                                                        <div class="gift_leftlist_img"><img src="{{ENV('ADMIN_APP_URL')}}{{$searchfilter['icon']}}"  class="img-fluid" alt="{{$searchfilter['name']}}"></div>
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
                                                    

                                                        <input type="hidden" name="max_age" class="max_age" value="" />
                                                        <input type="hidden" name="min_age" class="min_age" value="" />
                                                        <div class="age_box">
                                                            <div class="owl-carousel_age">
                                                                @if(!empty($searchfilters['search_age']))
                                                                @foreach($searchfilters['search_age'] as $searchfilter)
                                                                <div class="item">
                                                                    <span class="age-main-box">
                                                                            <input type="radio" name="age_id" id="a" value="age-{{$searchfilter['min_age']}}-{{$searchfilter['max_age']}}" data-min-age="{{$searchfilter['min_age']}}" data-max-age="{{$searchfilter['max_age']}}">
                                                                            <label for="a" class="age_list">
                                                                                {{$searchfilter['name']}}
                                                                            </label>
                                                                    </span>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
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
                                                                    <div class="gift_leftlist_img"><img src="{{ENV('ADMIN_APP_URL')}}{{$searchfilter['icon']}}" class="img-fluid" alt="{{$searchfilter['name']}}"></div>
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
                        <div class="row home_flower_section mb-4">
                            <div class="owl-carousel_flower">
                                @foreach($recentselling['product_list'] as $product_list)
                                @php
                                    $product_slug = \Str::slug($product_list['product_name'],'-').'-'.$product_list['product_id'];
                                @endphp
                                <div class="item">
                                    <div class="home_product_box">
                                        <div class="home_product_list">
                                            <div class="home_product_img mb-2">
                                                <a href="{{url('product-details/'.$product_slug)}}">
                                                    <img src="{{ENV('BUNNY_NET_URL')}}{{$product_list['product_image']}}?width=500&height=500" alt="{{$product_list['product_name']}}" class="img-fluid">
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
                                                            <div class="discount_text"><b>{{$product_list['discountper']}}%</b> Off</div>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 pb-4 earliest_text">
                                                        Earliest Delivery:
                                                        @if(!empty($product_list['delivery']))
                                                        @if($product_list['delivery'] == 1) 
                                                           <b>Express</b>  
                                                        @elseif($product_list['delivery'] == 2)    
                                                            <b>Today</b>
                                                        @elseif($product_list['delivery'] == 3)    
                                                            <b>Tomorrow</b>
                                                        @endif    
                                                    @endif
                                                    </div>
                                                </div>


                                                <div class="row" *ngIf="data.stock> 0">
                                                    <div class="col-lg-12">
                                                        <a href="{{url('product-details/'.$product_slug)}}" class="red_button">View Detail</a>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="product_wishlist" data-product-id="{{$product_list['product_id']}}">
                                                <div class="wishlist_icon_box" >
                                                    @if($product_list['isFavourite'] == "true")
                                                    <div><img  src="assets/images/product_wishlist_active.png" alt="wishlisted" style="max-width:20px"></div>
                                                    @endif
                                                    
                                                    @if($product_list['isFavourite'] == "false")
                                                    <div><img  src="assets/images/product_wishlist.png" alt="wishlisted" style="max-width:20px"></div>
                                                    @endif
                                                </div>
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
                                        <li><a href="{{url('/')}}">Home</a></li>                               
                                    <li><a href="{{url('privacypolicy')}}">Privacy Policy</a></li>

                                    <!-- <li><a href="offers">Offers</a></li>                                     -->

                                    <li><a href="{{url('termsconditions')}}">Terms & conditions</a></li>

                                    <li><a href="{{url('contact-us')}}">Contact Us</a></li>

                                    <li><a href="{{url('comingsoon')}}">Corporate Gifts</a></li>
                                    
                                    <li><a href="{{url('blog')}}">Blog</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_col_box50 footer_column3" style="min-height: inherit;">
                        <div class="footer90 mb-0">

                            <div class="row">

                                <div class="col-lg-12 text-center footer_playstore_icon">
                                    <a href="https://play.google.com/store/apps/details?id=com.byyu" target="_blank">
                                        <img src="{{ENV('BUNNY_NET_URL')}}assets/playstore_icon.png?height=58" class="img-fluid">
                                    </a>
                                    <a href="https://apps.apple.com/us/app/byyu-gifts-flowers-cakes/id6474729123" target="_blank">
                                    <img src="{{ENV('BUNNY_NET_URL')}}assets/appstore_icon.png?height=58" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer_col_box50 footer_column4" style="min-height: inherit">
                        <div class="footer90 mb-0" style="border: 0;">
                            <div class="row">
                                <div class="col-lg-12 text-center footer_social_icon">
                                        <a href="https://www.facebook.com/profile.php?id=61552755963187" target="_blank"><img src="{{ENV('BUNNY_NET_URL')}}assets/footer_facebook.png?height=30" alt="Facebbok" class="img-fluid"></a>
                                        <a href="https://twitter.com/byyu_com" target="_blank"><img src="{{ENV('BUNNY_NET_URL')}}assets/footer_twitter.png?height=30" alt="Twitter" class="img-fluid"></a>
                                        <a href="https://www.linkedin.com/company/byyu2/about/" target="_blank"><img src="{{ENV('BUNNY_NET_URL')}}assets/footer_linkedin.png?height=30" alt="Linkedin" class="img-fluid"></a>
                                        <a href="https://api.whatsapp.com/send?phone=971523487661" target="_blank"><img src="{{ENV('BUNNY_NET_URL')}}assets/footer_whatapp.png?height=30" alt="Whatsapp" class="img-fluid"></a>
                                        <a href="https://www.instagram.com/byyu.ae/" target="_blank"><img src="{{ENV('BUNNY_NET_URL')}}assets/footer_instagram.png?height=30" alt="Instagram" class="img-fluid"></a>
                                        <a href="https://www.tiktok.com/@byyu.ae/" target="_blank"><img src="{{ENV('BUNNY_NET_URL')}}assets/footer_tiktok.png?height=30" alt="Tiktok" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!--  PRODUCT-SLIDER-START -->
<script type="text/javascript">
    var app_url = "{{ENV('APP_URL')}}";
</script>
<link rel="stylesheet" href="assets/js/product_slider/owl.carousel.min.css">
<script src="assets/js/product_slider/jquery-1.12.4.min.js"></script>
<script src="assets/js/product_slider/owl.carousel.min.js"></script>
<script src="{{ENV('APP_URL')}}assets/js/allcommon-script.js"></script>
<script>

    $('.owl-carousel_homebanner').owlCarousel({
        autoplay: false,
        center: true,
        loop: true,
        nav: true,
        dots: false,
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
            0: {
                items: 2,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 5,
            },

        }
    });

    $('.owl-carousel_age').owlCarousel({
        autoplay: false,
        center: true,
        loop: true,
        nav: true,
        dots: false,
        items: 5,
        navigationText: false,
        responsive: {
            0: {
                items:5,
            },
            600: {
                items: 5,
            },
            1000: {
                items: 5,
            },

        }
    });

    
    $('.age_arrow_right').on('click',function(){
        $('.middle').animate({
            'marginLeft' : "+=30px" //moves left
        });
    });

    $('.age_arrow_left').on('click',function(){
        $('.middle').animate({
            'marginLeft' : "-=30px" //moves left
        });
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
        $('.age_box').css('opacity','1');
        $(this).parent().find('input:radio').attr('checked',true);
    });

    // $('.age-main-box').on('click',function() {
    //     $('.age-box').css('opacity','0.4');
    //     $(this).css('opacity','1');
    //     $('.filter4').removeClass('d-none');
    //     $('.occassion_box').css('opacity','1');
    //     $(this).find('input:radio').attr('checked',true);
    // });

    $('.age_list').on('click',function() {
        $('.age_list').css('opacity','0.4');
        $(this).css('opacity','1');
        $('.filter4').removeClass('d-none');

        $('.min_age').val($(this).parent().find('input:radio').data('min-age'));
        $('.max_age').val($(this).parent().find('input:radio').data('max-age'));
        console.log($(this).parent().find('input:radio').data('min-age'),$(this).parent().find('input:radio').data('max-age'));
        $(this).parent().find('input:radio').attr('checked',true);
        $()
    });    

    $('.occassion_box').on('click',function() {
        $(this).parent().find('input:radio').attr('checked',true);
        $('.occasion_name').val( $(this).parent().find('span').html());
        // window.location.href="{{url('product-list')}}";
        $('.productFilterForm').submit();
    });

</script>
<!--  PRODUCT-SLIDER-END -->


<!-- HOME-PAGE-LOAD-START -->

<script type="text/javascript"> 
    window.onload = function() {
    setTimeout(function() {
        document.getElementById('banner_hide').style.display = 'none';
    }, 5000);
    setTimeout(function() {
        document.getElementById('banner_show').style.display = 'block';
    }, 5000);
    };    
    
    $('.gobtn').on('click',function(){
        console.log('click');
        var searchtext = $(".search_text").val();
        searchtext = searchtext.replace(/\s+/g, '-').toLowerCase();
        window.location = app_url + 'search?search_text='+searchtext;
    }); 
</script>

<script src="{{ENV('APP_URL')}}assets/js/aeroplane/jquery-1.11.1.min.js"></script>
<script src="{{ENV('APP_URL')}}assets/js/aeroplane/aeroplane_ani.js"></script>
<!-- HOME-PAGE-LOAD-START -->

</body>

</html>
