@extends('layout')

@section('title')
  <title>{{__('admin.Job Detils')}}</title>
<meta name="keywords" content="{{__('admin.Job Detils')}}">
<meta name="title" content="{{__('admin.Job Detils')}}">
<meta name="description" content="{{__('admin.Job Detils')}}"> @endsection @section('frontend-content')
<!-- Breadcrumbs -->
<section class="pd-top-30">
  <div class="container">
    <div class="row">
      <!-- Breadcrumb-Content -->
      <div class="col-12">
        <div class="inflanar-breadcrumb__inner">
          <div class="inflanar-breadcrumb__content">
            <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Job Detils')}}</h2>
            <ul class="inflanar-breadcrumb__menu list-none">
              <li>
                <a href="{{ route('home') }}">{{__('admin.Home')}}</a>
              </li>
              <li class="active">
                <a href="javascript:;">{{__('admin.Job Detils')}}</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End breadcrumbs -->
<!-- Faq Area -->
<section class="wsus__blog_page mt_100 xs_mt_70 mb_100 xs_mb_70">
  <div class="container inflanar-container-medium">
    <div class="job-details-wrapper">
      <div class="job-details-header">
        <div class="row justify-content-between pb-5">
          <div class="col-auto mb-4 mb-lg-0">
            <div
              class="d-flex flex-column flex-md-row align-items-md-center job-header-left"
            >
              <div
                class="job-header-logo d-flex align-items-center justify-content-center"
              >
                <img width="100px" height="80px" src="{{ asset($job_post->thumb_image) }}" alt="" />
              </div>
              <div>
                <p class="job-type d-flex gap-2 align-items-center mb-1">
                  <svg
                    width="12"
                    height="10"
                    viewBox="0 0 12 10"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M4.68945 5.33398H6.68945V6.00065H4.68945V5.33398Z"
                      fill="#FE2C55"
                    />
                    <path
                      d="M9.23064 6.00048H7.35556V6.33381C7.35556 6.51801 7.20642 6.66714 7.02222 6.66714H4.35556C4.17135 6.66714 4.02222 6.51801 4.02222 6.33381V6.00048H2.14714C1.71615 6.00048 1.33498 5.72574 1.19852 5.31688L0 1.7207V9.00048C0 9.55187 0.448611 10.0005 1 10.0005H10.3778C10.9292 10.0005 11.3778 9.55187 11.3778 9.00048V1.72096L10.1792 5.31688C10.0428 5.72574 9.66163 6.00048 9.23064 6.00048Z"
                      fill="#FE2C55"
                    />
                    <path
                      d="M7.02292 0H4.35625C3.80486 0 3.35625 0.448611 3.35625 1V1.33333H0.574219L1.83142 5.10547C1.877 5.24184 2.00425 5.33333 2.14783 5.33333H4.02292V5C4.02292 4.8158 4.17205 4.66667 4.35625 4.66667H7.02292C7.20712 4.66667 7.35625 4.8158 7.35625 5V5.33333H9.23134C9.37491 5.33333 9.50217 5.24184 9.54774 5.10547L10.805 1.33333H8.02292V1C8.02292 0.448611 7.57431 0 7.02292 0ZM4.02292 1.33333V1C4.02292 0.816059 4.17231 0.666667 4.35625 0.666667H7.02292C7.20686 0.666667 7.35625 0.816059 7.35625 1V1.33333H4.02292Z"
                      fill="#FE2C55"
                    />
                  </svg>
                  Job type: <span>{{ $job_post->job_type}}</span>
                </p>
                <h3 class="job-post-title fw-bold mb-1">
                    {{ html_decode($job_post->title) }}
                </h3>
                <p class="job-company mb-2">{{ $job_post->user->name}}</p>
                <div class="d-flex align-items-center gap-3">
                  <span
                    class="job-post-date d-flex align-items-center gap-1"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="11"
                      height="11"
                      viewBox="0 0 11 11"
                      fill="none"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M3.81482 0.513554C3.81482 0.298962 3.64085 0.125 3.42626 0.125C3.21167 0.125 3.03771 0.298962 3.03771 0.513554V1.7167C2.1876 2.14527 1.51131 2.86822 1.14274 3.75163H9.85443C9.48587 2.86823 8.80959 2.14529 7.95951 1.71672V0.513554C7.95951 0.298962 7.78555 0.125 7.57095 0.125C7.35636 0.125 7.1824 0.298962 7.1824 0.513554V1.4222C6.85642 1.33638 6.51416 1.29067 6.16124 1.29067H4.83594C4.48302 1.29067 4.14078 1.33638 3.81482 1.42219V0.513554ZM0.835938 5.29067C0.835938 5.03013 0.860848 4.7754 0.908418 4.52874H10.0888C10.1363 4.7754 10.1612 5.03013 10.1612 5.29068V6.87501C10.1612 9.08415 8.37038 10.875 6.16124 10.875H4.83594C2.6268 10.875 0.835938 9.08415 0.835938 6.87501V5.29067ZM5.49857 7.76653C5.7847 7.76653 6.01664 7.53458 6.01664 7.24846C6.01664 6.96234 5.7847 6.73039 5.49857 6.73039C5.21245 6.73039 4.9805 6.96234 4.9805 7.24846C4.9805 7.53458 5.21245 7.76653 5.49857 7.76653ZM8.08868 7.24846C8.08868 7.53458 7.85673 7.76653 7.5706 7.76653C7.28448 7.76653 7.05253 7.53458 7.05253 7.24846C7.05253 6.96234 7.28448 6.73039 7.5706 6.73039C7.85673 6.73039 8.08868 6.96234 8.08868 7.24846ZM3.42623 7.76653C3.71235 7.76653 3.9443 7.53458 3.9443 7.24846C3.9443 6.96234 3.71235 6.73039 3.42623 6.73039C3.1401 6.73039 2.90815 6.96234 2.90815 7.24846C2.90815 7.53458 3.1401 7.76653 3.42623 7.76653Z"
                        fill="#22BE0D"
                      ></path>
                    </svg>
                    {{Carbon\Carbon::parse($job_post->created_at)->format('d M y');}}</span
                  >
                  <span
                    class="job-location d-flex align-items-center gap-1"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="10"
                      height="11"
                      viewBox="0 0 10 11"
                      fill="none"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M5.15385 11C6.89904 11 9.80769 7.58895 9.80769 4.88889C9.80769 2.18883 7.72409 0 5.15385 0C2.5836 0 0.5 2.18883 0.5 4.88889C0.5 7.58895 3.40865 11 5.15385 11ZM5.15371 6.59992C6.01046 6.59992 6.70499 5.86119 6.70499 4.94992C6.70499 4.03865 6.01046 3.29992 5.15371 3.29992C4.29696 3.29992 3.60243 4.03865 3.60243 4.94992C3.60243 5.86119 4.29696 6.59992 5.15371 6.59992Z"
                        fill="#13544E"
                      ></path></svg>{{$job_post->city->name}}</span
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <div class="d-flex align-items-center flex-column">
              @auth
                <a class="common_btn"  data-bs-toggle="modal" data-bs-target="#applicationModal">
                    {{__('admin.Apply Now')}}
                </a>
              @else
                <a href="{{route('login')}}" class="common_btn">
                    {{__('admin.Apply Now')}}
                </a>
              @endauth
              <h3 class="job-wage fw-bold mt-4">{{__('admin.Start At -')}}  {{ $currency_icon->icon }} {{ ($job_post->regular_price) }}/m</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="pt-5">
        {{--  <h4 class="descripiton-title">Job Description</h4>  --}}
         {!!$job_post->description!!}
      </div>
    </div>
  </div>
</section>
<!-- End Faq Area -->

<!-- Modal -->
<div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicationModalLabel">{{ __('admin.Application') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('apply-job') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="message" class="form-label">{{ __('admin.Message') }} <span class="text-danger">*</span></label>
                        @auth
                            <input type="hidden" name="user_id" value="{{ $job_post->user_id }}">
                            <input type="hidden" name="job_id" value="{{ $job_post->id }}">
                        @endauth
                        <textarea class="form-control" id="message" name="message" placeholder="{{ __('admin.Write your message') }}" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">{{ __('admin.Resume') }} <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="resume" name="resume" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">{{ __('admin.Apply Now') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
      $('#applicationForm').on('submit', function (event) {
        event.preventDefault();

        // Validate the form here if needed
        var isValid = true;

        if (isValid) {
          alert('Application submitted successfully!');
          $('#applicationModal').modal('hide');
        }
      });
    });
    </script>

@endsection
