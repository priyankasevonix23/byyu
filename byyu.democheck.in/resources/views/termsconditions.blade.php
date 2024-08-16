@include('layout/header')


<div class="middle_box width100">
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-4 mb-3">
                    <!--<div class="row">-->
                    <!--    <div class="col-lg-12 mb-4 black_heading">-->
                    <!--        Terms and condition-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <div class="row">
                        <div class="col-lg-12 verify_text mt-5 mb-5" style="color: #000;">
                           <h1 class="black_heading">Terms and condition</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                        <?php 
                        echo $data['data']['description'];
                        ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section>
</div>
@include('layout/footer')