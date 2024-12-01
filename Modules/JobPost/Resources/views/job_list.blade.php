@extends('layout')
    @section('title')
        <title>{{__('admin.Job List')}}</title>
        <meta name="keywords" content="{{__('admin.Job List')}}">
        <meta name="title" content="{{__('admin.Job List')}}">
        <meta name="description" content="{{__('admin.Job List')}}">
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
                        <h1>{{__('admin.Job List')}}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('admin.Job List')}}</li>
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
<!-- Faq Area -->
<section class="wsus__faq mt_90 xs_mt_60 mb_100 xs_mb_70">
  <div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-12 col-xl-8">
          <form action="{{route('serch-job')}}" method="GET">
            @csrf
            <div class="row g-3 align-items-center">
              <!-- Job Search -->
              <div class="col-lg-4">
                <div class="input-group input-group_two">
                  <span class="input-group-text bg-transparent border-end-0">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10.9 10.9L13 13M12.4 6.7C12.4 3.55198 9.84802 1 6.7 1C3.55198 1 1 3.55198 1 6.7C1 9.84802 3.55198 12.4 6.7 12.4C9.84802 12.4 12.4 9.84802 12.4 6.7Z" stroke="#A7AEBA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                  <input type="text" name="key" class="form-control border-start-0 shadow-none" placeholder="Job Title or keywords" />
                </div>
              </div>
              <!-- Location -->
              <div class="col-lg-3">
                <div class="input-group input-group_two">
                  <span class="input-group-text bg-transparent border-end-0">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="6.83268" cy="6.9987" r="4.66667" stroke="#A7AEBA" stroke-width="1.5" />
                      <circle cx="6.83203" cy="7" r="1.75" stroke="#A7AEBA" stroke-width="1.5" />
                      <path d="M6.83203 2.33268V1.16602" stroke="#A7AEBA" stroke-width="1.5" stroke-linecap="round" />
                      <path d="M6.83203 12.8327V11.666" stroke="#A7AEBA" stroke-width="1.5" stroke-linecap="round" />
                      <path d="M11.4993 7L12.666 7" stroke="#A7AEBA" stroke-width="1.5" stroke-linecap="round" />
                      <path d="M0.999349 7L2.16602 7" stroke="#A7AEBA" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                  </span>
                  <select class="form-select border-start-0 shadow-none" name="location">
                    <option value="0">All Location</option>
                    @foreach ($cities as $city)
                      <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- Categories -->
              <div class="col-lg-3">
                <div class="input-group input-group_two" >
                  <span class="input-group-text bg-transparent border-end-0">
                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10.1 7.66667H5.9M15 5.66667V10.3333C15 11.8061 13.7464 13 12.2 13H3.8C2.2536 13 1 11.8061 1 10.3333V3.66667C1 2.19391 2.2536 1 3.8 1H5.66667C6.2725 1 6.862 1.18714 7.34667 1.53333L8.65333 2.46667C9.138 2.81286 9.7275 3 10.3333 3H12.2C13.7464 3 15 4.19391 15 5.66667Z" stroke="#333333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </span>
                  <select class="form-select border-start-0 shadow-none" name="category">
                    <option value="0">All Categories</option>
                    @foreach ($job_categories as $category)
                      <option value="{{$category->id}}">{{$category->category->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- Search Button -->
              <div class="col-lg-2">
                <button class="btn btn-primary">Find Job</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    <div class="row">
    @foreach ($job_posts as $job_post)
      <div class="col-lg-4 col-xl-3 col-md-6 mb-4">
        <div class="job-card">
          <div class="job-icon">
            <img src="{{ asset($job_post->thumb_image) }}" alt="" />
          </div>
          <div class="d-flex gap-2 align-items-center mb-3">
            <span class="job-badge">{{ $job_post->job_type}}</span>
          </div>
          <h3 class="job-title">
            <a href="{{route('job-detils',$job_post->slug)}}"> {{ html_decode($job_post->title) }} </a>
          </h3>
          <div class="d-flex justify-content-between job-info">
            <h4 class="job-price m-0 fw-bold">{{__('admin.Start At -')}}  {{ $currency_icon->icon }}{{ ($job_post->regular_price) }}</h4>
            <span class="job-date"> {{Carbon\Carbon::parse($job_post->created_at)->format('d M y');}}</span>
          </div>
        </div>
      </div>
    @endforeach
    {{--  <div class="row justify-content-center mt-3">
      <div class="col-auto">
        <div class="inflanar-pagination">
          <ul class="inflanar-pagination__list list-none">
            <li class="inflanar-pagination__button">
              <a href="#">
                <i class="fas fa-angle-left"></i>
              </a>
            </li>
            <li>
              <a href="#">01</a>
            </li>
            <li class="active">
              <a href="#">02</a>
            </li>
            <li>
              <a href="#">03</a>
            </li>
            <li>
              <a href="#">04</a>
            </li>
            <li class="inflanar-pagination__button">
              <a href="#">
                <i class="fas fa-angle-right"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>  --}}


  </div>
</section>
<!-- End Faq Area -->
@endsection
