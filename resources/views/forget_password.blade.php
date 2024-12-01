@extends($active_theme)
@section('title')
    <title>{{__('user.Forget Password')}}</title>
@endsection
@section('meta')
    <meta name="description" content="{{__('user.Forget Password')}}">
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
                            <h1>{{__('user.Forget Password')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Forget Password')}}</li>
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
                <div class="col-12 col-xl-6 m-auto">
                    <div class="wsus__sign_in_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="wsus__review_input wsus__sign_in_text">
                                    <h2>{{__('user.Forget Your Password ?')}}</h2>
                                    <p>{{__('user.Did you forget your password ? Do not worry. Please submit below form using your email, and get a reset password link.')}}</p>
                                    <form method="POST" action="{{ route('send-forget-password') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <fieldset>
                                                    <legend>{{__('user.Email')}}*</legend>
                                                    <input type="email" name="email">
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
                                                <button type="submit" class="common_btn mt_20 w-100">{{__('user.Send Reset Link')}}</button>
                                            </div>
                                        </div>
                                    </form>

                                    <p class="create_account">
                                        {{__('user.Already have an account ?')}}
                                        <a href="{{ route('login') }}">{{__('user.Login')}}</a>
                                    </p>

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
