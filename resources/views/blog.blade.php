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
                            <h1>{{__('user.Blog')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Blog')}}</li>
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
        BLOG START
    ==========================-->
    <section class="wsus__blog_page mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="row">
                        @if($blogs->count() > 0)
                            @foreach ($blogs as $blog)
                                <div class="col-xl-6 col-md-6">
                                    <div class="wsus__single_blog">
                                        <div class="wsus__single_blog_img">
                                            <img src="{{ asset($blog->image) }}" alt="blog" class="img-fluid w-100">
                                        </div>
                                        <div class="wsus__single_blog_text">
                                            <ul class="d-flex flex-wrap">
                                                <li><i class="far fa-user"></i> {{__('user.By Admin')}}</li>
                                                <li><i class="far fa-comment-alt-lines"></i> {{ $blog->total_comment }} {{__('user. Comments')}}</li>
                                            </ul>
                                            <h2><a href="{{ route('blog', $blog->slug) }}">{{ $blog->title }}</a></h2>
                                            <a href="{{ route('blog', $blog->slug) }}">{{__('user.Learn More')}} <i class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{ $blogs->links('custom_pagination') }}

                        @else
                            <div class="col-12 text-center text-danger">
                                <h3>{{__('user.Blog Not Found')}}</h3>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div id="sticky_sidebar">
                        <div class="wsus__blog_search blog_sidebar m-0">
                            <h3>{{__('user.Search')}}</h3>
                            <form action="{{ route('blogs') }}">
                                <input type="text" placeholder="Search" name="search">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="wsus__related_blog blog_sidebar">
                            <h3>{{__('user.Popular Blog')}}</h3>
                            <ul>
                                @foreach ($popular_blogs as $popular_blog)
                                    <li>
                                        <img src="{{ asset($popular_blog->image) }}" alt="blog" class="img-fluid w-100">
                                        <div class="text">
                                            <a href="{{ route('blog', $popular_blog->slug) }}">{{ $popular_blog->title }}</a>
                                            <p><i class="far fa-calendar-alt"></i> {{ $popular_blog->created_at->format('d M Y') }}</p>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="wsus__blog_categori blog_sidebar">
                            <h3>{{__('user.Categories')}}</h3>
                            <ul>
                                @foreach ($categories as $category)
                                <li><a href="{{ route('blogs', ['category' => $category->slug]) }}">{{ $category->name }} <span>({{ $category->totalBlog }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="wsus__blog_newsletter" style="background: url({{ asset($subscriber->image) }});">
                            <div class="wsus__blog_newsletter_overlay">
                                <h3>{{ $subscriber->title }}</h3>
                                <p>{{ $subscriber->description }}</p>
                                <form id="subscriberForm">
                                    @csrf
                                    <input type="email" placeholder="{{__('user.Your Email')}}" name="email">
                                    <button id="subscribe_btn" type="submit" class="common_btn w-100">{{__('user.subscribe')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        BLOG END
    ==========================-->



    <script>
        (function($) {
            "use strict";
            $(document).ready(function () {
                $("#subscriberForm").on('submit', function(e){
                    e.preventDefault();
                    var isDemo = "{{ env('APP_MODE') }}"
                    if(isDemo == 'DEMO'){
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    let loading = "{{__('user.Processing...')}}"

                    $("#subscribe_btn").html(loading);
                    $("#subscribe_btn").attr('disabled',true);

                    $.ajax({
                        type: 'POST',
                        data: $('#subscriberForm').serialize(),
                        url: "{{ route('subscribe-request') }}",
                        success: function (response) {
                            if(response.status == 1){
                                toastr.success(response.message);
                                let subscribe = "{{__('user.Subscribe')}}"
                                $("#subscribe_btn").html(subscribe);
                                $("#subscribe_btn").attr('disabled',false);
                                $("#subscriberForm").trigger("reset");
                            }

                            if(response.status == 0){
                                toastr.error(response.message);
                                let subscribe = "{{__('user.Subscribe')}}"
                                $("#subscribe_btn").html(subscribe);
                                $("#subscribe_btn").attr('disabled',false);
                                $("#subscriberForm").trigger("reset");
                            }
                        },
                        error: function(err) {
                            toastr.error('Something went wrong');
                            let subscribe = "{{__('user.Subscribe')}}"
                                $("#subscribe_btn").html(subscribe);
                                $("#subscribe_btn").attr('disabled',false);
                                $("#subscriberForm").trigger("reset");
                        }
                    });
                })


            });
        })(jQuery);

    </script>


@endsection
