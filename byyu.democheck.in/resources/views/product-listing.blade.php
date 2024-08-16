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

        <section class="pt-5 pb-4" style="background-color: #fff; position: relative;min-height: 400px;">

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
                                                    <h1 class="black_heading" style="font-size: 25px">
                                                        @if(!empty(Request::get('search_text'))) {{ucfirst(str_replace('-', ' ', Request::get('search_text')))}} @endif
                                                        @if(!empty(Request::get('occasion_name'))) {{ucfirst(Request::get('occasion_name'))}} @endif
                                                    </h1>
                                                    @php  
                                                    //$category_url = explode('/',URL::current());
                                                    //$category_id = end($category_url); 
                                                    
                                                    @endphp
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <div class="owl-carousel_catlist">
                                                        @php $subcategories = array();$cid =0; @endphp
                                                        @if(!empty($categories))
                    
                                                        @foreach($categories as $index=>$category)
                    
                                                        @php
                                                            //echo "<pre>";print_r($category);"</pre>";
                                                            $category_slug = \Str::slug($category['title'],'-').'-'.$category['cat_id'];
                                                           
                                                            if($index == 0){
                                                                $cid =$category['cat_id'];
                                                                $subcategories = !empty($category['subcategory'])?$category['subcategory']:[];
                                                            }
                                                        @endphp
    
                                                                <div class="item">
                                                                    <input type="radio" name="cattitle" class="cattitle" id="cattitle_{{$category['cat_id']}}" data-category-id="{{$category['cat_id']}}" >
                                                                    <label for="cattitle_{{$category['cat_id']}}">
                                                                        <img src="{{ENV('ADMIN_APP_URL')}}{{$category['image']}}" class="img-fluid">
                                                                        <span>{{$category['title']}}</span>
                                                                    </label>
                                                                </div>
                                                             
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
                                            @if(!empty($categories))
                                            @foreach($categories as $index=>$category)
                                            
                                            @php $category_slug = \Str::slug($category['title'],'-').'-'.$category['cat_id']; @endphp
                                            @if(!empty($category['subcategory']))
                                                <div class="col-lg-10 subcat_list @if($index==0) @else d-none @endif" id="subcat_list_{{$category['cat_id']}}" >
                                                @foreach($category['subcategory'] as $subcategory)
                                                    <div class="mb-2">
                                                        <input type="radio" name="subcat" class="subcat" id="sub{{$subcategory['cat_id']}}" value="{{$subcategory['cat_id']}}">
                                                        <label for="sub{{$subcategory['cat_id']}}">{{$subcategory['title']}}</label>
                                                    </div>
                                                @endforeach
                                                </div>
                                            @endif
                                            
                                            @endforeach
                                            @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                            <input type="hidden" name="search_text" value="@if(!empty(Request::get('search_text'))) {{ucfirst(Request::get('search_text'))}} @endif">
                            <input type="hidden" value="<?php echo @$data_arr['occasion_id'];?>" name="occasion_id">
                            <input type="hidden" value="<?php echo @$data_arr['gender_id'];?>" name="gender_id">
                            <input type="hidden" value="<?php echo @$data_arr['relationship_id'];?>" name="relationship_id">
                            <input type="hidden" value="<?php echo @$data_arr['min_age'];?>" name="min_age">
                            <input type="hidden" value="<?php echo @$data_arr['max_age'];?>" name="max_age">
                            <input type="hidden" value="{{$cid}}" name="cat_id" id="cat_id">
                            <input type="hidden" value="parent" name="cat_type" id="cat_type">
                            
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
                                                        @php
                                                        $occasion_id = explode('-',@$data_arr['occasion_id']);
                                                        @endphp
                                                        <select name="occasionid" id="occasionid">
                                                            <option value="">Occasion</option>
                                                            @if(!empty($filterOcassion))
                                                            <?php $i=1; 
                                                            ?>
                                                            @foreach($filterOcassion as $filter)
                                                                <option value="{{$filter['id']}}" @if(!empty($occasion_id[1]) && $filter['id'] == trim($occasion_id[1])) selected @endif>{{$filter['name']}}</option>
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
        $('.cattitle').on('change',function(){
            var cat_id = $(this).data('category-id');
            $('#cat_id').val(cat_id);
            $('#cat_type').val('parent');
            $('.subcat_list').addClass('d-none');
            $('#subcat_list_'+cat_id).removeClass('d-none');
            
            var form = $('.filterForm');
            var target = "#productData";
            form.ajaxSubmit({
                  target: target,
                  data: { pricesortid: $('#pricesortid:selected').val(),discountsortid: $('#discountsortid:selected').val(),sortid: $('#sortid:selected').val(),'occasionid': $('#occasionid:selected').val()}
            });
        });
        
        $('.subcat').on('change',function(){
            var cat_id = $(this).data('category-id');
            $('#cat_id').val($(this).val());
            $('#cat_type').val('sub');
            var form = $('.filterForm');
            var target = "#productData";
         
            form.ajaxSubmit({
                  target: target,
                  data: { pricesortid: $('#pricesortid:selected').val(),discountsortid: $('#discountsortid:selected').val(),sortid: $('#sortid:selected').val(),'occasionid': $('#occasionid:selected').val()}
            });
        });
        
        $('#pricesortid,#discountsortid,#sortid,#occasionid').on('change',function(){
            var form = $('.filterForm');
            var target = "#productData";
         
            form.ajaxSubmit({
                  target: target,
                  data: { pricesortid: $('#pricesortid:selected').val(),discountsortid: $('#discountsortid:selected').val(),sortid: $('#sortid:selected').val(),'occasionid': $('#occasionid:selected').val()}
            });
        });
    });
</script>
