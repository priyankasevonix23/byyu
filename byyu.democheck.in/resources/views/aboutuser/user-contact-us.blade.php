@include('layout/header')


<div class="middle_box width100">
        <section style="position: relative;">
            <div class="container" style="position: relative; z-index: 5;">
                <div class="row">
                    
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3">
                        @include('aboutuser/aboutuser-leftmenu')
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                        <div class="col-lg-12 verify_text mt-5 mb-5" style="color: #000;">Contact Us</div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                                <div class="contact_list">
                                    <img src="{{ENV('APP_URL')}}assets/images/contact_email.png" class="img-fluid">
                                    <a href="mailto:contact@byyu.com">
                                        Email
                                        <span>contact@byyu.com</span>
                                    </a>
                                </div>
                                <div class="contact_list">
                                    <img src="{{ENV('APP_URL')}}assets/images/contact_whatapp.png" class="img-fluid">
                                    <a href="https://api.whatsapp.com/send?phone=971523487661">
                                        Whatsapp
                                        <span>+971523487661</span>
                                    </a>
                                </div>
                                <div class="contact_list">
                                    <img src="{{ENV('APP_URL')}}assets/images/contact_call.png" class="img-fluid">
                                    <a href="tel:+971526002661">
                                        Contact
                                        <span>800 byyu</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile_leftbox"></div>
        </section>
</div>
@include('layout/footer')