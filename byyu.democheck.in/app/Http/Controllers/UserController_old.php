<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Carbon\carbon;
use Symfony\Component\HttpFoundation\Session\Session;
use Auth;
use Hash;
use Mail;
use DB;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{

    public function __construct(Request $request){
    //construct
    }
    public function logingoogle(){
        return Socialite::driver('google')->redirect();

    }
    public function callback(Request $request){
        try {
            $user = Socialite::driver('google')->user();

            // Now you can access user information like name, email, etc.
            $title = "Hyp-Mobility";
            $data_arr = array();
            $data_arr['title'] ="Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Duabi";
            $data_arr['keywords'] = "";
            $data_arr['description'] = "";
            $data_arr['canonical'] = "";

            $nodeappUrl = env('NODE_APP_URL');
            $data=array();
            $name = $user->getName();
            $email = $user->getEmail();
//===========socialmedialogin  API=================
        try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'socialmedialogin', [
            'json' => [
            // Data to send in the request body
            'email' => $email,
            'name' => $name,
            'fcm_token' => '',
            'device_id' => '',
            'role' => 'socialMedia',

            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                // Response is successful, decode the JSON response
                $data = json_decode($response->getBody()->getContents(), true);
                $request->session()->put('userdata', $data['data'][0]);


                // Process the data as needed
            } else {
            }

        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }

            return redirect()->route('home');
        } catch (\Exception $e) {
            // Handle any exceptions that might occur
            return redirect()->route('login')->with('error', 'An error occurred. Please try again.');
        }

    }
    public function loginuser(Request $request,$id){
        // $userid = $userdata[0]['userid'];



        $nodeappUrl = env('NODE_APP_URL');
        $data=array();

        try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'fetchuser', [
            'json' => [
            // Data to send in the request body
            'user_id' => $id,
            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                // Response is successful, decode the JSON response
                $data = json_decode($response->getBody()->getContents(), true);
                $request->session()->put('userdata', $data['user']);
                if($request->session()->get('targetPage')){
                    $targetPage = $request->session()->get('targetPage');
                    $request->session()->pull('targetPage');
                    return response()->json([
                        'status' => 1,
                        'targetPage' => $targetPage,
                        'message' => 'Login successful',
                    ]);
                }else{
                    // echo "else";
                    return response()->json([
                        'status' => 1,
                        'targetPage' => 'home',
                        'message' => 'Login successful',
                    ]);
                }

            } else {
                // Handle non-200 status code
                // You may throw an exception or handle it according to your requirements
            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }

    }

    public function logout(Request $request)
    {
        // Check if 'userdata' exists in the session
        if ($request->session()->has('userdata')) {
            // Remove 'userdata' from the session
            $request->session()->forget('userdata');
        }

        // Redirect the user to the login page or any other page
        return redirect()->route('home');
    }

// open login page
    public function login(Request $request)
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] ="Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Duabi";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";

        $nodeappUrl = env('NODE_APP_URL');
        $data=array();
        $searchfilters=array();
        //===========current location fetch api=================
        try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'fetchCountryCode', [
            ]);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);

            } else {

            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }
        return view('login.login', compact('title','data_arr','data','searchfilters'));

    }

    public function loginotp($id = null)
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] ="Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Duabi";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        $user= array();
        //===========fetchuser=================
        try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'fetchuser', [
            'json' => [
            // Data to send in the request body
            'user_id' => $id,
            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                // Response is successful, decode the JSON response
                $data = json_decode($response->getBody()->getContents(), true);
                $user=$data['user'];
                // Process the data as needed
            } else {
                // Handle non-200 status code
                // You may throw an exception or handle it according to your requirements
            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }


        return view('login.login-otp', compact('title', 'data_arr','user'));
    }


    public function register(Request $request)
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] ="Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Duabi";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        //===========current location fetch api=================
        try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'fetchCountryCode', [
            ]);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
            } else {

            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }
        return view('register', compact('title','data_arr','data'));


    }

    public function userprofile()
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] = "Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        if (session()->has('userdata')) {
            $user = session()->get('userdata');
            $client = new Client();
            $response = $client->post($nodeappUrl.'fetchuser', [
            'json' => [
            'user_id' => $user['id'],
            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $userdata1 = json_decode($response->getBody()->getContents(), true);
                $userdata=$userdata1['user'];

            } else {
           }

          }
          //===========current location fetch api=================
          try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'fetchCountryCode', [
            ]);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
            } else {

            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }

        return view('aboutuser.userprofile', compact('title', 'data','data_arr','userdata'));
    }
    public function specialday()
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] = "Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        try {
            if (session()->has('userdata')) {
                $user = session()->get('userdata');
                $client = new Client();
                $response = $client->post($nodeappUrl.'show_member', [
                'json' => [
                'user_id' => $user['id'],
                ]
                ]);

                // Check the response status code
                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $memberarr = json_decode($response->getBody()->getContents(), true);
                    $member=$memberarr['data'];
                    // echo "<pre>";print_r($member);exit;


                } else {
               }

              }


            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }

        return view('aboutuser.special-day', compact('title','data_arr','member'));

    }
    public function specialdayadd()
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] = "Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        try {
            if (session()->has('userdata')) {
                $user = session()->get('userdata');
                $client = new Client();
                $response = $client->post($nodeappUrl.'celebration_event', [
                'json' => [
                'user_id' => $user['id'],
                ]
                ]);

                // Check the response status code
                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $celebration_events = json_decode($response->getBody()->getContents(), true);

                } else {
               }
               //get relations
               $responserelation = $client->post($nodeappUrl.'userrelation', [
                'json' => [
                'user_id' => $user['id'],
                ]
                ]);

                // Check the response status code
                $statusCoderelation = $responserelation->getStatusCode();

                if ($statusCoderelation == 200) {
                    $relations = json_decode($responserelation->getBody()->getContents(), true);
                    // echo "<pre>";print_r($relations);exit;


                } else {
               }


              }
            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }

        return view('aboutuser.special-day-add', compact('title','data_arr','celebration_events',"relations"));

    }
    public function specialdaysubmit(Request $request){

             $nodeappUrl = env('NODE_APP_URL');
             try {
                if (session()->has('userdata')) {
                    $user = session()->get('userdata');
                    $client = new Client();

                    $response = $client->post($nodeappUrl.'add_member', [
                    'json' => [
                    'user_id' => $user['id'],
                    'name' => $request->name,
                    'relation' => $request->relation,
                    'celebration_name' => $request->celebration_name,
                    'date_day' => $request->date_day,
                    'date_month' => $request->date_month,
                    'date_year' => "",
                    ]
                    ]);

                    // Check the response status code
                    $statusCode = $response->getStatusCode();

                    if ($statusCode == 200) {
                        $data = json_decode($response->getBody()->getContents(), true);
                        // echo "<pre>";print_r($data);exit;
                        if ($data['status'] == 1) {

                            return redirect()->route('specialday')->with('success', $data['message']);

                        } elseif ($data['status'] == 2) {
                            return back()->with('error', $data['message']);
                        } else {
                            return back()->with('error', $data['message']);
                        }



                    } else {
                   }

                  }


                } catch (RequestException $e) {
                    $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
                } catch (\Exception $e) {
                    $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
                }

    }

    public function myorders()
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] = "Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        try {
        if (session()->has('userdata')) {
            $user = session()->get('userdata');
            $client = new Client();
            $response = $client->post($nodeappUrl.'my_orders', [
            'json' => [
            'user_id' => $user['id'],
            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $orderarray = json_decode($response->getBody()->getContents(), true);
                $orders=$orderarray['data'];

            } else {
           }

          }


        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }

        return view('aboutuser.myorder', compact('title','data_arr','orders'));

    }
    public function orderd_deatils($id)
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] = "Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        try {
            if (session()->has('userdata')) {
                $user = session()->get('userdata');
                $client = new Client();
                $response = $client->post($nodeappUrl.'order_details', [
                'json' => [
                'user_id' => $user['id'],
                'cart_id'=>$id
                ]
                ]);

                // Check the response status code
                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $orderarray = json_decode($response->getBody()->getContents(), true);
                    $orderDetails=$orderarray['data'];
                } else {
               }

              }


            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }


        return view('aboutuser.orderdetails', compact('title','data_arr','orderDetails'));

    }
    public function loginsubmit(Request $request)
    {
        $nodeappUrl = env('NODE_APP_URL');

        try {
            $client = new Client();
            $response = $client->post($nodeappUrl . 'login', [
                'json' => [
                    'user_phone' => $request->mobile,
                    'country_code' => $request->country_code,
                    'dialcode' => "",
                    'device_id' => ""
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                if ($data['status'] == 1) {

                    return redirect()->route('loginotp', ['id' => $data['data']['id']]);
                } elseif ($data['status'] == 2) {
                    return redirect()->route('register');
                } else {
                    return back()->with('error', $data['message']);
                }
            } else {
                return back()->with('error', 'Unexpected response from server.');
            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception
            return back()->with('error', 'Request failed: ' . $errorMessage);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred
            return back()->with('error', 'An error occurred: ' . $errorMessage);
        }
    }

    public function registeruser(Request $request)
    {
        $nodeappUrl = env('NODE_APP_URL');

        // Define validation rules
        $rules = [
            'name' => 'required',
            'user_email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits_between:10,15',
            'privacy_policy_flag' => 'accepted'
        ];

        // Define custom error messages (optional)
        $messages = [
            'name.required' => 'The name field is required.',
            'user_email.required' => 'The email field is required.',
            'user_email.email' => 'The email must be a valid email address.',
            'mobile.required' => 'The mobile number is required.',
            'mobile.numeric' => 'The mobile number must be a valid number.',
            'mobile.digits_between' => 'The mobile number must be between 10 and 15 digits.',
            'privacy_policy_flag.accepted' => 'You must accept the privacy policy.'
        ];

        // Validate the request
        $validated = $request->validate($rules, $messages);

        try {
            $client = new Client();
            $requestData = [
                'name' => $request->name,
                'user_email' => $request->user_email,
                'user_phone' => $request->mobile,
                'dialcode' => $request->country_code,
                'privacy_policy_flag' => $request->privacy_policy_flag === 'on' ? 1 : 0, // Set 1 if privacy_policy_flag is 'on', otherwise 0
                'flag_code' => $request->selected_flag_emoji,
                'dob' => $request->dob,
                'referral_code' => $request->referral_code,
                'whatsapp_flag' => $request->has('whatsapp_flag') ? 1 : 0, // Check if whatsapp_flag exists

            ];


            $response = $client->post($nodeappUrl . 'register_details', [
                'json' => $requestData
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                if ($data['status'] == 1) {

                    return redirect()->route('loginotp', ['id' => $data['data']['id']]);
                } elseif ($data['status'] == 2) {
                    return redirect()->route('register');
                } else {
                    return back()->with('error', $data['message']);
                }
            } else {
                return back()->with('error', 'Unexpected response from server.');
            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception
            return back()->with('error', 'Request failed: ' . $errorMessage);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred
            return back()->with('error', 'An error occurred: ' . $errorMessage);
        }
    }
    public function loginotpsubmit(Request $request)
    {

        $nodeappUrl = env('NODE_APP_URL');
           $rules = [
            'otp' => 'required',
        ];

        $messages = [
            'otp.required' => 'The otp field is required.',

        ];
        $validated = $request->validate($rules, $messages);
        try {
            $client = new Client();
            $requestData = [
                'otp' => $request->otp,
                "user_phone"=> $request->user_phone,
                "country_code"=> $request->country_code,
                "dialcode"=> $request->dialcode,
                "referral_code"=>"",
                "device_id"=> $request->device_id,

            ];


            $response = $client->post($nodeappUrl . 'verify_phone', [
                'json' => $requestData
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                if ($data['status'] == 1) {

                           $client = new Client();
                            $responsenew = $client->post($nodeappUrl.'fetchuser', [
                            'json' => [
                            'user_id' => $request->userid,
                            ]
                            ]);
                            $statusCodenew = $responsenew->getStatusCode();

                            if ($statusCodenew == 200) {
                                // Response is successful, decode the JSON response
                                $datanew = json_decode($responsenew->getBody()->getContents(), true);

                                $request->session()->put('userdata', $datanew['user']);
                                return redirect()->route('home');


                            } else {
                                // Handle non-200 status code
                                // You may throw an exception or handle it according to your requirements
                            }


                } elseif ($data['status'] == 2) {

                    return redirect()->back()->with('error', $data['message']);
                } else {
                    return redirect()->back()->with('error', $data['message']);

                }
            } else {
                return back()->with('error', 'Unexpected response from server.');
            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception
            return back()->with('error', 'Request failed: ' . $errorMessage);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred
            return back()->with('error', 'An error occurred: ' . $errorMessage);
        }


    }
    public function userprofilesubmit(Request $request)
    {

        $nodeappUrl = env('NODE_APP_URL');
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'name.required' => 'The name field is required.',
        ];

        $validated = $request->validate($rules, $messages);
        try {
            $client = new Client();
            $requestData = [
                'name' => $request->name,
                'email' => $request->email,
                'user_phone' => $request->mobile,
                'country_code' => $request->country_code,
                'privacy_policy_flag' => $request->privacy_policy_flag, // Set 1 if privacy_policy_flag is 'on', otherwise 0
                'user_gender' => $request->user_gender,
                'user_id' => $request->user_id,
                'whatsapp_flag' => $request->has('whatsapp_flag') ? 1 : 0, // Check if whatsapp_flag exists
                'flag_code'=>$request->selected_flag_emoji

            ];



            $response = $client->post($nodeappUrl . 'profile_update', [
                'json' => $requestData
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                if ($data['status'] == 1) {
                    return redirect()->route('userprofile')->with('success', $data['message']);
                } elseif ($data['status'] == 2) {
                    return back()->with('error', $data['message']);
                } else {
                    return back()->with('error', $data['message']);
                }
            } else {
                return back()->with('error', 'Unexpected response from server.');
            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception
            return back()->with('error', 'Request failed: ' . $errorMessage);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred
            return back()->with('error', 'An error occurred: ' . $errorMessage);
        }

    }


    public function address()
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] = "Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        try {
        if (session()->has('userdata')) {
            $user = session()->get('userdata');
            $client = new Client();
            $response = $client->post($nodeappUrl.'show_address', [
            'json' => [
            'user_id' => $user['id'],
            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $address = json_decode($response->getBody()->getContents(), true);
                $addresses=$address['data'];
                // echo "<pre>";print_r($addresses);exit;

            } else {
           }

          }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }
        // echo "<pre>";print_r($addresses);exit;
        return view('aboutuser.useraddress', compact('title','data_arr','addresses','user'));

    }

    public function getmap($id)
    {
        return view('map');
    }

   public function addressnew($id)
   {
    $title = "Hyp-Mobility";
    $data_arr = array();
    $data_arr['title'] = "Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Dubai";
    $data_arr['keywords'] = "";
    $data_arr['description'] = "";
    $data_arr['canonical'] = "";
    $nodeappUrl = env('NODE_APP_URL');

    try {
    if (session()->has('userdata')) {
        $user = session()->get('userdata');
        $client = new Client();
        $response = $client->post($nodeappUrl.'show_address_edit', [
        'json' => [
        'address_id'=>$id,
        ]
        ]);

        // Check the response status code
        $data = json_decode($response->getBody()->getContents(), true);

        if (!empty($data)) {

            //  echo "<pre>";print_r($data);exit;
                 return view('address.address-new', compact('title','data_arr','data'));

                } else {

                }

      }
    } catch (RequestException $e) {
        $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
    }
    return view('address.address-new', compact('title','data_arr'));


   }

   public function addaddress(Request $request)
{
    if (session()->has('userdata')) {
        $user = session()->get('userdata');

        $nodeappUrl = env('NODE_APP_URL');

        $rules = [
            'name' => 'required',
            'user_phone' => 'required',
            'cityname' => 'required',
            'vila' => 'required',
            'apartment' => 'required',
            'landmark' => 'required'
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'user_phone.required' => 'The mobile field is required.',
            'cityname.required' => 'The city name is required.',
            'vila.required' => 'The vila field is required.',
            'apartment.required' => 'The apartment field is required.',
            'landmark.required' => 'The landmark field is required.',
        ];

        $validated = $request->validate($rules, $messages);

        // Prepare the data to be sent to the API
        $requestData = [
            'user_id' => $user['id'],
            'type' => $request->option,
            'receiver_name' => $request->name, // Use the validated name from the request
            'receiver_phone' => $request->user_phone,
            'city_name' => $request->cityname,
            'society_name' => $request->vila,
            'house_no' => $request->apartment,
            'landmark' => $request->landmark, // This might be overwritten later, depending on how your API behaves
            'state' => '',
            'pin' => '',
            'lat' => '25.2048', // You might need to get these coordinates dynamically
            'lng' => '25.2048', // You might need to get these coordinates dynamically
            'whome' => $request->has('whom') ? $request->whom : '' // Conditionally set 'whome' based on the request

        ];

        if (!empty($request->address_id)) {
            $requestData['address_id'] = $request->address_id;
        }

        //  echo "<pre>";print_r($requestData);exit;
        try {

            if (empty($request->address_id)) {
                $client = new Client();

                $response = $client->post($nodeappUrl . 'add_address', [
                    'json' => $requestData
                ]);
            } else {
                $client = new Client();


                $response = $client->post($nodeappUrl . 'edit_address', [
                    'json' => $requestData
                ]);
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                if ($data['status'] == 1) {

                    return redirect()->route('address')->with('success', $data['message']);
                } else {
                    return back()->with('error', $data['message']);
                }
            } else {
                return back()->with('error', 'Unexpected response from server.');
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception
            return back()->with('error', 'Request failed: ' . $errorMessage);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred
            return back()->with('error', 'An error occurred: ' . $errorMessage);
        }
    } else {
        return redirect()->route('login')->with('error', 'User not authenticated.');
    }
}



    public function  deleteaddress($addressid){
        $nodeappUrl = env('NODE_APP_URL');

        try {
        if (session()->has('userdata')) {
            $user = session()->get('userdata');
            $client = new Client();
            $response = $client->post($nodeappUrl.'remove_address', [
            'json' => [
            'user_id' => $user['id'],
            'address_id'=>$addressid,
            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                if ($data['status'] == 1) {
                    return redirect()->route('address')->with('success', $data['message']);
                } elseif ($data['status'] == 2) {
                    return back()->with('error', $data['message']);
                } else {
                    return back()->with('error', $data['message']);
                }

            } else {
           }

          }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }

    }


}
