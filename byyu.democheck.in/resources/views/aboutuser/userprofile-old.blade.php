@include('layout.header')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

<style>
    .hide {
        display: none;
    }
    .error-message {
        color: red;
        margin-top: 5px;
        font-size: 14px;
    }

</style>

<div class="middle_box width100">
    <section style="position: relative;">
        <div class="container" style="position: relative; z-index: 5;">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    @include('aboutuser/aboutuser-leftmenu')
                </div>
                <div class="col-lg-8 mt-5">
                    <div class="row">
                        <div class="col-lg-12 black_heading mb-5 pb-2" style="border-bottom: 1px dashed #000;">
                            My Profile <br>
                            <!-- <span style="font-size:15px;color:red">Please complete your profile before placing an order</span> -->
                            <div id="responsemessage" style="color: green; margin-bottom: 10px; font-size: 15px;"></div>
                            @if(session('error'))
                             <div class="error-message" style="margin-bottom: 20px;">{{ session('error') }}</div>
                           @endif
                           @if(session('success'))
                             <div class="success-message" style="margin-bottom: 20px;color:green">{{ session('success') }}</div>
                           @endif



                        </div>
                    </div>
                    <form  method="POST" id="loginform" action="{{route('userprofilesubmit')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8 mb-5">
                                <div class="label_list2">
                                    <input type="text" class="input_text" name="name" id="name" value="{{$userdata['name']}}">
                                    <div class="label_position">Full Name</div>
                                </div>
                                <div class="error-message" id="name-error"></div>
                                @error('name')
                                    {{ $message }}
                                @enderror

                            </div>
                            <div class="col-lg-8 mb-5">
                                <div class="label_list2">
                                    <input type="text" class="input_text" name="email" id="email" value="{{$userdata['email']}}">
                                    <div class="label_position">Email ID</div>
                                </div>
                                <div class="error-message" id="email-error"></div>

                                <div class="otp-verification-boxemail mt-4" style="float: left;width: 100%; display: none;">
                                    <div class="otp-message" style="font-size: 14px;margin: 0 0 10px 0;">
                                        Please enter the OTP to verify your email:
                                    </div>
                                    <input type="text" style="width: 180px;margin: 0 20px 0 0;" class="otp-input input_text" placeholder="Enter OTP" id="otpValue" name="otpValue">
                                    <button class="red_button" id="submitOtpButton">Submit OTP</button>
                                </div>
                                <div id="otpmessage" style="color: red; margin-bottom: 10px; font-size: 15px;"></div>

                            </div>
                            <div class="col-lg-6 mb-5" style="position: relative;">
                                <!-- <div class="country_code_dropbox">
                                    <input style="opacity: 0; display: none;" ng2TelInput [ng2TelInputOptions]="{separateDialCode:true,hiddenInput:''}" hiddenInput=false />
                                </div> -->
                                <div class="label_list2">
                                    <div class="mobile_number_country_box">
                                        <div id="phone-container" class="input-group">
                                            <input type="number" class="mobile_textbox" name="mobile" id="phone" value="{{$userdata['user_phone']}}" autocomplete="off">
                                            <input type="hidden" class="input_text" id="currentcountrycode" value="{{$data['message']}}">
                                            <input type="hidden" class="input_text" id="country_code" name="country_code" value="{{$userdata['country_code']}}">
                                            <input type="hidden" class="input_text" id="flagcode" name="flagcode" value="{{$userdata['flag_code']}}">
                                            <input type="hidden" class="input_text" id="privacyvalue" name="privacy" value="{{$userdata['privacy_policy_flag']}}">
                                            <input type="hidden" class="input_text" id="user_id" name="user_id" value="{{$userdata['id']}}">
                                        </div>
                                    

                                        <input type="hidden" id="NODE_APP_URL" value="{{ env('NODE_APP_URL') }}">
                                        <input type="hidden" id="selected_flag_emoji" name="selected_flag_emoji" value="">
                                        <input type="hidden" class="input_text" id="lastid" name="user_id" value="">


                                        <div class="label_position">Enter Mobile Number</div>
                                        <div id="countryMessage" style="color: red; margin-bottom: 10px; font-size: 10px;"></div>
                                        <div class="error-message" id="phone-error"></div>
                                    </div>

                                </div>
                                <div class="otp-verification-box" style="display: none;">
                                    <div class="otp-messagemobile" style="font-size: 14px;margin: 0 0 12px 0;">
                                        Please enter the OTP to verify your Mobile number:
                                    </div>
                                    <input type="text" style="width: 180px;margin: 0 20px 0 0;" class="otp-input input_text" placeholder="Enter OTP" id="otpValuephone" name="otpValuephone">
                                    <button class="otp-submit-button red_button" id="submitOtpmobile">Submit OTP</button>
                                    <div id="otpmessagephone" style="color: red; margin-bottom: 10px; font-size: 15px;"></div>

                                </div>

                            </div>
                            <div class="col-lg-3 mb-5">
                                <div class="label_list2">
                                    <input type="date" name="dob" id="dob" value="{{$userdata['dob']}}" class="input_text" >

                                    <div class="label_position">DOB</div>
                                    <div class="error-message" id="dob-error">
                                                        @error('dob')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 mb-5">
                                <div class="label_list2">
                                    <div class="gender_box">
                                        <div style="float: left;">
                                            <input type="radio" id="male" name="user_gender" value="male" @if($userdata['user_gender'] == 'male') checked @endif>

                                            <label for="male">
                                                <div class="dot"></div>
                                                <span>Male</span>
                                            </label>
                                        </div>
                                        <div style="float: left;">
                                            <input type="radio" id="female" name="user_gender" value="female" @if($userdata['user_gender'] == 'female') checked @endif>
                                            <label for="female">
                                                <div class="dot"></div>
                                                <span>Female</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="label_position" style="margin: -28px 0 0 4px;">Select Gender:</div>
                                </div>
                            </div>
                            @if($userdata['privacy_policy_flag'] == 0)

                            <div class="col-lg-8 mb-2">
                                <label for="policy">
                                    <input type="checkbox" name="privacy_policy_flag" id="privacy_policy_flag">&nbsp;
                                    <a href="/privacypolicy" style="color: #f03613; text-decoration: none;">I agree to the Privacy Policy</a>
                                    <span style="color:red">*</span>
                                </label>
                                <div class="error-message" id="privacy_policy_flag-error" >
                            @error('privacy_policy_flag')
                                                    {{ $message }}
                                 @enderror
                            </div>


                            @endif

                            <div class="col-lg-8 mb-3" style="position: relative;">
                                <label for="whatsapp">

                                    @if($userdata['whatsapp_flag'] == 1)
                                    <input type="checkbox" name="whatsapp_flag" id="whatsapp_flag" selected>&nbsp;
                                    @else
                                    <input type="checkbox" name="whatsapp_flag" id="whatsapp_flag" >&nbsp;
                                    @endif

                                    I want to receive notification on Whatsapp <span style="color:red">*</span>
                                </label>
                                <div style="width: 30px;height: 20px;left: 0;top: 0;z-index: 500;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-5">
                                <input type="submit" value="Update" class="red_button"> &nbsp;
                                <input type="button" value="Delete My Account" class="red_button">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="profile_leftbox"></div>
    </section>
