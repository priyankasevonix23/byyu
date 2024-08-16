@include('layout/header')

<style>
    .hide {
        display: none;
    }
    .error-message {
        color: red;
        margin-top: 5px;
        font-size: 14px;
    }
</style>
<div class="middle_box width100">
    <section style="position: relative;">
        <div class="container" style="position: relative; z-index: 5;">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    @include('aboutuser/aboutuser-leftmenu')
                </div>
                <div class="col-lg-8 mt-5">
                    <div class="row mb-4 pb-2" style="border-bottom: 1px dashed #000;">
                        <div class="col-8 black_heading">Special Days</div>
                        <div class="col-4"><a class="red_button" style="float: right;" id="addButton" href="{{ route('specialdayadd', ['id' => 0]) }}">Add</a></div>
                    </div>
                    @if(session('error'))
                             <div class="error-message" style="margin-bottom: 20px;">{{ session('error') }}</div>
                           @endif
                           @if(session('success'))
                        <div class="success-message" style="margin-bottom: 20px; color: green;">{{ session('success') }}</div>
                    @endif


                    <!-- Hidden form to add special day -->
                    <div class="row mb-4 pb-2" id="specialDayForm" style="display: none;">
                        <div class="col-12">
                            <form>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name">

                                </div>
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" id="relationship" placeholder="Enter relationship">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                    <div class="row" style="background-color: #fff;">


                                @foreach($member as $data)
                                <div class="col-lg-6 mb-3">
                                    <div class="specialday_list">
                                        <div class="row" style="font-size: 13px;">
                                            <div class="col-lg-7">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-2" style="color: #0fb565; font-family: Metropolis-Bold; font-size: 21px;">{{ $data['name'] }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div style="float: left;width: auto;background-color: #f7ecb2;padding: 8px 20px;line-height: normal;border-radius: 100px; margin: 0 0 5px 0;">
                                                            <div style="float: left;width: auto;padding: 0 4px 0 0;">Relationship: <b>{{ $data['relation'] }}</b></div>
                                                        </div>
                                                        <div style="float: left;width: auto;background-color: #ffe1e3;padding: 8px 20px;line-height: normal;border-radius: 100px;">
                                                            <div style="float: left;width: auto;padding: 0 4px 0 0;">Date: <b>{{ $data['date_day'] }} {{ $data['date_month'] }}</b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 specialday_list_icon mt-3">
                                                    <a href="{{ route('specialdayadd', ['id' => $data['id']]) }}">
                                                        <span><img src="{{ asset('assets/images/specialdays/edit.png') }}" class="img-fluid"></span>
                                                          </a>
                                                        <a href="{{ route('deletemember', ['id' => $data['id']]) }}">
                                                        <span><img src="{{ asset('assets/images/specialdays/delete.png') }}" class="img-fluid"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-12 text-center mb-2 mt-2" style="min-height: 110px;display: flex;align-items: center;justify-content: center;">
                                                        <img src="https://byyu.b-cdn.net/{{ $data['icon'] }}" class="img-fluid" style="max-height: 100px; max-width: 120px;">
                                                    </div>
                                                    <div class="col-lg-12 text-center" style="color: #f03613; font-weight: bold; font-size: 13px; background-color: #fff; border-radius: 100px; padding: 5px 0;box-shadow: 0px 3px 0px #ffe1e3;">{{ $data['nextdays'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="profile_leftbox"></div>
    </section>
</div>

@include('layout/footer')


