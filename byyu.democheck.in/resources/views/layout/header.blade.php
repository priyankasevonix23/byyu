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
    <meta name="robots" content="noindex,nofollow">
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
    <meta property="og:url" content="{{ $data_arr['canonical'] ?? URL::current() }}">
    <meta property="og:description" content="{{ $data_arr['description'] ?? 'Find the perfect gift at byyu Online Gift Store! Enjoy seamless online flowers delivery in Dubai. Explore our exquisite collection today.' }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $data_arr['image'] ?? 'https://www.byyu.com/assets/images/BYYU_Logo.png'}}">

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
   @if(Request::is('event-product-list/*') || Request::is('product-list/*'))

    @if(Request::is('event-product-list/*'))
        @php $title = !empty($eventDetails['event_name']) ? $eventDetails['event_name'] : ''; @endphp
    @endif

    @if(Request::is('product-list/*'))
       @php $title = !empty($categoryTitle) ? $categoryTitle : ''; @endphp
    @endif
  <script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "WebSite",
    "name": "{{ $title ?? 'byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai'}}",
    "url": "{{ $data_arr['canonical'] ?? \URL::current() }}",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "{{ $data_arr['canonical'] ?? \URL::current() }}{search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>
  @endif 
    <header id="header_top" class="top_header" [class.scrolled]="isScrolled">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="logo mt-1 mb-1">
                <a href="{{url('/')}}"><img src="{{ENV('APP_URL')}}assets/images/BYYU_Logo.png" class="img-fluid" alt="byyu logo"></a>
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
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_profile_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">My Profile</div>
                  </a>
                  <a href="{{ url('/logout') }}">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_logout_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Sign Out</div>
                  </a>

                  @else
                  <a href="{{ url('/login') }}">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_login_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Sign In</div>
                  </a>

                  @endif

                  <a class="mobile_searchbox" onclick="search_top()">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_search_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Search</div>
                    </a>

              </div>

              <form method="get" action="{{url('search')}}">
                <div class="search_box" id="search_top">
                  <div class="searchyourgift_img"><img src="{{ENV('APP_URL')}}assets/images/search_gift_text.gif" class="img-fluid @if(!empty(Request::get('search_text'))) d-none @endif" alt="Search Bar"></div>
                  <input type="text" name="search_text" class="search_text" value="{{Request::get('search_text')}}">
                  <input type="submit" value="submit" class="gobtn" disabled>
                  <div onclick="search_top()" class="search_close_mobile">x</div>
                </div>
              </form>

            </div>
          </div>
        </div>
    </header>
