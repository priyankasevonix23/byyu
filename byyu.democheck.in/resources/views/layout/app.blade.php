<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ENV('APP_URL')}}assets/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ENV('APP_URL')}}assets/images/favicon.ico">

    <title>{{ $data_arr['title'] ?? 'Byyu Online Gifts Dubai | Byyu Online Gift Store | Byyu Dubai'}}</title>
     
    @stack('styles') 
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
                <a href="{{url('/')}}"><img src="{{ENV('APP_URL')}}assets/images/BYYU_Logo.png" class="img-fluid"></a>
              </div>
              
              <div class="top_othermenu_box">
                  <a routerLink="/wishlist">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_wishlist_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Wishlist</div>
                  </a>
                  <a routerLink="/wishlist">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_cart_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Cart</div>
                  </a>
                  <a routerLink="/wishlist">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_profile_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">My Profile</div>
                  </a>
                  <a routerLink="/wishlist">
                    <div class="top_othermenu_imgbox"><img src="{{ENV('APP_URL')}}assets/images/top_login_icon.png" class="img-fluid"></div>
                    <div class="top_othermenu_heading">Sign In</div>
                  </a>
    
              </div>
              <form method="get" action="{{url('search')}}">
                <div class="search_box" id="search_top">
                  <div class="searchyourgift_img"><img src="{{ENV('APP_URL')}}assets/images/search_gift_text.gif" class="img-fluid @if(!empty(Request::get('search_text'))) d-none @endif"></div>
                  <input type="text" name="search_text" class="search_text" value="{{Request::get('search_text')}}">
                  <input type="submit" value="submit" class="gobtn" disabled>
                  <div onclick="search_top()" class="search_close_mobile">x</div>
                </div>
              </form>
            </div>
          </div>
        </div>    
    </header>
 
        <div class="container">
            @yield('content')
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
                                    <a href="https://play.google.com/store/apps/details?id=com.byyu" target="_blank"><img src="{{ENV('APP_URL')}}assets/images/playstore_icon.png" class="img-fluid"></a>
                                    <a href="https://apps.apple.com/us/app/byyu-gifts-flowers-cakes/id6474729123" target="_blank"><img src="{{ENV('APP_URL')}}assets/images/appstore_icon.png" class="img-fluid"></a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="footer_col_box50 footer_column4" style="min-height: inherit">
                        <div class="footer90 mb-0" style="border: 0;">                    
                            <div class="row">
                                
                                <div class="col-lg-12 text-center footer_social_icon">
                                        <a href="https://www.facebook.com/profile.php?id=61552755963187" target="_blank"><img src="{{ENV('APP_URL')}}assets/images/footer_facebook.png" class="img-fluid"></a>
                                        <a href="https://twitter.com/byyu_com" target="_blank"><img src="{{ENV('APP_URL')}}assets/images/footer_twitter.png" class="img-fluid"></a>
                                        <a href="https://www.linkedin.com/company/byyu2/about/" target="_blank"><img src="{{ENV('APP_URL')}}assets/images/footer_linkedin.png" class="img-fluid"></a>
                                        <a href="https://www.instagram.com/byyu.ae/" target="_blank"><img src="{{ENV('APP_URL')}}assets/images/footer_instagram.png" class="img-fluid"></a>
                                        <a href="https://www.tiktok.com/@byyu.ae/" target="_blank"><img src="{{ENV('APP_URL')}}assets/images/footer_tiktok.png" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--  PRODUCT-SLIDER-START -->
    <link rel="stylesheet" href="{{ENV('APP_URL')}}assets/js/product_slider/owl.carousel.min.css">
    <script src="{{ENV('APP_URL')}}assets/js/product_slider/jquery-1.12.4.min.js"></script>
    <script src="{{ENV('APP_URL')}}assets/js/product_slider/owl.carousel.min.js"></script>
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
        $('.owl-carousel_similar').owlCarousel({
            autoplay: false,
            center: false,
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
        $('.owl-carousel_frequent').owlCarousel({
            autoplay: false,
            center: false,
            loop: true,
            nav: true,
            dots: false,
            items: 6,
            navigationText: false,
            responsive: {           
                1300: {
                    items: 6
                }
            }
        });

        

    </script>

    @stack('scripts')
<!--  PRODUCT-SLIDER-END -->
</body>

</html>