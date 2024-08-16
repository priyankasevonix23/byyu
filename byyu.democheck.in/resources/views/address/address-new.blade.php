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
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-4 mb-3">
                    <div class="row">
                        <div class="col-lg-12 mb-2 black_heading">
                            Add Recipients Address
                        </div>
                    </div>
                    @if(session('error'))
                        <div class="error-message" style="margin-bottom: 20px;">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="success-message" style="margin-bottom: 20px; color: green;">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('addaddress') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="personal_details_box_no">
                                        <div class="row">
                                            <div class="col-lg-12 text18_red" style="padding-bottom: 30px;">
                                            <img src="{{ asset('assets/images/address/map_address_icon.png') }}" class="img-fluid" style="max-height: 25px;margin: 0 10px 0 0;">
                                            @if(!empty($data['city']))

                                            {{ $data['city']}}
                                            @else
                                             <?php echo @$addressdata['data']['address'];?>
                                             @endif
                                            </div>
                                        </div>

                                        <input type="hidden" name="userprofile" value="{{ request()->segment(count(request()->segments()) - 1) }}">


                                        @if(!empty($data['lat']) && !empty($data['lng']))
                                        <input type="hidden" class="input_text" id="lat" name="lat" value="{{ $data['lat'] }}">
                                        <input type="hidden" class="input_text" id="lng" name="lng" value="{{ $data['lng'] }}">
                                        <input type="hidden" class="input_text" id="city" name="city" value="{{ $data['city'] }}">

                                         @else
                                         <input type="hidden" class="input_text" id="lat" name="lat" value="{{ $addressdata['data']['lat'] }}">
                                        <input type="hidden" class="input_text" id="lng" name="lng" value="{{ $addressdata['data']['lng'] }}">
                                        <input type="hidden" class="input_text" id="city" name="city" value="{{ $addressdata['data']['address'] }}">



                                        @endif
                                        <div class="row">
                                            <div class="col-lg-4" style="margin-bottom: 30px;">
                                                
                                                <div class="label_list2">
                                                <div class="country_code_dropbox">
                                                </div>
                                                    <div class="mobile_number_country_box">
                                                    <div id="phone-container" class="input-group">
                                                        <input type="number" class="mobile_textbox" id="phone" formControlName="user_phone" name="user_phone" value="{{ $data['receiver_phone'] ?? '' }}">
                                                        <input type="hidden" class="input_text" id="country_code" name="country_code" value="{{ old('country_code') }}">
                                                    </div>
                                                        <div class="label_position">Enter Mobile Number<span style="color: red;">*</span></div>
                                                        <input type="hidden" name="address_id" value="{{ $data['address_id'] ?? '' }}">
                                                        <input type="hidden" id="selected_flag_emoji" name="selected_flag_emoji">
                                                        <?php
                                                            $user = session()->get('userdata');
                                                            if(isset($data['countrycode']) && !empty($data['countrycode']))
                                                            {
                                                                $currentCountryCode =  $data['countrycode'];

                                                            }else{
                                                                $currentCountryCode = $user['country_code'];

                                                            }
                                                        ?>
                                                        <input type="hidden" id="currentcountrycode" name="currentcountrycode" value="{{ $currentCountryCode }}">
                                                    </div>
                                                </div>

                                                <div class="error-message" id="user_phone-error">
                                                        @error('user_phone')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                            </div>
                                            <div class="col-lg-4" style="margin-bottom: 25px;">
                                                <div class="label_list2">
                                                    <input type="text" class="input_text" formControlName="name" name="name" value="{{ $data['receiver_name'] ?? '' }}">
                                                    <div class="label_position">Full Name<span style="color: red;">*</span></div>
                                                </div>
                                                <div class="error-message" id="name-error">
                                                        @error('name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 new_address_box">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2 text18_red">
                                            Save as<span style="color: red;">*</span>:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-5 address_type_box">
                                            <input type="radio" id="home" name="option" value="Home" {{ (isset($data['type']) && $data['type'] == 'Home') ? 'checked' : '' }}>
                                            <label for="home">Home</label>
                                            <input type="radio" id="office" name="option" value="Office" {{ (isset($data['type']) && $data['type'] == 'Office') ? 'checked' : '' }}>
                                            <label for="office">Office</label>
                                            <input type="radio" id="others" name="option" value="Others" {{ (isset($data['type']) && $data['type'] == 'Others') ? 'checked' : '' }}>
                                            <label for="others">Other</label>
                                            <div class="error-message" id="option-error">
                                                        @error('option')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4"  id="whomContainer" style="{{ (isset($data['type']) && $data['type'] == 'Others') ? '' : 'display:none;' }}">
                                            <div class="row">
                                                <div class="col-lg-12" style="padding-bottom: 35px;">
                                                    <div class="label_list2">
                                                        <input type="text" class="input_text" formControlName="whom" name="whom" value="{{ $data['whom'] ?? '' }}">
                                                        <div class="label_position">Personal Details</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="padding-bottom: 35px;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">
                                                        <input type="text" class="input_text" formControlName="vila" name="vila" value="{{ $data['house_no'] ?? '' }}">
                                                        <div class="label_position">Community/Building Name<span style="color: red;">*</span></div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="error-message" id="vila-error">
                                                        @error('vila')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                        </div>
                                        <div class="col-lg-4" style="padding-bottom: 35px;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">
                                                        <input type="text" class="input_text" formControlName="apartment" name="apartment" value="{{ $data['building_villa'] ?? '' }}">
                                                        <div class="label_position">Villa/Apartment Number<span style="color: red;">*</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="error-message" id="apartment-error">
                                                        @error('apartment')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                        </div>
                                        <div class="col-lg-4" style="padding-bottom: 35px;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">
                                                        <input type="text" class="input_text" formControlName="street" name="street" value="{{ $data['society'] ?? '' }}">
                                                        <input type="hidden" name="country_codes" id="country_codes" value="{{ $data['countrycode'] ?? '' }}">
                                                        <div class="label_position">Street/Locality Name<span style="color: red;">*</span></div>
                                                    </div>
                                                </div>
                                                <div class="error-message" id="street-error">
                                                        @error('street')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-4" style="padding-bottom: 35px;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">
                                                        <input type="text" class="input_text" formControlName="landmark" name="landmark" value="{{ $data['landmark'] ?? '' }}">
                                                        <div class="label_position">Landmark</div>
                                                    </div>
                                                </div>
                                                <div class="error-message" id="landmark-error">
                                                        @error('landmark')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="label_list2">
                                                        <input type="text" class="input_text" formControlName="cityname" name="cityname" value="Dubai" readonly >
                                                        <div class="label_position">Emirate</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="error-message" id="cityname-error">
                                                        @error('cityname')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                        </div>

                                        <fieldset class="form-group mb-4">
                                            <button type="submit" class="red_button" style="height: 35px; float: left;">Save Recipients Address</button>&nbsp;
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!-- <div class="col-lg-4" style="background-color: #fffce9; position: relative;">
                    <div style="position: absolute; left: 0; top: 0; bottom: 0; right: 0; width: 100%; height: 100%; z-index: 5;"></div>
                    <div class="left-section2">
                        <div class="row">
                            <div class="col-lg-12 text-center p-0">
                            @if(!empty($data['lat']) && !empty($data['lng']))
                                <iframe
                                    width="100%"
                                    height="600"
                                    frameborder="0"
                                    style="border:0"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125961.05008787992!2d{{ $data['lng'] }}!3d{{ $data['lat'] }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1715925044018!5m2!1sen!2sin"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                         @else




                            <iframe
                                    width="100%"
                                    height="600"
                                    frameborder="0"
                                    style="border:0"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125961.05008787992!2d{{ $addressdata['data']['lng'] }}!3d{{ $addressdata['data']['lat']}}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1715925044018!5m2!1sen!2sin"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                          @endif


                                </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-lg-4" style="background-color: #fffce9;">
                    <div class="left-section">
                        <div class="row">
                            <div class="col-lg-12 pt-5 text-center">
                                <img src="{{ENV('APP_URL')}}assets/images/address/address_location.png" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
</div>
@include('layout.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const whomContainer = document.getElementById('whomContainer');
        const radioButtons = document.querySelectorAll('input[name="option"]');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'Others') {
                    whomContainer.style.display = '';
                } else {
                    whomContainer.style.display = 'none';
                }
            });
        });

        // Initial check to display/hide the "Whom" input based on the pre-selected option
        const selectedOption = document.querySelector('input[name="option"]:checked');
        if (selectedOption && selectedOption.value !== 'Others') {
            whomContainer.style.display = 'none';
        }
    });
