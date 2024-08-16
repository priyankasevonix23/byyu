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
use App\Traits\ProfileTrait;

class HomeController extends Controller
{
 
    protected $nodeappUrl;
    protected $loggedInUser;
    use ProfileTrait;

    public function __construct(){
        $this->nodeappUrl = env('NODE_APP_URL');
        $this->nodeappnewUrl = env('NODE_APP_NEW_URL');
    } 
    
    public function index(Request $request)
    {
        $summary = $this->getSummaryCount();
        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gift Store | Online Flowers Delivery in Dubai";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "Find the perfect gift at byyu Online Gift Store! Enjoy seamless online flowers delivery in Dubai. Explore our exquisite collection today.";
        $data_arr['canonical'] = "https://www.byyu.com/";
        
        //$nodeappUrl = env('NODE_APP_URL');
        $data=array();
        $searchfilters=array();
        //===========ONEAPI=================
        try {
            $client = new Client();
            $response = $client->post($this->nodeappnewUrl.'oneapi', [
            'json' => [
            // Data to send in the request body
            'user_id' => !empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',
            'platform'=>"web",
            ]
            ]);
            
            // Check the response status code
            $statusCode = $response->getStatusCode();
            
            if ($statusCode == 200) {
                // Response is successful, decode the JSON response
                $data = json_decode($response->getBody()->getContents(), true);
                // echo "<pre>";print_r($data);echo "</pre>";exit;
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

        try {
            $client = new Client();
            $response = $client->get($nodeappUrl.'searchfilters', []);
            
            // Check the response status code
            $statusCode = $response->getStatusCode();
            
            if ($statusCode == 200) {
                // Response is successful, decode the JSON response
                $searchfilters = json_decode($response->getBody()->getContents(), true);
                $searchfilters = $searchfilters['data'];
                // echo "<pre>";print_r($searchfilters);echo "</pre>";
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
        
        return view('index', compact('title','data_arr','data','searchfilters','summary'));
    }
    public function newindex(Request $request)
    {
        $summary = $this->getSummaryCount();
        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];
        $title = "byyu";
        $data_arr = array();
        $data_arr['title'] ="Byyu Online Gifts Dubai | Byyu Online Gifts Store | Byyu Duabi";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";
        
        $nodeappUrl = env('NODE_APP_URL');
        $data=array();
        $searchfilters=array();
        //===========ONEAPI=================
        try {
            $client = new Client();
            $response = $client->post($nodeappUrl.'oneapi', [
            'json' => [
            // Data to send in the request body
            'user_id' => !empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',
            'platform'=>"web",
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

        try {
            $client = new Client();
            $response = $client->get($nodeappUrl.'searchfilters', []);
            
            // Check the response status code
            $statusCode = $response->getStatusCode();
            
            if ($statusCode == 200) {
                // Response is successful, decode the JSON response
                $searchfilters = json_decode($response->getBody()->getContents(), true);
                $searchfilters = $searchfilters['data'];
                // echo "<pre>";print_r($searchfilters);echo "</pre>";
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
        
        return view('new-index', compact('title','data_arr','data','searchfilters','summary'));
    }

    


    
    
}