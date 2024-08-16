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

use Illuminate\Support\Str;

class ProductController extends Controller

{

    protected $nodeappUrl;

    protected $loggedInUser;

    protected $summary;

    use ProfileTrait;

 

    public function __construct(){

        $this->nodeappUrl = env('NODE_APP_URL');
        $this->nodeappnewUrl = env('NODE_APP_NEW_URL');
        

    } 

    

    public function index(Request $request)

    {

        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];

        $summary = $this->getSummaryCount();
        
        if(Str::contains($request->category_id, '+')){
            $category_name = str_replace("+","-",$request->category_id);
            return redirect('product-list/'. $category_name);
        }

        $category_url = explode('-',$request->category_id);
        $category_id = end($category_url);
        array_pop($category_url);
        $category_name= ucwords(implode(' ',$category_url));



        $selectedFilters = !empty($request->selectedFilters) ? explode(',',$request->selectedFilters):[];



        $title = "";

        $data_arr = array();

        $data_arr['title'] = $category_name." | Online Gift Shops in Dubai";

        $data_arr['keywords'] = "";

        $data_arr['description'] = "";

        $data_arr['canonical'] = env('APP_URL')."product-list/".$request->category_id;

        

        

        $data=array();

        $searchfilters=array();

       

        $categoryTitle = '';

        //===========ONEAPI=================

