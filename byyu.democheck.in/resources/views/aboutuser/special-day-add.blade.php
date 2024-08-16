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
    .success-message {
        color: green;
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
                    <div class="row">
                        <div class="col-lg-12 black_heading mb-5 pb-2" style="border-bottom: 1px dashed #000;">
                            {{ isset($member['data']) ? 'Edit Special Day' : 'Add Special Day' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            @if(session('error'))
                                <div class="error-message" style="margin-bottom: 20px;">{{ session('error') }}</div>
                            @endif
                            @if(session('success'))
                                <div class="success-message" style="margin-bottom: 20px;">{{ session('success') }}</div>
                            @endif

                            <form method="POST" action="{{ route('specialdaysubmit') }}">
                                @csrf
                                @if(isset($member['data']))
                                    <input type="hidden" name="id" value="{{ $member['data']['id'] }}">
                                @endif

                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-6 mb-5">
                                            <div class="label_list2">
                                                <input type="text" class="input_text" formControlName="name" name="name" id="name" value="{{ $member['data']['name'] ?? '' }}">
                                                <div class="label_position">Full Name<span style="color: red;">*</span></div>
                                            </div>
                                            <div class="error-message" id="name-error">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="label_list2">
                                                <select class="input_text" formControlName="relation" name="relation" id="relation">
                                                    <option value="">Select Relation<span style="color: red;">*</span></option>
                                                    @foreach ($relations['data'] as $relation)
                                                        <option value="{{ $relation['name'] }}" {{ isset($member['data']) && $member['data']['relation'] == $relation['name'] ? 'selected' : '' }}>
                                                            {{ $relation['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="label_position">Relationship<span style="color: red;">*</span></div>
                                                <div class="error-message" id="relation-error">
                                                        @error('relation')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-5">
                                            <div class="label_list2">
                                                <select class="input_text" formControlName="celebration_name" name="celebration_name" id="celebration_name">
                                                    <option value="">Select Special Day<span style="color: red;">*</span></option>
                                                    @foreach ($celebration_events['data'] as $event)
                                                        <option value="{{ $event['celebration_name'] }}" {{ isset($member['data']) && $member['data']['celebration_name'] == $event['celebration_name'] ? 'selected' : '' }}>
                                                            {{ $event['celebration_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message" id="celebration_name-error">
                                                        @error('celebration_name')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                <div class="label_position" style="margin: -18px 0 0 4px !important;">Special Day<span style="color: red;">*</span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <div class="label_list2">
                                                <select class="input_text" formControlName="date_month" name="date_month" id="date_month">
                                                    <option disabled selected>Select</option>
                                                    <option value="January" {{ isset($member['data']) && $member['data']['date_month'] == 'January' ? 'selected' : '' }}>January</option>
                                                    <option value="February" {{ isset($member['data']) && $member['data']['date_month'] == 'February' ? 'selected' : '' }}>February</option>
                                                    <option value="March" {{ isset($member['data']) && $member['data']['date_month'] == 'March' ? 'selected' : '' }}>March</option>
                                                    <option value="April" {{ isset($member['data']) && $member['data']['date_month'] == 'April' ? 'selected' : '' }}>April</option>
                                                    <option value="May" {{ isset($member['data']) && $member['data']['date_month'] == 'May' ? 'selected' : '' }}>May</option>
                                                    <option value="June" {{ isset($member['data']) && $member['data']['date_month'] == 'June' ? 'selected' : '' }}>June</option>
                                                    <option value="July" {{ isset($member['data']) && $member['data']['date_month'] == 'July' ? 'selected' : '' }}>July</option>
                                                    <option value="August" {{ isset($member['data']) && $member['data']['date_month'] == 'August' ? 'selected' : '' }}>August</option>
                                                    <option value="September" {{ isset($member['data']) && $member['data']['date_month'] == 'September' ? 'selected' : '' }}>September</option>
                                                    <option value="October" {{ isset($member['data']) && $member['data']['date_month'] == 'October' ? 'selected' : '' }}>October</option>
                                                    <option value="November" {{ isset($member['data']) && $member['data']['date_month'] == 'November' ? 'selected' : '' }}>November</option>
                                                    <option value="December" {{ isset($member['data']) && $member['data']['date_month'] == 'December' ? 'selected' : '' }}>December</option>
                                                </select>
                                                <div class="label_position">Select Month<span style="color: red;">*</span></div>
                                                <div class="error-message" id="date_month-error">
                                                        @error('date_month')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <div class="label_list2">
                                                <select class="input_text" formControlName="date_day" name="date_day" id="date_day">
                                                    <option disabled selected>Select</option>
                                                    <!-- Day options will be dynamically updated -->
                                                </select>
                                                <div class="label_position">Date<span style="color: red;">*</span></div>
                                            </div>
                                            <div class="error-message hide" id="date-error">Please select a month first.</div>
                                            <div class="error-message" id="date_day-error">
                                                        @error('date_day')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset class="form-group mb-4">
                                    <button type="submit" class="red_button">{{ isset($member['data']) ? 'Update Special Day' : 'Add Special Day' }}</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_leftbox"></div>
    </section>
</div>
@include('layout/footer')

<script>
    $(document).ready(function() {
        function updateDaysInMonth(selectedDay) {
            var month = $('#date_month').val();
            var daysInMonth;

            switch (month) {
                case 'January': case 'March': case 'May': case 'July': case 'August': case 'October': case 'December':
                    daysInMonth = 31;
                    break;
                case 'April': case 'June': case 'September': case 'November':
                    daysInMonth = 30;
                    break;
                case 'February':
                    daysInMonth = 28; // Adjust for leap years if necessary
                    break;
                default:
                    daysInMonth = 31;
            }

            var $dateDay = $('#date_day');
            $dateDay.empty();
            $dateDay.append('<option disabled selected>Select</option>');
            for (var day = 1; day <= daysInMonth; day++) {
                $dateDay.append('<option value="' + day + '">' + day + '</option>');
            }

            if (selectedDay) {
                $dateDay.val(selectedDay);
            }

            // Hide the error message if a month is selected
            $('#date-error').addClass('hide');
        }

        $('#date_month').change(function() {
            updateDaysInMonth();
        });

        $('#date_day').focus(function() {
            if ($('#date_month').val() === null) {
                $('#date-error').removeClass('hide');
            } else {
                $('#date-error').addClass('hide');
            }
        });

        // Trigger the change event if editing an existing special day
        @if(isset($member['data']) && isset($member['data']['date_month']) && isset($member['data']['date_day']))
            $('#date_month').trigger('change');
            updateDaysInMonth('{{ $member['data']['date_day'] }}');
        @endif
    });
</script>
