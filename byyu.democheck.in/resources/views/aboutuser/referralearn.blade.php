@include('layout/header')
<style>
.tooltip2 {
display: none;
}
.show-tooltip {
display: block;
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

                        <!-- <div class="row text-center">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-12 black_heading pb-4 pt-4" style="font-size: 25px;">Refer and enjoy rewards together!</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text15_black mb-4" style="line-height: 21px;">
                                        Gift joy with every referral!! Invite friends to byyu and earn AED {{number_format($member['referral_return_amount'],2)}} as a thank you.<br>
                                        Your friends receive a warm welcome with AED {{number_format($member['referral_amount'],2)}} off their first cherished order.<br>
                                        Spread the delight with byyu
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="refer_code_box">Refer code:<br><span style="font-family: Metropolis-Bold;font-size: 21px;">{{$member['referral_code']}}</span></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="refer_earn_box">
                                            <span>{{$member['referral_count']}} Referrals</span>
                                            <span>AED {{$member['referral_earned']}} Earned</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mt-5 mb-5 text-center">
                                        <a class="red_button" onclick="copyToClipboard('<?php echo $member['referral_code']; ?>')">Copy & Share with friend</a>
                                        <span class="tooltip2">Copied!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 pt-4 pb-4 referral_img_right" style="background-color: #f6f6f6;"><img src="assets/images/referral_img.png" class="img-fluid"></div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-12 black_heading pt-4 text-center" style="font-size: 25px; text-transform: uppercase;">Refer now and earn</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 black_heading pb-5 text-center" style="font-size: 25px;"><span style="color: #f03613;">AED {{number_format($member['referral_return_amount'],2)}}</span> for each referral</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 text-center"><img src="{{ENV('APP_URL')}}assets/images/referral/referral_icon1.png" class="img-fluid"></div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12">Invite your friends to byyu's</div>
                                            <div class="col-lg-12" style="font-size: 11px;color: #eb3513;">(Send a referral link to your friend via SMS/ Email/ WhatsApp)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mt-3"><img src="{{ENV('APP_URL')}}assets/images/referral/referral_shadow.png" class="img-fluid"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 text-center"><img src="{{ENV('APP_URL')}}assets/images/referral/referral_icon2.png" class="img-fluid"></div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12">Your friends receive </div>
                                            <div class="col-lg-12"><span style="color: #f03613;">AED {{number_format($member['referral_amount'],2)}}</span> off their initial purchase.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mt-3"><img src="{{ENV('APP_URL')}}assets/images/referral/referral_shadow.png" class="img-fluid"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 text-center"><img src="{{ENV('APP_URL')}}assets/images/referral/referral_icon3.png" class="img-fluid"></div>
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-12">You get <span style="color: #f03613;">AED {{number_format($member['referral_return_amount'],2)}}</span> for every friend that makes a purchase</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12"></div>
                                </div>
                            </div>
                            <div class="col-lg-5 text-center" style="background-color: #fafafa;">
                                <div class="row">
                                    <div class="col-lg-12 mb-3 mt-5">
                                        <div class="refer_code_box">Refer code:<br><span style="font-family: Metropolis-Bold;font-size: 21px;">{{$member['referral_code']}}</span></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="refer_earn_box">
                                            <span>{{$member['referral_count']}} Referrals</span>
                                            <span>AED {{$member['referral_earned']}} Earned</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mt-5 mb-4 text-center">
                                        <a class="red_button" onclick="copyToClipboard('<?php echo $member['referral_code']; ?>')">Copy & Share with friend</a>
                                        <span class="tooltip2">Copied!</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <img src="{{ENV('APP_URL')}}assets/images/referral_img.png" class="img-fluid" style="max-height: 210px;opacity: 0.3;">
                                    </div>
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

<script>
function copyToClipboard(referral_code) {
// Define the text to be copied
const textToCopy ="{{ENV('APP_URL')}}sharing/referral?code="+referral_code;
// Create a temporary textarea element to hold the text
const textarea = document.createElement('textarea');
textarea.value = textToCopy;
// Make the textarea out of viewport
textarea.style.position = 'absolute';
textarea.style.left = '-9999px';
// Append the textarea to the body
document.body.appendChild(textarea);
// Select the text
textarea.select();
// Copy the text
document.execCommand('copy');
// Remove the textarea from the DOM
document.body.removeChild(textarea);

// Show the tooltip
const tooltip = document.querySelector('.tooltip2');
tooltip.classList.add('show-tooltip');

// Hide the tooltip after 2 seconds
setTimeout(() => {
tooltip.classList.remove('show-tooltip');
}, 2000);

}
</script>
