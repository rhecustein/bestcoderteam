@extends($active_theme)
@section('title')
    <title>{{ $service->name }}</title>
    <title>{{ $service->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $service->seo_description }}">
@endsection

@section('frontend-content')
    <!--=========================
        BREADCRUMB START
    ==========================-->
    <div class="wsus__breadcrumb" style="background: url({{ asset($breadcrumb->image) }});">
        <div class="wsus__breadcrumb_overlay pt_90 xs_pt_60 pb_95 xs_pb_65">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <h1>{{__('user.Ready to Booking')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Ready to Booking')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
        BREADCRUMB END
    ==========================-->


        <!--=========================
        BOOKING SERVICE START
    ==========================-->
    <section class="wsus__booking_service mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="wsus__booking_area">
                        <ul class="booking_bar d-flex flex-wrap">
                            <li class="active">1 <span>{{__('user.Service')}}</span></li>
                            <li>2 <span>{{__('user.Information')}}</span></li>
                            <li>3 <span>{{__('user.Confirmation')}}</span></li>
                        </ul>
                        <div class="wsus__booking_img">
                            <img src="{{ asset($service->image) }}" alt="booking images" class="img-fluid w-100">
                        </div>
                        <div class="wsus__booking_text">
                            <h2>{{ $service->name }}</h2>

                            <div class="row">
                                @if (count($what_you_will_get) > 0)
                                    <div class="col-xl-6">
                                        <div class="wsus__booking_list_text">
                                            <h3>{{__('user.What you will get')}}:</h3>
                                            <ul class="list">
                                                @foreach ($what_you_will_get as $get_item)
                                                <li>{{ $get_item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (count($benifits) > 0)
                                    <div class="col-xl-6">
                                        <div class="wsus__booking_list_text">
                                            <h3>{{__('user.Benifits of the Package')}}:</h3>
                                            <ul class="list">
                                                @foreach ($benifits as $benifit)
                                                <li>{{ $benifit }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if ($additional_services->count() > 0)
                                <div class="wsus__service_cart">
                                    <h4>{{__('user.Upgrade your order with extras')}}</h4>
                                    <div class="wsus__service_cart_bg">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th class="images">{{__('user.images')}}</th>
                                                        <th class="name">{{__('user.Service Name')}}</th>
                                                        <th class="price">{{__('user.Unit Price')}}</th>
                                                        <th class="qty">{{__('user.Quantity')}}</th>
                                                    </tr>

                                                    @foreach ($additional_services as $index => $additional_service)
                                                    <tr>
                                                        <td class="images">
                                                            <img src="{{ asset($additional_service->image) }}" alt="cart images"
                                                                class="img-fluid w-100">
                                                        </td>
                                                        <td class="name">
                                                            <div class="form-check">
                                                                <input onclick="checkExtraService({{ $additional_service->id }},{{ $additional_service->price }},'{{ $additional_service->service_name }}')" class="form-check-input" type="checkbox" value=""
                                                                    id="flexCheckDefault-{{ $index }}">
                                                                <label class="form-check-label" for="flexCheckDefault-{{ $index }}">
                                                                    {{ $additional_service->service_name }}
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="price">
                                                            <p>

                                                            @if ($setting->currency_position == 'before_price')
                                                            {{ $currency_icon->icon }}{{ $additional_service->price }}
                                                            @else
                                                            {{ $additional_service->price }}{{ $currency_icon->icon }}
                                                            @endif

                                                            </p>
                                                        </td>
                                                        <td class="qty">
                                                            <input min="1" onchange="qtyUpdate({{ $additional_service->id }}, {{ $additional_service->price }})" id="service_qty_{{ $additional_service->id }}" type="number" value="{{ $additional_service->qty }}">
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <ul class="wsus__booking_button_area d-flex">
                        <li><a href="{{ route('service', $service->slug) }}" class="common_btn">{{__('user.Previous')}}</a></li>

                        <li><a href="javascript:;" id="readyToBookingBtn" class="common_btn">{{__('user.Next')}}</a></li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__sidebar" id="sticky_sidebar">

                        <div class="wsus__booking_calendar">
                            <div id="service_available_dates"></div>
                        </div>

                        <div class="wsus__booking_pic_up mt_25">
                            <h3>{{__('user.Select Schedule')}}</h3>
                            <select id="schedule_box">
                                <option value="">{{__('user.Select')}}</option>
                            </select>
                        </div>

                        <div class="wsus__booking_summery">
                            <h3>{{__('user.Booking Summery')}}</h3>
                            <ul>
                                @foreach ($package_features as $package_feature)
                                    <li>{{ $package_feature }}</li>
                                @endforeach
                            </ul>
                            <div class="wsus__booking_cost">
                                <p class="package_fee">{{__('user.Package Fee')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $service->price }}
                                    @else
                                    {{ $service->price }}{{ $currency_icon->icon }}
                                    @endif

                                </span></p>
                                <ul class="extra_service_area">

                                </ul>
                                @php
                                    $extra_service = 0.00;
                                @endphp
                                <h4>{{__('user.Extra Service')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}<span id="extra_service_price">{{ round($extra_service, 2) }}</span>
                                    @else
                                    <span id="extra_service_price">{{ round($extra_service, 2) }}</span> {{ $currency_icon->icon }}
                                    @endif

                                </span>



                                </h4>

                                <h5>{{__('user.Total')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}<span id="total_price">{{ round($service->price + $extra_service, 2) }}</span>
                                    @else
                                    <span id="total_price">{{ round($service->price + $extra_service, 2) }}</span>{{ $currency_icon->icon }}
                                    @endif

                                </span>

                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form action="{{ route('booking-information', $service->slug) }}" id="submitReadyToBooking">
        <input type="hidden" id="input_extra_total" name="extra_total" value="{{ round($extra_service, 2) }}">
        <input type="hidden" id="input_sub_total" name="sub_total" value="{{ round($service->price, 2) }}">
        <input type="hidden" id="input_total" name="total" value="{{ round($service->price + $extra_service, 2) }}">
        <input type="hidden" id="input_date" name="date" value="">
        <input type="hidden" id="schedule_time_slot" name="schedule_time_slot" value="">

        <div id="extra_input">
        </div>
    </form>

    <!--=========================
        BOOKING SERVICE END
    ==========================-->

<script>
    let currency_icon = "{{ $currency_icon->icon }}"
    let currency_position = "{{ $setting->currency_position }}"
    let extraService = [];

    (function($) {
    "use strict";
        $(document).ready(function () {
            $("#readyToBookingBtn").on("click", function(){
                if(!$("#input_date").val()){
                    toastr.error("{{__('user.Please select a date')}}")
                    return;
                }

                if(!$("#schedule_time_slot").val()){
                    toastr.error("{{__('user.Please select a schedule')}}")
                    return;
                }

                $("#submitReadyToBooking").submit();
            })

            //Date and time
            $("#service_available_dates").flatpickr({
                minDate: "today",
                inline: true,
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "d-m-Y"
            });

            $("#service_available_dates").on("change", function(){
                let date_string = $(this).val();
                $("#input_date").val(date_string)
                let provider_id = "{{ $service->provider_id }}";
                $.ajax({
                    type: 'get',
                    data: {date : date_string, provider_id : provider_id},
                    url: "{{ route('get-available-schedule') }}",
                    success: function (response) {
                        if(response.is_available){
                            $("#schedule_box").html(response.available_schedules);
                        }else{
                            let html = `<option value="">{{__('user.Select')}}</option>`;
                            $("#schedule_box").html(html);
                            $("#schedule_time_slot").val('');

                            toastr.error("{{__('user.Schedule Not Found')}}")
                        }
                    },
                    error: function(response) {
                        let html = `<option value="">{{__('user.Select')}}</option>`;
                        $("#schedule_box").html(html);
                        $("#schedule_time_slot").val('');

                        toastr.error("{{__('user.Something went wrong')}}")
                    }
                });
            })

            $("#schedule_box").on("change", function(){
                $("#schedule_time_slot").val($(this).val());
            })

        });
    })(jQuery);

    function toISODate(d) {
             const z = n => ('0' + n).slice(-2);
             return d.getFullYear() + '-' + z(d.getMonth()+1) + '-' +
             z(d.getDate());
        }

    function checkExtraService(id, price, name){

        if(!extraService.some(service => service.id == id)){
            let qty = $("#service_qty_"+id).val();
            price = price * qty;
            let arr = {
                id : id,
                name : name,
                price : price,
                qty : qty
            };
            extraService.push(arr);
        }else{
            extraService = extraService.filter(service => service.id !== id)
        }
        loadExtraService();
    }

    function loadExtraService(){
        let html_service = '';
        let extra_price = 0;
        let extra_input = '';
        extraService.forEach(service => {
            extra_price += service.price;

            if(currency_position == 'before_price'){
                html_service += `
                    <li>
                        <p>${service.name} <b>x ${service.qty} </b></p> <span>${currency_icon}${service.price}</span>
                    </li>
                `;
            }else{
                html_service += `
                    <li>
                        <p>${service.name} <b>x ${service.qty} </b></p> <span>${service.price}${currency_icon}</span>
                    </li>
                `;
            }


            extra_input += `
                <input type="hidden" value="${service.id}" name="ids[]">
                <input type="hidden" value="${service.price}" name="prices[]">
                <input type="hidden" value="${service.qty}" name="quantities[]">
                <input type="hidden" value="${service.name}" name="names[]">
            `;
        });

        $(".extra_service_area").html(html_service);
        $("#extra_input").html(extra_input);

        $("#extra_service_price").html(extra_price);
        $("#input_extra_total").val(extra_price);


        let sub_total = $("#input_sub_total").val();
        let total_price = sub_total*1 + extra_price*1;
        $("#total_price").html(total_price);
        $("#input_total").val(total_price);


    }

    function qtyUpdate(id, new_price){
        if(extraService.some(service => service.id == id)){
            extraService = extraService.map(service => {
                let qty = service.qty;
                let price = service.price;
                if(service.id == id){
                    qty = $("#service_qty_"+id).val();
                    price = new_price * qty;
                }
                return {
                    ...service,
                    qty,
                    price
                }
            })
            loadExtraService();
        }
    }
</script>

@endsection
