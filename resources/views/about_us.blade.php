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
                            <h1>{{__('user.About Us')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.About Us')}}</li>
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


    @if ($work_visbility)
    <!--=========================
        WORK START
    ==========================-->
    <div class="wsus__work mt_90 xs_mt_60">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 m-auto">
                    <div class="wsus__section_heading text-center mb_20">
                        <h2>{{ $how_it_work_title }}</h2>
                        <p>{{ $how_it_work_descritpion }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach ($how_it_works as $index => $how_it_work)
            <div class="col-lg-4 col-md-6">
                <div class="wsus__work_single {{ $how_it_works->count() == ++$index ? 'last_item' : '' }}">
                    <span>
                        <img src="{{ asset($how_it_work->image) }}" alt="work icon" class="img-fluid w-100">
                    </span>
                    <h4>{{ $how_it_work->title }}</h4>
                    <p>{{ $how_it_work->description }}</p>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
    <!--=========================
        WORK END
    ==========================-->
    @endif

    @if ($about_visbility)
    <!--=========================
        ABOUT START
    ==========================-->
    <div class="wsus__about mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-12 col-lg-6">
                    <div class="wsus__about_img">
                        <img src="{{ asset($about_us_section->background_image) }}" alt="about" class="img-fluid w-100 img_1">
                        <img src="{{ asset($about_us_section->foreground_image) }}" alt="about" class="img-fluid w-100 img_2">
                        <div class="wus__about_rating">
                            <img src="{{ asset($about_us_section->client_image_one) }}" alt="about" class="img-fluid w-100 rating_img_1">
                            <img src="{{ asset($about_us_section->client_image_two) }}" alt="about" class="img-fluid w-100 rating_img_2">
                            <img src="{{ asset($about_us_section->client_image_three) }}" alt="about" class="img-fluid w-100 rating_img_3">
                            <p> {{ $about_us_section->total_rating }}
                                <span>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 col-lg-6">
                    <div class="wsus__about_text">
                        <h2>{{ $about_us_section->about_us_title }}</h2>
                        {!! clean($about_us_section->about_us) !!}

                        <a href="{{ route('contact-us') }}" class="common_btn">{{__('user.Contact Us')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
        ABOUT END
    ==========================-->
    @endif

    @if ($coundown_visibility)
    <!--=========================
        COUNTER START
    ==========================-->
    <section class="wsus__counter" style="background: url({{ asset($counter_bg_image->image) }});">
        <div class="wsus__counter_overlay">
            <div class="container">
                <div class="row">
                    @foreach ($counters as $counter)
                        <div class="col-xl-3 col-sm-6 col-lg-3">
                            <div class="wsus__single_counter">
                                <span>
                                    <img src="{{ asset($counter->icon) }}" alt="counter" class="img-fluid w-100">
                                </span>
                                <h4 class="counter">{{ $counter->number }}</h4>
                                <p>{{ $counter->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        COUNTER END
    ==========================-->
    @endif

    @if ($why_choose_visibility)
    <!--=========================
        ABOUT REASONS START
    ==========================-->
    <section class="wsus__about_reasons mt_100 xs_mt_70 mb_80 xs_mb_50">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-5 col-xl-6 col-lg-6">
                    <div class="wsus__about_reasons_text">
                        <h2>{{ $why_choose_us->why_choose_us_title }}</h2>
                        <p>{!! clean($why_choose_us->why_choose_desciption) !!}</p>
                        <ul>
                            <li>
                                <h6>{{ $why_choose_us->item_one }}</h6>
                                <p>{{ $why_choose_us->description_one }}</p>
                            </li>

                            <li>
                                <h6>{{ $why_choose_us->item_two }}</h6>
                                <p>{{ $why_choose_us->description_two }}</p>
                            </li>

                            <li>
                                <h6>{{ $why_choose_us->item_three }}</h6>
                                <p>{{ $why_choose_us->description_three }}</p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-5 col-lg-6">
                    <div class="wsus__about_reasons_img">
                        <img src="{{ asset($why_choose_us->background_image) }}" alt="about reasons" class="img-fluid w-100 img_1">
                        <img src="{{ asset($why_choose_us->foreground_image) }}" alt="about reasons" class="img-fluid w-100 img_2">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        ABOUT REASONS END
    ==========================-->
    @endif


    @if ($join_as_provider_visibility)
    <!--=========================
        SELLAR JOIN START
    ==========================-->
    <section class="wsus__seller_join pt_90 xs_pt_60 pb_100 xs_pb_70" style="background: url({{ asset($join_as_a_provider->image) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="wsus__seller_join_text text-center">
                        <h3>{{ $join_as_a_provider->title }}</h3>
                        <a href="{{ route('join-as-a-provider') }}">{{ $join_as_a_provider->button_text }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        SELLAR JOIN END
    ==========================-->
    @endif

    @if ($testimonial_section->visibility)
    <!--=========================
        TESTIMONIAL START
    ==========================-->
    <section class="wsus__testimonial pt_90 xs_pt_60 pb_100 xs_pb_70"
        style="background: url({{ asset('frontend/images/testimonial_bg.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 m-auto">
                    <div class="wsus__section_heading text-center mb_50">
                        <h2>{{ $testimonial_section->title }}</h2>
                        <p>{{ $testimonial_section->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row testi_slider">
                @foreach ($testimonials as $testimonial)
                    <div class="col-xl-6">
                        <div class="wsus__single_testimonial">
                            <p class="review_text">{{ $testimonial->comment }}</p>
                            <div class="wsus__single_testimonial_img">
                                <img src="{{ asset($testimonial->image) }}" alt="clients" class="img-fluid">
                                <p><span>{{ $testimonial->name }}</span> {{ $testimonial->designation }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--=========================
        TESTIMONIAL END
    ==========================-->
    @endif
@endsection