        try {

            $client = new Client();

            if(!empty($request->subcategory_id)){
                $url = $this->nodeappnewUrl.'sub_cat_product';
            }else{
                $url = $this->nodeappnewUrl.'cat_product'; 
            }
            $response = $client->post($url, [

            'json' => [

            // Data to send in the request body

            "cat_id"=>empty($request->subcategory_id)?$category_id:$request->subcategory_id,"user_id"=>!empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',"byname"=>" ","min_price"=>"","max_price"=>"","max_rating"=>"","stock"=>"","min_discount"=>"","max_discount"=>"","min_rating"=>"","platform"=>"web","sortid"=>!empty($request->sortid) ? $request->sortid : "","pricesortid"=>!empty($request->pricesortid) ? $request->pricesortid : "","discountsortid"=>!empty($request->discountsortid) ? $request->discountsortid : "","ocassionid"=>!empty($request->occasionid) ? $request->occasionid : ""

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categoryProducts = json_decode($response->getBody()->getContents(), true);

                // print_r($categoryProducts);
                $categoryProductsNew =$categoryProducts;
                $categoryProducts = !empty($categoryProducts['data'])?$categoryProducts['data']:[];

                $categoryTitle = !empty($category_name)? $category_name:'';

                // echo "<pre>";print_r($categoryProducts);echo "</pre>";exit;

                // Process the data as needed

            } else {

                // Handle non-200 status code

                // You may throw an exception or handle it according to your requirements

            }

        } catch (RequestException $e) {

            $errorMessage = $e->getMessage();print_r($errorMessage); // Handle the exception // Log the error or return a response indicating a failure

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();print_r($errorMessage); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

        }



        try {

            $client = new Client();

            $response = $client->post($this->nodeappnewUrl.'catee', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categories = json_decode($response->getBody()->getContents(), true);

                $categories = $categories['data'];
                
                if(!empty($categories)){
                    foreach($categories as $category){
                        if($category['cat_id'] == $category_id){
                            $data_arr['description'] = $category['meta_description'];
                            $data_arr['title'] = $category['meta_title'];
                            $data_arr['image'] = isset($category['image'])? ENV('BUNNY_NET_URL').$category['image'].'?width=256&height=256':'';
                        }
                    }
                }

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

            $response = $client->post($this->nodeappUrl.'sortfillter', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $filterData = json_decode($response->getBody()->getContents(), true);

                $filterPrice = $filterData['filter_price'];

                $filterDiscount = $filterData['filter_discount'];

                $filterSort = $filterData['sort'];
                
                $filterOcassion = $filterData['ocassion'];

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

            $response = $client->post($this->nodeappUrl.'all_event', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $responseData = json_decode($response->getBody()->getContents(), true);

                $events = $responseData['data'];

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

        if($request->ajax()){
             return view('includes.filtered-product-list', compact('categoryProducts'));
        }else{
             return view('category-product-listing', compact('title','data_arr','categoryProducts','categories','categoryTitle','filterOcassion','filterPrice','filterDiscount','filterSort','selectedFilters','summary','events'));
        }

        // return view('category-product-listing', compact('title','data_arr','categoryProducts','categories','categoryTitle','filterPrice','filterDiscount','filterSort','selectedFilters','summary'));

    }



    public function eventProductListing(Request $request)

    {

        $summary = $this->getSummaryCount();

        $event_id = explode('-',$request->event_id);

        // $event_name= ucwords(str_replace('+', ' ', $event_id[0]));

        $selectedFilters = !empty($request->selectedFilters) ? explode(',',$request->selectedFilters):[];

        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];



        $title = "";

        $data_arr = array();

        $data_arr['title'] ="";

        $data_arr['keywords'] = "";

        $data_arr['description'] = "";

        $data_arr['canonical'] = env('APP_URL')."event-product-list/".$request->event_id;

        

        

        $data=array();

        $searchfilters=array();

       

        $categoryTitle = '';

        //===========ONEAPI=================

        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'event_details', [

            'json' => [

            // Data to send in the request body

            "event_id"=>!empty($event_id[1])?$event_id[1]:'',
            "user_id"=>!empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',
            "byname"=>" ","min_price"=>"","max_price"=>"","max_rating"=>"","stock"=>"","min_discount"=>"","max_discount"=>"",
            "min_rating"=>"","platform"=>"website",
            "sortid"=>!empty($request->sortid) ? $request->sortid : "",
            "pricesortid"=>!empty($request->pricesortid) ? $request->pricesortid : "",
            "discountsortid"=>!empty($request->discountsortid) ? $request->discountsortid : "",
            "ocassionid"=>!empty($request->occasionid) ? $request->occasionid : "",
            "cat_id"=>$request->cat_id,
            "cat_type"=>$request->cat_type,
            ]

            ]);

            // print_r(["event_id"=>!empty($event_id[1])?$event_id[1]:'',
            // "user_id"=>!empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',
            // "byname"=>" ","min_price"=>"","max_price"=>"","max_rating"=>"","stock"=>"","min_discount"=>"","max_discount"=>"",
            // "min_rating"=>"","platform"=>"website",
            // "sortid"=>!empty($request->sortid) ? $request->sortid : "",
            // "pricesortid"=>!empty($request->pricesortid) ? $request->pricesortid : "",
            // "discountsortid"=>!empty($request->discountsortid) ? $request->discountsortid : "",
            // "ocassionid"=>!empty($request->occasionid) ? $request->occasionid : "",
            // "cat_id"=>$request->cat_id,
            // "cat_type"=>$request->cat_type]);

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $eventDetails = json_decode($response->getBody()->getContents(), true);

                // print_r($categoryProducts);

                $eventProducts = !empty($eventDetails['productlist'])?$eventDetails['productlist']:[];

                $eventDetails = !empty($eventDetails['event_details'])?$eventDetails['event_details']:[];

                if(!empty($eventDetails)){
                    $data_arr['description'] = !empty($eventDetails['meta_description'])?$eventDetails['meta_description']:'';
                    $data_arr['title'] = !empty($eventDetails['meta_title'])?$eventDetails['meta_title']:'';
                }

                // echo "<pre>";print_r($categoryProducts);echo "</pre>";exit;

                // Process the data as needed

            } else {

                // Handle non-200 status code

                // You may throw an exception or handle it according to your requirements

            }

        } catch (RequestException $e) {

            $errorMessage = $e->getMessage();print_r($errorMessage); // Handle the exception // Log the error or return a response indicating a failure

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();print_r($errorMessage); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

        }



        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'sortfillter', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $filterData = json_decode($response->getBody()->getContents(), true);

                $filterPrice = $filterData['filter_price'];

                $filterDiscount = $filterData['filter_discount'];
                
                $filterOcassion = $filterData['ocassion'];

                $filterSort = $filterData['sort'];

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

            $response = $client->post($this->nodeappUrl.'catee', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categories = json_decode($response->getBody()->getContents(), true);

                $categories = $categories['data'];

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

        if($request->ajax()){
            $categoryProducts = $eventProducts;
            //print_r($categoryProducts);
            return view('includes.filtered-product-list', compact('categoryProducts'));
        }else{
           return view('event-product-listing', compact('title','data_arr','eventProducts','eventDetails','categoryTitle','filterOcassion','filterPrice','filterDiscount','filterSort','selectedFilters','categories','summary'));
        }


        

    }



    public function getCategories(Request $request){



        $summary = $this->getSummaryCount();



        $product_id = explode('-',$request->product_id);

        $title = "";

        $data_arr = array();

        $data_arr['title'] ="Online Gift Shops in Dubai | byyu Online Gift Store";

        $data_arr['keywords'] = "";

        $data_arr['description'] = "Shop the best at byyu Online Gift Store! Explore a variety of presents at one of the leading online gift shops in Dubai. Find your perfect gift today!";

        $data_arr['canonical'] = "https://www.byyu.com/category-listing";



        $product = array();

        try {

            $client = new Client();



            $response = $client->post($this->nodeappUrl.'catee', [

            'json' => [

            'user_id' => '',

            'page' => 1

            ]]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categories = json_decode($response->getBody()->getContents(), true);

                $categories = $categories['data'];

                //echo "<pre>";print_r($product);echo "</pre>";exit;

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

        return view('category-listing',compact('title','data_arr','categories','summary'));

    }



    public function getProductDetail(Request $request){
        $ipAddress = $request->ip();
        $client = new Client();
        $response = $client->get("http://ip-api.com/json/{$ipAddress}");
        if ($response->getStatusCode() == 200) {
            $data_ss = json_decode($response->getBody());
            $timezone = $data_ss->timezone;
        } else {
            $timezone = "";
        }
        $five_pm = Carbon::createFromFormat('h:i a', '05:00 pm', $timezone);
        $current_time = Carbon::now($timezone);
        $current_timenew = $current_time->format('h:i a');
        $current_time_carbon = Carbon::createFromFormat('h:i a', $current_timenew, $timezone);
        
        if($current_time_carbon->greaterThanOrEqualTo($five_pm)){
            $show_message = "Please order before 4:00 PM for express delivery";
        }else{
            $show_message = "Delivery within 90-120 minutes";
        }
            
        $summary = $this->getSummaryCount();
        
        if(Str::contains($request->product_id, '+')){
            $product_name = str_replace("+","-",$request->product_id);
            return redirect('product-details/'. $product_name);
        }

        $product_url = explode('-',$request->product_id);
        $product_id = end($product_url);
        array_pop($product_url);
        $product_title = implode(' ',$product_url);
        
        $title = "";
        $data_arr = array();
        $data_arr['title'] = $product_title." Online- byyu";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['image'] = "";
        $data_arr['canonical'] = env('APP_URL')."product-details/".$request->product_id;
        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];

        // Share button 1
       // $shareButtons = \Share::page(
       //      url('product-details/'.$request->product_id)
       // )
       // ->facebook()
       // ->twitter()
       // ->linkedin()
       // ->whatsapp();

        $product = array();
        try {
            $client = new Client();

            $response = $client->post($this->nodeappUrl.'product_det', [
            'json' => [
            'user_id' => !empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',
            'product_id' => !empty($product_id)?$product_id:''
            ]]);
            
            // Check the response status code
            $statusCode = $response->getStatusCode();
            
            if ($statusCode == 200) {
                // Response is successful, decode the JSON response
                $product = json_decode($response->getBody()->getContents(), true);
                $product = $product['data'];
                $data_arr['description'] = isset($product['detail']['meta_description']) ?  $product['detail']['meta_description'] : substr(strip_tags($product['detail']['description']),0,100);
                $data_arr['image'] = isset($product['detail'])? ENV('BUNNY_NET_URL').$product['detail']['product_image'].'?width=256&height=256':'';
                $data_arr['title'] = isset($product['detail']['meta_title']) ?  $product['detail']['meta_title'] : $product_title." Online- byyu";
                // echo "<pre>";print_r($product);echo "</pre>";exit;
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
        
        return view('product-details', compact('title','data_arr','product','summary','show_message'));
    }


    public function search(Request $request)

    {

        $summary = $this->getSummaryCount();



        $this->loggedInUser = !empty($request->session()->get('userdata'))? $request->session()->get('userdata'):[];

        $title = "";

        $data_arr = array();

        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gifts Store | byyu Duabi";

        $data_arr['keywords'] = "";

        $data_arr['description'] = "";

        $data_arr['canonical'] = "";

        $selectedFilters = !empty($request->selectedFilters) ? explode(',',$request->selectedFilters):[];

      

        

        $data=array();

        $searchfilters=array();

        $categoryProducts=array();

        $filterPrice = array();

        $filterDiscount = array();

        $filterSort = array();

        $search_text =  str_replace('+', ' ', $request->search_text);



        //===========ONEAPI=================

        try {

            $client = new Client();

            $response = $client->post($this->nodeappnewUrl.'searchbystore', [

            'json' => [

            // Data to send in the request body

            "cat_id"=>$request->cat_id,"cat_type"=>$request->cat_type,"store_id"=>"","keyword"=>!empty($search_text) ? $search_text : "","user_id"=>!empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',"byname"=>"","sub_cat_id"=>"","min_price"=>"","max_price"=>"","stock"=>"","min_discount"=>"","max_discount"=>"","min_rating"=>"","max_rating"=>"","sort"=>"","sortname"=>"","sortprice"=>"","sortid"=>!empty($request->sortid) ? $request->sortid : "","pricesortid"=>!empty($request->pricesortid) ? $request->pricesortid : "","discountsortid"=>!empty($request->discountsortid) ? $request->discountsortid : ""

            ]

            ]);

            //print_r(["cat_id"=>$request->cat_id,"cat_type"=>$request->cat_type,"store_id"=>"","keyword"=>!empty($search_text) ? $search_text : "","user_id"=>!empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',"byname"=>"","sub_cat_id"=>"","min_price"=>"","max_price"=>"","stock"=>"","min_discount"=>"","max_discount"=>"","min_rating"=>"","max_rating"=>"","sort"=>"","sortname"=>"","sortprice"=>"","sortid"=>!empty($request->sortid) ? $request->sortid : "","pricesortid"=>!empty($request->pricesortid) ? $request->pricesortid : "","discountsortid"=>!empty($request->discountsortid) ? $request->discountsortid : ""]);

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categoryProductsData = json_decode($response->getBody()->getContents(), true);

             //   $categoryProductNew =  $categoryProducts;

                $categoryProducts =  !empty($categoryProductsData['data'])?$categoryProductsData['data']:[];

                // echo "<pre>";print_r($categoryProducts);echo "</pre>";exit;

                // Process the data as needed

            } else {

                print_r($response->getBody()->getContents());

                // Handle non-200 status code

                // You may throw an exception or handle it according to your requirements

            }

        } catch (RequestException $e) {

            $errorMessage = $e->getMessage();echo "re";print_r($errorMessage); // Handle the exception // Log the error or return a response indicating a failure

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();print_r($errorMessage); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

        }



        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'catee', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categories = json_decode($response->getBody()->getContents(), true);

                $categories = $categories['data'];

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

            $response = $client->post($this->nodeappUrl.'sortfillter', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $filterData = json_decode($response->getBody()->getContents(), true);

                $filterPrice = $filterData['filter_price'];

                $filterDiscount = $filterData['filter_discount'];
                
                $filterOcassion = $filterData['ocassion'];

                $filterSort = $filterData['sort'];

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

        if($request->ajax()){
             return view('includes.filtered-product-list', compact('categoryProducts'));
        }else{
            return view('product-listing', compact('title','data_arr','categoryProducts','categories','filterOcassion','filterPrice','filterDiscount','filterSort','selectedFilters','summary'));
        }
    }

    

    public function productFilters(Request $request)
    {

        $summary = $this->getSummaryCount();



        $title = "";

        $data_arr = array();

        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gifts Store | byyu Duabi";

        $data_arr['keywords'] = "";

        $data_arr['description'] = "";

        $data_arr['canonical'] = "";

        

        

        $data=array();

        $searchfilters=array();

        $categoryProducts=array();

        $category_id = explode('-',$request->productfilters);

        $occasion_name = $request->occasion_name;

        $age_id ='age-'.$request->min_age.'-'.$request->max_age;

                //===========ONEAPI=================

        try {

            $client = new Client();

            $response = $client->post($this->nodeappnewUrl.'productfilters', [

            'json' => [

            "cat_id"=>$request->cat_id,"cat_type"=>$request->cat_type,"age_id"=>$age_id,"gender_id"=>$request->gender_id,"occasion_id"=>$request->occasion_id,"relationship_id"=>$request->relationship_id,"min_age"=>$request->min_age,"max_age"=>$request->max_age

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categoryProducts = json_decode($response->getBody()->getContents(), true);
                $categoryProductNew =  $categoryProducts; 
                $categoryProducts = !empty($categoryProducts['data']) ? $categoryProducts['data'] : [];

                

                // Process the data as needed

            } else {

                // Handle non-200 status code

                // You may throw an exception or handle it according to your requirements

            }

        } catch (RequestException $e) {

            $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure

            // echo $errorMessage;

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

            // echo $errorMessage;

        }



        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'catee', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categories = json_decode($response->getBody()->getContents(), true);

                $categories = $categories['data'];

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

            $response = $client->post($this->nodeappUrl.'sortfillter', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $filterData = json_decode($response->getBody()->getContents(), true);

                $filterPrice = $filterData['filter_price'];

                $filterDiscount = $filterData['filter_discount'];

                $filterSort = $filterData['sort'];

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



        return view('product-listing', compact('title','data_arr','categories','categoryProducts','categoryProductNew','filterPrice','filterDiscount','filterSort','occasion_name','summary'));

    }


    public function getproductFilters(Request $request)
    {

        $summary = $this->getSummaryCount();



        $title = "";

        $data_arr = array();

        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gifts Store | byyu Duabi";

        $data_arr['keywords'] = "";

        $data_arr['description'] = "";

        $data_arr['canonical'] = "";

        

        

        $data=array();

        $searchfilters=array();

        $category_id = explode('-',$request->productfilters);

        $occasion_name = $request->occasion_name;

        //===========ONEAPI=================

        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'cat_product', [

            'json' => [

            // Data to send in the request body

            "cat_id"=>'',"user_id"=>!empty($this->loggedInUser['id'])? $this->loggedInUser['id']:'',"byname"=>" ","min_price"=>"","max_price"=>"","max_rating"=>"","stock"=>"","min_discount"=>"","max_discount"=>"","min_rating"=>"","platform"=>"web","sortid"=>!empty($request->sortid) ? $request->sortid : "","pricesortid"=>!empty($request->pricesortid) ? $request->pricesortid : "","discountsortid"=>!empty($request->discountsortid) ? $request->discountsortid : ""

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categoryProducts = json_decode($response->getBody()->getContents(), true);

                // print_r($categoryProducts);
                $categoryProductNew =  $categoryProducts;        
                $categoryProducts = !empty($categoryProducts['data'])?$categoryProducts['data']:[];

                $categoryTitle = !empty($category_id[0])? str_replace('+', ' ', $category_id[0]):'';

                // echo "<pre>";print_r($categoryProducts);echo "</pre>";exit;

                // Process the data as needed

            } else {

                // Handle non-200 status code

                // You may throw an exception or handle it according to your requirements

            }

        } catch (RequestException $e) {

            $errorMessage = $e->getMessage();print_r($errorMessage); // Handle the exception // Log the error or return a response indicating a failure

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();print_r($errorMessage); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure

        }



        try {

            $client = new Client();

            $response = $client->post($this->nodeappUrl.'catee', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $categories = json_decode($response->getBody()->getContents(), true);

                $categories = $categories['data'];

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

            $response = $client->post($this->nodeappUrl.'sortfillter', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $filterData = json_decode($response->getBody()->getContents(), true);

                $filterPrice = $filterData['filter_price'];

                $filterDiscount = $filterData['filter_discount'];

                $filterSort = $filterData['sort'];

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



        return view('product-listing', compact('title','data_arr','categories','categoryProducts','categoryProductNew','filterPrice','filterDiscount','filterSort','occasion_name','summary'));

    }
    
    
    public function productGiftNow(Request $request)
    {

        $summary = $this->getSummaryCount();

        $title = "";
        $data_arr = array();
        $data_arr['title'] ="byyu Online Gifts Dubai | byyu Online Gifts Store | byyu Duabi";
        $data_arr['keywords'] = "";
        $data_arr['description'] = "";
        $data_arr['canonical'] = "";

        $data=array();
        $searchfilters=array();
        $categoryProducts=array();
        $category_id = explode('-',$request->productfilters);
        $occasion_name = $request->occasion_name;
        $age_id ='age-'.$request->min_age.'-'.$request->max_age;
        
        
        $data_arr['occasion_id']=$request->occasion_id;
        $data_arr['gender_id']=$request->gender_id;
        $data_arr['relationship_id']=$request->relationship_id;
        $data_arr['min_age']=$request->min_age;
        $data_arr['max_age']=$request->max_age;

        //===========Product Filters=================
        
        try {
        $client = new Client();
        $response = $client->post($this->nodeappUrl.'productfilters', [
        'json' => [
        "age_id"=>$age_id,
        "gender_id"=>$request->gender_id,
        "occasion_id"=>$request->occasion_id,
        "relationship_id"=>$request->relationship_id,
        "min_age"=>$request->min_age,
        "max_age"=>$request->max_age,
        "sortid"=>!empty($request->sortid) ? $request->sortid : "",
        "pricesortid"=>!empty($request->pricesortid) ? $request->pricesortid : "",
        "discountsortid"=>!empty($request->discountsortid) ? $request->discountsortid : "",
        "ocassionid"=>!empty($request->occasionid) ? $request->occasionid : "",
        "cat_id"=>$request->cat_id,
        "cat_type"=>$request->cat_type,
        ]
        ]);
        // Check the response status code
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $categoryProductsData = json_decode($response->getBody()->getContents(), true);
        // $categoryProductNew =  $categoryProducts; 
        $categoryProducts = !empty($categoryProductsData['data']) ? $categoryProductsData['data'] : [];
        // Process the data as needed
        } else {
        // Handle non-200 status code
        // You may throw an exception or handle it according to your requirements
        }
        } catch (RequestException $e) {
        $errorMessage = $e->getMessage(); // Handle the exception // Log the error or return a response indicating a failure
        // echo $errorMessage;
        } catch (\Exception $e) {
        $errorMessage = $e->getMessage(); // Other exceptions occurred // Handle the exception // Log the error or return a response indicating a failure
        // echo $errorMessage;
        }

        //===========Catee=================

        try {
        $client = new Client();
        $response = $client->post($this->nodeappUrl.'catee', [
        'json' => [
        // Data to send in the request body
        "page"=>"1"
        ]
        ]);
        // Check the response status code
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $categories = json_decode($response->getBody()->getContents(), true);
        $categories = $categories['data'];
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

      //===========Sort Fillter=================
    
        try {
        $client = new Client();
        $response = $client->post($this->nodeappUrl.'sortfillter', [
        'json' => [
        // Data to send in the request body
        "page"=>"1"
        ]
        ]);
        // Check the response status code
        $statusCode = $response->getStatusCode();
        if ($statusCode == 200) {
        // Response is successful, decode the JSON response
        $filterData = json_decode($response->getBody()->getContents(), true);
        $filterPrice = $filterData['filter_price'];
        $filterDiscount = $filterData['filter_discount'];
        $filterOcassion = $filterData['ocassion'];
        $filterSort = $filterData['sort'];
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

            $response = $client->post($this->nodeappUrl.'all_event', [

            'json' => [

            // Data to send in the request body

            "page"=>"1"

            ]

            ]);

            

            // Check the response status code

            $statusCode = $response->getStatusCode();

            

            if ($statusCode == 200) {

                // Response is successful, decode the JSON response

                $responseData = json_decode($response->getBody()->getContents(), true);

                $events = $responseData['data'];

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

        if($request->ajax()){
            return view('includes.filtered-product-list', compact('categoryProducts'));
        }else{
            return view('product-listing', compact('title','data_arr','categoryProducts','categories','filterOcassion','filterPrice','filterDiscount','filterSort','summary','events'));
        }
        // return view('product-listing', compact('title','data_arr','categories','categoryProducts','categoryProductNew','filterPrice','filterDiscount','filterSort','occasion_name','summary'));

    }




}