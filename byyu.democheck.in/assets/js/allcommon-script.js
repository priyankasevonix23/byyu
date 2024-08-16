// ----------------------RESPONSIVE-NAV-START---------------------



  function menu() {

      var x = document.getElementById("header_top");

      if (x.className === "top_header") {

          x.className += " open";

      } else {

          x.className = "top_header";

      }

  }



  function search_top() {

      var x = document.getElementById("search_top");

      if (x.className === "search_box") {

          x.className += " search_open";

      } else {

          x.className = "search_box";

      }

  }



//   PRODUCT-DETAILS-COMING-SOON-START

  function comingsoon() {

      var x = document.getElementById("comingsoon");

      if (x.className === "comingsoon") {

          x.className += " comingsoon_open";

      } else {

          x.className = "comingsoon";

      }

  }

//   PRODUCT-DETAILS-COMING-SOON-START





//   HOMEPAGE-DOWNLOADAPP-START

function downloadapp() {

      var x = document.getElementById("downloadapp_mainbox");

      if (x.className === "downloadapp_mainbox") {

          x.className += " downloadapp_close";

      } else {

          x.className = "downloadapp_mainbox";

      }

  }

//   HOMEPAGE-DOWNLOADAPP-END



// PROFILE-MENU-NAV-START



function profile_menu() {

    var x = document.getElementById("profile_menu");

    if (x.className === "profile_menu") {

        x.className += " profile_menu_open";

    } else {

        x.className = "profile_menu";

    }

}

// PROFILE-MENU-NAV-END



// ----------------------RESPONSIVE-NAV-END---------------------







// ----------------------COMMON-ABOUT-PRODUCT-LEFT-FILTER-MENU-START---------------------

    function category_menu() {

        var x = document.getElementById("occassion_menu_box");

        if (x.className === "occassion_menu_box") {

            x.className += " occassion_menu_open";

        } else {

            x.className = "occassion_menu_box";

        }

    }

    

    function filter_menu() {

        var x = document.getElementById("filter_menu_box");

        if (x.className === "occassion_menu_box") {

            x.className += " occassion_menu_open";

        } else {

            x.className = "occassion_menu_box";

        }

    }

// ----------------------COMMON-ABOUT-PRODUCT-LEFT-FILTER-MENU-END---------------------







// ----------------------PRODUCT-DETAILS-SHARE-MOBILE-START---------------------



function product_share() {

    var x = document.getElementById("share_box");

    if (x.className === "share_box") {

        x.className += " share_box_open";

    } else {

        x.className = "share_box";

    }

}



// ----------------------PRODUCT-DETAILS-SHARE-MOBILE-END---------------------







// ----------------------HOMEPAGE-BANNER-TAB-SCRIPT-START---------------------



function openCity(evt, cityName) {

    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");

    for (i = 0; i < tabcontent.length; i++) {

        tabcontent[i].style.display = "none";

    }

    tablinks = document.getElementsByClassName("tablinks");

    for (i = 0; i < tablinks.length; i++) {

        tablinks[i].className = tablinks[i].className.replace(" active", "");

    }

    document.getElementById(cityName).style.display = "block";

    evt.currentTarget.className += " active";

}



// ----------------------HOMEPAGE-BANNER-TAB-SCRIPT-END---------------------



//searchbox enable disable

$(".search_text").keypress(function(){

 if ($(".search_text").val().length > 0) {

      $(".gobtn").removeAttr('disabled');



   }

});



$(".search_text").blur(function(){

    if ($(".search_text").val().length ==0) {

      $(".gobtn").attr('disabled','disabled');

   }else{

       $(".gobtn").removeAttr('disabled');

   }

});





$('.priceBox').on('click',function() {

  $('.priceBox').find('input:radio:checked').attr('checked',false);

  $(this).find('input:radio').attr('checked',true);

  // filters.push($.trim($(this).find('label').text()));

  // $('.selectedFilters').val(filters);

  // console.log(filters);

  // addFilters();

});



$('.discountBox').on('click',function() {

  $('.discountBox').find('input:radio:checked').attr('checked',false);

  $(this).find('input:radio').attr('checked',true);

  // filters.push($.trim($(this).find('label').text()));

  // console.log(filters);

  // $('.selectedFilters').val(filters);

  // addFilters();

});



