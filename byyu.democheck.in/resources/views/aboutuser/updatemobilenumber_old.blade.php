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
                <div class="col-lg-8">
                    <div class="row" style="align-items: center;">
                        <div class="col-lg-7 mt-5">
                            <div class="row">
                                <div class="col-lg-12 black_heading mb-5 pb-2" style="border-bottom: 1px dashed #000;">Update Mobile Number</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 mb-4">
                                                
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
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="button" class="red_button" value="Update">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <img src="{{ENV('APP_URL')}}assets/images/updatemobilenumber-img.png" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_leftbox"></div>
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
