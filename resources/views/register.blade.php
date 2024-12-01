@extends($active_theme)
@section('title')
    <title>{{__('user.Register')}}</title>
@endsection
@section('meta')
    <meta name="description" content="{{__('user.Register')}}">
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
                            <h1>{{__('user.Register')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Register')}}</li>
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
        SIGN IN START
    ==========================-->
    <section class="wsus__sign_in mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10 col-xxl-10 m-auto">
                    <div class="wsus__sign_in_area">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="wsus__review_input wsus__sign_in_text">
                                    <h2>{{__('user.Sign In To Kingserve')}}</h2>
                                    <p>{{__('user.Welcome back! Register with your valid data for successfully registration.')}}</p>
                                    <form method="POST" action="{{ route('store-register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <fieldset>
                                                    <legend>{{__('user.Name')}}*</legend>
                                                    <input type="text" name="name">
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-12">
                                                <fieldset>
                                                    <legend>{{__('user.Email')}}*</legend>
                                                    <input type="email" name="email">
                                                </fieldset>
                                            </div>

                                            <div class="col-xl-12">
                                                <fieldset>
                                                    <legend>{{__('user.password')}}*</legend>
                                                    <input type="password" name="password">
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
                                                <button type="submit" class="common_btn mt_20 w-100">{{__('user.Create Account')}}</button>
                                            </div>
                                        </div>
                                    </form>

                                    @if ($socialLogin->is_gmail == 1 || $socialLogin->is_facebook == 1)
                                        <span class="or">{{__('user.or')}}</span>
                                        <ul>
                                            @if ($socialLogin->is_gmail == 1)
                                                <li><a href="{{ route('login-google') }}"><i class="fab         fa-google-plus-g"></i> {{__('user.Sign In with Google')}}</a>
                                                </li>
                                            @endif
                                            @if ($socialLogin->is_facebook == 1)
                                                <li><a href="{{ route('login-facebook') }}"><i class="fab fa-facebook-f"></i> {{__('user.Sign In with Facebook')}}</a></li>
                                            @endif
                                        </ul>
                                    @endif

                                    <p class="create_account">
                                        {{__('user.Already have an account ?')}}
                                        <a href="{{ route('login') }}">{{__('user.Login')}}</a>
                                    </p>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 d-none d-lg-block">
                                <div class="wsus__sign_in_img">
                                    <img src="{{ asset($login_page->image) }}" alt="login" class="img-fluid w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        SIGN IN END
    ==========================-->
@endsection
