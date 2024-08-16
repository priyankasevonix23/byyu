@include('layout.header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="middle_box width100">
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" style="background-color: #fffce9; background-image: url({{ENV('APP_URL')}}assets/images/register/register_img.png);background-repeat: no-repeat;background-position: center;background-size: cover;"></div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <div>
                        <div class="row">
                            <div class="col-lg-12 verify_text mt-4 mb-5 text-center">Verify OTP</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login_inner2 text-center login_number_box">
                                    <div class="row">
                                        <div class="col-lg-12 text-center logingift_img mb-5">
                                            <img src="{{ENV('APP_URL')}}assets/images/login/login_otp.png" class="img-fluid mt-0">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <!-- Message div to show response messages -->
                                            <div id="responseMessage" style="color: red; margin-bottom: 10px;"></div>
                                            <form id="otpForm" enctype="multipart/form-data">
                                                <fieldset class="login_number_box mb-4">
                                                    <div class="label_list" style="width: 100%;">
                                                        <input type="number" id="otp" class="input_text" value="" maxlength="6" style="text-align: center;" >
                                                        <input type="hidden" id="NODE_APP_URL" name="NODE_APP_URL" value="{{ env('NODE_APP_URL') }}">
                                                        <input type="hidden" id="user_phone" name="user_phone" value="{{ $user['user_phone'] }}">
                                                        <input type="hidden" id="device_id" name="device_id" value="{{ $user['device_id'] }}">
                                                        <input type="hidden" id="dialcode" name="dialcode" value="{{ $user['dialcode'] }}">
                                                        <input type="hidden" id="country_code" name="country_code" value="{{ $user['country_code'] }}">
                                                        <input type="hidden" id="appUrl" name="appUrl" value="{{ env('APP_URL') }}">
                                                        <input type="hidden" id="userid" name="userid" value="{{ $user['id'] }}">


                                                        <div class="invalid-feedback mt-3" id="otpRequiredMessage" style="display: none;">
                                                            <div>OTP is required</div>
                                                        </div>
                                                        <div class="label_position">Enter OTP</div>
                                                    </div>
                                                    <?php
                                                        $countryCode = $user['country_code'];
                                                        $lastTwoDigits = !empty($user['user_phone'])?substr($user['user_phone'], -2):''; // Extract the last two digits
                                                        ?>
                                                    <div style="font-size: 13px; margin: 15px 0 0 0; float: left; width: 100%;background-color: #fffce9;padding: 9px 0;border-radius: 10px;border: 1px solid #f3ecc0;line-height: normal;">
                                                        <div>Kindly enter the OTP <br>sent to your WhatsApp <?php echo $countryCode; ?>-XXXXXXXX<span id="lastTwoDigits"></span></div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="form-group mb-4">
                                                    <button type="submit" class="login_submit_btn">Verify</button>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-5">
                                            Didn't receive OTP? <a onclick="resendOtp()" style="color: #f03613;"><u>Resend OTP</u></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layout.footer')

<script>
    $(document).ready(function() {
            const fullPhoneNumber = $('#user_phone').val();
            const country_code = $('#country_code').val();

    var lastTwoDigits = fullPhoneNumber.slice(-2);
    // alert(lastTwoDigits)
    $('#lastTwoDigits').text(lastTwoDigits);
});

    $(document).ready(function() {
        $('#otpForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            const otp = $('#otp').val();
            const user_phone = $('#user_phone').val();
            const device_id = $('#device_id').val();
            const dialcode = $('#dialcode').val();
            const country_code = $('#country_code').val();
            const NODE_APP_URL = $('#NODE_APP_URL').val();
            const appUrl = $('#appUrl').val();
            const userid = $('#userid').val();




            // Clear any previous message
            $('#responseMessage').text('');
            $('#otpRequiredMessage').hide(); // Hide the OTP required message by default

            // Check if OTP is empty
            if (!otp) {
                $('#otpRequiredMessage').show(); // Show the OTP required message
                return; // Prevent form submission
            }

            const formData = {
                user_phone: user_phone,
                otp: otp,
                country_code: country_code,
                dialcode: dialcode, // Add actual dial code if available
                referral_code: "",
                device_id: device_id
            };

            console.log(formData); // Debug: print the data to console

            // Send AJAX request
            $.ajax({
                url: NODE_APP_URL + "verify_phone",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    console.log(response);

                    if (response.status === '1') {
                        var loginUserUrl = "{{ route('loginuser', ['id' => '__ID__']) }}".replace('__ID__', userid);

                        $.ajax({
                        url: loginUserUrl,
                        method: "GET",
                        contentType: "application/json",

                        // data: JSON.stringify({ userid: userid }), // Send userid in the dataS
                        success: function(loginResponse) {
                            if(loginResponse.status == 1)
                            {
                                window.location.href = appUrl;



                            }



                        },
                        error: function(loginError) {
                            // Handle error response of the loginuser request
                            console.log(loginError);
                            $('#responseMessage').text('Login request failed. Please try again.');
                        }
                    });



                        // You can add further actions here if needed
                    } else if (response.status === '0') {
                        $('#otp').val("");
                        $('#responseMessage').text(response.message);
                    }
                },
                error: function(error) {
                    // Handle error response
                    console.log(error);
                    $('#responseMessage').text('An error occurred. Please try again.');
                }
            });
            //ajax end
        });
    });

    function resendOtp() {
            const user_phone = $('#user_phone').val();
            const country_code = $('#country_code').val();
            const NODE_APP_URL = $('#NODE_APP_URL').val();

          const formData = {
                user_phone: user_phone,
                country_code: country_code,
                dialcode: "", // Add actual dial code if available

            };
             // Send AJAX request
             $.ajax({
                url: NODE_APP_URL + "resendotp",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    $('#responseMessage').text(response.message);
                },
                error: function(error) {
                    // Handle error response
                    console.log(error);
                    $('#responseMessage').text('An error occurred. Please try again.');
                }
            });
            //ajax end

    }
</script>
