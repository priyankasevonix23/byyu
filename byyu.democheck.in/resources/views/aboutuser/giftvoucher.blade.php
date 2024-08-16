@include('layout/header')
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
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 verify_text text-center mt-5 mb-4" style="font-size: 41px;">Gift <span style="color: #f8a932;">Voucher</span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    @if (session()->has('error'))
                                       <div class="alert alert-danger">
                                           {{session()->get('error')}}
                                        </div>
                                    @endif
                                    @if (session()->has('message'))
                                       <div class="alert alert-success">
                                           {{session()->get('message')}}
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('redeemgiftvoucher')}}">
                                        @csrf
                                    <div class="giftvoucher_img_box">
                                        <div class="row">
                                            <div class="col-lg-12 mb-2" style="font-family: Metropolis-Bold;">Enter Gift Voucher</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-3"><input type="text" name="gift_code" id="" style="border-radius: 100px;border: 1px solid #ccc;padding: 6px 10px;text-align: center; width:80%" required></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><input type="submit" value="Apply" class="red_button" name="" id="" style="width: 90px;text-align: center;padding: 8px 0;font-family: Metropolis-Bold; cursor:pointer"></div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center"><img src="{{ENV('APP_URL')}}assets/images/giftvoucher/giftvoucher_rightimg.png" class="img-fluid"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_leftbox"></div>
    </section>
</div>

@include('layout/footer')

<script>
    function goto_edit_address(address_id) {
        // Add your JavaScript code to handle address edit navigation
        console.log('Edit address:', address_id);
    }

    function goto_map_address() {
        // Add your JavaScript code to handle adding a new address
        console.log('Go to add new address');
    }
</script>
