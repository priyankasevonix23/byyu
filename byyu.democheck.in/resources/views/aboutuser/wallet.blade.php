@include('layout/header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
                        <div class="col-lg-12 black_heading mb-4 pb-2" style="border-bottom: 1px dashed #000;">Wallet</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="background-color: #fbf8ea;padding: 10px 20px;border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-2 mt-2" style="font-family: Metropolis-Bold; color: #000; font-size: 18px;">
                                                        Available Balance: <span style="color: #0fb565;">{{ $wallet['total_wallet_amount'] }} AED</span>
                                                    </div>
                                                    <div class="col-lg-12 mb-2">
                                                        <b>Wallet:</b> {{ $wallet['cash_wallet_amount'] }} AED &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <b>Rewards:</b> {{ $wallet['reward_wallet_amount'] }} AED
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-6 text-center">
                                                <div class="redeem_code_box">
                                                    <div style="width: auto; float: left; cursor: pointer;" title="Click here">
                                                        <img src="assets/images/redeem_code_icon.png" class="img-fluid redeem_code_icon"><br>
                                                        <div class="red_button" style="padding: 6px 15px 5px 15px; font-size: 12px; margin: 0px 0 0 0;">Redeem Code</div>
                                                    </div>
                                                    <div style="float: left; width: auto;padding: 20px 0 0 0; position: relative;">
                                                        <span style="position: absolute;top: 0;right: 0;background-color: #454545;color: #fff;line-height: normal;font-size: 14px;padding: 3px 6px 4px 7px;border-radius: 0 10px 0 10px;margin: -10px -20px 0 0px; cursor: pointer;">x</span>
                                                        <input type="text" name="" id="" value="" placeholder="Enter Redeem code" style="border: 1px solid #7c7c7c; border-radius: 100px; padding: 9px 18px; line-height: normal; width: 190px; font-size: 14px; text-transform: uppercase; float: left;outline: none;">
                                                        <input type="button" value="Apply" class="red_button" style="padding: 8px 15px; font-size: 12px; margin: 1px 0 0 7px; line-height: normal; float: right; width: 70px;">
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                        <div class="row">
                        <div class="col-lg-12 mb-3">
                        
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-pending" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Pending and Expiring</button>
                        </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                            
                        <div class="row">
                        @foreach($wallet['all_wallet_details'] as $data)
                        <div class="col-lg-12 mb-3">
                        <div class="" style="background-color: #f8f8f8; border-radius: 10px; padding:10px 20px; font-size: 15px;">
                        <div class="row">
                        @if($data['wallet_type'] == 'Deduction')
                        <div class="col-lg-12" style="color: #f03613; font-family: Metropolis-Bold; font-size: 18px;">Deduction</div>
                        @elseif($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] == 'NULL')
                        <div class="col-lg-12" style="color: #0fb565; font-family: Metropolis-Bold; font-size: 18px;">Refund</div>
                        @elseif($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] != 'NULL')
                        <div class="col-lg-12" style="color: #0fb565; font-family: Metropolis-Bold; font-size: 18px;">{{$data['wallet_dis_name']}}</div>
            
                        @endif
                        </div>
                        <div class="row">
                        <div class="col-lg-4">
                        Amount: <b style="{{ $data['wallet_type'] == 'Deduction' ? 'color: #f03613;' : 'color: #0fb565;' }}">{{ $data['wallet_amount'] }} AED</b>
                        </div>
                        <div class="col-lg-4">
                        Wallet Type: <b style="color: #000;">{{ $data['wallet_type'] }}</b>
                        </div>
                        @if($data['cart_id'])
                        <div class="col-lg-4">
                        Order id: <b style="color: #000;">{{ $data['cart_id'] }}</b>
                        </div>
                        @endif
                        
                        @if($data['wallet_type'] == 'Deduction')
                        <div class="col-lg-4">
                        Deduction Date: <b style="color: #000;">{{date("d-m-Y", strtotime($data['created_at']))}}</b>
                        </div>
                        @endif
                        
                        @if($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] != 'Refund')
                        <div class="col-lg-4">
                        Date: <b style="color: #000;">{{date("d-m-Y", strtotime($data['created_at']))}}</b>
                        </div>
                        @endif
                        
                        @if($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] == 'Refund')
                        <div class="col-lg-4">
                        Refund Date: <b style="color: #000;">{{date("d-m-Y", strtotime($data['created_at']))}}</b>
                        </div>
                        @endif
                        
                        
                        </div>
                        </div>
                        </div>
                        @endforeach
                        </div>    
                            
                        </div>
                        <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                         
                         <div class="row">
                        @foreach($wallet['pending_expiry_wallet_details'] as $data)
                        <div class="col-lg-12 mb-3">
                        <div class="" style="background-color: #f8f8f8; border-radius: 10px; padding:10px 20px; font-size: 15px;">
                        <div class="row">
                        @if($data['wallet_type'] == 'Deduction')
                        <div class="col-lg-12" style="color: #f03613; font-family: Metropolis-Bold; font-size: 18px;">Deduction</div>
                        @elseif($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] == 'NULL')
                        <div class="col-lg-12" style="color: #0fb565; font-family: Metropolis-Bold; font-size: 18px;">Refund</div>
                        @elseif($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] != 'NULL')
                        <div class="col-lg-12" style="color: #0fb565; font-family: Metropolis-Bold; font-size: 18px;">{{$data['wallet_dis_name']}}</div>
            
                        @endif
                        </div>
                        <div class="row">
                        <div class="col-lg-4">
                        Amount: <b style="{{ $data['wallet_type'] == 'Deduction' ? 'color: #f03613;' : 'color: #0fb565;' }}">{{ $data['wallet_amount'] }} AED</b>
                        </div>
                        <div class="col-lg-4">
                        Wallet Type: <b style="color: #000;">{{ $data['wallet_type'] }}</b>
                        </div>
                        @if($data['cart_id'])
                        <div class="col-lg-4">
                        Order id: <b style="color: #000;">{{ $data['cart_id'] }}</b>
                        </div>
                        @endif
                        
                        @if($data['wallet_type'] == 'Deduction')
                        <div class="col-lg-4">
                        Deduction Date: <b style="color: #000;">{{date("d-m-Y", strtotime($data['created_at']))}}</b>
                        </div>
                        @endif
                        
                        @if($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] != 'Refund')
                        <div class="col-lg-4">
                        Date: <b style="color: #000;">{{date("d-m-Y", strtotime($data['created_at']))}}</b>
                        </div>
                        @endif
                        
                        @if($data['wallet_type'] == 'Cash Wallet' && $data['wallet_dis_name'] == 'Refund')
                        <div class="col-lg-4">
                        Refund Date: <b style="color: #000;">{{date("d-m-Y", strtotime($data['created_at']))}}</b>
                        </div>
                        @endif
                        
                        
                        </div>
                        </div>
                        </div>
                        @endforeach
                        </div>
                        
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