$('.sortBox').on('click',function() {

  $('.sortBox').find('input:radio:checked').attr('checked',false);

  $(this).find('input:radio').attr('checked',true);

  // filters.push($.trim($(this).find('label').text()));

  // console.log(filters);

  // $('.selectedFilters').val(filters);

  // addFilters();

});



function addFilters(){

  var res = '';

  if(filters.length > 0){

    // console.log(filters.length);

    $.each(filters, function( key, value ) {

      res += '<a href="#">'+value+'<span class="close_filter">x</span></a>';

    });

    $('.filters_list').html(res);

  }

}

  

$(document).ready(function(){



    var filters = [];

    $(document).on('click','.close_filter',function(){

      var filtertype = $(this).parent().data('filtertype');

      var filtervalue = $(this).parent().data('filtervalue');



      console.log(filtertype);

      if(filtertype == 'pricesortid'){

          $('.priceBox').find('input:radio:checked').attr('checked',false);

      }

      if(filtertype == 'discountsortid'){

          $('.discountBox').find('input:radio:checked').attr('checked',false);

      }

      if(filtertype == 'sortid'){

          $('.sortBox').find('input:radio:checked').attr('checked',false);

      }

      $(this).parent().remove();



      if($('.priceBox').find('input:radio:checked').length > 0){

        filters.push($.trim($('.priceBox').find('input:radio:checked').parent().find('label').text()) + '+pricesortid_'+$('.priceBox').find('input:radio:checked').val());  

      }

      if($('.discountBox').find('input:radio:checked').length > 0){

        filters.push($.trim($('.discountBox').find('input:radio:checked').parent().find('label').text()) + '+discountsortid_'+$('.discountBox').find('input:radio:checked').val());

      }

      if($('.sortBox').find('input:radio:checked').length > 0){

        filters.push($.trim($('.sortBox').find('input:radio:checked').parent().find('label').text()) + '+sortid_'+$('.sortBox').find('input:radio:checked').val());

      }

      console.log(filters);

      $('.selectedFilters').val(filters);



      $('form').submit();

    });



    

    $(document).on('click','.btn-apply',function(e){

      if($('.priceBox').find('input:radio:checked').length > 0){

        filters.push($.trim($('.priceBox').find('input:radio:checked').parent().find('label').text()) + '+pricesortid_'+$('.priceBox').find('input:radio:checked').val());  

      }

      if($('.discountBox').find('input:radio:checked').length > 0){

        filters.push($.trim($('.discountBox').find('input:radio:checked').parent().find('label').text()) + '+discountsortid_'+$('.discountBox').find('input:radio:checked').val());

      }

      if($('.sortBox').find('input:radio:checked').length > 0){

        filters.push($.trim($('.sortBox').find('input:radio:checked').parent().find('label').text()) + '+sortid_'+$('.sortBox').find('input:radio:checked').val());

      }

      $('.selectedFilters').val(filters);



      $('form').submit();

    });



    

});



$('.clear-button').on('click',function() {

  $('.filter_linkbox').find('input:radio:checked').attr('checked',false);

  $('.filters_list').html('');

  let path = window.location.href.split('?')[0]

  window.location = path;

});





//add to wishlist on all listing page and product detail page

$('.product_wishlist').on('click',function(){

  

      var product_id = $(this).data('product-id');

      var selected_wishlist = $(this);

      

      $.ajax({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          },

          url : app_url + "add-to-wishlist",

          data : {'product_id' : product_id},

          type : 'POST',

          dataType : 'json',

          success : function(response){

              if(response.success == false){

                console.log('here');

                window.location.href = app_url + 'login';

              }else{

                if(response.status == 1){



                  $('.alert-message').removeClass('d-none');

                  $('.alert-message').html('Product added to wishlist successfully');

                  selected_wishlist.find('img').attr('src',app_url+'assets/images/product_wishlist_active.png');

                  // console.log(selected_wishlist.find('img').length);

                  var wishlistcount = $('#wishlist_total_count').html();

                  console.log(wishlistcount,parseInt(wishlistcount) + 1);

                  $('#wishlist_total_count').html(parseInt(wishlistcount) + 1);

                }

                if(response.status == 2){

                   $('.alert-message').removeClass('d-none');

                   $('.alert-message').html('Product removed from wishlist successfully'); 

                   selected_wishlist.find('img').attr('src',app_url+'assets/images/product_wishlist.png');

                   // console.log(selected_wishlist.find('img').length);

                   var wishlistcount = $('#wishlist_total_count').html();

                   console.log(wishlistcount,parseInt(wishlistcount) - 1);

                   $('#wishlist_total_count').html(parseInt(wishlistcount) - 1);

                }  

              }

              var location = window.location.href;

              if(location.indexOf('wishlist') != -1){

                window.location.reload();

              }

              

          }

      });

  });



