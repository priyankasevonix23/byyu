<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://tap-sdks.b-cdn.net/card/1.0.0-beta/index.js"></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!--<script src="https://tap-sdks.b-cdn.net/benefit-pay/build-1.0.10/main.js"></script>-->
		<title>card demo</title>
	</head>
	<body>
	    <form method="post" action="{{url('payment-process')}}">
	        @csrf
		<div id="card-sdk-id"></div>
		<input type="hidden" name="address_id" value="{{$data['address_id']}}" />
		<input type="hidden" name="payment_method" value="Paid" />
		<input type="hidden" name="address_id" value="{{$data['address_id']}}" />
		<input type="hidden" name="wallet_amount" value="{{$data['wallet_amount']}}" />
		<input type="hidden" name="payment_id" value="{{$data['payment_id']}}" />
		<input type="hidden" name="payment_gateway" value="" />
		<input type="hidden" name="coupon_code" value="{{$data['coupon_code']}}" />
		<input type="hidden" name="coupon_amount" value="{{$data['coupon_amount']}}" />
		<input type="hidden" name="total_mrp" value="{{$data['total_mrp']}}" />
		<input type="hidden" name="remaining_total_amount" value="{{$data['remaining_total_amount']}}" />
		<input type="hidden" name="platform" value="{{$data['platform']}}" />
		<input type="hidden" name="token_id" value="" id="token_id" />
		<input type="hidden" name="tapcustomer_id" value="{{$data['user']['tapcustomer_id'] ?? ''}}" />
		<button id="card-v2" type="button" class="red_button btn_submit" onClick="window.CardSDK.tokenize();">Submit</button>
		<button id="load-card-v2" type="button" class="red_button btn_load_card" onClick="window.CardSDK.loadSavedCard('card_KuAT12241031CFjK15T87i227');">Load</button
		</form>
		<script>
			const { renderTapCard, Theme, Currencies, Direction, Edges, Locale,tokenize, resetCardInputs,saveCard,updateCardConfiguration,updateTheme,loadSavedCard } = window.CardSDK
			const { unmount } = renderTapCard('card-sdk-id', {
				publicKey: 'pk_test_OduLFGEbq3iAY46haNxpRDZf',
				merchant: {
					id: '26925267'
				},
				transaction: {
					amount: {{$data['total_mrp']}},
					currency: Currencies.AED
				},
				customer: {
					id: "{{$data['user']['tapcustomer_id'] ?? ''}}", //'cus_TS03A4220240946b9OK1206309',
					name: [
						{
							lang: Locale.EN,
							first: "{{$data['user']['name']}}",
							last: '',
							middle: ''
						}
					],
					nameOnCard: "{{$data['user']['name']}}",
					editable: true,
					contact: {
						email: "{{$data['user']['email']}}",
						phone: {
							countryCode: "{{$data['user']['country_code']}}",
							number: "{{$data['user']['user_phone']}}",
						}
					}
				},
				acceptance: {
					supportedBrands: ['AMERICAN_EXPRESS', 'VISA', 'MASTERCARD', 'MADA','KNET','BENEFIT','FAWRY','OMANNET','APPLE_PAY','GOOGLE_PAY'],
					supportedCards: "ALL"
				},
				fields: {
					cardHolder: true
				},
				addons: {
					displayPaymentBrands: true,
					loader: true,
					saveCard: true
				},
				interface: {
					locale: Locale.EN,
					theme: Theme.DYNAMIC,
					edges: Edges.CURVED,
					direction: Direction.LTR
				},
				onReady:function(data){
				    console.log('onReady');
				    var rescard = window.CardSDK.loadSavedCard('card_KuAT12241031CFjK15T87i227');
				    console.log('loadcards',rescard);
				},
				onFocus: () => console.log('onFocus'),
				onBinIdentification: (data) => console.log('onBinIdentification', data),
				onValidInput: (data) => console.log('onValidInputChange', data),
				onInvalidInput: (data) => console.log('onInvalidInput', data),
				onError: (data) => console.log('onError', data),
				onSuccess:function(data){
				  console.log('onSuccess', data);   
				  $('#token_id').val(data.id);
             
        		  //   var form = $(form);
        		  //   console.log(form.serialize());
        		  //   $.ajax({
            //             url: '{{ url("payment-process") }}',
            //             method: 'POST',
            //             data:form.serialize(),
            //             // type:'JSON',
            //             success: function(response) {
            //                 console.log(response)
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error('Error', error);
            //             }
        		  //   }); 
        		   $('form').submit();
				},
				
			});
			
		
			
		</script>
		
		<style type="text/css">
		    body {
               background-image: url('assets/images/updatemobilenumber-img.png');
               background-repeat: no-repeat;
               background-attachment: fixed;
               background-position: right;
            }
		    .red_button {
                background-color: #f03613;
                color: #ffffff !important;
                padding: 9px 30px;
                border-radius: 100px;
                text-decoration: none;
                border: 0;
                transition-duration: 0.1s;
                text-transform: uppercase;
                line-height: normal;
                font-size: 13px;
            }
            .btn_submit{
                margin-left: auto;
                box-sizing: border-box;
                margin-right: auto;
                display: flex;
                max-width: 500px;
                position: relative;
                transition: 0.05s ease-out;
            }
            
		</style>
		<!--<div id="benefit-pay-button"></div>-->
		<!--<script type="text/javascript">-->
		<!--	const { render, Edges, Environment, Locale, ThemeMode } = window.TapBenefitpaySDK-->
		<!--	render(-->
		<!--		{-->
		<!--			operator: {-->
		<!--				publicKey: 'pk_test_OduLFGEbq3iAY46haNxpRDZf'-->
		<!--			},-->
		<!--			environment: Environment.Development,-->
		<!--			debug: true,-->
		<!--			merchant: {-->
		<!--				id: '26925267'-->
		<!--			},-->
		<!--			transaction: {-->
		<!--				amount: '12',-->
		<!--				currency: 'BHD'-->
		<!--			},-->
		<!--			reference: {-->
		<!--				transaction: 'txn_123',-->
		<!--				order: 'ord_123'-->
		<!--			},-->
		<!--			customer: {-->
		<!--				names: [-->
		<!--					{-->
		<!--						lang: Locale.EN,-->
		<!--						first: 'test',-->
		<!--						last: 'tester',-->
		<!--						middle: 'test'-->
		<!--					}-->
		<!--				],-->
		<!--				contact: {-->
		<!--					email: 'test@gmail.com',-->
		<!--					phone: {-->
		<!--						countryCode: '20',-->
		<!--						number: '1000000000'-->
		<!--					}-->
		<!--				}-->
		<!--			},-->
		<!--			interface: {-->
		<!--				locale: Locale.EN,-->
		<!--				edges: Edges.CURVED-->
		<!--			},-->
		<!--			post: {-->
		<!--				url: ''-->
		<!--			},-->
		<!--			onReady: () => {-->
		<!--				console.log('Ready')-->
		<!--			},-->
		<!--			onClick: () => {-->
		<!--				console.log('Clicked')-->
		<!--			},-->
		<!--			onCancel: () => console.log('cancelled'),-->
		<!--			onError: (err) => console.log('onError', err),-->
		<!--			onSuccess: (data) => {-->
		<!--				console.log(data)-->
		<!--			}-->
		<!--		},-->
		<!--		'benefit-pay-button'-->
		<!--	)-->
		<!--</script>-->
		
		<script>
