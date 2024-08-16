<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

use Carbon\carbon;

// use Symfony\Component\HttpFoundation\Session\Session;

use Auth;

use Hash;

use Mail;

use DB;

use Session;

use App\Traits\ProfileTrait;



class CartController extends Controller

{

    protected $nodeappUrl;

    protected $loggedInUser;

    use ProfileTrait;

 

    public function __construct(){

        $this->nodeappUrl = env('NODE_APP_URL');

       

    } 



	public function addToCart(Request $request)

    {

      

        $data=array();

        $searchfilters=array();

        $product_id = $request->product_id;

        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];


	$data = array(
              "qty"=> $request->quantity,
              "varient_id"=> $request->product_id,
              "special"=> 0,
              "device_id"=> "",
              "platform"=> "web",
              "delivery_type"=> $request->delivery,
              "delivery_date"=> $request->delivery_date,
              "delivery_time"=> $request->delivery_time,
              "personalized_message"=>null,
              "personalized_text"=>empty($request->message)?$request->message:null,
              "personalized_image"=>null,
              "egg_eggless"=>$request->egg_eggless,
              "flavour"=>$request->flavour,
            );

        if(empty($this->loggedInUser)){
            $request->session()->put('targetPage',$request->currentpage);
            $request->session()->put('addToCartData',$data);
            return redirect()->route('login');
        }
        //===========ONEAPI=================
        
        $personalized_text = array();
        $message = $request->message;
        $textname = $request->textname;
        
        if (!empty($message)) {
        for ($i = 0; $i < count($message); $i++) {
        $personalized_text[] = array(
        "name" => $textname[$i],
        "value" => $message[$i]
        );
        }
        }
        
