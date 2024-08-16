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

class LoginController extends Controller
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
            $title = "byyu";
            $data_arr = array();
            $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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

                // echo "<pre>";print_r($data['data'][0]);exit;

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


    public function login(Request $request)
    {
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
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
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gift Store | byyu Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        $nodeappUrl = env('NODE_APP_URL');

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
        $user=$data['user'];

        return view('login.login-otp', compact('title', 'data_arr','user'));
    }


    public function register(Request $request)
    {
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
        return view('register', compact('title','data_arr','data'));


    }



}
