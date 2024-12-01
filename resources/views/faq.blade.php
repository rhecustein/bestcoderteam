@extends($active_theme)
@section('title')
    <title>{{__('user.FAQ')}}</title>
@endsection
@section('meta')
    <meta name="description" content="{{__('user.FAQ')}}">
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
                            <h1>{{__('user.FAQ')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.FAQ')}}</li>
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
        FAQ START
    ==========================-->
    <section class="wsus__faq mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__section_heading text-center mb_30">
                        <h2>{{__('user.Frequently Asked Questions')}}</h2>
                        <p>{{__('user.There are many variations of passages of Lorem Ipsum available but the majority')}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-12 col-lg-6">
                    <div class="wsus__faq_area">
                        <div class="accordion accordion-flush" id="accordionFlushExample">

                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne-{{ $faq->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne-{{ $faq->id }}" aria-expanded="false"
                                            aria-controls="flush-collapseOne-{{ $faq->id }}">
                                            {{ ++ $index }}. {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne-{{ $faq->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne-{{ $faq->id }}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            {!! clean($faq->answer) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-9 col-lg-6 mt_20 xs_mt_0">
                    <div class="wsus__sidebar" id="sticky_sidebar">
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
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{__('user.email')}}*</legend>
                                            <input type="email" name="email">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{__('user.subject')}}*</legend>
                                            <input type="text" name="subject">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{__('user.message')}}*</legend>
                                            <textarea name="message" rows="4"></textarea>
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
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        FAQ END
    ==========================-->
@endsection
