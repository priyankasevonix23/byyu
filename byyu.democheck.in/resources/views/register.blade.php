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

<?php
$referral_code=@$_GET['code'];
?>
<style>
    .hide {
        display: none;
    }
    .error-message {
        color: red;
        margin-top: 5px;
        font-size: 14px;
    }
    .flag-container img {
        width: 32px;
        height: 32px;
    }
</style>

<div class="middle_box width100">
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pt-4 mb-3">
                    <div class="row">
                        <div class="col-lg-12 mb-3 verify_text">
                            Sign Up
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            Already have a account? <a href="{{ url('/login') }}" style="color: #f03613;">Sign in</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 black_heading mb-5" style="font-size: 21px;">
                            Create an Account
                        </div>
                        @if(session('error'))
                        <div class="error-message" style="margin-bottom: 20px;">{{ session('error') }}</div>

                    @endif
                    </div>

                    <div class="row">

                        <div class="col-lg-11 mb-5">
                            <form method="POST" action="{{ route('registeruser') }}" id="registerForm" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-6 mb-5">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">
                                                        <input type="text" class="input_text" id="name" name="name" value="{{ old('name') }}">
                                                        <div class="label_position">Full Name<span style="color:red">*</span></div>
                                                    </div>
                                                    <div class="error-message" id="name-error">
                                                        @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                    <!-- <span id="flag-icon" class="flag-icon"></span> -->

                                                    <input type="hidden" id="appUrl" value="{{ env('APP_URL') }}">
                                                    <input type="hidden" id="NODE_APP_URL" value="{{ env('NODE_APP_URL') }}">
                                                    <input type="hidden" id="currentcountrycode" name="currentcountrycode" value="{{ $data['message'] }}">
                                                    <input type="hidden" id="flagcode" name="flagcode" value="{{ $data['message'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">
                                                        <input type="email" class="input_text" id="user_email" name="user_email" value="{{ old('user_email') }}">

                                                        <div class="label_position">Email ID:<span style="color:red">*</span></div>
                                                    </div>
                                                    <div class="error-message" id="user_email-error">
                                                        @error('user_email')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mobile_number_country_box">
                                                        <div id="phone-container" class="input-group">
                                                            <div class="country_code_dropbox" style="display: none;"></div>
                                                                <input type="text" class="mobile_textbox" name="mobile" id="phone" value="">
                                                                <input type="hidden" class="input_text" id="country_code" name="country_code" value="{{ old('country_code') }}">
                                                                <input type="hidden" id="selected_country_flag" name="selected_country_flag" value="{{ old('selected_country_flag') }}">                                                                
                                                                <input type="hidden" id="selected_flag_emoji" name="selected_flag_emoji">
                                                            
                                                        </div>
                                                        <div class="label_position">Enter Mobile Number<span style="color:red">*</span></div>
                                                        <span id="valid-msg" class="hide">✓ Valid</span>
                                                        <span id="error-msg" class="hide"></span>
                                                        <div class="error-message" id="phone-error">
                                                        <div id="countryMessage" style="color: red; margin-bottom: 10px; font-size: 10px;float: left;width: 100%;margin:0;"></div>
                                                        @error('mobile')
                                                        {{ $message }}
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-5">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">

                                                        <input type="date" class="input_text" id="dob" name="dob"  value="{{ old('dob') }}">

                                                        <div class="label_position">Date of Birth:</div>
                                                    </div>
                                                </div>
                                                <div class="error-message" id="dob-error">
                                                        @error('dob')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 mb-5">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="label_list2">
                                                            <input type="text" class="input_text" id="referral_code" name="referral_code" value="{{$referral_code}}">
                                                            <div class="label_position">Referral Code:</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="label_list2">
                                                    <div class="gender_box">
                                                        <div style="float: left;">
                                                            <input type="radio" id="male" name="user_gender" value="male" {{ old('user_gender') == 'male' ? 'checked' : '' }}>
                                                            <label for="male">
                                                                <div class="dot"></div>
                                                                <span>Male</span>
                                                            </label>
                                                        </div>
                                                        <div style="float: left;">
                                                            <input type="radio" id="female" name="user_gender" value="female" {{ old('user_gender') == 'female' ? 'checked' : '' }}>
                                                            <label for="female">
                                                                <div class="dot"></div>
                                                                <span>Female</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="label_position" style="margin: -28px 0 0 4px;">Select Gender:</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <label for="privacy_policy_flag">
                                                <input type="checkbox" name="privacy_policy_flag" id="privacy_policy_flag" {{ old('privacy_policy_flag') ? 'checked' : '' }}>&nbsp;
                                                I agree to the <a href="https://www.byyu.com/privacypolicy" style="color: #f03613; text-decoration: none;">Privacy Policy</a> <span style="color:red">*</span>
                                            </label>
                                            <div class="error-message" id="privacy_policy_flag-error">
                                                @error('privacy_policy_flag')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4" style="position: relative;">
                                            <label for="whatsapp_flag">
                                                <input type="checkbox" name="whatsapp_flag" id="whatsapp_flag" {{ old('whatsapp_flag') ? 'checked' : '' }}>&nbsp;
                                                I want to receive notification on Whatsapp
                                            </label>
                                            <div style="width: 100%;height: 20px;left: 0;top: 0;z-index: 500;"></div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group mb-4">
                                    <button type="submit" class="red_button">Sign Up</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="background-color: #fffce9; background-image: url({{ env('APP_URL') }}/assets/images/register/register_img.png);background-repeat: no-repeat;background-position: center;background-size: cover;">
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        const input = document.querySelector("#phone");
        const countryCodeInput = document.querySelector("#country_code");
        const currentcountrycode = document.querySelector("#currentcountrycode").value;
        const flagContainer = document.createElement('div');
        document.querySelector('.country_code_dropbox').appendChild(flagContainer);
        const flagCodeInput = document.querySelector("#flagcode");
        const selectedCountryFlagInput = document.querySelector("#selected_country_flag");
        var whatsappCheckbox = document.getElementById('whatsapp_flag');
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        input.addEventListener('keypress', function(event) {
            var charCode = event.which ? event.which : event.keyCode;
            if (charCode < 48 || charCode > 57) {
                event.preventDefault();
            }
        });
        const updateFlagEmoji = () => {
            const countryCode = $('#currentcountrycode').val();
            let flagEmoji = '';
            if (countryCode) {
                flagEmoji = countryCode.toUpperCase().replace(/./g, char => String.fromCodePoint(char.charCodeAt(0) + 127397));
            }
            $('#selected_flag_emoji').val(flagEmoji);
        };
        updateFlagEmoji();
        const errorMap = ["Invalid number", "Invalid country code", "Invalid number", "Invalid number", "Invalid number"];
        const iti = window.intlTelInput(input, {
            initialCountry: currentcountrycode,
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
        const reset = () => {
            input.classList.remove("error");
        };
        const validateInput = () => {
            reset();
            if (iti.isValidNumber()) {
                // Valid number, do nothing
            } else {
                const errorCode = iti.getValidationError();
            }
        };
        const updateCountryCode = () => {
            const countryData = iti.getSelectedCountryData();
            countryCodeInput.value = countryData.dialCode;
        };
        const updateSelectedCountryFlag = (iso2) => {
            selectedCountryFlagInput.value = iso2;
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
            input.placeholder = "";
            reset();
            updateCountryCode();
            validateInput();
            updateFlagEmoji();
            const countryData = iti.getSelectedCountryData();
            const requiredLength = getRequiredNumberLength(countryData);
            const phoneNumber = input.value.trim();
            const numericPhoneNumber = phoneNumber.replace(/\D/g, '');
            const truncatedPhoneNumber = numericPhoneNumber.slice(0, requiredLength);
            input.value = truncatedPhoneNumber;
            
            
            if (countryCodeInput.value !== "971") {
                whatsappCheckbox.checked = true;
                whatsappCheckbox.disabled = true;
                $('#countryMessage').text('All communication outside the UAE is exclusively done through WhatsApp.');
            } else {
                whatsappCheckbox.checked = false;
                whatsappCheckbox.disabled = false;
                $('#countryMessage').text('You will receive further communication via SMS. Please confirm.');
                whatsappCheckbox.addEventListener('click', function() {
                    if (!whatsappCheckbox.checked) {
                        alert('You will receive further communication via SMS. Please confirm');
                        whatsappCheckbox.checked = false;
                    }else
                    {
                     alert('You will receive further communication via WhatsApp. Please confirm');
                        whatsappCheckbox.checked = true;   
                    }
                });
            }
            const countryCode = countryData.iso2.toLowerCase();
            const flagEmoji = countryCode.toUpperCase().replace(/./g, char => String.fromCodePoint(char.charCodeAt(0) + 127397));
            $('#selected_flag_emoji').val(flagEmoji);
            updateSelectedCountryFlag(countryData.iso2);
            flagCodeInput.value = countryData.iso2;
        });
        // Initial check based on currentcountrycode
        if (currentcountrycode.toLowerCase() !== "ae") {
            whatsappCheckbox.checked = true;
            whatsappCheckbox.disabled = true;
            $('#countryMessage').text('All communication outside the UAE is exclusively done through WhatsApp.');
        } else {
            whatsappCheckbox.checked = false;
            whatsappCheckbox.disabled = false;
            $('#countryMessage').text('You will receive further communication via SMS. Please confirm.');
        }
        updateCountryCode();
        updateSelectedCountryFlag(currentcountrycode.toLowerCase());
        input.addEventListener('input', () => {
            const countryData = iti.getSelectedCountryData();
            const phoneNumberLength = input.value.replace(/\D/g, '').length;
            const maxLength = getRequiredNumberLength(countryData);
            if (phoneNumberLength > maxLength) {
                input.value = input.value.slice(0, maxLength);
            }
        });
        input.placeholder = "";
        $('#registerForm').on('submit', function(event) {
            const dob = $('#dob').val();
            const eighteenYearsAgo = new Date();
            eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear() - 18);
            if (new Date(dob) > eighteenYearsAgo) {
                event.preventDefault();
                $('#dob-error').text('Date of Birth should be greater than 18 years.');
            }
        });
        const mobileInput = document.getElementById("phone");
        if (mobileInput.value) {
            mobileInput.value = mobileInput.value.replace(/\s+/g, '');
        }
    });
</script>
@include('layout.footer')