</div>

<script>
    $(document).ready(function() {

        const input = document.querySelector("#phone");
        const errorMsg = document.querySelector("#error-msg");
        const validMsg = document.querySelector("#valid-msg");
        const currentcountrycode = document.querySelector("#currentcountrycode").value;
        const countryCodeInput = document.querySelector("#country_code").value;
        const flagCodeInput = document.querySelector("#flagcode");
        var whatsappCheckbox = document.getElementById('whatsapp_flag');
        const user_id = document.querySelector("#user_id").value;
        const NODE_APP_URL = document.querySelector("#NODE_APP_URL").value;

        //check country code by dailcode
        const dialCodeToCountryCode = {
                    "1": "US", "7": "RU", "20": "EG", "27": "ZA", "30": "GR", "31": "NL", "32": "BE", "33": "FR",
                    "34": "ES", "36": "HU", "39": "IT", "40": "RO", "41": "CH", "43": "AT", "44": "GB", "45": "DK",
                    "46": "SE", "47": "NO", "48": "PL", "49": "DE", "51": "PE", "52": "MX", "53": "CU", "54": "AR",
                    "55": "BR", "56": "CL", "57": "CO", "58": "VE", "60": "MY", "61": "AU", "62": "ID", "63": "PH",
                    "64": "NZ", "65": "SG", "66": "TH", "81": "JP", "82": "KR", "84": "VN", "86": "CN", "90": "TR",
                    "91": "IN", "92": "PK", "93": "AF", "94": "LK", "95": "MM", "98": "IR", "211": "SS", "212": "MA",
                    "213": "DZ", "216": "TN", "218": "LY", "220": "GM", "221": "SN", "222": "MR", "223": "ML",
                    "224": "GN", "225": "CI", "226": "BF", "227": "NE", "228": "TG", "229": "BJ", "230": "MU",
                    "231": "LR", "232": "SL", "233": "GH", "234": "NG", "235": "TD", "236": "CF", "237": "CM",
                    "238": "CV", "239": "ST", "240": "GQ", "241": "GA", "242": "CG", "243": "CD", "244": "AO",
                    "245": "GW", "246": "IO", "248": "SC", "249": "SD", "250": "RW", "251": "ET", "252": "SO",
                    "253": "DJ", "254": "KE", "255": "TZ", "256": "UG", "257": "BI", "258": "MZ", "260": "ZM",
                    "261": "MG", "262": "RE", "263": "ZW", "264": "NA", "265": "MW", "266": "LS", "267": "BW",
                    "268": "SZ", "269": "KM", "290": "SH", "291": "ER", "297": "AW", "298": "FO", "299": "GL",
                    "350": "GI", "351": "PT", "352": "LU", "353": "IE", "354": "IS", "355": "AL", "356": "MT",
                    "357": "CY", "358": "FI", "359": "BG", "370": "LT", "371": "LV", "372": "EE", "373": "MD",
                    "374": "AM", "375": "BY", "376": "AD", "377": "MC", "378": "SM", "379": "VA", "380": "UA",
                    "381": "RS", "382": "ME", "383": "XK", "385": "HR", "386": "SI", "387": "BA", "389": "MK",
                    "420": "CZ", "421": "SK", "423": "LI", "500": "FK", "501": "BZ", "502": "GT", "503": "SV",
                    "504": "HN", "505": "NI", "506": "CR", "507": "PA", "508": "PM", "509": "HT", "590": "BL",
                    "591": "BO", "592": "GY", "593": "EC", "594": "GF", "595": "PY", "596": "MQ", "597": "SR",
                    "598": "UY", "599": "CW", "670": "TL", "672": "NF", "673": "BN", "674": "NR", "675": "PG",
                    "676": "TO", "677": "SB", "678": "VU", "679": "FJ", "680": "PW", "681": "WF", "682": "CK",
                    "683": "NU", "685": "WS", "686": "KI", "687": "NC", "688": "TV", "689": "PF", "690": "TK",
                    "691": "FM", "692": "MH", "850": "KP", "852": "HK", "853": "MO", "855": "KH", "856": "LA",
                    "880": "BD", "886": "TW", "960": "MV", "961": "LB", "962": "JO", "963": "SY", "964": "IQ",
                    "965": "KW", "966": "SA", "967": "YE", "968": "OM", "970": "PS", "971": "AE", "972": "IL",
                    "973": "BH", "974": "QA", "975": "BT", "976": "MN", "977": "NP", "992": "TJ", "993": "TM",
                    "994": "AZ", "995": "GE", "996": "KG", "998": "UZ"
                };

     const getCountryCodeFromDialCode = (dialCode) => {
            return dialCodeToCountryCode[dialCode] || "";
        };
        const currentCountryCodeval = getCountryCodeFromDialCode(countryCodeInput).toLowerCase();

        var currentflag = "";
        if(countryCodeInput === "") {
            currentflag = currentcountrycode;
        } else {
            currentflag = currentCountryCodeval;

        }
        if (currentflag.toLowerCase() !== "ae") {

            $('#countryMessage').text('All communication outside the UAE is exclusively done through WhatsApp.');

            whatsappCheckbox.checked = true;
            whatsappCheckbox.disabled = true;

        } else {
            whatsappCheckbox.checked = false;
            whatsappCheckbox.disabled = false;

        }
        // flag imoji start
        const updateFlagEmoji = () => {
            const countryCode = currentflag;

            let flagEmoji = '';

            if (countryCode) {

                flagEmoji = countryCode.toUpperCase().replace(/./g, char => String.fromCodePoint(char.charCodeAt(0) + 127397));
            }
            // $('#flag-icon').text(flagEmoji);
            $('#selected_flag_emoji').val(flagEmoji);

        };
        updateFlagEmoji();


        //flag imoji end

        const errorMap = ["Invalid number", "Invalid country code", "Invalid number", "Invalid number", "Invalid number"];

        // Initialize plugin with separateDialCode option

        const iti = window.intlTelInput(input, {
            initialCountry:currentflag,
            formatOnDisplay: false, // Ensure no formatting is applied
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        const reset = () => {
            input.classList.remove("error");
        };



        const validateInput = () => {
            reset();
            const phoneNumber = input.value.trim();
            if (iti.isValidNumber()) {
                // showValid();
            } else {
                const errorCode = iti.getValidationError();
                // showError(errorMap[errorCode]);
            }
        };

        const updateCountryCode = () => {
            const countryData = iti.getSelectedCountryData();
            countryCodeInput.value = countryData.dialCode;
            flagCodeInput.value = countryData.iso2;
        };

        const numberLengths = {
            us: 10,
            ae: 9,
            // Add more countries and their expected lengths here
        };

        const getRequiredNumberLength = (countryData) => {
            return numberLengths[countryData.iso2] || 10; // Default to 10 if country is not in the list
        };

        input.addEventListener('input', validateInput);

        input.addEventListener('countrychange', () => {
            input.value = ''; // Clear the phone input field
            input.placeholder = "";
            updateFlagEmoji();

            reset();
            updateCountryCode();
            validateInput();

            const countryData = iti.getSelectedCountryData();
            const requiredLength = getRequiredNumberLength(countryData);
            const phoneNumber = input.value.trim();
            const numericPhoneNumber = phoneNumber.replace(/\D/g, '');
            const truncatedPhoneNumber = numericPhoneNumber.slice(0, requiredLength);
            input.value = truncatedPhoneNumber;
            const currentCountryDialCode = iti.getSelectedCountryData().dialCode;
            const currentCountryCode = getCountryCodeFromDialCode(currentCountryDialCode);
            const currentCountryCodeValue = iti.getSelectedCountryData().iso2.toLowerCase();
            $('#country_code').val(currentCountryDialCode);


            // alert(`Country Code Changed: ${currentCountryCodeValue.toUpperCase()}`);

            whatsappCheckbox.checked = false;

            if (currentCountryDialCode !== "971") {
                    whatsappCheckbox.checked = true;
                    $('#countryMessage').text('All communication outside the UAE is exclusively done through WhatsApp.');
                    whatsappCheckbox.disabled = true;


                    // Update flag emoji
                const countryCode = countryData.iso2.toLowerCase();

                const flagEmoji = countryCode.toUpperCase().replace(/./g, char => String.fromCodePoint(char.charCodeAt(0) + 127397));
                $('#selected_flag_emoji').val(flagEmoji); // Update hidden field with flag emoji




                }else{
                    $('#countryMessage').text('');

                    whatsappCheckbox.checked = false;
                    whatsappCheckbox.disabled = false;

                }
                flagCodeInput.value = countryData.iso2;
        });

        updateCountryCode();

        input.addEventListener('input', () => {
            const countryData = iti.getSelectedCountryData();
            const phoneNumberLength = input.value.replace(/\D/g, '').length;
            const maxLength = getRequiredNumberLength(countryData);

            if (phoneNumberLength > maxLength) {
                input.value = input.value.slice(0, maxLength);
            }
        });

        $('#profile-form').on('submit', function(e) {
            const privacyvalue = document.querySelector("#privacyvalue").value;


            e.preventDefault();
            let isValid = true;

            validateInput();
            updateCountryCode();

            $('.error-message').html('');

            const name = $('#name').val();
            if (!name || name.trim() === '' || /\d/.test(name)) {
                $('#name-error').html('Please enter your full name.');
                isValid = false;
            }

            const email = $('#email').val();
            const phone = $('#phone').val();

               var updateprivacy = 1;
                if(privacyvalue == 0){
                    if (!$('#privacy_policy_flag').is(':checked')) {
                            $('#privacy-policy-error').html('Please agree to the privacy policy.');
                            isValid = false;
                        }
                    if ($('#privacy_policy_flag').is(':checked')) {
                        updateprivacy = 1;
                    }
                }


            if (isValid) {

                const formData = {
                    name: name,
                    email: email,
                    user_phone: input.value,
                    country_code: countryCodeInput.value,
                    privacy_policy_flag: updateprivacy,
                    user_gender: $('input[name="user_gender"]:checked').val(),
                    whatsapp_flag: $('#whatsapp_flag').is(':checked') ? 1 : 0,
                    user_id:user_id
                };
                console.log(formData)
                  // Send AJAX request
            $.ajax({
                url: NODE_APP_URL+"profile_update",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(formData),
                success: function(response) {
                    // Handle success response
                    if (response.status == '1') {
                        $('#responsemessage').text(response.message);

                    } else if (response.status == '0') {
                        $('#responsemessage').text(response.message);
                    } else {
                        $('#responsemessage').text(response.message);
                    }
                },
                error: function(error) {
                    // Handle error response
                    console.log(error);
                }
            });
             // Send AJAX end

                // Send AJAX request here...
            }
        });
         // update email
    const isValidEmail = (email) => {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        };
        const showOtpVerificationBox = () => {
            $('.otp-verification-box').show();
        };
        const showOtpVerificationBoxemail = () => {
            $('.otp-verification-boxemail').show();
        };
        //update email
        $('#email').on('input', function() {
            const flag_code = document.querySelector("#flagcode").value;

            updateCountryCode();
            const emailval = $(this).val();
              if (!emailval || emailval.trim() === '' || !isValidEmail(emailval)) {
                $('#email-error').html('Please enter a valid email address.');
            }else{

                const emailformData = {
                    change_type: "email",
                    new_info: emailval,
                    country_code: countryCodeInput.value,
                    user_id:user_id,
                    flag_code:flag_code
                };
                // Send AJAX request
               $.ajax({
                        url: NODE_APP_URL+"send_otp",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify(emailformData),
                        success: function(response) {
                            $('#lastid').val(response.lastid);

                            // Handle success response
                            if (response.status == '1') {

                                $('#email-error').html(response.message);
                                showOtpVerificationBoxemail();
                            } else if (response.status == '0') {
                                $('#responsemessage').text(response.message);
                                $('.otp-verification-boxemail').hide();


                            } else {
                                $('#responsemessage').text(response.message);
                            }
                        },
                        error: function(error) {
                            // Handle error response
                            console.log(error);
                        }
                    });
                    //Send AJAX end
                    $('#submitOtpButton').on('click', function(e) {
                        e.preventDefault(); // Prevent form submission

                        verifyOtp();
                    });
                    function verifyOtp() {
                        const otpValue = $('#otpValue').val();
                        const emailval = $('#email').val();
                        const lastid = $('#lastid').val();


                        if (!otpValue || otpValue.trim() === '') {
                            alert('Please enter the OTP.');
                            return;
                        }

                        const otpFormData = {
                            otp: otpValue,
                            lastid: lastid
                        };
                        console.log(otpFormData)

                        $.ajax({
                            url: NODE_APP_URL + "verify_otp_update",
                            method: "POST",
                            contentType: "application/json",
                            data: JSON.stringify(otpFormData),
                            success: function(response) {
                                if (response.status == '1') {
                                    $('#otpmessage').text(response.message);
                                } else {
                                    $('#otpmessage').text(response.message);
                                    $('#otpValue').val("");
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                     }
                     //verifyotp end


            }

        });

        // update mobile
        $('#phone').on('input', function() {
            const flag_code = document.querySelector("#flagcode").value;
            const country_codeval = document.querySelector("#country_code").value;



            updateCountryCode();
            const phoneval = $(this).val();

             if (!phoneval || phoneval.trim() === '' ) {
                $('#phone-error').html('Please enter a valid mobile number.');
        }else{
            // alert(country_codeval);
            // alert(flag_code);


                const phoneformData = {
                    change_type: "mobileno",
                    new_info: phoneval,
                    country_code: country_codeval,
                    user_id:user_id,
                    flag_code:flag_code
                };
                // Send AJAX request
               $.ajax({
                        url: NODE_APP_URL+"send_otp",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify(phoneformData),
                        success: function(response) {
                            $('#lastid').val(response.lastid);

                            // Handle success response
                            if (response.status == '1') {
                                $('#phone-error').html(response.message);
                                showOtpVerificationBox();

                            } else if (response.status == '0') {
                                $('.otp-verification-box').hide();

                                $('#phone-error').html(response.message);

                            } else {
                                $('#responsemessage').text(response.message);
                            }
                        },
                        error: function(error) {
                            // Handle error response
                            console.log(error);
                        }
                    });
                    //Send AJAX end
                    $('#submitOtpmobile').on('click', function(e) {
                        e.preventDefault(); // Prevent form submission

                        verifyOtp();
                    });
                    function verifyOtp() {
                        const otpValuephone = $('#otpValuephone').val();
                        const lastid = $('#lastid').val();


                        if (!otpValuephone || otpValuephone.trim() === '') {
                            alert('Please enter the OTP.');
                            return;
                        }

                        const otpFormData = {
                            otp: otpValuephone,
                            lastid: lastid
                        };
                        console.log(otpFormData)

                        $.ajax({
                            url: NODE_APP_URL + "verify_otp_update",
                            method: "POST",
                            contentType: "application/json",
                            data: JSON.stringify(otpFormData),
                            success: function(response) {
                                if (response.status == '1') {
                                    $('#otpmessagephone').text(response.message);
                                    // $('#otpValuephone').val("");

                                } else {
                                    $('#otpmessagephone').text(response.message);
                                    $('#otpValuephone').val("");

                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                     }




            }

        });
        input.placeholder = "";
          // Date of birth validation
          $('#loginform').on('submit', function(event) {
            const dob = $('#dob').val();
            const eighteenYearsAgo = new Date();
            eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear() - 18);

            if (new Date(dob) > eighteenYearsAgo) {
                event.preventDefault();
                $('#dob-error').text('Date of Birth should be greater than 18 years.');
            }
        });


    });


</script>
@include('layout.footer')
