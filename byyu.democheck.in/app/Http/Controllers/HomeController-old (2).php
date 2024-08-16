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

class HomeController extends Controller
{
 
    public function __construct(Request $request){
    //construct
    } 
    
    public function index(Request $request)
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] ="Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Duabi";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        
        $nodeappUrl = env('NODE_APP_URL');
        $data=array();
        //===========ONEAPI=================
        try {
        $client = new Client();
        $response = $client->post($nodeappUrl.'oneapi', [
        'json' => [
        // Data to send in the request body
        'user_id' => '',
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
        
       
 
        
        return view('index', compact('title','data_arr','data'));
    }

    public function getProducts(Request $request)
    {
        $title = "Hyp-Mobility";
        $data_arr = array();
        $data_arr['title'] ="Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Duabi";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        
        $nodeappUrl = env('NODE_APP_URL');
        $data=array();
        //===========ONEAPI=================
        try {
        $client = new Client();
        $response = $client->post($nodeappUrl.'oneapi', [
        'json' => [
        // Data to send in the request body
        'user_id' => '',
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
        
       
 
        
        return view('index', compact('title','data_arr','data'));
    }
    
}