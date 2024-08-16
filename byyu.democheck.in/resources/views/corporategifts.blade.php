@include('layout/header')


<div class="middle_box width100">
    <section>
        <div class="corporate_right">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-0 mb-5">
                        <img src="{{ENV('APP_URL')}}assets/images/corporate_banner.png" class="img-fluid">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="corporate_rightinner">
                            <div class="row">
                                <div class="col-lg-12 black_heading mb-3" style="font-size: 28px;">Our Sample Products</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-4 col-sm-4 col-md-4 mb-4">
                                    <img src="{{ENV('APP_URL')}}assets/images/corporate_product_img1.png" class="img-fluid" style="max-height: 180px; border-radius:15px">
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4 mb-4">
                                    <img src="{{ENV('APP_URL')}}assets/images/corporate_product_img2.png" class="img-fluid" style="max-height: 180px; border-radius:15px">
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-4 mb-4">
                                    <img src="{{ENV('APP_URL')}}assets/images/corporate_product_img3.png" class="img-fluid" style="max-height: 180px; border-radius:15px">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-12" style="background-color: #f8f6ea; border-radius: 10px;">
                                    <div class="row" style="min-height: 100px;align-items: center;">
                                        <div class="col-lg-3 mt-3 mb-3 black_heading text-center" style="line-height: normal;font-size: 31px;">
                                            <span style="font-size: 24px;">BRAND THAT</span> <br><span style="color: #f03613;">TRUST US</span>
                                        </div>
                                        <div class="col-lg-9 text-center">
                                            <img src="{{ENV('APP_URL')}}assets/images/corporate_trustimg_1.png" class="img-fluid" style="max-height: 60px; margin:0 20px">
                                            <img src="{{ENV('APP_URL')}}assets/images/corporate_trustimg_2.png" class="img-fluid" style="max-height: 60px; margin:0 20px">
                                            <img src="{{ENV('APP_URL')}}assets/images/corporate_trustimg_3.png" class="img-fluid" style="max-height: 57px; margin:0 20px">
                                            <img src="{{ENV('APP_URL')}}assets/images/corporate_trustimg_4.png" class="img-fluid" style="max-height: 30px; margin:0 20px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 black_heading mb-3 text-center" style="font-size: 28px;">Benefits to our <span style="color: #f03613;">Partners</span></div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-4 mb-3">
                                    <div class="benefits_box">
                                        <div class="bbenefits_icon"><img src="{{ENV('APP_URL')}}assets/images/corporate_ProductCustomization_icon.png" class="img-fluid"></div>
                                        <div class="bbenefits_text">Product Customization <span>as per request</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="benefits_box">
                                        <div class="bbenefits_icon"><img src="{{ENV('APP_URL')}}assets/images/corporate_timedelivery_icon.png" class="img-fluid"></div>
                                        <div class="bbenefits_text">Timely Delivery</div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="benefits_box">
                                        <div class="bbenefits_icon"><img src="{{ENV('APP_URL')}}assets/images/corporate_offer_icon.png" class="img-fluid"></div>
                                        <div class="bbenefits_text">Offer a wide range of <span>highquality, unique products</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="corporate_left">
            <div class="corporate_leftinner">
                <div class="row">
                    <div class="col-lg-12 black_heading mb-3" style="text-transform: uppercase;font-size: 28px;">Contact Us</div>
                </div>
                <div class="row">
                 
             <div class="col-lg-12">
                @if (session()->has('success'))
                   <div class="alert alert-success">
                @if(is_array(session()->get('success')))
                        <ul>
                            @foreach (session()->get('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        @else
                            {{ session()->get('success') }}
                        @endif
                    </div>
                @endif
                @if (count($errors) > 0)
                  @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      {{$errors->first()}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  @endif
                @endif
                <div class="alert alert-danger d-none" role="alert" id="email-error"></div>
            </div>
                    <form method="post" action="{{route('contactussubmit')}}" onsubmit="return formCheck(this)">
                        {{csrf_field()}}
                        <div class="col-lg-12 cor_input mb-3"><input type="text" name="firstname" id="firstname" placeholder="First Name" required></div>
                        <div class="col-lg-12 cor_input mb-3"><input type="text" name="lastname" id="lastname" placeholder="Last Name" required></div>
                        <div class="col-lg-12 cor_input mb-3"><input type="email" name="email" id="emailid" placeholder="Email Id" required></div>
                        <div class="col-lg-12 cor_input mb-3"><textarea name="message" id="message" placeholder="Enter Message" required></textarea></div>
                        <div class="col-lg-12 cor_input mb-3"><input type="submit" id="submit" value="Submit" style="background-color: #f03613;width: auto;border: 0;color:#fff;padding: 10px 30px;border-radius: 100px;"></div>
                    </form>
                </div>
            </div>
            <div class="corporate_giftimg">
                <img src="{{ENV('APP_URL')}}assets/images/corporate_giftimg.png" class="img-fluid">
            </div>
        </div>
        
    </section>
</div>
@include('layout/footer')
<script>
    function formCheck(form){
        const isValidEmail = (email) => {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        };
            console.log('on blur');
            var emailval = document.getElementById('emailid').value;
            if (!emailval || emailval.trim() === '') {
                $('#email-error').html('Please enter a email address.');
                $('#email-error').removeClass('d-none');
                return false;
            }else if (!isValidEmail(emailval)) {
                $('#email-error').html('Please enter a valid email address.');
                $('#email-error').removeClass('d-none');
                return false;
            }else{
                $('#email-error').html('');
                $('#email-error').addClass('d-none');
                return true;
            }
        }
        
    $(document).ready(function(){
        
        
        
        
    });
</script>