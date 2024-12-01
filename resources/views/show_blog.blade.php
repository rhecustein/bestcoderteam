@extends($active_theme)
@section('title')
    <title>{{ $blog->title }}</title>
    <title>{{ $blog->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $blog->seo_description }}">
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
        BLOG DETAILS START
    ==========================-->
    <section class="wsus__blog_details mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="wsus__blog_det_area">
                        <div class="wsus__blog_details_img">
                            <img src="{{ asset($blog->image) }}" alt="blog details" class="imf-fluid w-100">
                        </div>
                        <div class="wsus__blog_details_text">
                            <ul class="details_bloger d-flex flex-wrap">
                                <li><i class="far fa-user"></i> {{__('user.By Admin')}}</li>
                                <li><i class="far fa-comment-alt-lines"></i> {{ $blog->total_comment }} {{__('user.Comments')}}</li>
                                <li><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('d M Y') }}</li>
                            </ul>
                            <h2>{{ $blog->title }}</h2>

                            <ul class="blog_details_list">
                                {!! clean($blog->description) !!}
                            </ul>
                            <div class="blog_tags_share d-flex flex-wrap justify-content-between align-items-center">
                                <div class="share d-flex flex-wrap align-items-center">
                                    <span>{{__('user.share')}}:</span>
                                    <ul class="d-flex flex-wrap">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog', $blog->slug) }}&t={{ $blog->title }}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('blog', $blog->slug) }}&title={{ $blog->title }}"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="https://twitter.com/share?text={{ $blog->title }}&url={{ route('blog', $blog->slug) }}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.pinterest.com/pin/create/button/?description={{ $blog->title }}&media=&url={{ route('blog', $blog->slug) }}"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="blog_det_button mt_100 xs_mt_70">

                        @if ($prevBlog)
                            <li>
                                <a href="{{ route('blog', $prevBlog->slug) }}">
                                    <img src="{{ asset($prevBlog->image) }}" alt="button img" class="img-fluid w-100">
                                    <p>{{ $prevBlog->title }}
                                        <span> <i class="far fa-long-arrow-left"></i> {{__('user.Previous')}}</span>
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if ($nextBlog)
                            <li>
                                <a href="{{ route('blog', $nextBlog->slug) }}">
                                    <p>{{ $nextBlog->title }}
                                        <span>{{__('user.next')}} <i class="far fa-long-arrow-right"></i></span>
                                    </p>
                                    <img src="{{ asset($nextBlog->image) }}" alt="button img" class="img-fluid w-100">
                                </a>
                            </li>
                        @endif
                    </ul>

                    @if ($facebookComment->comment_type == 1)
                        @if ($blog->totalComment > 0)
                            <div class="wsus__comment mt_100 xs_mt_70">
                                <h4>{{ $blog->totalComment }} {{__('user.Comments')}}</h4>

                                @foreach ($blog_comments as $blog_comment)
                                    <div class="wsus__single_comment m-0 border-0">
                                        <img src="http://www.gravatar.com/avatar" alt="review" class="img-fluid">
                                        <div class="wsus__single_comm_text">
                                            <h3>{{ html_decode($blog_comment->name) }}</h3>
                                            <p>{{ html_decode($blog_comment->comment) }}</p>
                                            <a href="javascript:;">{{ $blog_comment->created_at->format('d M Y') }}</a>
                                        </div>
                                    </div>
                                @endforeach

                                {{ $blog_comments->links('custom_pagination') }}
                            </div>
                        @endif

                        <div class="wsus__review_input comment_input mt_100 xs_mt_70">
                            <h4>{{__('user.Leave A Comment')}}</h4>
                            <p>{{__('user.Your email address will not be published. Required fields are marked')}} *</p>
                            <form id="blogCommentForm">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <fieldset>
                                            <legend>{{__('user.Name')}}*</legend>
                                            <input type="text" name="name">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-6">
                                        <fieldset>
                                            <legend>{{__('user.email')}}*</legend>
                                            <input type="email" name="email">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-12">
                                        <fieldset>
                                            <legend>{{__('user.comment')}}*</legend>
                                            <textarea rows="5" name="comment"></textarea>
                                        </fieldset>
                                    </div>

                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                                    @if($recaptchaSetting->status==1)
                                        <div class="col-xl-12">
                                            <div class="wsus__single_com mt_20">
                                                <div class="g-recaptcha" data-sitekey="{{ $recaptchaSetting->site_key }}"></div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-xl-12">
                                        <button type="submit" class="common_btn mt_20">{{__('user.Submit comment')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="wsus__review_input comment_input mt_100 xs_mt_70">
                            <div class="wsus__blog_comment">
                                <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>
                            </div>
                        </div>
                    @endif

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
        BLOG DETAILS END
    ==========================-->

    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId={{ $facebookComment->app_id }}&autoLogAppEvents=1" nonce="MoLwqHe5"></script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function () {
                $("#blogCommentForm").on('submit', function(e){
                    e.preventDefault();
                    var isDemo = "{{ env('APP_MODE') }}"
                    if(isDemo == 'DEMO'){
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }
                    $.ajax({
                        type: 'POST',
                        data: $('#blogCommentForm').serialize(),
                        url: "{{ route('blog-comment') }}",
                        success: function (response) {
                            if(response.status == 1){
                                toastr.success(response.message)
                                $("#blogCommentForm").trigger("reset");
                            }
                        },
                        error: function(response) {
                            if(response.responseJSON.errors.name)toastr.error(response.responseJSON.errors.name[0])
                            if(response.responseJSON.errors.email)toastr.error(response.responseJSON.errors.email[0])
                            if(response.responseJSON.errors.comment)toastr.error(response.responseJSON.errors.comment[0])

                            if(!response.responseJSON.errors.name && !response.responseJSON.errors.email && !response.responseJSON.errors.comment){
                                toastr.error("{{__('user.Please complete the recaptcha to submit the form')}}")
                            }
                        }
                    });
                })


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