//product detail

$(document).on('click','.btn-in-qty',function(){

    var quantity = parseInt($('.quantity').html());

    $('.quantity').html(quantity + 1);

    $('#quantity').val($('.quantity').html());

    var final_qty = parseInt($('.quantity').html());

    if(final_qty > 1){

      $('.btn-de-qty').removeAttr('disabled');

    }

});

$(document).on('click','.btn-de-qty',function(){

  var quantity = parseInt($('.quantity').html());

  if(quantity <= 1){

    quantity = 1;

  }else{

    quantity = quantity - 1;

  }

  $('.quantity').html(quantity);

  $('#quantity').val($('.quantity').html());

  var final_qty = parseInt($('.quantity').html());

  if(final_qty == 1){

    $('.btn-de-qty').attr('disabled',true);

  }else if(final_qty > 1){

    $('.btn-de-qty').removeAttr('disabled');

  }

});

function formatAMPM(date) {

  var hours = (date.getHours() + 1);

  var minutes = date.getMinutes();

  var ampm = hours >= 12 ? 'pm' : 'am';

  hours = hours % 12;

  hours = hours ? hours : 12; // the hour '0' should be '12'

  minutes = minutes < 10 ? '0'+minutes : minutes;

  var strTime = hours + ':' + minutes + ' ' + ampm;

  return strTime;

}

$('input[type=radio][name=delivery]').change(function() {

    if($(this).val() == 1 ){

      if($('.product_delivery_type').val() != $(this).val()){

        $('.express-message').removeClass('d-none');  

      }

      

      var d = new Date();

      var month = d.getMonth()+1;

      var day = d.getDate();



      var todayDate = d.getFullYear() + '-' +

          ((''+month).length<2 ? '0' : '') + month + '-' +

          ((''+day).length<2 ? '0' : '') + day;

      $('.delivery_date').val(todayDate);

      $('.delivery_time').val(formatAMPM(new Date));

      $('#datePicker2').attr('disabled',true);

      $('.ptimeslot').attr('disabled',true);

      $('#datePicker2').val(todayDate);

      

      document.getElementById('timesoltDate').style.display='none';
      document.getElementById('timesoltother').style.display='none';
      document.getElementById('timesoltexpressday').style.display='block';
      document.getElementById('timesoltsameday').style.display='none';

    }



    if($(this).val() == 2){

        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
        month = '0' + month.toString();
        if(day < 10)
        day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
    

        $('#datePicker2').attr('min', maxDate);

        $('#datePicker2').val(maxDate);

        fetchTimeSlot(maxDate);

        // $('#datePicker2').removeAttr('disabled');

        $('#datePicker2').attr('disabled',true);

        $('.ptimeslot').removeAttr('disabled');

        

        document.getElementById('timesoltDate').style.display='block';
        document.getElementById('timesoltother').style.display='block';
        document.getElementById('timesoltexpressday').style.display='none';
        // document.getElementById('timesoltsameday').style.display='none';

    }



    if($(this).val() == 3 ){

        // var dtToday = new Date();
        // var month = dtToday.getMonth() + 1;
        // var day = dtToday.getDate() + 1;
        // var year = dtToday.getFullYear();
        // if(month < 10)
        // month = '0' + month.toString();
        // if(day < 10)
        // day = '0' + day.toString();
        // var maxDate = year + '-' + month + '-' + day;
        
            var dtToday = new Date();
            // Increment the day by 1
            dtToday.setDate(dtToday.getDate() + 1);
            var month = dtToday.getMonth() + 1; // Months are zero-based
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();

            if (month < 10) {
                month = '0' + month.toString();
            }
            if (day < 10) {
                day = '0' + day.toString();
            }

            var maxDate = year + '-' + month + '-' + day;


        

        $('#datePicker2').attr('min', maxDate);

        $('#datePicker2').val(maxDate);

        fetchTimeSlot(maxDate);

        $('#datePicker2').removeAttr('disabled');

        $('.ptimeslot').removeAttr('disabled');

        

        document.getElementById('timesoltDate').style.display='block';
        document.getElementById('timesoltother').style.display='block';
        document.getElementById('timesoltexpressday').style.display='none';
        document.getElementById('timesoltsameday').style.display='none';  

    }

});


