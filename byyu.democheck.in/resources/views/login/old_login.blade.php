@include('layout.header')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<style>
    .hide {
        display: none;
    }
</style>

<div class="middle_box width100">
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" style="background-color: #fffce9; background-image: url({{ENV('APP_URL')}}assets/images/register/register_img.png);background-repeat: no-repeat;background-position: center;background-size: cover;"></div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4 pt-2 mb-3">
                    <div>
                        <div class="row">
                            <div class="col-lg-12 verify_text mt-4 mb-5 text-center">
                                Sign In
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login_inner2 text-center">
                                    <form  method="POST"action="{{route('loginsubmit')}}" enctype="multipart/form-data">
                                        @csrf

                                        <fieldset class="login_number_box mb-3">
                                            <div class="label_list">
                                                <div id="phone-container" class="input-group">
                                                    <input type="text" class="number_text form-control" id="phone" name="mobile" value="" formControlName="mobile" Required>
                                                    <!-- Hidden input for the country code -->
                                                    <input type="hidden" id="countryCode" name="country_code">
                                                    <input type="hidden" id="countryCodeadd" name="countryCodeadd" value="">
                                                    <!-- <input type="hidden" id="flagcode" name="flagcode" value=""> -->

                                                    <input type="hidden" id="appUrl" name="appUrl" value="{{ env('APP_URL') }}">
                                                    <input type="hidden" id="NODE_APP_URL" name="NODE_APP_URL" value="{{ env('NODE_APP_URL') }}">
                                                    <input type="hidden" id="currentcountrycode" name="currentcountrycode" value="{{ $data['message'] ?? ''}}">


                                                </div>
                                                <div class="label_position">Enter Mobile Number</div>

                                                <span id="valid-msg" class="hide">✓ Valid</span>
                                                <span id="error-msg" class="hide"></span>
                                                <div id="countryMessage" style="color: red; margin-bottom: 10px; font-size: 10px;"></div>

                                            </div>

                                            <div class="invalid-feedback mt-3">
                                                <div>Country Code is required</div>

                                            </div>
                                            <div class="invalid-feedback">
                                                <div>Mobile number is required</div>
                                            </div>
                                            <div class="mobile_communication_mess text-center"></div>
                                        </fieldset>
                                        <fieldset class="form-group mb-5">
                                            <button type="submit" class="login_submit_btn">GET OTP</button>
                                        </fieldset>
                                    </form>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <div class="register_continue_text"><span>Or Continue with</span></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-3" style="    margin-left: 42px;
    background-image: url(http://localhost/byyu/assets/images/login/login_shadow.png);
    background-size: cover;
    background-position: center;
    width: 52px;
">
<a href="{{ route('login.google') }}">
    <img src="{{ asset('assets/images/login/google.png') }}"  style="width: 100%; max-width: 50px; margin: auto; display: block;">
</a>
                                        <!-- <img src="{{ asset('assets/images/login/google.png') }}" alt="Google Icon" style="width: 100%; max-width: 50px; margin: auto; display: block;"> -->
                                        </div>
                                        <div class="col-lg-9 mb-5 p-0 register_continue_buttonbox text-center" style="position: relative;">
                                            <div style="max-width: 280px; margin: 0 auto; position: relative;">
                                                <asl-google-signin-button size='medium' style="width: 260px;position: absolute;left: 0;"></asl-google-signin-button>

                                                <span style="font-size: 14px; padding: 6px 10px 0 26px; float: left; font-family: Metropolis-Bold; color: #737373; text-transform: uppercase;width: 100%;">Continue with Google</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            Don't have an account? <a href="{{ url('/register') }}" style="color: #f03613; text-decoration: none">Sign Up</a>
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
<script>
    const input = document.querySelector("#phone");
    const errorMsg = document.querySelector("#error-msg");
    const validMsg = document.querySelector("#valid-msg");
    const countryCodeInput = document.querySelector("#countryCode");
    const appUrl = document.querySelector("#appUrl").value;
    const NODE_APP_URL = document.querySelector("#NODE_APP_URL").value;
    const currentcountrycode = document.querySelector("#currentcountrycode").value;
    // const flagcodefetch = document.querySelector("#flagcode").value;


    if (currentcountrycode !== "971") {
                    $('#countryMessage').text('All communication outside the UAE is exclusively done through WhatsApp.');
                }else{
                    $('#countryMessage').text('');

                }



    const errorMap = ["Invalid number", "Invalid country code", "Invalid number", "Invalid number", "Invalid number"];

    // Initialize plugin with separateDialCode option
    const iti = window.intlTelInput(input, {
        initialCountry: currentcountrycode,
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
    const initialCountryData = iti.getSelectedCountryData();
   const initialDialCode = initialCountryData.dialCode;
//    const flagcode = initialCountryData.iso2;
   $('#countryCodeadd').val(initialDialCode);
//    $('#flagcode').val(flagcode);






    const reset = () => {
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.innerHTML = "";
        validMsg.classList.add("hide");
    };

    const showError = (msg) => {
        input.classList.add("error");
        errorMsg.innerHTML = msg;
        errorMsg.classList.remove("hide");
        errorMsg.style.color = "red";
    };

    const showValid = () => {
        validMsg.innerHTML = "✓ Valid";
        validMsg.classList.remove("hide");
        validMsg.style.color = "green";
    };

    const validateInput = () => {
        reset();
        const phoneNumber = input.value.trim();
        const countryData = iti.getSelectedCountryData();
        const nationalNumber = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);


    };

    // Update hidden input with country code on initialization and country change
    const updateCountryCode = () => {
        const countryData = iti.getSelectedCountryData();
        countryCodeInput.value = countryData.dialCode;
    };

    // Predefined list of required number lengths for selected countries
    const numberLengths = {
        us: 10,
        ae: 9,
        // Add more countries and their expected lengths here
    };

    const getRequiredNumberLength = (countryData) => {
        return numberLengths[countryData.iso2] || 10; // Default to 10 if country is not in the list
    };

    // Trigger validation on input change
    input.addEventListener('input', validateInput);
    input.placeholder = "";

    // On change flag: reset and update country code
    input.addEventListener('countrychange', () => {
        reset();
        updateCountryCode();
        validateInput();
        input.placeholder = "";

        // Alert the required number length for the selected country
        const countryData = iti.getSelectedCountryData();
        const requiredLength = getRequiredNumberLength(countryData);
        const phoneNumber = input.value.trim();
        const numericPhoneNumber = phoneNumber.replace(/\D/g, '');
        const truncatedPhoneNumber = numericPhoneNumber.slice(0, requiredLength);
        input.value = truncatedPhoneNumber;
        $('#countryCodeadd').val(countryCodeInput.value);
        $('#countryMessage').text('All communication outside the UAE is exclusively done through WhatsApp.');
              if (countryCodeInput.value !== "971") {
                    $('#countryMessage').text('All communication outside the UAE is exclusively done through WhatsApp.');
                }else{
                    $('#countryMessage').text('');

                }

        // alert(`The required number of digits for ${countryData.name} is ${requiredLength}.`);
    });

    // Set the initial country code value
    updateCountryCode();



    // Restrict input length based on country-specific phone number length
    input.addEventListener('input', () => {
        const countryData = iti.getSelectedCountryData();
        const phoneNumberLength = input.value.replace(/\D/g, '').length; // Remove non-numeric characters
        const maxLength = getRequiredNumberLength(countryData);

        if (phoneNumberLength > maxLength) {
            input.value = input.value.slice(0, maxLength);
        }
    });

</script>





@include('layout.footer')
