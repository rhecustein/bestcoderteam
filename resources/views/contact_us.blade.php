
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
                            <h1>{{__('user.Contact Us')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Contact Us')}}</li>
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
        CONTACT START
    ==========================-->
    <section class="wsus__contact mt_90 xs_mt_60">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="wsus__contact_top">
                        <span><i class="fas fa-phone-alt"></i></span>
                        {!! clean(nl2br($contact->phone)) !!}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="wsus__contact_top">
                        <span><i class="fas fa-envelope"></i></span>
                        {!! clean(nl2br($contact->email)) !!}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="wsus__contact_top">
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        {!! clean(nl2br($contact->address)) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8 mt_25">
                    <div class="wsus__review_input contact_input">
                        <h4>{{__('user.Feel Free to Get in Touch')}}</h4>
                        <form method="POST" action="{{ route('send-contact-message') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <fieldset>
                                        <legend>{{__('user.Name')}}*</legend>
                                        <input type="text" name="name">
                                    </fieldset>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <fieldset>
                                        <legend>{{__('user.phone')}}</legend>
                                        <input type="text" name="phone">
                                    </fieldset>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <fieldset>
                                        <legend>{{__('user.email')}}*</legend>
                                        <input type="email" name="email">
                                    </fieldset>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <fieldset>
                                        <legend>{{__('user.subject')}}*</legend>
                                        <input type="text" name="subject">
                                    </fieldset>
                                </div>
                                <div class="col-xl-12">
                                    <fieldset>
                                        <legend>{{__('user.message')}}*</legend>
                                        <textarea name="message" rows="6"></textarea>
                                    </fieldset>
                                </div>

                                @if($recaptchaSetting->status==1)
                                    <div class="col-xl-12">
                                        <div class="wsus__single_com mt_20">
                                            <div class="g-recaptcha" data-sitekey="{{ $recaptchaSetting->site_key }}"></div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-xl-12">
                                    <button type="submit" class="common_btn mt_20">{{__('user.Send message')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 mt_25">
                    <div class="wsus__support_time">
                        <i class="fas fa-user-headset"></i>
                        <p>{{__('user.Support Time')}}
                            <span> {{ $contact->support_time }}</span>
                            {{ $contact->off_day }}
                        </p>
                        <img src="{{ asset($contact->supporter_image) }}" alt="contact img" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="contact_map mt_100 xs_mt_70">
            {!! $contact->map !!}
        </div>
    </section>
    <!--=========================
        CONTACT END
    ==========================-->

@endsection
