<div class="profile_menu_mobile" onclick="profile_menu()">Menu</div>
<div id="profile_menu" class="profile_menu">
    <div class="profile_leftbox_inner pt-4">
        <div class="row">
            <div class="col-lg-12 profile_leftlink p-0">
                <ul>
                    <li class="{{ (Request::is('userprofile') || Request::is('updatemobilenumber/*')) ? 'active' : '' }}"><a href="{{ url('/userprofile') }}">My Profile</a></li>                    <li class="{{ Request::is('special-day') ? 'active' : '' }}"><a href="{{ url('/special-day') }}">Special Days</a></li>
                    <li class="{{ Request::is('useraddress') ? 'active' : '' }}"><a href="{{ url('/useraddress') }}">Addresses</a></li>
                    <li class="{{ Request::is('myorders') ? 'active' : '' }}"><a href="{{ url('/myorders') }}">Your Orders</a></li>
                    <li class="{{ Request::is('coupons-list') ? 'active' : '' }}"><a href="{{ url('/coupons-list') }}">Coupons</a></li>
                    <li class="{{ Request::is('giftvoucher') ? 'active' : '' }}"><a href="{{ url('/giftvoucher') }}">Gift Voucher</a></li>
                    <li class="{{ Request::is('referralearn') ? 'active' : '' }}"><a href="{{ url('/referralearn') }}">Referral</a></li>
                    <li class="{{ Request::is('wallet') ? 'active' : '' }}"><a href="{{ url('/wallet') }}">Wallet</a></li>
                    <li class="{{ Request::is('contactus') ? 'active' : '' }}"><a href="{{ url('/user-contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ url('/logout') }}">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
