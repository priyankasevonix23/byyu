<?php

namespace App\Traits;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

trait ProfileTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function getSummaryCount() {

        $app_url = env('NODE_APP_URL');

        $cart_count = 0;$wishlist_count = 0;
        $cartDetail = array();
        $wishListDetail = array();

        $loggedInUser = !empty(session()->has('userdata'))? session()->get('userdata'):[];
        // $user_id= $this->loggedInUser['id'];
// print_r(session()->get('userdata'));
        if(!empty($loggedInUser['id'])){
          // echo "if";exit;
           try {

              $client = new Client();
              $response = $client->post($app_url.'app_info', [
              'json' => [
              // Data to send in the request body
              "user_id"=>$loggedInUser['id'],
              "app_name"=> "customer","platform"=> "android", "actual_device_id"=> ""
              ]
              ]);
              
              // Check the response status code
              $statusCode = $response->getStatusCode();
              
              if ($statusCode == 200) {
                  // Response is successful, decode the JSON response
                  $appInfo = json_decode($response->getBody()->getContents(), true);
                  // print_r($appInfo);
                  $cart_count = $appInfo['total_items'];
                  $wishlist_count = $appInfo['wishlist_count'];
                  
                  // print_r(array('cart_count' => $cart_count,'wishlist_count'=>$wishlist_count,'in'=>'trait'));exit;
                  return array('cart_count' => $cart_count,'wishlist_count'=>$wishlist_count);
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

          return array('cart_count' => $cart_count,'wishlist_count'=>$wishlist_count);

          // try {
          //     $this->loggedInUser = !empty(Session()->get('userdata'))? Session()->get('userdata'):[];
             
          //     if(empty($this->loggedInUser)){
          //         return redirect()->route('login');
          //     }

          //      $user_id= $this->loggedInUser['id'];
          //     $client = new Client();
          //     $response = $client->post($this->nodeappUrl.'show_wishlist', [
          //     'json' => [
          //     // Data to send in the request body
          //     "user_id"=>$this->loggedInUser['id'],
          //     ]
          //     ]);
              
          //     // Check the response status code
          //     $statusCode1 = $response->getStatusCode();
              
          //     if ($statusCode1 == 200) {
          //         // Response is successful, decode the JSON response
          //         $wishListItems = json_decode($response->getBody()->getContents(), true);
          //         $wishListItems = !empty($wishListItems['data'])?$wishListItems['data']:[];
                  
          //     } else {
          //         // Handle non-200 status code
          //         // You may throw an exception or handle it according to your requirements
          //     }
          // } catch (RequestException $e) {
          //     $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
          //     print_r($errorMessage);
          // } catch (\Exception $e) {
          //     $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
          //     print_r($errorMessage);
          // }
        }
        


    }

}