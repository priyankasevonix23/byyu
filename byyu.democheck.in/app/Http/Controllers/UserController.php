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
use App\Traits\ProfileTrait;
use Illuminate\Support\Facades\Crypt; // Import the Crypt facade if you want to use Laravel's encryption



class UserController extends Controller
{

    use ProfileTrait;

    public function __construct(Request $request){

    //construct
    }
    public function logingoogle(){
        return Socialite::driver('google')->redirect();

    }
    
    public function callback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
                            // echo "<pre>";print_r($user);exit;
            // Now you can access user information like name, email, etc.
            $title = "byyu";
            $data_arr = array();
            $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gifts Store | byyu Duabi";
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
                return redirect()->route('home');
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
    
    public function loginuser(Request $request,$id)
    {
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
                return response()->json([
                    'status' => 1,
                    'message' => 'Login successful',
                ]);

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
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="Login - Online Gift Shops in Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "Discover a world of gifts! Login to our online gift shop in Dubai for a curated selection of unique presents. Explore now for special surprises!";
        $data_arr['canonical'] = "https://www.byyu.com/login";

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
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        $user= array();
        //===========fetchuser=================
        $decodedId = base64_decode($id);
        try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'fetchuser', [
            'json' => [
            // Data to send in the request body
            'user_id' => $decodedId,
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


    public function register(Request $request,$id = null)
    {
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gifts Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        $data=array();
        //===========current location fetch api=================
        $decodedId = base64_decode($id);
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
        
        $userdataDetails=array();
        $client = new Client();
        $response = $client->post($nodeappUrl.'fetchuser', [
        'json' => [
        'user_id' => $decodedId,
        ]
        ]);
        
        // Check the response status code
        $statusCode = $response->getStatusCode();
        
        if ($statusCode == 200) {
        $userdata1 = json_decode($response->getBody()->getContents(), true);
        if(@$userdata1['user']){
        $userdataDetails=$userdata1['user'];
        }
        }

        
        
        
        return view('register', compact('title','data_arr','data','userdataDetails'));


    }

    public function userprofile()
    {
       // echo session()->get('targetPage');
        $summary = $this->getSummaryCount();

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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


        return view('aboutuser.userprofile', compact('title', 'data','data_arr','userdata','summary'));
    }
    
    public function specialday()
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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


                } else {
               }

              }


            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }


