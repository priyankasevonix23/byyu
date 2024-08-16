@include('layout/header')

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
                        <div class="col-lg-12 black_heading mb-4 pb-2" style="border-bottom: 1px dashed #000;">Your Orders</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            @foreach($orders as $order)
                                <div class="transaction_his_list mb-4">
                                    <a href="{{ url('/orderd_deatils/' . $order['cart_id']) }}" style="color:#000; text-decoration: none;">
                                        <div class="row">
                                            <div class="col-lg-2 text-center">
                                                <img src="{{ str_replace('/api/', '/', env('NODE_APP_URL')) . $order['data'][0]['varient_image'] }}" class="img-fluid" style="max-height: 123px; border: 3px solid #f8f8f8;">
                                            </div>
                                            <div class="col-lg-7 pt-3 pb-3 myorder_list">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-3 pb-1" style="border-bottom: 1px solid #ccc; font-weight: bold;">{{ $order['data'][0]['product_name'] }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 mb-1">
                                                        Order ID: <b>{{ $order['group_cart_id'] }}</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 mb-1">
                                                        Delivery Date: <b>{{ $order['delivery_date'] }}</b>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        Time: <b>{{ $order['time_slot'] }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="history_status history_status2" style="background-color: {{ $order['order_status'] == 'Pending' ? '#ffdd9c' : '#d4edda' }};">
                                                        Order Status<br>
                                                                    <span>
                                                                    @if ($order['order_status'] == 'Pending')
                                                                    Placed
                                                                    @elseif ($order['order_status'] == 'Processing')
                                                                    Processing
                                                                    @elseif ($order['order_status'] == 'Out_For_Delivery')
                                                                    Out For Delivery
                                                                    @elseif ($order['order_status'] == 'Ready_For_Pickup')
                                                                    Ready For Pickup
                                                                    @elseif ($order['order_status'] == 'Completed')
                                                                    Completed
                                                                    @elseif ($order['order_status'] == 'Refund')
                                                                    Refund
                                                                    @elseif ($order['order_status'] == 'Cancelled')
                                                                    Cancelled    
                                                                        @else
                                                                            Unknown Status
                                                                        @endif
                                                                    </span>

                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_leftbox"></div>
    </section>
</div>

@include('layout/footer')