$('#datePicker2').on('change',function(){
  fetchTimeSlot($(this).val());

});


function fetchTimeSlot(date){
  $.ajax({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      },

      url : node_app_url + "get_daytimeslot",

      data : {"date":date ,"product_id": $('.product_id').val()},

      type : 'POST',

      dataType : 'json',

      success : function(response){

       

        if(response.status == 1){

          if(response.data.length > 0){

            $('.timeslot-error').html('');

             var res = '';

              res += '<option value="" disabled selected>Select</option>';

            for(var i=0;i<response.data.length;i++){

              if(response.data[i].time_slot){

                res += '<option value="'+response.data[i].time_slot+'">'+response.data[i].time_slot+'</option>';

              }

              

              // $('.ptimeslot').append('<option value="'+response.data[i].time_slot+'">'+response.data[i].time_slot+'<option>');

            }

            // console.log(response.data.length,res);

            $('.ptimeslot').html(res);

          }else{

            $('.ptimeslot').html('');

          }

        }else{
       
        document.getElementById('timesoltDate').style.display='none';
        document.getElementById('timesoltother').style.display='none';
        document.getElementById('timesoltexpressday').style.display='none';   
        document.getElementById('timesoltsameday').style.display='block';   
            
        //   $('.timeslot-error').html(response.message);

        }

        

      }

  });

}

$('.ptimeslot').on('change',function(){

  $('.delivery_date').val($('#datePicker2').val());

  $('.delivery_time').val($(this).val());

});


//cart summary

$(document).on('click','.btn-csin-qty',function(){

    var quantity = parseInt($(this).parent().find('.quantity').html());

    $(this).parent().find('.quantity').html(quantity + 1);



    $.ajax({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          },

          url : app_url + "add-to-cart",

          data : {"user_id":$('.user_id').val() ,"quantity": $(this).parent().find('.quantity').html(),"product_id": $(this).data('product-id'),"delivery_type": $(this).data('delivery-type'), "delivery_date": $(this).data('delivery-date'),"delivery_time": $(this).data('delivery-time'),"target":"cart"},

          type : 'POST',

          dataType : 'json',

          success : function(response){

            console.log(response);

              // if(response.status == 1){

               

              // }

              window.location.reload();

          }

      });

});

$(document).on('click','.btn-csde-qty',function(){

  var quantity = parseInt($(this).parent().find('.quantity').html());

  if(quantity <= 0){

    quantity = 0;

  }else{

    quantity = quantity - 1;

  }

  $(this).parent().find('.quantity').html(quantity);



  $.ajax({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          },

          url : app_url + "add-to-cart",

          data : {"user_id":$('.user_id').val() ,"quantity": $(this).parent().find('.quantity').html(),"product_id": $(this).data('product-id'),"delivery_type": $(this).data('delivery-type'), "delivery_date": $(this).data('delivery-date'),"delivery_time": $(this).data('delivery-time'),"target":"cart"},

          type : 'POST',

          dataType : 'json',

          success : function(response){

            console.log(response);

              // if(response.status == 1){

               

              // }

              window.location.reload();

          }

      });

});


//address

$('.current_address_box_list').on('click',function(){

  console.log('select addresss');

    $('.current_address_box_list').find('input:radio').removeAttr('checked');

    $(this).find('input:radio').attr('checked',true);

    $(this).find('input:radio').prop('checked',true);

});


// $(".proceed_to_checkout").on('click',function(){

//   $('.address')

// });


$('.wallet_box').on('click',function(){
  console.log($(this).parents('.wallet_box').find('input:checkbox').length);
  $(this).parents('.wallet_box').find('input:checkbox').attr('checked',true);
  $(this).parents('.wallet_box').find('input:checkbox').prop('checked',true);
  
  $('.wallet-amount-box').toggleClass('d-none');
});

