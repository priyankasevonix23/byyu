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
                <div class="col-lg-8 mt-5">
                    <div class="row">
                        <div class="col-lg-12 black_heading mb-4 pb-2" style="border-bottom: 1px dashed #000;">Show Address</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-11 mb-5">
                            <div class="row">
                            @if(session('error'))
                             <div class="error-message" style="margin-bottom: 20px;">{{ session('error') }}</div>
                           @endif
                           @if(session('success'))
                                    <div class="success-message" style="margin-bottom: 20px; color: green;">{{ session('success') }}</div>
                                @endif
                                @if(!empty($addresses) && count($addresses) > 0)

                                @foreach($addresses as $index => $address)
                                    <div class="col-lg-6 mb-4">
                                        <div class="current_address_box_list">
                                            <input type="radio" id="{{ $address['address_id'] }}" name="radios" value="all">
                                            <label for="{{ $address['address_id'] }}" class="current_address_box">
                                                <div class="edit_icon_box">
                                                <a href="{{ route('deleteaddress', ['id' => $address['address_id']]) }}" class="edit_address_icon">
                                                    <img src="{{ asset('assets/images/profile/delete_icon.png') }}" class="img-fluid">
                                                </a>
                                                <?php $userprofile="userprofile"; ?>
                                                <a href="{{ route('addressnew', ['addresstype' => 'userprofile', 'id' => $address['address_id']]) }}" class="edit_address_icon">
                                                        <img src="assets/images/profile/edit_icon.png" class="img-fluid">
                                                    </a>
                                                </div>
                                                <span>@if(!empty($address['type'])) {{ $address['whom'] }} @endif {{ $address['type'] }}</span>
                                                <div style="float: left;width: 100%;margin: 0 0 10px 0;"><b>Name:</b> {{ $address['receiver_name'] }}</div>
                                                <div><b>Address:</b> {{ $address['city'] }}</div> 
                                                <div><b>Community /Building Name:</b> {{ $address['house_no'] }}</div> 

                                                <div><b>Villa/Apartment Number:</b> {{ $address['building_villa'] }}</div> 

                                                <div><b>Street/Locality Name:</b> {{ $address['society'] }}</div> 
                                                <div><b>Landmark:</b> {{ $address['landmark'] }}</div> 
                                                <div><b> Emirate:</b> {{ $address['cityname'] }}</div>
                                                <br>
                                                <div style="float: left;width: 100%;margin: 0 0 10px 0;"><b>Mobile No:</b>
                                                       @if ($address['country_code'] !== 0)
                                                      {{ $address['country_code'] }}
                                                      @endif {{ $address['receiver_phone'] }}</div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-11 text-center mb-5">
                            <?php $userprofile="userprofile"; ?>
                        <a href="{{ url('getmap/' . $userprofile . '/' . $user['id']) }}" class="red_button new_address_btn" style="padding: 9px 20px 9px 40px;">Add Recipients Address</a>&nbsp;

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
    function goto_edit_address(address_id) {
        // Add your JavaScript code to handle address edit navigation
        console.log('Edit address:', address_id);
    }

    function goto_map_address() {
        // Add your JavaScript code to handle adding a new address
        console.log('Go to add new address');
    }
</script>
