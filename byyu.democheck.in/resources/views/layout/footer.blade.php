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
    var node_app_url = "{{ENV('NODE_APP_URL')}}"; 

</script>

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
            0: {
                items: 2,
            },
            600: {
                items: 3
            },
            1200: {
                items: 5
            },
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
            0: {
                items: 2,
            },
            600: {
                items: 3
            },
            1200: {
                items: 5
            },
            1300: {
                items: 5
            }
        }

    });


    // PRODUCT-LISTING-CAT-SLIDER-START
    $('.owl-carousel_catlist').owlCarousel({

        autoplay: false,

        center: false,

        loop: true,

        nav: true,

        dots: false,

        items: 6,

        navigationText: false,

        responsive: {
            0: {
                items: 3,
            },
            600: {
                items: 3
            },
            1200: {
                items: 8
            },
            1300: {
                items: 8
            }
        }

    });
    // PRODUCT-LISTING-CAT-SLIDER-END



    



</script>



@stack('scripts')

<!--  PRODUCT-SLIDER-END -->

</body>



</html>