@include('layout.header')
<div class="middle_box width100">
        <section class="" style="position: relative;min-height: 500px">

                <div class="container">
					<div class="row cart_empty_box">
                        <div class="col-lg-12 text-center"> Your payment is failed .<br> Please click on below button to continue<br><br>
                        <a href="{{url('/myorders')}}" class="red_button mt-3" style="text-decoration: none;">My Orders</a>&nbsp;&nbsp;
                        <a href="{{url('/cart-summary')}}" class="red_button mt-3" style="text-decoration: none;">Retry Payment</a>
                        </div>
                    </div>
                </div>
        </section>
</div>                    
@include('layout.footer')