$('.btn-wallet-apply').on('click',function(){
  var wallet_txt = parseFloat($('.wallet_txt').val());
  var wallet_amount = parseFloat($('.wallet_amount').val());
  $('.wallet_used_balance').html('AED '+$('.wallet_txt').val()+ ' (-)');
  $('.wallet-div').removeClass('d-none');
  
  // console.log(wallet_txt , wallet_amount);
  if(wallet_txt > wallet_amount ){
    $('.text-danger').removeClass('d-none');
    $('.text-danger').html('Entered amount should not be more than wallet balance');
  }else if(wallet_txt > $('.remaining_total_amount').val()){
    $('.text-danger').removeClass('d-none');
    $('.text-danger').html('Entered amount should not be more than total amount');
  }else{
    $('.btn_wallet_remove').removeClass('d-none');
    $('.btn-wallet-apply').addClass('d-none');
    $('.text-danger').addClass('d-none');
    if($('.hd_coupon_amount').val() > 0){
      var total = $('.total_amount').val() - $('.wallet_txt').val() - $('.hd_coupon_amount').val();
    }else{
      var total = $('.total_amount').val() - $('.wallet_txt').val();  
    }
    
    // console.log('total',total);
    var roundedTotal = total.toFixed(2);
    $('.total_amount_lbl').html(roundedTotal);
    $('.used_wallet_amount').val($('.wallet_txt').val());
    $('.remaining_total_amount').val(total);
  }
  
});

$('.btn_coupon_apply').on('click',function(){
    
var address_id=$('#address_id').val();
  $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : app_url + "apply-coupon",
        data : {'coupon_code': $('.txt_coupon_code').val()},
        type : 'POST',
        dataType : 'json',
        success : function(response){
          console.log(response);

            if(response.status == 1){
              $('.btn_coupon_remove').removeClass('d-none');
              $('.btn_coupon_apply').addClass('d-none');

              var res = response.data;
              $('.coupon_message').html('');
              $('.coupon-div').removeClass('d-none');
              $('.coupon_amount').html('AED '+ res.save_amount + ' (-)');
              $('.hd_coupon_amount').val(res.save_amount);
              $('.total_amount_lbl').html(res.discounted_amount);
              $('.remaining_total_amount').val(res.discounted_amount);
              
              var coupon_code=$('.txt_coupon_code').val();
              window.location =app_url+"checkout?address_id="+address_id+"&coupon_code="+coupon_code;

            }else{
              $('.coupon_message').html(response.message);
            }
            // window.location.reload();
        }
    });
});

$('.btn_coupon_remove').on('click',function(){
    $('.txt_coupon_code').val('');
    $('.btn_coupon_remove').addClass('d-none'); 
    $('.btn_coupon_apply').removeClass('d-none');
    $('.coupon-div').addClass('d-none');
    $('.hd_coupon_amount').val(0);
    if($('.used_wallet_amount').val() > 0){
      $('.total_amount_lbl').html($('.old_remaining_total_amount').val() - $('.used_wallet_amount').val());  
    }else{
      $('.total_amount_lbl').html($('.old_remaining_total_amount').val());
    }
    
    $('.remaining_total_amount').val($('.old_remaining_total_amount').val());
}); 

$('.btn_wallet_remove').on('click',function(){
  $('.wallet_txt').val('');
  $('.btn_wallet_remove').addClass('d-none'); 
  $('.btn-wallet-apply').removeClass('d-none');
  $('.wallet-div').addClass('d-none');
  $('.used_wallet_amount').val(0);

  if($('.hd_coupon_amount').val() > 0){
      $('.total_amount_lbl').html($('.total_amount').val() - $('.hd_coupon_amount').val());  
    }else{
      $('.total_amount_lbl').html($('.total_amount').val());
    }
    
  $('.remaining_total_amount').val($('.total_amount').val());
});


function apply_coupon(coupon_code,address_id){
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url : app_url + "apply-coupon",
data : {'coupon_code':coupon_code},
type : 'POST',
dataType : 'json',
success : function(response){
if(response.status == 1){
window.location =app_url+"checkout?address_id="+address_id+"&coupon_code="+coupon_code;
}
if(response.status == 2){
}
}

});

}