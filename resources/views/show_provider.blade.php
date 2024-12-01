@extends($active_theme)
@section('title')
    <title>{{ $provider->user_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $provider->user_name }}">
@endsection

@section('frontend-content')
    <!--=========================
        SELLAR PAGE START
    ==========================-->
    <div class="wsus__sellar_page mb_100 xs_mb_70">
        <div class="wsus__sellar_top" style="background: url({{ asset($breadcrumb->image) }});">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__sellar_top_text d-flex flex-wrap align-items-center">
                            <img src="{{ $provider->image ? asset($provider->image) : asset($default_avatar->image) }}" alt="sellar" class="img-fluid w-100">
                            <div class="text">
                                <h2>{{ $provider->user_name }}</h2>
                                <span>{{ $provider->designation }}</span>
                                @if ($show_provider_contact_info->status == 1)
                                    <a href="mailto:{{ $provider->email }}"><i class="fas fa-envelope"></i>
                                        {{ $provider->email }}</a>

                                    <a href="callto:{{ $provider->phone }}"><i class="fas fa-phone-alt"></i>
                                        {{ $provider->phone }}</a>
                                @endif


                                <p><i class="fas fa-map-marker-alt"></i> {{ $provider->address }}</p>
                                <ul class="d-flex flex-wrap">
                                    <li><i class="fas fa-box-check"></i> {{__('user.Completed Order')}} <b>{{ $complete_order }}</b></li>
                                    <li><i class="fas fa-box-check"></i> {{__('user.Canceled Order')}} <b>{{ $canceled_order }}</b></li>
                                    <li><i class="fas fa-star"></i> {{__('user.Reviews')}} <b>{{ $total_review }}</b></li>
                                </ul>
                                <div class="contact_btn_area">
                                    @auth('web')
                                    <a href="javascript:;" class="provider_contact" onclick="sendNewMessage('{{ $provider->name }}','{{ $provider->id }}', '{{ $provider->designation }}', '{{ $provider->image }}')">{{__('user.Contact Here')}}</a>
                                    @else
                                        <a href="javascript:;" class="provider_contact" onclick="sendNewMessagePrevLogin()">{{__('user.Contact Here')}}</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt_100 xs_mt_70">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__sellar_search d-flex flex-wrap justify-content-between align-items-center">
                        <h3>{{__('user.My All Services')}}</h3>

                        <form action="{{ route('providers', $provider->user_name) }}" class="d-flex flex-wrap">
                            <input value="{{ request()->has('search') ? request()->get('search') : '' }}" type="text" placeholder="{{__('user.Search Service')}}" name="search">
                            <button type="submit" class="common_btn">{{__('user.search')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($services->count() > 0)
                    @foreach ($services as $service)
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
                                            <span>{{ $service->provider->name }}</span>
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
                                    <a class="common_btn" href="{{ route('service', $service->slug) }}">{{__('user.Book now')}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $services->links('custom_pagination') }}
                @else
                    <div class="col-12 text-danger py-5">
                        <h3>{{__('user.Service Not Found')}}</h3>
                    </div>
                @endif
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
            </div>
        </div>
    </div>
    <!--=========================
        SELLAR PAGE END
    ==========================-->

@endsection