// 		$(document).ready(function(){
// 		   $('.btn_submit').on('click',function(){
// 		       alert('btn click');
		       
// 		   });
// 		}); 
		</script>
		
    
	</body>
</html>

<!--<html>-->
<!--   <head>-->
<!--      <title>goSell Elements Demo</title>-->
<!--      <meta charset="utf-8">-->
<!--      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />-->
<!--      <link rel="shortcut icon" href="https://goSellJSLib.b-cdn.net/v2.0.0/imgs/tap-favicon.ico" />-->
<!--      <link href="https://goSellJSLib.b-cdn.net/v2.0.0/css/gosell.css" rel="stylesheet" />-->
<!--   </head>-->
<!--   <body>-->
<!--      <script type="text/javascript" src="https://goSellJSLib.b-cdn.net/v2.0.0/js/gosell.js"></script>-->
<!--      <div id="root"></div>-->
<!--      <p id="msg"></p>-->
<!--      <button id="submit-elements" onclick="goSell.submit()">Submit</button>-->
<!--      <script>-->
<!--         goSell.goSellElements({-->
<!--           containerID:"root",-->
<!--           gateway:{-->
<!--             publicKey:"pk_test_OduLFGEbq3iAY46haNxpRDZf",-->
<!--             language:"en",-->
<!--             supportedCurrencies: "all",-->
<!--             supportedPaymentMethods: "all",-->
<!--             notifications:'msg',-->
<!--             labels:{-->
<!--                 cardNumber:"Card Number",-->
<!--                 expirationDate:"MM/YY",-->
<!--                 cvv:"CVV",-->
<!--                 cardHolder:"Name on Card",-->
<!--                 actionButton:"Pay"-->
<!--             },-->
<!--             style: {-->
<!--                 base: {-->
<!--                   color: '#535353',-->
<!--                   lineHeight: '18px',-->
<!--                   fontFamily: 'sans-serif',-->
<!--                   fontSmoothing: 'antialiased',-->
<!--                   fontSize: '16px',-->
<!--                   '::placeholder': {-->
<!--                     color: 'rgba(0, 0, 0, 0.26)',-->
<!--                     fontSize:'15px'-->
<!--                   }-->
<!--                 },-->
<!--                 invalid: {-->
<!--                   color: 'red',-->
<!--                   iconColor: '#fa755a '-->
<!--                 }-->
<!--             }-->
<!--           }-->
<!--         });-->

<!--      </script>-->
<!--   </body>-->
<!--</html>-->