</script>
<script>
    $(document).ready(function() {
        const input = document.querySelector("#phone");

        const errorMsg = document.querySelector("#error-msg");
        const validMsg = document.querySelector("#valid-msg");
        const countryCodeInput = document.querySelector("#country_code");
        const currentcountrycode = document.querySelector("#currentcountrycode").value;
        const flagContainer = document.createElement('div');
        // flagContainer.className = 'flag-container';
        document.querySelector('.country_code_dropbox').appendChild(flagContainer);

        const selectedCountryFlagInput = document.querySelector("#selected_country_flag"); // Input to store the selected country flag code





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
        const currentCountryCodeval = getCountryCodeFromDialCode(currentcountrycode).toLowerCase();




        // flag imoji start
        const updateFlagEmoji = () => {
            // const countryCode = $('#currentcountrycode').val();
            let flagEmoji = '';

            if (currentCountryCodeval) {

                flagEmoji = currentCountryCodeval.toUpperCase().replace(/./g, char => String.fromCodePoint(char.charCodeAt(0) + 127397));
            }
            // $('#flag-icon').text(flagEmoji);
            $('#selected_flag_emoji').val(flagEmoji);

        };
        updateFlagEmoji();

        //flag imoji end

        const errorMap = ["Invalid number", "Invalid country code", "Invalid number", "Invalid number", "Invalid number"];


        // Initialize plugin with separateDialCode option
        const iti = window.intlTelInput(input, {
            initialCountry: currentCountryCodeval,
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        const reset = () => {
            input.classList.remove("error");
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

            if (iti.isValidNumber()) {
                showValid();
            } else {
                const errorCode = iti.getValidationError();
                // showError(errorMap[errorCode]);
            }
        };

        const updateCountryCode = () => {
            const countryData = iti.getSelectedCountryData();
            countryCodeInput.value = countryData.dialCode;
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
           // reset();
            updateCountryCode();
            validateInput();
            updateFlagEmoji();

            const countryData = iti.getSelectedCountryData();
            const requiredLength = getRequiredNumberLength(countryData);
            const phoneNumber = input.value.trim();
            const numericPhoneNumber = phoneNumber.replace(/\D/g, '');
            const truncatedPhoneNumber = numericPhoneNumber.slice(0, requiredLength);
            input.value = truncatedPhoneNumber;
            countryCodeInput.value = countryCodeInput.value;



             // Update flag emoji
                const countryCode = countryData.iso2.toLowerCase();
                const flagEmoji = countryCode.toUpperCase().replace(/./g, char => String.fromCodePoint(char.charCodeAt(0) + 127397));
                $('#selected_flag_emoji').val(flagEmoji); // Update hidden field with flag emoji

        });

        updateCountryCode();
        input.placeholder = "";
        // updateFlag(currentcountrycode.toLowerCase()); // Set the initial flag

        // Restrict input length based on country-specific phone number length
        input.addEventListener('input', () => {
            const countryData = iti.getSelectedCountryData();
            const phoneNumberLength = input.value.replace(/\D/g, '').length; // Remove non-numeric characters
            const maxLength = getRequiredNumberLength(countryData);

            if (phoneNumberLength > maxLength) {
                input.value = input.value.slice(0, maxLength);
            }
        });
          // Remove spaces from mobile number on page load
          const mobileInput = document.getElementById("phone");
        if (mobileInput.value) {
            mobileInput.value = mobileInput.value.replace(/\s+/g, '');
        }


    });
</script>
