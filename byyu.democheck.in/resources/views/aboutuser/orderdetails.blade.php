@include('layout/header')

<div class="middle_box width100">
    <section class="mt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-2 black_heading">Order Details</div>
            </div>
            <div class="row">
                @foreach ($orderDetails as $order)
                <div class="col-lg-8 mb-5">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div style="background-color: #fbfbfb; padding: 20px 30px; border-radius: 15px; border: 1px solid #e4e4e4; box-shadow: 0 10px 10px #ececec; font-size: 14px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12 text18_red mb-2" style="font-size: 21px;">{{ $order['data']['product_name'] }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-1">
                                                Order Status:
                                                <b>
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
                                                </b>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-1">Expected by: <b>{{ $order['delivery_date'] }}</b></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-1">Qty: <b>{{ $order['data']['qty'] }}</b>&nbsp;&nbsp;&nbsp; Amount: AED <b>{{ number_format($order['data']['qty']*$order['data']['price'],2) }}</b> </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12 text_25_black mb-2" style="font-size: 18px;">Shipping Address:</div>
                                            <div class="col-lg-12 mb-1">Delivery To: <b>{{ $order['user_name'] }}</b></div>
                                            <div class="col-lg-12">Address:
                                                <b>{{ $order['delivery_address'] }}</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 text_25_black mb-4" style="font-size: 21px; padding:0 0 0 30px;">Order Track:</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="track_list {{ in_array($order['order_status'], ['Pending', 'Processing', 'Ready_For_Pickup', 'Out_For_Delivery', 'Completed', 'Refund']) ? 'track_list_selected' : '' }}">
                                                    <div class="track_list_arrow"><img src="{{ asset('assets/images/track_list_arrow.png') }}"></div>
                                                    <div class="track_list_text">Order<br>Placed</div>
                                                </div>
                                                <div class="track_list_sept"></div>
                                                <div class="track_list {{ in_array($order['order_status'], ['Processing', 'Ready_For_Pickup', 'Out_For_Delivery', 'Completed', 'Refund']) ? 'track_list_selected' : '' }}">
                                                    <div class="track_list_arrow"><img src="{{ asset('assets/images/track_list_arrow.png') }}"></div>
                                                    <div class="track_list_text">Order<br>Processed</div>
                                                </div>
                                                <div class="track_list_sept"></div>
                                                <div class="track_list {{ in_array($order['order_status'], ['Ready_For_Pickup', 'Out_For_Delivery', 'Completed', 'Refund']) ? 'track_list_selected' : '' }}">
                                                    <div class="track_list_arrow"><img src="{{ asset('assets/images/track_list_arrow.png') }}"></div>
                                                    <div class="track_list_text">Ready For<br>PickUp</div>
                                                </div>
                                                <div class="track_list_sept"></div>
                                                <div class="track_list {{ in_array($order['order_status'], ['Out_For_Delivery', 'Completed', 'Refund']) ? 'track_list_selected' : '' }}">
                                                    <div class="track_list_arrow"><img src="{{ asset('assets/images/track_list_arrow.png') }}"></div>
                                                    <div class="track_list_text">Out For<br>Delivery</div>
                                                </div>
                                                <div class="track_list_sept"></div>
                                                <div class="track_list {{ in_array($order['order_status'], ['Completed', 'Refund']) ? 'track_list_selected' : '' }}">
                                                    <div class="track_list_arrow"><img src="{{ asset('assets/images/track_list_arrow.png') }}"></div>
                                                    <div class="track_list_text">Order<br>Completed</div>
                                                </div>
                                                @if ($order['order_status'] == 'Refund')
                                                    <div class="track_list_sept"></div>
                                                    <div class="track_list track_list_selected">
                                                        <div class="track_list_arrow"><img src="{{ asset('assets/images/track_list_arrow.png') }}"></div>
                                                        <div class="track_list_text">Order<br>Return</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div style="background-color: #f3fbef; padding: 20px 30px; border-radius: 15px;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 text_25_black mb-2" style="font-size: 21px;">Payment Summary:</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 mb-1">Payment Method: <b>{{ $order['payment_method'] }}</b></div>
                                            @if ($order['discountonmrp'] > 0)
                                            <div class="col-lg-6 mb-1">Discount price: <b style="color: #26b312;">AED {{ number_format($order['discountonmrp'],2) }} </b></div>
                                            @endif
                                            <!-- <div class="col-lg-6 mb-1">Coupon Discount: <b style="color: #26b312;">{{ $order['coupon_discount'] }} AED</b></div> -->
                                            @if ($order['coupon_discount'] > 0 && $order['coupon_id'])
                                                <div class="col-lg-6 mb-1">Coupon Discount: <b style="color: #26b312;">AED {{ number_format($order['coupon_discount'],2) }} </b></div>
                                            @endif
                                            <div class="col-lg-6 mb-1">Delivery fees: <b style="color: #e20312;">AED {{ number_format($order['delivery_charge'],2) }} </b></div>
                                            <div class="col-lg-6 mb-1" style="font-family: Metropolis-Bold; font-size: 21px;">Total: <b style="color: #e20312;">AED {{ number_format($order['total_products_mrp'],2) }}</b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 text-center">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <img src="{{ str_replace('/api/', '/', env('NODE_APP_URL')) . $order['data']['varient_image'] }}" class="img-fluid" style="max-height: 250px; border-radius: 10px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text_25_black mb-2 text-center">Your Order Details</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">Order Date: <b>{{ $order['order_date'] }}</b></div>
                        <div class="col-lg-12">Order ID: <b>{{ $order['group_cart_id'] }}</b></div>
                        <div class="col-lg-12">Order total: AED <b>{{ number_format($order['total_products_mrp'],2) }}</b></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@include('layout/footer')