<!--<html>-->
<!--<head>-->
<!--    <title>goSell Demo</title>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />-->
<!--    <link rel="shortcut icon" href="https://goSellJSLib.b-cdn.net/v2.0.0/imgs/tap-favicon.ico" />-->
<!--    <link href="https://goSellJSLib.b-cdn.net/v2.0.0/css/gosell.css" rel="stylesheet" />-->
<!--</head>-->
<!--<body>-->
<!--    <script type="text/javascript" src="https://goSellJSLib.b-cdn.net/v2.0.0/js/gosell.js"></script>-->

<!--    <div id="root"></div>-->
<!--    <button id="openLightBox" onclick="goSell.openLightBox()">open goSell LightBox</button>-->
<!--    <button id="openPage" onclick="goSell.openPaymentPage()">open goSell Page</button>-->

<!--    <script>-->

<!--    goSell.config({-->
<!--      containerID:"root",-->
<!--      gateway:{-->
<!--        publicKey:"{{ env('TAP_PAYMENT_PUBLIC_KEY')}}",-->
<!--        language:"en",-->
<!--        contactInfo:true,-->
<!--        supportedCurrencies:"all",-->
<!--        supportedPaymentMethods: "all",-->
<!--        saveCardOption:true,-->
<!--        customerCards: true,-->
<!--        notifications:'standard',-->
<!--        callback:(response) => {-->
<!--            console.log('response', response);-->
<!--        },-->
<!--        onClose: () => {-->
<!--            console.log("onClose Event");-->
<!--        },-->
<!--        backgroundImg: {-->
<!--          url: 'imgUrl',-->
<!--          opacity: '1'-->
<!--        },-->
<!--        labels:{-->
<!--            cardNumber:"Card Number",-->
<!--            expirationDate:"MM/YY",-->
<!--            cvv:"CVV",-->
<!--            cardHolder:"Name on Card",-->
<!--            actionButton:"Pay"-->
<!--        },-->
<!--        style: {-->
<!--            base: {-->
<!--              color: '#535353',-->
<!--              lineHeight: '18px',-->
<!--              fontFamily: 'sans-serif',-->
<!--              fontSmoothing: 'antialiased',-->
<!--              fontSize: '16px',-->
<!--              '::placeholder': {-->
<!--                color: 'rgba(0, 0, 0, 0.26)',-->
<!--                fontSize:'15px'-->
<!--              }-->
<!--            },-->
<!--            invalid: {-->
<!--              color: 'red',-->
<!--              iconColor: '#fa755a '-->
<!--            }-->
<!--        }-->
<!--      },-->
<!--      customer:{-->
<!--        id:"cus_TS03A4220240946b9OK1206309",-->
<!--        first_name: "First Name",-->
<!--        middle_name: "Middle Name",-->
<!--        last_name: "Last Name",-->
<!--        email: "demo@email.com",-->
<!--        phone: {-->
<!--            country_code: "965",-->
<!--            number: "99999999"-->
<!--        }-->
<!--      },-->
<!--      order:{-->
<!--        amount: 100,-->
        <!--currency:"USD", //KWD-->
<!--        items:[{-->
<!--          id:1,-->
<!--          name:'item1',-->
<!--          description: 'item1 desc',-->
<!--          quantity:'x1',-->
<!--          amount_per_unit:'KD00.000',-->
<!--          discount: {-->
<!--            type: 'P',-->
<!--            value: '10%'-->
<!--          },-->
<!--          total_amount: 'KD000.000'-->
<!--        },-->
<!--        {-->
<!--          id:2,-->
<!--          name:'item2',-->
<!--          description: 'item2 desc',-->
<!--          quantity:'x2',-->
<!--          amount_per_unit:'KD00.000',-->
<!--          discount: {-->
<!--            type: 'P',-->
<!--            value: '10%'-->
<!--          },-->
<!--          total_amount: 'KD000.000'-->
<!--        },-->
<!--        {-->
<!--          id:3,-->
<!--          name:'item3',-->
<!--          description: 'item3 desc',-->
<!--          quantity:'x1',-->
<!--          amount_per_unit:'KD00.000',-->
<!--          discount: {-->
<!--            type: 'P',-->
<!--            value: '10%'-->
<!--          },-->
<!--          total_amount: 'KD000.000'-->
<!--        }],-->
<!--        shipping:null,-->
<!--        taxes: null-->
<!--      },-->
<!--     transaction:{-->
<!--       mode: 'charge',-->
<!--       charge:{-->
<!--          saveCard: true,-->
<!--          threeDSecure: true,-->
<!--          description: "Test Description",-->
<!--          statement_descriptor: "Sample",-->
<!--          reference:{-->
<!--            transaction: "txn_0001",-->
<!--            order: "ord_0001"-->
<!--          },-->
<!--          metadata:{},-->
<!--          receipt:{-->
<!--            email: false,-->
<!--            sms: true-->
<!--          },-->
<!--          redirect: "{{url('success')}}",-->
<!--          post: null,-->
<!--        }-->
<!--     }-->
<!--    });-->

<!--    </script>-->

<!--</body>-->
<!--</html>-->