        return view('aboutuser.special-day', compact('title','data_arr','member','summary'));

    }
    
    public function referralearn()
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        
        $user = session()->get('userdata');
        $data=array();
        try {
        $client = new Client();
        $response = $client->post($nodeappUrl.'app_info', [
        'json' => [
        // Data to send in the request body
        "app_name"=>"customer",
        "platform"=>"android",
        "actual_device_id"=>"TP1A.220624.014",
        "user_id"=> $user['id'],
        "app_link"=>""
        ]
        ]);
        
        // Check the response status code
        $statusCode = $response->getStatusCode();
        
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $data = json_decode($response->getBody()->getContents(), true);
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

        $member=$data;
        return view('aboutuser.referralearn', compact('title','data_arr','member','summary'));

    }
    
    public function usercontactus()
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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


                } else {
               }

              }


            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }


        return view('aboutuser.user-contact-us', compact('title','data_arr','member','summary'));

    }

    public function wallet()
    {
        $summary = $this->getSummaryCount();

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        try {
            if (session()->has('userdata')) {
                $user = session()->get('userdata');
                $client = new Client();
                $response = $client->post($nodeappUrl . 'cash_reward_wallet_history', [
                    'json' => [
                        'user_id' => $user['id'],
                    ]
                ]);

                // Check the response status code
                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $wallet = json_decode($response->getBody()->getContents(), true);

                    // Pass the data to the view
                    return view('aboutuser.wallet', compact('title', 'data_arr', 'wallet','summary'));

                } else {
                    // Handle non-200 status codes
                    $errorMessage = "Error: Received status code $statusCode";
                    return view('aboutuser.wallet', compact('title', 'data_arr', 'errorMessage','summary'));
                }
            }
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception
            return view('aboutuser.wallet', compact('title', 'data_arr', 'errorMessage'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred
            return view('aboutuser.wallet', compact('title', 'data_arr', 'errorMessage','summary'));
        }
    }

    public function  deletemember($id)
    {
        $nodeappUrl = env('NODE_APP_URL');

        try {
        if (session()->has('userdata')) {
            $user = session()->get('userdata');
            $client = new Client();
            $response = $client->post($nodeappUrl.'delete_member', [
            'json' => [
            'user_id' => $user['id'],
            'mem_id'=>$id,
            ]
            ]);

            // Check the response status code
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                if ($data['status'] == 1) {
                    return redirect()->route('specialday')->with('success', $data['message']);
                } elseif ($data['status'] == 2) {
                    return redirect()->back()->with('success', $data['message']);

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
    
    public function specialdayadd($id)
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        try {
            if (session()->has('userdata')) {
                $user = session()->get('userdata');
                $client = new Client();
                // get celebration
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


                } else {
               }
                //get members
                $responsemember = $client->post($nodeappUrl.'edit_member', [
                    'json' => [
                    'id' => $id,
                    ]
                    ]);

                    // Check the response status code
                    $statusCodemember = $responsemember->getStatusCode();

                    if ($statusCodemember == 200) {
                        $member = json_decode($responsemember->getBody()->getContents(), true);


                    } else {
                   }


              }
            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }

                            //  echo "<pre>";print_r($member);exit;

        return view('aboutuser.special-day-add', compact('title','data_arr','celebration_events',"relations",'member','summary'));

    }
    
    public function specialdaysubmit(Request $request)
    {


             $nodeappUrl = env('NODE_APP_URL');
             $rules = [
                'name' => 'required',
                'relation' => 'required',
                'celebration_name' => 'required',
                'date_day' => 'required|numeric|min:1|max:31',
                'date_month' => 'required',
            ];

            $messages = [
                'name.required' => 'The name field is required.',
                'relation.required' => 'The relation field is required.',
                'celebration_name.required' => 'The celebration name field is required.',
                'date_day.required' => 'The day field is required.',
                'date_day.numeric' => 'The day must be a number.',
                'date_day.min' => 'The day must be at least :min.',
                'date_day.max' => 'The day may not be greater than :max.',
                'date_month.required' => 'The month field is required.',
                'date_month.numeric' => 'The month must be a number.',
                'date_month.min' => 'The month must be at least :min.',
                'date_month.max' => 'The month may not be greater than :max.',
            ];

            $validated = $request->validate($rules, $messages);
             try {

                if (session()->has('userdata')) {


                    $user = session()->get('userdata');
                    $client = new Client();
                    
                    if($request->relation == 'Others'){
                      $relation=$request->otherrelation;
                    }else
                    {
                     $relation=$request->relation;   
                    }
                    
                    $responseData= [
                        'user_id' => $user['id'],
                        'name' => $request->name,
                        'relation' => $relation,
                        'celebration_name' => $request->celebration_name,
                        'date_day' => $request->date_day,
                        'date_month' => $request->date_month,
                        'date_year' => "",
                    ];
                    if ($request->has('id') && !is_null($request->input('id'))) {
                             $responseData['mem_id']=$request->id;
                     }
                //    echo "<pre>";print_r($responseData);exit;


                    if ($request->has('id') && !is_null($request->input('id'))) {
                        $response = $client->post($nodeappUrl.'update_member', [
                            'json' =>$responseData
                            ]);
                    } else {
                        $response = $client->post($nodeappUrl.'add_member', [
                            'json' =>$responseData
                            ]);
                    }

                    // Check the response status code
                    $statusCode = $response->getStatusCode();

                    if ($statusCode == 200) {
                        $data = json_decode($response->getBody()->getContents(), true);
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
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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

        return view('aboutuser.myorder', compact('title','data_arr','orders','summary'));

    }
    
    public function orderd_deatils($id)
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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
                    // echo "<pre>";print_r($orderDetails);exit;
                } else {
               }

              }


            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }


        return view('aboutuser.orderdetails', compact('title','data_arr','orderDetails','summary'));

    }
    
    public function loginsubmit(Request $request)
    {
        $nodeappUrl = env('NODE_APP_URL');
        $rules = [
            'mobile' => 'required|numeric'
        ];

        $messages = [
            'mobile.required' => 'The mobile field is required.',
            'mobile.numeric' => 'The mobile field must be a number.'
        ];

        $validated = $request->validate($rules, $messages);


        try {
            $client = new Client();
            $response = $client->post($nodeappUrl . 'login', [
                'json' => [
                    'user_phone' => $request->mobile,
                    'country_code' => $request->country_code,
                    'dialcode' => "",
                    'device_id' => "",
                    'reactivate'=> $request->reactivate
                ]
            ]);

            $statusCode = $response->getStatusCode();


            if ($statusCode == 200) {

                $data = json_decode($response->getBody()->getContents(), true);
                if ($data['status'] == 1) {
                    $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 24);
                    $combinedString = $data['data']['id'] . $randomString;
                    $encodedId = base64_encode($combinedString);
                    $userString = substr($encodedId, 0, 32);
                    return redirect()->route('loginotp', ['id' => $userString]);
                } elseif ($data['status'] == 2) {
                    $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 24);
                    $combinedString = $data['user_id'];
                    $encodedId = base64_encode($combinedString);
                    $userString = substr($encodedId, 0, 32);
                    return redirect()->route('register', ['id' => $userString]);

                } else {
                    return back()->with('alert', $data['message']);
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
    
    public function contactus(Request $request)
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="Contact Us | Online Gift Shops in Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "Have questions? Get in touch with us! Discover top-notch service at our online gift shops in Dubai. Reach out today for all your gifting needs.";
        $data_arr['canonical'] = "https://www.byyu.com/contact-us";
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
        return view('contactus', compact('title','data_arr','data','summary'));


    }

    public function corporategifts(Request $request)
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="Corporategift | Online Gift Shops in Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "Have questions? Get in touch with us! Discover top-notch service at our online gift shops in Dubai. Reach out today for all your gifting needs.";
        $data_arr['canonical'] = "https://www.byyu.com/contact-us";
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
        return view('corporategifts', compact('title','data_arr','data'));


    }
    
    public function offers(Request $request)
    {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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
        return view('offers', compact('title','data_arr','data','summary'));


    }
    
    public function privacypolicy(Request $request)
    {

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="Privacy Policy | Online Gift Shops in Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "Discover our trusted online gift shops in Dubai. Explore unique collections with confidence knowing your data is secured by our strict Privacy Policy.";
        $data_arr['canonical'] = "https://www.byyu.com/privacypolicy";
        $nodeappUrl = env('NODE_APP_URL');

        //===========current location fetch api=================
        
        $data=array();
        try {
        $client = new Client();
        $response = $client->post($nodeappUrl.'appprivacyNew', [
        'json' => [
        // Data to send in the request body

        ]
        ]);
        
        // Check the response status code
        $statusCode = $response->getStatusCode();
        
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $data = json_decode($response->getBody()->getContents(), true);
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
        

        return view('privacypolicy', compact('title','data_arr','data'));


    }
    
    public function termsconditions(Request $request)
    {
        $summary = $this->getSummaryCount();

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="Terms and Condition | Order Flowers Online Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "Review our Terms and Conditions before you order flowers online in Dubai. We ensure a seamless experience for your floral gifting needs.";
        $data_arr['canonical'] = "https://www.byyu.com/termsconditions";
        $nodeappUrl = env('NODE_APP_URL');

        //===========current location fetch api=================
        $user = session()->get('userdata');
        $data=array();
        try {
        $client = new Client();
        $response = $client->post($nodeappUrl.'apptermsNew', [
        'json' => [
        // Data to send in the request body

        ]
        ]);
        
        // Check the response status code
        $statusCode = $response->getStatusCode();
        
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $data = json_decode($response->getBody()->getContents(), true);
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
        

        return view('termsconditions', compact('title','data_arr','data','summary'));


    }
   
   public function comingsoon(Request $request)
   {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gift Store - byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "Explore byyu Online Gift Store for unique gifts and find the best selections at byyu Dubai. Discover quality, convenience, and exceptional service for all your gifting needs.";
        $data_arr['canonical'] = "https://www.byyu.com/comingsoon";
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
        return view('comingsoon', compact('title','data_arr','data','summary'));


    }

   public function registeruser(Request $request)
   {
        $nodeappUrl = env('NODE_APP_URL');

        // Define validation rules
        $rules = [
            'name' => 'required',
            'user_email' => 'required|email|regex:/^[\w.%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            'mobile' => 'required|numeric',
            'privacy_policy_flag' => 'accepted'
        ];

        // Define custom error messages (optional)
        $messages = [
            'name.required' => 'name field is required.',
            'user_email.required' => 'email field is required.',
            'user_email.email' => 'email must be a valid email address.',
            'user_email.regex' => 'email must be a valid email address',
            'mobile.required' => 'mobile number is required.',
            'mobile.numeric' => 'mobile number must be a valid number.',
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
                'country_code' => $request->country_code,
                'privacy_policy_flag' => $request->privacy_policy_flag === 'on' ? 1 : 0, // Set 1 if privacy_policy_flag is 'on', otherwise 0
                'flag_code' => $request->selected_flag_emoji,
                'dob' => $request->dob,
                'referral_code' => $request->referral_code,
                'whatsapp_flag' => $request->has('whatsapp_flag') ? 1 : 0, // Check if whatsapp_flag exists
                'user_gender'=>$request->user_gender

            ];
            // echo "<pre>";print_r($requestData); exit;


            $response = $client->post($nodeappUrl . 'register_details', [
                'json' => $requestData
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                if ($data['status'] == 1) {
                    $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 24);
                    $combinedString = $data['data']['id'] . $randomString;
                    $encodedId = base64_encode($combinedString);
                    $userString = substr($encodedId, 0, 32);

                    return redirect()->route('loginotp', ['id' => $userString]);
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
            // print_r($requestData);

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
				
				                $request->session()->put('userdata', $datanew['user']);
                                if($request->session()->get('wishlist_product_id')){
                                
                                    $client = new Client();
                                    $response = $client->post($nodeappUrl.'add_rem_wishlist', [
                                    'json' => [
                                        "user_id"=> $request->userid,
                                        "varient_id"=>$request->session()->get('wishlist_product_id')
                                    ]
                                    ]);
                                    
                                    // Check the response status code
                                    $statusCode = $response->getStatusCode();
                                    
                                    if ($statusCode == 200) {
                                        // Response is successful, decode the JSON response
                                        if(session()->get('wishlist_product_id')){
                                            session()->forget('wishlist_product_id');
                                        }
                                        // Process the data as needed
                                    } 
                                
                                }

                                if($request->session()->get('targetPage')){
                                    $targetUrl = $request->session()->get('targetPage');
                                    if(session()->get('targetPage')){
                                        session()->forget('targetPage');
                                    }

                                    if($request->session()->get('addToCartData')){
                                        $data = array('user_id'=>$request->userid) + $request->session()->get('addToCartData');
                                        $client = new Client();
                                        $response = $client->post($nodeappUrl.'add_to_cart', [
                                        'json' => $data
                                        ]);

                                        // Check the response status code
                                        $statusCode = $response->getStatusCode();
                                        
                                        if ($statusCode == 200) {
                                            if(session()->get('addToCartData')){
                                                session()->forget('addToCartData');
                                            }
                                            return redirect('cart-summary');
                                        }
                                    }
                                    return redirect('cart-summary');
                                }


                                return redirect()->route('home');


                            } else {
                                // Handle non-200 status code
                                // You may throw an exception or handle it according to your requirements
                                echo "<pre>";print_r($response);echo "</pre>";exit;
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
            echo "<pre>";print_r($errorMessage);echo "</pre>";exit;
            $errorMessage = $e->getMessage(); // Handle the exception
            return back()->with('error', 'Request failed: ' . $errorMessage);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred
            echo "<pre>";print_r($errorMessage);echo "</pre>";exit;
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
        if ($request->privacy == 0) {
            $rules['privacy_policy_flag'] = 'accepted';
            $messages['privacy_policy_flag.accepted'] = 'You must accept the privacy policy.';
        }


        $validated = $request->validate($rules, $messages);
        try {
            if (session()->has('userdata')) {
                $user = session()->get('userdata');
            $client = new Client();
            $requestData = [
                'name' => $request->name,
                'email' => $request->email,
                'user_phone' => $request->mobile,
                'dob' => $request->dob,
                'country_code' => $request->country_code,
                'privacy_policy_flag' => $request->privacy_policy_flag === 'on' ? 1 : 0, // Set 1 if 'on', otherwise 0
                'user_gender' => $request->user_gender,
                'user_id' => $user['id'],
                'whatsapp_flag' => $request->has('whatsapp_flag') ? 1 : 0, // Check if whatsapp_flag exists
                'flag_code'=>$request->selected_flag_emoji

            ];

            if ($request->privacy == 0) {
                // If privacy is 0, set privacy_policy_flag based on the value of $request->privacy_policy_flag
                $requestData['privacy_policy_flag'] = $request->privacy_policy_flag === 'on' ? 1 : 0;
            } else {
                // If privacy is not 0, set privacy_policy_flag to 1
                $requestData['privacy_policy_flag'] = 1;
            }



            $response = $client->post($nodeappUrl . 'profile_update', [
                'json' => $requestData
            ]);

            $statusCode = $response->getStatusCode();


            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                if ($data['status'] == 1) {
                    $request->session()->put('userdata', $data['data']);
                    if(!empty(session()->get('targetPage'))){

                      $url = session()->get('targetPage');
                      session()->forget('targetPage');
                        // echo "here".$url;exit;
                        return redirect($url);
                    }else{
                        return redirect()->route('userprofile')->with('success', $data['message']);    
                    }
                    
                } elseif ($data['status'] == 2) {
                    return back()->with('error', $data['message']);
                } else {
                    return back()->with('error', $data['message']);
                }
            } else {
                return back()->with('error', 'Unexpected response from server.');
            }
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
        if (session()->has('userdata')) {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        try {

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
                return view('aboutuser.useraddress', compact('title','data_arr','addresses','user','summary'));

            } else {
                return view('aboutuser.useraddress', compact('title','data_arr','user','summary'));

           }


        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }
        return view('aboutuser.useraddress', compact('title','data_arr','user','summary'));

       }else{

        return redirect()->route('login');

       }
        // echo "<pre>";print_r($addresses);exit;

    }
    
   public function giftvoucher()
   {
        if (session()->has('userdata')) {
        $summary = $this->getSummaryCount();
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

        try {

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
                return view('aboutuser.giftvoucher', compact('title','data_arr','addresses','user','summary'));

            } else {
                return view('aboutuser.giftvoucher', compact('title','data_arr','user','summary'));

           }


        } catch (RequestException $e) {
            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        }
        return view('aboutuser.giftvoucher', compact('title','data_arr','user','summary'));

       }else{

        return redirect()->route('login');

       }
        // echo "<pre>";print_r($addresses);exit;

    }
    
    public function redeemgiftvoucher(Request $request)
   {
        if (session()->has('userdata')) {
            $summary = $this->getSummaryCount();
            $title = "byyu";
            $data_arr = array();
            $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
            $data_arr['keywords'] = "";
            $data_arr['description'] = "";
            $data_arr['canonical'] = "";
            $nodeappUrl = env('NODE_APP_URL');
    
            try {
    
                $user = session()->get('userdata');
                $client = new Client();
                $response = $client->post($nodeappUrl.'reward_wallet', [
                'json' => [
                    "user_id" => $user['id'],
                    "reward_code"=>$request->gift_code,
                    "device_id"=>""
                   ]        
                ]);
    
                // Check the response status code
                $statusCode = $response->getStatusCode();
    
                if ($statusCode == 200) {
                    $redeemResponse = json_decode($response->getBody()->getContents(), true);
                    if($redeemResponse['status'] == 1){
                        return redirect()->back()->with('message',$redeemResponse['message']);
                    }else{
                        return redirect()->back()->with('error',$redeemResponse['message']);
                    }
                } 
    
            } catch (RequestException $e) {
                $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            } catch (\Exception $e) {
                $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            }

       }else{

        return redirect()->route('login');

       }
        // echo "<pre>";print_r($addresses);exit;

    }
    
   public function getmap($addresstype, $id)
   {
	   //session()->put('targetPage','cart');
        return view('map',compact('addresstype'));
    }

   public function addressnew(Request $request,$addresstype,$id)
   {
    $ipAddress = $request->ip();
        
    $client = new Client();
    $response = $client->get("http://ip-api.com/json/{$ipAddress}");
    if($response->getStatusCode() == 200){
      $data_ss = json_decode($response->getBody());
    //   print_r($data_ss);exit;
      $country_code = $data_ss->countryCode;
    }else{
      $country_code="";   
    }    
    
    $summary = $this->getSummaryCount();
    $title = "byyu";
    $data_arr = array();
    $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
    $data_arr['keywords'] = "";
    $data_arr['description'] = "";
    $data_arr['canonical'] = "";
    $nodeappUrl = env('NODE_APP_URL');
    $addressdata=array();
    try {
    if (session()->has('userdata')) {
        $user = session()->get('userdata');
        $client = new Client();
        if($id == $user['id']){
            $responsenew = $client->post($nodeappUrl.'fetchuser_addresses', [
                'json' => [
                'user_id'=>$id,
                ]
                ]);

                $addressdata = json_decode($responsenew->getBody()->getContents(), true);


                    return view('address.address-new', compact('title','data_arr','addressdata','summary','country_code'));

        }else{
            
            $response = $client->post($nodeappUrl.'show_address_edit', [
            'json' => [
            'address_id'=>$id,
            ]
            ]);
            
            $data = json_decode($response->getBody()->getContents(), true);

            
            $responsenew = $client->post($nodeappUrl.'fetchuser_addresses', [
                'json' => [
                'user_id'=>$id,
                ]
                ]);

                $addressdata = json_decode($responsenew->getBody()->getContents(), true);

                if (!empty($data)) {
                    return view('address.address-new', compact('title','data_arr','data','addressdata','summary','country_code'));
                }
        }


      }
    } catch (RequestException $e) {
        $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
    }

    return view('address.address-new', compact('title','data_arr','summary','addressdata'));


   }

   public function addaddress(Request $request)
   {
    
    // echo $request->userprofile;die();

                    //  echo "<pre>";print_r($request->all());exit;
                       

         $rules = [
            'name' => 'required',
            'user_phone' => 'required|numeric',
            'cityname' => 'required',
            'vila' => 'required',
            'apartment' => 'required',
            'street' => 'required',
            'option'=>'required',

        ];

        $messages = [
            'name.required' => 'name field is required.',
            'user_phone.required' => 'mobile field is required.',
            'user_phone.numeric' => 'mobile number must be a valid number.',
            'cityname.required' => 'city name is required.',
            'vila.required' => 'Building name field is required.',
            'apartment.required' => 'apartment field is required.',
            'street.required' => 'street field is required.',
            'option.required' => 'Type of addres field is required.',


        ];

        $validated = $request->validate($rules, $messages);

    if (session()->has('userdata')) {
        $user = session()->get('userdata');

        $nodeappUrl = env('NODE_APP_URL');

        // Prepare the data to be sent to the API
        $requestData = [
            'user_id' => $user['id'],
            'type' => $request->option,
            'receiver_name' => $request->name, // Use the validated name from the request
            'receiver_phone' => $request->user_phone,
            'cityname' => $request->cityname,
            'society_name'=>$request->street,
            'building_villa' => $request->apartment,
            'house_no' => $request->vila,
            'landmark' => $request->landmark, // This might be overwritten later, depending on how your API behaves
            'flag_code'=>$request->selected_flag_emoji,
            'country_code'=>$request->country_code,
            'city_name'=>$request->city,
            'lat'=>$request->lat,
            'lng'=>$request->lng,
            'whom'=>$request->whom,


        ];


        if (!empty($request->address_id)) {
            $requestData['address_id'] = $request->address_id;
        }else{
            $requestData['whome'] = $request->whom; // Conditionally set 'whome' based on the request

        }

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
            
            if($request->userprofile == "cart") {
            return redirect()->route('cartaddress');
            }else{
            return redirect()->route('address');
            }
            
            
            

            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);


                // if ($data['status'] == 1) {
                    
                // } else {
                //     return back()->with('error', $data['message']);
                // }
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

   public function  deleteaddress($addressid)
   {
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
                    return redirect()->back()->with('success', $data['message']);

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

    public function couponslist()
    {
        $summary = $this->getSummaryCount();

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        $data=array();
        $userdata=array();
        $couponList=array();
        
            // try {
            // $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];
            // if(empty($this->loggedInUser)){
            // return redirect()->route('login');
            // }
            
            $client = new Client();
            $response = $client->post($nodeappUrl.'couponlist', [
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
            // } catch (RequestException $e) {
            // $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
            // print_r($errorMessage);
            // } catch (\Exception $e) {
            // $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
            // print_r($errorMessage);
            // }
            // print_r($couponList);die();
  
        return view('aboutuser.couponslist', compact('title', 'data','data_arr','userdata','summary','couponList'));
    }
    
    public function updatemobilenumber(Request $request)
    {
        $summary = $this->getSummaryCount();

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
        $data=array();
        $userdata=array();
        $couponList=array();
        
        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];
        if(empty($this->loggedInUser)){
            return redirect()->route('login');
        }
            
        $userdata = array();
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
                $request->session()->put('userdata', $userdata);
            }

        }
        // print_r($userdata);exit;
  
        return view('aboutuser.updatemobilenumber', compact('title', 'data','data_arr','userdata'));
    }

    public function contactus_submit(Request $request){
        $summary = $this->getSummaryCount();

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
            
        $userdata = array();
        $client = new Client();
        $response = $client->post($nodeappUrl.'contactus_submit', [
        'json' => [
            "firstname"=>$request->firstname,
            "lastname"=>$request->lastname,
            "email"=>$request->email,
            "message"=>$request->message
        ]
        ]);

        // Check the response status code
        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $data = json_decode($response->getBody()->getContents(), true);
            if ($data['status'] == 1) {
                return redirect()->back()->with('success', $data['message']);
            } else {
                return redirect()->back()->with('error', $data['message']);
            }
        }
    }
    
    public function deleteaccount(Request $request){
        $summary = $this->getSummaryCount();

        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] = "byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');
         
        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];    
        $userdata = array();
        $client = new Client();
        $response = $client->post($nodeappUrl.'user_deactivate', [
            'json' => [
                "user_id"=>!empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',
                "activate_deactivate_status"=>"deactivate",
                "deactivate_by"=>"Customer"
            ]
        ]);

        // Check the response status code
        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $data = json_decode($response->getBody()->getContents(), true);
            if ($data['status'] == 1) {
                return  redirect()->route('logout')->with('success', $data['message']);
            } else {
                return redirect()->back()->with('error', $data['message']);
            }
        }
    }
}
