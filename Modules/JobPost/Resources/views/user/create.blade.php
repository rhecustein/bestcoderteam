@extends($active_theme)
@section('title')
    <title>{{__('user.Dashboard')}}</title>
@endsection
@section('meta')
    <meta name="description" content="{{__('admin.All Job Post')}}">
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
                            <h1>{{__('admin.All Job Post')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('admin.All Job Post')}}</li>
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
        DASHBOARD START
    ==========================-->
    <section class="wsus__dashboard mt_90 xs_mt_60 mb_100 xs_mb_70">
        <div class="container">
            <div class="wsus__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="wsus__dashboard_menu">
                            <div class="dasboard_header d-flex flex-wrap align-items-center">
                                <img src="{{ $user->image ? asset($user->image) : asset($default_avatar->image) }}" alt="user" class="img-fluid w-100 user_avatar">
                                <div class="text">
                                    <h2>{{ html_decode($user->name) }}</h2>
                                </div>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">

                                <a href="{{route('dashboard')}}"><button class="nav-link" type="button" id="v-pills-jobpost-tab"  aria-selected="false"><span><i
                                    class="fas fa-user"></i></span> {{__('user.Dashboard')}} </button></a>

                                <a href="{{route('jobpost.index')}}"><button class="nav-link active" type="button" id="v-pills-jobpost-tab"  aria-selected="false"><span><i
                                    class="fas fa-file-signature"></i></span> {{__('user.Job Post')}} </button></a>

                                <a href="{{route('dashboard')}}"><button class="nav-link" type="button" id="v-pills-jobpost-tab"  aria-selected="false"><span><i
                                    class="fas fa-bags-shopping"></i></span> {{__('user.Order')}} </button></a>

                                <a href="{{route('dashboard')}}"><button class="nav-link" type="button" id="v-pills-jobpost-tab"  aria-selected="false"><span><i
                                    class="fas fa-star"></i></span> {{__('user.Reviews')}} </button></a>

                                <a href="{{route('dashboard')}}"><button class="nav-link" type="button" id="v-pills-jobpost-tab"  aria-selected="false"><span><i
                                    class="fas fa-user-headset"></i></span> {{__('user.Support Ticket')}} </button></a>

                                <a href="{{route('dashboard')}}"><button class="nav-link" type="button" id="v-pills-jobpost-tab"  aria-selected="false"><span><i
                                    class="fas fa-user-lock"></i></span> {{__('user.Change Password')}} </button></a>

                                <button class="nav-link" type="button" data-bs-toggle="modal"
                                    data-bs-target="#accountDelete"><span> <i class="fas fa-trash"></i> </span>
                                    {{__('user.Delete Account')}}</button>

                                    <button class="nav-link" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><span> <i class="fas fa-sign-out-alt"></i> </span>
                                    {{__('user.Logout')}}</button>


                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="wsus__dashboard_content">
                            <div class="wsus_dashboard_body">
                                <div class="wsus__review_input">
                                    <div class="row py-1">
                                        <div class="col-md-6 py-1">
                                            <h3>{{__('admin.Create Job Post')}}</h3>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="{{route('jobpost.index')}}" class="common_btn order_request_btn">{{__('admin.Go Back')}}</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <form action="{{ route('jobpost.store') }}" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.Thumbnail Image')}}*</legend>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="file" name="thumb_image">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.Title')}} *</legend>
                                                    <input type="text" id="title"  name="title" value="{{ old('title') }}">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.Slug')}}*</legend>
                                                    <input type="text"  id="slug" type="text" name="slug" value="{{ old('slug') }}">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.Category')}}</legend>
                                                    <select name="category_id" id="" class="form-select">
                                                        <option value="">{{__('admin.Select Category')}}</option>
                                                        @foreach ($categories as $category)
                                                            <option  {{ $category->id == old('category_id') ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.City')}}</legend>
                                                    <select name="city_id" id="city_id" class="form-select">
                                                        <option value="">{{__('admin.Select City')}}</option>
                                                        @foreach ($cities as $city)
                                                            <option {{ $city->id == old('city_id') ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.Job Type')}}</legend>
                                                    <select name="job_type" id="" class="form-select">
                                                        <option {{ 'Hourly' == old('job_type') ? 'selected' : '' }} value="Hourly">{{ __('admin.Hourly') }}</option>
                                                        <option {{ 'Daily' == old('job_type') ? 'selected' : '' }} value="Daily">{{ __('admin.Daily') }}</option>
                                                        <option {{ 'Monthly' == old('job_type') ? 'selected' : '' }} value="Monthly">{{ __('admin.Monthly') }}</option>
                                                        <option {{ 'Yearly' == old('job_type') ? 'selected' : '' }} value="Yearly">{{ __('admin.Yearly') }}</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.Start Price')}} *</legend>
                                                    <input type="text"  name="regular_price" id="regular_price" value="{{ old('regular_price') }}">
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <legend>{{__('admin.Address')}} *</legend>
                                                    <input type="text" name="address" id="address" value="{{ old('address') }}">
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-12">
                                                <fieldset>
                                                    <legend>{{__('admin.Description')}} *</legend>
                                                    <textarea class="summernote"  name="description" id="description">{{ old('description') }}</textarea>
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-6">
                                                   <div class="dashboard-cehckbox">
                                                    <label>{{__('admin.Visibility Status')}} *</label>
                                                        <input name="status" type="checkbox" >
                                                   </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button type="submit" class="common_btn mt_20">{{__('user.Update')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        (function($) {
            "use strict"
            $(document).ready(function () {
                $("#title").on("keyup",function(e){
                    let inputValue = $(this).val();
                    let slug = inputValue.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
                    $("#slug").val(slug);
                })
            });
        })(jQuery);
    </script>
    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            tinymce.init({
                selector: '.summernote',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                    { value: 'First.Name', title: 'First Name' },
                    { value: 'Email', title: 'Email' },
                ]
            });
            $('#dataTable').DataTable();
            $('.select2').select2();
            $('.sub_cat_one').select2();
            $('.tags').tagify();
            $('.datetimepicker_mask').datetimepicker({
                format:'Y-m-d H:i',
            });
        });

        })(jQuery);
    </script>

    <!--=========================
        DASHBOARD END
    ==========================-->
@endsection
