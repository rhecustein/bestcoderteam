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
                            <h1>{{__('user.Booking Information')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Booking Information')}}</li>
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
        BOOKING INFO START
    ==========================-->
    <section class="wsus__booking_info mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="wsus__booking_area">
                        <ul class="booking_bar d-flex flex-wrap">
                            <li class="active">1 <span>{{__('user.Service')}}</span></li>
                            <li class="active">2 <span>{{__('user.Information')}}</span></li>
                            <li>3 <span>{{__('user.Confirmation')}}</span></li>
                        </ul>
                        <div class="wsus__review_input mt_30 p-0 border-0">

                            @if ($setting->commission_type == 'subscription')
                                @php
                                    $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                                    $module_status = json_decode($json_module_data);
                                @endphp

                                @if ($module_status->Subscription)
                                    <form id="customer_info_form" action="{{ route('user.sub.payment', $service->slug) }}">
                                @endif

                            @else
                                <form id="customer_info_form" action="{{ route('payment', $service->slug) }}">
                            @endif

                                <h3>{{__('user.Booking Information')}}</h3>

                                <div class="row">
                                    <div class="col-xl-6">
                                        <fieldset>
                                            <legend>{{__('user.Name')}}*</legend>
                                            <input type="text" name="name">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-6">
                                        <fieldset>
                                            <legend>{{__('user.email')}}</legend>
                                            <input type="text" name="email">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-6">
                                        <fieldset>
                                            <legend>{{__('user.Phone')}}*</legend>
                                            <input type="text" name="phone">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-6">
                                        <fieldset>
                                            <legend>{{__('user.post code')}}</legend>
                                            <input type="text" name="post_code">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{__('user.your address')}}*</legend>
                                            <input type="text" name="address">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{__('user.order note')}}</legend>
                                            <textarea rows="5" name="order_note" placeholder="{{__('user.Write a order note')}}"></textarea>
                                        </fieldset>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__login_check d-flex flex-wrap mt_20">
                                            <div class="form-check">
                                                <input required class="" type="checkbox" name="agree_with"
                                                    id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{__('user.I agree with')}} <a href="{{ route('terms-and-conditions') }}">{{__('user.Terms and Conditions')}}</a>
                                                    </label>
                                            </div>

                                        </div>
                                    </div>

                                    <input type="hidden" name="extras" value="{{ $extras }}">
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul class="wsus__booking_button_area d-flex">
                        <li><a href="{{ route('ready-to-booking', $service->slug) }}" class="common_btn">{{__('user.Previous')}}</a></li>
                        <li><a href="javascript:;" id="customer_info_btn" class="common_btn">{{__('user.Next')}}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="wsus__sidebar" id="sticky_sidebar">
                        <div class="wsus__booking_summery m-0">
                            <h3>{{__('user.Booking Summery')}}</h3>
                            <ul>
                                @foreach ($package_features as $package_feature)
                                    <li>{{ $package_feature }}</li>
                                @endforeach
                            </ul>
                            <div class="wsus__booking_cost">
                                <p>{{__('user.Package Fee')}} <span>
                                @if ($setting->currency_position == 'before_price')
                                {{ $currency_icon->icon }}{{ $service->price }}
                                @else
                                {{ $service->price }}{{ $currency_icon->icon }}
                                @endif

                                </span></p>
                                <ul>
                                    @if ($extra_services->ids)
                                        @foreach ($extra_services->ids as $index => $id)
                                            <li>
                                                <p>{{ $extra_services->names[$index] }} <b>x{{ $extra_services->quantities[$index] }}</b></p> <span>{{ $currency_icon->icon }}{{ $extra_services->prices[$index] }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <h4>{{__('user.Extra Service')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $extra_services->extra_total }}
                                    @else
                                    {{ $extra_services->extra_total }}{{ $currency_icon->icon }}
                                    @endif

                                </span></h4>
                                <p>{{__('user.Subtotal')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $extra_services->sub_total }}
                                    @else
                                    {{ $extra_services->sub_total }}{{ $currency_icon->icon }}
                                    @endif

                                </span></p>
                                <h5>{{__('user.Total')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $extra_services->total }}
                                    @else
                                    {{ $extra_services->total }}{{ $currency_icon->icon }}
                                    @endif

                                </span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        BOOKING INFO END
    ==========================-->


<script>
    (function($) {
    "use strict";
        $(document).ready(function () {
            $("#customer_info_btn").on("click", function(){
                $("#customer_info_form").submit();
            })
        });
    })(jQuery);

</script>

@endsection
