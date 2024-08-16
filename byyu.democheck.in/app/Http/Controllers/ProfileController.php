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



class ProfileController extends Controller

{

    protected $nodeappUrl;

    protected $loggedInUser;

    use ProfileTrait;

 

    public function __construct(){

        $this->nodeappUrl = env('NODE_APP_URL');

       

    } 



	public function addToWishlist(Request $request)

    {

        

        $data=array();

        $searchfilters=array();

        $product_id = $request->product_id;

        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];



        if(empty($this->loggedInUser)){
            $request->session()->put('wishlist_product_id',$product_id);
            return response()->json(array('success'=>false,'message'=>'Please logged to add item to wishlist'));
        }

        //===========ONEAPI=================

        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'add_rem_wishlist', [

            'json' => [

            	"user_id"=> $this->loggedInUser['id'],

				"varient_id"=>$request->product_id

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $addToWishlist = json_decode($response->getBody()->getContents(), true);

                return response()->json($addToWishlist);

                // Process the data as needed

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



    public function getWishlist(Request $request){

        $summary = $this->getSummaryCount();

        $wishListItems = array();

        try {

              $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];



              if(empty($this->loggedInUser)){

                  return redirect()->route('login');

              }



              $user_id= $this->loggedInUser['id'];

              $client = new Client();

              $response = $client->post($this->nodeappUrl.'show_wishlist', [

              'json' => [

              // Data to send in the request body

              "user_id"=>$this->loggedInUser['id'],

              ]

              ]);

              

              // Check the response status code

              $statusCode1 = $response->getStatusCode();

              

              if ($statusCode1 == 200) {

                  // Response is successful, decode the JSON response

                  $wishListItems = json_decode($response->getBody()->getContents(), true);

                  $wishListItems = !empty($wishListItems['data'])?$wishListItems['data']:[];

                  

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

        return view('aboutuser.wishlist',compact('wishListItems','summary'));

    }

}