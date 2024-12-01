@php
    $error_404=App\Models\ErrorPage::find(2);

    $selected_theme = Session::get('selected_theme');
    if ($selected_theme == 'theme_one'){
        $active_theme = 'layout';
    }elseif($selected_theme == 'theme_two'){
        $active_theme = 'layout2';
    }elseif($selected_theme == 'theme_three'){
        $active_theme = 'layout3';
    }else{
        $active_theme = 'layout';
    }

@endphp

@extends($active_theme)
@section('title')
    <title>{{ $error_404->page_name }}</title>
@endsection
@section('meta')
<title>{{ $error_404->page_name }}</title>
@endsection

@section('frontend-content')
        <!--=========================
        404 START
    ==========================-->
    <section class="wsus__404 mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 m-auto mb_40">
                    <div class="wsus__404_text">
                        <h2>{{ $error_404->page_number }}</h2>
                        <h4>{{ $error_404->header }}</h4>
                        <p>{{ $error_404->description }}</p>
                        <a href="{{ route('home') }}" class="common_btn">{{__('user.Go Back Home')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        404 END
    ==========================-->

@endsection
