@include('layout.header')

<script>

    function filter_menu() {

        var x = document.getElementById("filter_menu_box");

        if (x.className === "occassion_menu_box") {

            x.className += " occassion_menu_open";

        } else {

            x.className = "occassion_menu_box";

        }

    }

</script>



<div class="middle_box width100">

        <section class="pb-4" style="background-color: #fff; position: relative;min-height: 400px;">

            <div class="container-fluid" style="position: relative;">

                

                <div>                    
        

                    <!-- MIDDLE-CONTENT-START -->

                    <div class="about_listing_rightbox">
                         
                        <form class="filterForm" method="get" action="{{URL::current()}}"> 
                        <div style="max-height: 222px; overflow-x: hidden;">
                            <div class="row maincategory_box" style="position: relative;">
                                <div class="col-lg-12">
                                    <div class="container" style="position: relative;z-index: 5;">
                                        <div class="row">
                                            <div class="col-lg-12 mt-3 mb-2 text-center">
                                                <h1 class="black_heading" style="font-size: 25px">Online {{ucfirst($categoryTitle)}} </h1>
                                                @php  
                                                $category_url = explode('/',URL::current());
                                                $category_id = end($category_url); 
                                                $cidArr = explode('-',$category_id);
                                                $cid = end($cidArr);
                                                
                                                @endphp
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <div class="owl-carousel_catlist">
                                                    @php $subcategories = array(); @endphp
                                                    @if(!empty($categories))
                
                                                    @foreach($categories as $category)
                
                                                    @php
                                                        //echo "<pre>";print_r($category);"</pre>";
                                                        $category_slug = \Str::slug($category['title'],'-').'-'.$category['cat_id'];
                                                       
                                                        if($category_slug == $category_id){
                                                            $subcategories = !empty($category['subcategory'])?$category['subcategory']:[];
                                                            $category_id = $category['cat_id'];
                                                        }
                                                    @endphp

                                        
                                        
                                                         <div class="item">
                                                            <a href="{{url('product-list/'.$category_slug)}}" style="text-decoration: none;">
                                                            <img src="{{ENV('ADMIN_APP_URL')}}{{$category['image']}}" class="img-fluid">
                                                            </a>
                                                            <a href="{{url('product-list/'.$category_slug)}}" style="text-decoration: none;" >
                                                            <span @if($cid == $category['cat_id']) style="color:#f03613;"  @endif>{{$category['title']}}</span>
                                                            </a>
                                                        </div> 
                                                        <!--<div class="item">-->
                                                        <!--    <input type="radio" name="cattitle" id="cattitle_{{$category['cat_id']}}" @if($cid == $category['cat_id']) checked @endif>-->
                                                        <!--    <label for="cattitle_{{$category['cat_id']}}">-->
                                                        <!--        <img src="{{ENV('ADMIN_APP_URL')}}{{$category['image']}}" class="img-fluid">-->
                                                        <!--        <span>{{$category['title']}}</span>-->
                                                        <!--    </label>-->
                                                        <!--</div>-->
                                                    

                                                @endforeach    

                                                @endif

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 pt-2 pb-2" style="background-color: #f8f4e4;">
                            <div class="col-lg-12">
                                <div class="container">
                                    <div class="row" style="align-items: center;">
                                        <div class="col-lg-1 pt-1 pb-1" style="font-family: Metropolis-Bold;">BY TYPES:</div>
                                            
                                            @if(!empty($subcategories))
                                                <div class="col-lg-10 subcat_list" id="subcat_list_{{$category['cat_id']}}" >
                                                @foreach($subcategories as $subcategory)
                                                    <div class="mb-2">
                                                        <input type="radio" name="subcat" class="subcat" id="sub{{$subcategory['cat_id']}}" value="{{$subcategory['cat_id']}}">
                                                        <label for="sub{{$subcategory['cat_id']}}">{{$subcategory['title']}}</label>
                                                    </div>
                                                @endforeach
                                                </div>
                                            @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 pt-2 pb-2" style="background-color: #f8f8f8;">
                            <div class="col-lg-12">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-lg-2" style="font-size: 13px;text-transform: uppercase;font-weight: bold;">Filters:</div>
                                                <div class="col-lg-10 filter_select">
                                                    <select name="pricesortid" id="pricesortid">
                                                        <option value="">Price</option>
                                                        @if(!empty($filterPrice))
                                                        <?php $i=1; ?>
                                                        @foreach($filterPrice as $filter)
                                                        <option value="{{$filter['id']}}">{{$filter['name']}}</option>
                                                        <?php $i=$i+1; ?>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <select name="discountsortid" id="discountsortid">
                                                        <option value="">Discount</option>
                                                        @if(!empty($filterDiscount))
                                                        <?php $i=1; ?>
                                                        @foreach($filterDiscount as $filter)
                                                            <option value="{{$filter['id']}}">{{$filter['name']}}</option>
                                                        <?php $i=$i+1; ?>
                                                        @endforeach
                                                        @endif                    
                                                     
                                                    </select>
                                                    <select name="occasionid" id="occasionid">
                                                        <option value="">Occasion</option>
                                                        @if(!empty($events))
                                                        <?php $i=1; ?>
                                                        @foreach($events as $event)
                                                            <option value="{{$event['id']}}">{{$event['event_name']}}</option>
                                                        <?php $i=$i+1; ?>
                                                        @endforeach
                                                        @endif                    
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-lg-12">
                                                    <div class="sort_box">
                                                        <img src="{{ENV('APP_URL')}}assets/images/sort_icon.png" class="img-fluid" style="max-height: 11px;">
                                                        <span>SORT BY:</span>
                                                        <select name="sortid" id="sortid">
                                                            @if(!empty($filterSort))
                                                            <?php $i=1; ?> 
                                                            @foreach($filterSort as $filter)
                                                            <option value="{{$filter['id']}}">{{$filter['name']}}</option>
                                                            <?php $i=$i+1; ?>
                                                            @endforeach
                                                            @endif
                                                            <option> High to Low Price </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                        <div id="productData">
                                @include('includes.filtered-product-list', ['categoryProducts' => $categoryProducts])
                        </div>
                        

                    </div>

                    <!-- MIDDLE-CONTENT-END -->

        

                </div>



            </div>

        </section>

</div>



@include('layout.footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>  
<script type="text/javascript">
    $(document).ready(function(){
        $('#pricesortid,#discountsortid,#sortid,.subcat,#occasionid').on('change',function(){
            var form = $('.filterForm');
            var target = "#productData";
         
            form.ajaxSubmit({
                  target: target,
                  data: { pricesortid: $('#pricesortid:selected').val(),discountsortid: $('#discountsortid:selected').val(),sortid: $('#sortid:selected').val(),'occasionid': $('#occasionid:selected').val(),'subcategory_id':$('.subcat:checked').val()}
            });
        });
    });
</script>