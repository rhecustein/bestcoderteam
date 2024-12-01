@extends($active_theme)
@section('title')
    <title>{{ $seo_setting->seo_title }}</title>
@endsection

@section('title')
    <meta name="description" content="{{ $seo_setting->seo_description }}">
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
                            <h1>{{__('user.Service')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Service')}}</li>
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
        SERVICES START
    ==========================-->
    <section class="wsus__services_page mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <form action="{{ route('services') }}" id="search_service_form">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                        <div class="wsus__service_search">
                            <label>{{__('user.Location')}}</label>
                            <select name="service_area" class="select_2 search_service_item">
                                <option value="">{{__('user.Select')}}</option>

                                @if (request()->has('service_area'))
                                    @foreach ($service_areas as $service_area)
                                    <option {{ request()->get('service_area') == $service_area->slug ? 'selected' : '' }} value="{{ $service_area->slug }}">{{ $service_area->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($service_areas as $service_area)
                                    <option value="{{ $service_area->slug }}">{{ $service_area->name }}</option>
                                    @endforeach
                                @endif



                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                        <div class="wsus__service_search">
                            <label>{{__('user.Category')}}</label>
                            <select name="category" class="select_2 search_service_item">
                                <option value="">{{__('user.Select')}}</option>

                                    @if (request()->has('category'))
                                        @foreach ($categories as $category)
                                        <option {{ request()->get('category') == $category->slug ? 'selected' : '' }} value="{{ $category->slug }}">{{ $category->name }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                        <div class="wsus__service_search">
                            <label>{{__('user.Price Range')}}</label>
                            <select name="price_range" class="select_2 search_service_item">
                                <option value="">{{__('user.Select')}}</option>
                                @if (request()->has('price_range'))
                                    <option {{ request()->get('price_range') == 'high_price' ? 'selected' : '' }}  value="high_price">{{__('user.high Price')}}</option>
                                    <option {{ request()->get('price_range') == 'low_price' ? 'selected' : '' }} value="low_price">{{__('user.low Price')}}</option>
                                @else
                                    <option value="low_price">{{__('user.low Price')}}</option>
                                    <option value="high_price">{{__('user.high Price')}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-lg-3">
                        <div class="wsus__service_search ">
                            <label>{{__('user.Others')}}</label>
                            <select name="others" class="select_2 search_service_item">


                                @if (request()->has('others'))
                                    <option value="">{{__('user.Select')}}</option>
                                    <option {{ request()->get('others') == 'asc' ? 'selected' : '' }} value="asc">{{__('user.Ascending')}}</option>
                                    <option {{ request()->get('others') == 'desc' ? 'selected' : '' }} value="desc">{{__('user.Descending')}}</option>
                                @else
                                    <option value="">{{__('user.Select')}}</option>
                                    <option value="asc">{{__('user.Ascending')}}</option>
                                    <option value="desc">{{__('user.Descending')}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">

                @if ($services->count() > 0)
                    @foreach ($services as $service)
                        @if ($active_theme == 'layout2')
                            <div class="col-xl-4 col-md-6 col-lg-4">
                                <div class="wsus__single_services2">
                                    <div class="wsus__services_img2">
                                        <img src="{{ asset($service->image) }}" alt="service" class="img-fluid w-100">
                                        <a class="category" href="{{ route('services',['category'=> $service->category->slug]) }}">{{ $service->category->name }}</a>
                                    </div>
                                    <div class="wsus__services_text2">
                                        <img src="{{ $service->provider ? asset($service->provider->image) : '' }}" alt="user" class="img-fluid">
                                        <ul class="d-flex justify-content-between">
                                            <li>{{ $service->provider->name }}
                                                @php
                                                $kyc = Modules\Kyc\Entities\KycInformation::where('user_id',$service->provider->id)->where('status',1)->first();
                                                @endphp
                                                @if($kyc)
                                                    <svg class="kyc-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z"></path>
                                                    </svg>
                                                @endif
                                            </li>

                                            @php
                                                $reviewQty = $service->totalReview;
                                                $totalReview = $service->averageRating;
                                                if ($reviewQty > 0) {
                                                    $average = $totalReview;
                                                    $intAverage = intval($average);
                                                    $nextValue = $intAverage + 1;
                                                    $reviewPoint = $intAverage;
                                                    $halfReview=false;
                                                    if($intAverage < $average && $average < $nextValue){
                                                        $reviewPoint= $intAverage + 0.5;
                                                        $halfReview=true;
                                                    }
                                                }
                                            @endphp

                                            <li>
                                                @if ($reviewQty > 0)
                                                    <p>
                                                        @for ($i = 1; $i <=5; $i++)
                                                            @if ($i <= $reviewPoint)
                                                                <i class="fas fa-star"></i>
                                                            @elseif ($i> $reviewPoint )
                                                                @if ($halfReview==true)
                                                                <i class="fas fa-star-half-alt"></i>
                                                                    @php
                                                                        $halfReview=false
                                                                    @endphp
                                                                @else
                                                                <i class="far fa-star"></i>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                        <span>({{ $service->totalReview }})</span>
                                                    </p>
                                                @else
                                                    <p>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <span>({{ $service->totalReview }})</span>
                                                    </p>
                                                @endif
                                            </li>
                                        </ul>
                                        <a class="title" href="{{ route('service', $service->slug) }}">{{ $service->name }}</a>
                                        <div
                                            class="single_service_footer2 d-flex flex-wrap justify-content-between align-items-center">
                                            <span>

                                                @if ($setting->currency_position == 'before_price')
                                                    {{ $currency_icon->icon }}{{ $service->price }}
                                                @else
                                                    {{ $service->price }}{{ $currency_icon->icon }}
                                                @endif

                                            </span>
                                            <a class="common_btn2" href="{{ route('ready-to-booking', $service->slug) }}">{{__('user.Book now')}}</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xl-4 col-md-6 col-lg-4">
                                <div class="wsus__single_services">
                                    <div class="wsus__services_img">
                                        <img src="{{ asset($service->image) }}" alt="service" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__services_text">
                                        <ul class="d-flex justify-content-between">
                                            <li><a href="{{ route('services',['category'=> $service->category->slug]) }}">{{ $service->category->name }}</a></li>
                                            <li>
                                                @if ($setting->currency_position == 'before_price')
                                                    {{ $currency_icon->icon }}{{ $service->price }}
                                                @else
                                                    {{ $service->price }}{{ $currency_icon->icon }}
                                                @endif
                                            </li>
                                        </ul>
                                        <a class="title" href="{{ route('service', $service->slug) }}">{{ $service->name }}</a>
                                        <div
                                            class="single_service_footer d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="img_area">
                                                <img src="{{ $service->provider ? asset($service->provider->image) : '' }}" alt="user" class="img-fluid">
                                                <span>{{ $service->provider->name }}
                                                    @php
                                                    $kyc = Modules\Kyc\Entities\KycInformation::where('user_id',$service->provider->id)->where('status',1)->first();
                                                    @endphp
                                                    @if($kyc)
                                                        <svg class="kyc-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                            <path d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z"></path>
                                                        </svg>
                                                    @endif
                                                </span>
                                            </div>


                                            @php
                                                $reviewQty = $service->totalReview;
                                                $totalReview = $service->averageRating;
                                                if ($reviewQty > 0) {
                                                    $average = $totalReview;
                                                    $intAverage = intval($average);
                                                    $nextValue = $intAverage + 1;
                                                    $reviewPoint = $intAverage;
                                                    $halfReview=false;
                                                    if($intAverage < $average && $average < $nextValue){
                                                        $reviewPoint= $intAverage + 0.5;
                                                        $halfReview=true;
                                                    }
                                                }
                                            @endphp

                                            @if ($reviewQty > 0)
                                                <p>
                                                    @for ($i = 1; $i <=5; $i++)
                                                        @if ($i <= $reviewPoint)
                                                            <i class="fas fa-star"></i>
                                                        @elseif ($i> $reviewPoint )
                                                            @if ($halfReview==true)
                                                            <i class="fas fa-star-half-alt"></i>
                                                                @php
                                                                    $halfReview=false
                                                                @endphp
                                                            @else
                                                            <i class="far fa-star"></i>
                                                            @endif
                                                        @endif
                                                    @endfor
                                                    <span>({{ $service->totalReview }})</span>
                                                </p>
                                            @else
                                                <p>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <span>({{ $service->totalReview }})</span>
                                                </p>
                                            @endif
                                        </div>
                                        <a class="common_btn" href="{{ route('ready-to-booking', $service->slug) }}">{{__('user.Book now')}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {{ $services->links('custom_pagination') }}
                @else
                    <div class="col-12 text-center text-danger">
                        <h3>{{__('user.Service Not Found')}}</h3>
                    </div>
                @endif
            </div>

            @if ($partner_visbility)
            <div class="row mt_75 xs_mt_45">
                <div class="col-12">
                    <div class="wsus__brand_list">
                        <div class="row justify-content-center">
                            @foreach ($partners as $partner)
                                <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                                    <div class="wsus__single_brand">
                                        <a href="{{ $partner->link ? $partner->link : 'javascript:;' }}">
                                            <img src="{{ asset($partner->logo) }}" alt="brand" class="img-fluid w-100">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!--=========================
        SERVICES END
    ==========================-->




<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $(".search_service_item").on("change",function(){
                $("#search_service_form").submit();
            })
        });
    })(jQuery);



</script>
@endsection