        $personalized_image=array();
        // Prepare image files for upload
        if ($request->hasFile('image')) {
        $date = date('d-m-Y');
        foreach ($request->file('image') as $index => $file) {
        // Ensure file is an instance of UploadedFile
        if ($file instanceof \Illuminate\Http\UploadedFile) {
        $fileName = str_replace(" ", "-", $file->getClientOriginalName());
        $filePath = 'images/personalized/' . $date . '/' . $fileName;
        // Move the file to the storage path
        $file->move(public_path('images/personalized/' . $date), $fileName);
        
        // Append to personalized_image array
        $personalized_image[] = array(
        "name" => $request->imagename[$index],
        "value" => '/' . $filePath
        );
        }
        }
        }
        

        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'add_to_cart', [

            'json' => [

              "user_id"=> $this->loggedInUser['id'],				

              "qty"=> $request->quantity,

              "varient_id"=> $request->product_id,

              "special"=> 0,

              "device_id"=> "",

              "platform"=> "web",

              "delivery_type"=> $request->delivery,

              "delivery_date"=> $request->delivery_date,

              "delivery_time"=> $request->delivery_time,

              "personalized_message"=>null,

              "personalized_text"=>$personalized_text,

              "personalized_image"=>$personalized_image,
              
              "egg_eggless"=>$request->egg_eggless,
              
              "flavour"=>$request->flavour,

            ]

            ]);



            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

               

                // Process the data as needed

              if($request->target == 'cart'){

                 $addToCart = json_decode($response->getBody()->getContents(), true);

                return response()->json($addToCart);

              }else{
                $addToCart = json_decode($response->getBody()->getContents(), true);
                if($addToCart['status'] == 0)
                {
                return redirect()->back()->with('error', $addToCart['message']);
                }else
                {
                 return redirect('cart-summary');   
                }

              }

            } else {

                // Handle non-200 status code

                // You may throw an exception or handle it according to your requirements

            }

        } catch (RequestException $e) {

            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

            print_r($errorMessage);

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

            print_r($errorMessage);

        }



        

    }





    public function getCartSummary(Request $request){



      try {

              $summary = $this->getSummaryCount();

              

              $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];

              $user_id= $this->loggedInUser['id'];





              if(empty($this->loggedInUser)){

                  return redirect()->route('login');

              }



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'show_cart', [

              'json' => [

              // Data to send in the request body

              "user_id"=>$this->loggedInUser['id'],

              "device_id"=>""

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $cartItems = json_decode($response->getBody()->getContents(), true);

                  $cartDetail = !empty($cartItems['data'])?$cartItems['data']:[];

                  $request->session()->put('cartdata', $cartDetail);

                  // Process the data as needed

                   // echo "<pre>";print_r($cartDetail);echo "</pre>";exit;
                  $is_time_valid_data=1;
                  return view('cart-summary',compact('cartDetail','user_id','summary','is_time_valid_data'));

              } else {

                  // Handle non-200 status code

                  // You may throw an exception or handle it according to your requirements

              }

          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }

    }



    public function getAddress(Request $request){



      if(session()->get('targetPage')){
        session()->forget('targetPage');
      }
      
        
        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];
        $summary = $this->getSummaryCount();
        
        $client = new Client();
        $response = $client->post($this->nodeappUrl.'show_cart', [
        'json' => [
        // Data to send in the request body
        "user_id"=>$this->loggedInUser['id'],
        "device_id"=>""
        ]
        
        ]);
        
        // Check the response status code
        $statusCode1 = $response->getStatusCode();
        // Response is successful, decode the JSON response
        $cartItems = json_decode($response->getBody()->getContents(), true);
        $cartDetail = !empty($cartItems['data'])?$cartItems['data']:[];

        foreach($cartDetail['data'] as $Cartdata)
        {
         
         $user_id=$this->loggedInUser['id'];    
         $is_time_valid=$Cartdata['is_time_valid'];
         if($is_time_valid == 1)
         {
          $is_time_valid_data=2;     
          return view('cart-summary',compact('cartDetail','user_id','summary','is_time_valid_data'));   
         }
        }



      $user_id= $this->loggedInUser['id'];

      $cartDetail = array();

      $userAddresses = array();

      try {

              



              if(empty($this->loggedInUser)){

                  return redirect()->route('login');

              }



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'show_cart', [

              'json' => [

              // Data to send in the request body

              "user_id"=>$this->loggedInUser['id'],

              "device_id"=>""

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $cartItems = json_decode($response->getBody()->getContents(), true);

                  $cartDetail = !empty($cartItems['data'])?$cartItems['data']:[];

                 

                  // Process the data as needed

                  // return view('address.address',compact('cartDetail','user_id'));

              } else {

                  // Handle non-200 status code

                  // You may throw an exception or handle it according to your requirements

              }

          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }



        try {

              



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'show_address', [

              'json' => [

              // Data to send in the request body

              "user_id"=>$this->loggedInUser['id'],

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $userAddresses = json_decode($response->getBody()->getContents(), true);

                  $userAddresses = !empty($userAddresses['data'])?$userAddresses['data']:[];

                 

              } else {

                  // Handle non-200 status code

                  // You may throw an exception or handle it according to your requirements

              }

          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }



         return view('address.address',compact('cartDetail','user_id','userAddresses','summary'));    

      

    }



    public function getCheckoutDetails(Request $request){

      

      $summary = $this->getSummaryCount();

      $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];
      
      if(empty($this->loggedInUser['user_phone'])){
        $request->session()->put('targetPage',$request->getRequestUri());
        return redirect()->route('userprofile')->with('error', 'Please update your mobile number to proceed further');
      }


      $user_id= $this->loggedInUser['id'];

      $cartDetail = array();

      $userAddresses = array();

     $coupon_code=@$_GET['coupon_code'];

      if(!empty($request->address_id)){

        $request->session()->put('address_id', $request->address_id);

      }

      

      try {

              

              if(empty($this->loggedInUser)){

                  return redirect()->route('login');

              }



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'show_cart', [

              'json' => [

              // Data to send in the request body

              "user_id"=>$this->loggedInUser['id'],

              "device_id"=>""

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $cartItems = json_decode($response->getBody()->getContents(), true);

                  $cartDetail = !empty($cartItems['data'])?$cartItems['data']:[];

                            // echo "<pre>";print_r($cartDetail);echo "</pre>";exit;

                  // Process the data as needed

                  // return view('address.address',compact('cartDetail','user_id'));

              } else {

                  // Handle non-200 status code

                  // You may throw an exception or handle it according to your requirements

              }

          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }



        try {

              $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];



              if(empty($this->loggedInUser)){

                  return redirect()->route('login');

              }



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'app_info', [

              'json' => [

              // Data to send in the request body

              "app_name"=>"customer",

              "platform"=>"android",

              "actual_device_id"=>'',

              "user_id"=>$this->loggedInUser['id'],

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $app_info = json_decode($response->getBody()->getContents(), true);

                  // echo "<pre>";print_r($app_info);echo "</pre>";exit;

                  // Process the data as needed

                  // return view('address.address',compact('cartDetail','user_id'));

              } else {

                  // Handle non-200 status code

                  // You may throw an exception or handle it according to your requirements

              }

          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }  



        // try {



        //       $client = new Client();

        //       $response = $client->post($this->nodeappUrl.'show_address', [

        //       'json' => [

        //       // Data to send in the request body

        //       "user_id"=>$this->loggedInUser['id'],

        //       ]

        //       ]);

              

        //       // Check the response status code

        //       $statusCode1 = $response->getStatusCode();

              

        //       if ($statusCode1 == 200) {

        //           // Response is successful, decode the JSON response

        //           $userAddresses = json_decode($response->getBody()->getContents(), true);

        //           $userAddresses = !empty($userAddresses['data'])?$userAddresses['data']:[];

                 

        //       } else {

        //           // Handle non-200 status code

        //           // You may throw an exception or handle it according to your requirements

        //       }

        //   } catch (RequestException $e) {

        //       $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

        //       print_r($errorMessage);

        //   } catch (\Exception $e) {

        //       $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

        //       print_r($errorMessage);

        //   }



          try {



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'show_address', [

              'json' => [

              // Data to send in the request body

              "user_id"=>$this->loggedInUser['id'],

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $userAddresses = json_decode($response->getBody()->getContents(), true);

                  $userAddresses = !empty($userAddresses['data'])?$userAddresses['data']:[];

                 

              }



          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }
          
          
         //========= Get Messages API ============
        $getmessages=array();
        try {
        $client = new Client();
        $response = $client->post($this->nodeappUrl.'getmessages', [
        'json' => [
        // Data to send in the request body
        'user_id'=>"",
        ]
        ]);
        
        // Check the response status code
        $statusCode = $response->getStatusCode();
        
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $getmessages = json_decode($response->getBody()->getContents(), true);
        // Process the data as needed
        } else {
        // Handle non-200 status code
        // You may throw an exception or handle it according to your requirements
        }
        } catch (RequestException $e) {
        // Guzzle request exception occurred
        // Handle the exception
        $errorMessage = $e->getMessage();
        // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
        // Other exceptions occurred
        // Handle the exception
        $errorMessage = $e->getMessage();
        // Log the error or return a response indicating a failure
        }
        
        $apply_coupon=array();
        if($coupon_code){
        //=========Compare car List API ============
        
        try {
        $client = new Client();
        $response = $client->post($this->nodeappUrl.'apply_coupon', [
        'json' => [
        // Data to send in the request body
        'store_id'=> 1,
        'coupon_code'=>$coupon_code, //Session::get('coupon'),
        'user_id'=> $this->loggedInUser['id'],
        'total_delivery'=> 1
        ]
        ]);
        
        // Check the response status code
        $statusCode = $response->getStatusCode();
        
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $apply_coupon = json_decode($response->getBody()->getContents(), true);
        // Process the data as needed
        } else {
        // Handle non-200 status code
        // You may throw an exception or handle it according to your requirements
        }
        } catch (RequestException $e) {
        // Guzzle request exception occurred
        // Handle the exception
        $errorMessage = $e->getMessage();
        // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
        // Other exceptions occurred
        // Handle the exception
        $errorMessage = $e->getMessage();
        // Log the error or return a response indicating a failure
        }
        }



         return view('checkout',compact('cartDetail','user_id','userAddresses','summary','app_info','getmessages','apply_coupon'));    

      

    }
   
     public function loadPayment(Request $request){
        $cartdata = $request->session()->get('cartdata');
        $cart_total_price = $cartdata['total_price'];

        $used_wallet_amount = $request->used_wallet_amount;
        $remaining_total_amount = $request->remaining_total_amount;
        $coupon_amount = !empty($request->hd_coupon_amount)?$request->hd_coupon_amount:0;
        $coupon_code = !empty($request->txt_coupon_code)?$request->txt_coupon_code:0;

        
        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];
        $data = array(    
                          "user"=>$this->loggedInUser,
                          "user_id"=> $this->loggedInUser['id'],
                          "address_id"=>session()->get('address_id'),
                          "payment_method"=> "Card",
                          "payment_status"=> "success",
                          "wallet"=> "no",
                          "wallet_amount"=>$used_wallet_amount,
                          "remaining_total_amount"=>$remaining_total_amount,
                          "payment_id"=> 0,
                          "payment_gateway"=> null,
                          "coupon_code"=> $coupon_code,
                          "coupon_amount"=> $coupon_amount,
                          "total_mrp"=> $remaining_total_amount,
                          "platform"=> "Web");
        return view('payment.payment',compact('data'));

    }


    public function proceedPayment(Request $request){
        
      try {
              $cartdata = $request->session()->get('cartdata');
              $cart_total_price = $cartdata['total_price'];

              $used_wallet_amount = $request->used_wallet_amount;
              $remaining_total_amount = $request->remaining_total_amount;
              $coupon_amount = !empty($request->hd_coupon_amount)?$request->hd_coupon_amount:0;
              $coupon_code = !empty($request->txt_coupon_code)?$request->txt_coupon_code:0;
              
              $tapcustomer_id = $request->tapcustomer_id;
              $token_id = $request->token_id;

              $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];

              $client = new Client();
              $response = $client->post($this->nodeappUrl.'app_info', [
              'json' => [
              // Data to send in the request body
              "app_name"=>"customer",
              "platform"=>"android",
              "actual_device_id"=>'',
              "user_id"=>$this->loggedInUser['id'],
              ]
              ]);

              
              // Check the response status code
              $statusCode = $response->getStatusCode();
              
              if ($statusCode == 200) {

                  // Response is successful, decode the JSON response
                  $appInfo = json_decode($response->getBody()->getContents(), true);
                  // $appInfo = !empty($userWallet['data'])?$userWallet['data']:[];
                  // $totalWalletAmount=0;
                  // if($appInfo['userwallet']>0){
                  //   $totalWalletAmount=$appInfo['userwallet'];
                  //   $isWalletSelected=true;
                  // }
                  // else{
                  //   $isWalletSelected=false;
                  // }

                  // if($isWalletSelected && $totalWalletAmount<$cart_total_price)  {
                  //alert("Choose Payment Method on Apply Wallet");
                  // }else if(!$isWalletSelected ){
                    //alert("Please select mode of payment ");
                  // if($isWalletSelected && $totalWalletAmount>$cart_total_price){
                  // echo "wallet--".$request->wallet;
                  // echo "success".$request->wallet."--".$remaining_total_amount;
                  //if($request->wallet && $remaining_total_amount == 0){
                  
                  //echo $request->used_wallet_amount.'----'.$remaining_total_amount;
                  if((!empty($request->used_wallet_amount) && $remaining_total_amount == 0) || $remaining_total_amount == 0){      
                   // echo "if----".$request->used_wallet_amount.'----'.$remaining_total_amount;exit;
                          $client = new Client();
                          $response = $client->post($this->nodeappUrl.'payment-request', [
                          'json' => [
                          // Data to send in the request body
                          "user_id"=> $this->loggedInUser['id'],
                          "address_id"=>session()->get('address_id'),
                          "payment_method"=> "Wallet",
                          "payment_status"=> "success",
                          "wallet"=> "no",
                          "wallet_amount"=>$used_wallet_amount,
                          "payment_id"=> 0,
                          "payment_gateway"=> null,
                          "coupon_code"=> $coupon_code,
                          "coupon_amount"=> $coupon_amount,
                          "total_mrp"=> $remaining_total_amount,
                          "platform"=> "Web",
                          "tapcustomer_id" => $tapcustomer_id,
                          ]
                          ]);
                          
                          // Check the response status code
                          $statusCode = $response->getStatusCode();
                          
                          if ($statusCode == 200) {
                            // return redirect('order-summary');
                            return redirect('success');
                          
                          }
                  // }
                 
                  }else{
                //   echo "else";exit;
                 //    print_r(array("user_id"=> $this->loggedInUser['id'],
                 //    "address_id"=>session()->get('address_id'), //65
                 //    "payment_method"=> "Card",
                 //    "payment_status"=> "success",
                 //    "wallet"=> "no",
                 //    "wallet_amount"=>$used_wallet_amount,
                 //    "payment_id"=> "",
                 //    "payment_gateway"=> "",
                 //    "coupon_code"=>"",
                 //    "coupon_amount"=>"",
                 //    "total_mrp"=> $remaining_total_amount,
                 //    "platform"=> "Web"));exit;
                    $client = new Client();
                    $response = $client->post($this->nodeappUrl.'payment-request', [
                    'json' => [
                    // Data to send in the request body
                    "user_id"=> $this->loggedInUser['id'],
                    "address_id"=>session()->get('address_id'), //65
                    "payment_method"=> "Card", //"Card",
                    "payment_status"=> "success",
                    "wallet"=> "no",
                    "wallet_amount"=>$used_wallet_amount,
                    "payment_id"=> "",
                    "payment_gateway"=> "",
                    "coupon_code"=> $coupon_code,
                    "coupon_amount"=> $coupon_amount,
                    "total_mrp"=> $remaining_total_amount,
                    "platform"=> "Web",
                    "tapcustomer_id" => $tapcustomer_id,
                    "token_id" => $token_id,
                    ]
                    ]);
                    
                    // Check the response status code
                    $statusCode = $response->getStatusCode();
                    
                    if ($statusCode == 200) {
                      $paymentResponse = json_decode($response->getBody()->getContents(), true);
                      
                    //   return redirect('success');
                          
                          
                      
                    // $paymentResponse = !empty($paymentResponse['data'])?$paymentResponse['data']:[];
                    
                    //   print_r($paymentResponse);exit;
                      if($paymentResponse['status']=="1"){
                          if($paymentResponse['message'] == "Payment URL"){
                            session()->forget('coupon');
                            session()->forget('address_id');
                            return redirect($paymentResponse['data']);
                          }
                          return back()->with('success', $paymentResponse['message']);
                      }

                    // return response()->json($paymentResponse);
                    }
                    
                  }
              }

              


          } catch (RequestException $e) {
              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
              print_r($errorMessage);
          } catch (\Exception $e) {
              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
              print_r($errorMessage);
          }
      

    }


    

    public function viewCoupons(Request $request){
    
    $summary = $this->getSummaryCount();
      try {

              $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];



              if(empty($this->loggedInUser)){

                  return redirect()->route('login');

              }



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'couponlist', [

              'json' => [

              // Data to send in the request body

              // "user_id"=>$this->loggedInUser['id'],

              "device_id"=>""

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $couponList = json_decode($response->getBody()->getContents(), true);

                  $couponList = !empty($couponList['data'])?$couponList['data']:[];

                            // echo "<pre>";print_r($cartDetail);echo "</pre>";exit;

                  // Process the data as needed

                  // return view('address.address',compact('cartDetail','user_id'));

              } else {

                  // Handle non-200 status code

                  // You may throw an exception or handle it according to your requirements

              }

          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }



      

      return view('coupons',compact('couponList','summary'));

    }



    public function selectCoupon(Request $request){

      if(!empty($request->coupontext)){

        session()->put('coupon',$request->coupontext);

      }

      return redirect('checkout');

    }

    public function applyCoupon(Request $request){

      try {

              $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];



              if(empty($this->loggedInUser)){

                  return redirect()->route('login');

              }



              $client = new Client();

              $response = $client->post($this->nodeappUrl.'apply_coupon', [

              'json' => [

              // Data to send in the request body

              // "user_id"=>$this->loggedInUser['id'],

              'store_id'=> 1,

              'coupon_code'=> $request->coupon_code, //Session::get('coupon'),

              'user_id'=> $this->loggedInUser['id'],

              'total_delivery'=> 1

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $couponApply = json_decode($response->getBody()->getContents(), true);

                  return response()->json($couponApply);

                            // echo "<pre>";print_r($cartDetail);echo "</pre>";exit;

                  // Process the data as needed

                  // return view('address.address',compact('cartDetail','user_id'));

              } else {

                  // Handle non-200 status code

                  // You may throw an exception or handle it according to your requirements

              }

          } catch (RequestException $e) {

              $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          } catch (\Exception $e) {

              $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

              print_r($errorMessage);

          }

      return redirect('checkout');

    }

    public function orderDetail(){

      return view('order-summary');

    }

    public function success(){

      // echo "<span style='font-size:25px;color:green;top: 30%;float: left;width: 100%;position: relative;'><center><h1>Your payment is successful. Please click on Close button to continue<h1></center></span>";
       $summary = $this->getSummaryCount();
      return view('payment.success',compact('summary'));

    }

    public function failed(){

      // echo "<span style='font-size:25px;color:red;top: 30%;float: left;width: 100%;position: relative;'><center><h1>Your payment is failed please click on Close button to continue<h1></center></span>";
      $summary = $this->getSummaryCount();
      return view('payment.failed',compact('summary'));

    }


}