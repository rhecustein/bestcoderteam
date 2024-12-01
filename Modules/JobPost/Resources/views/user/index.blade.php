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

                                <div class="row py-4">
                                    <div class="col-md-6">
                                        <h3>{{__('admin.All Job Post')}}</h3>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a href="{{route('jobpost.create')}}" class="common_btn order_request_btn">{{__('admin.Create New')}}</a>
                                    </div>
                                </div>

                                <div class="wsus_dashboard_order">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr class="t_header">
                                                    <th>{{__('admin.SN')}}</th>
                                                    <th>{{__('admin.Title')}}</th>
                                                    <th>{{__('admin.Price')}}</th>
                                                    <th>{{__('admin.Visibility')}}</th>
                                                    <th>{{__('admin.Applications')}}</th>
                                                    <th>{{__('admin.Job Status')}}</th>
                                                    <th>{{__('admin.Action')}}</th>
                                                </tr>
                                                @foreach ($job_posts as $index => $job_post)
                                                    <tr>
                                                        <td>
                                                            <h5>#{{ ++$index }}</h5>
                                                        </td>
                                                        <td>
                                                            <p>{{ html_decode($job_post->title) }} </p>
                                                        </td>
                                                        <td>
                                                            {{ $currency_icon->icon }}{{ $job_post->regular_price }}
                                                        </td>

                                                        <td>
                                                            @if ($job_post->approved_by_admin == 'approved')
                                                                <span class="active">{{__('user.Approved')}}</span>
                                                            @else ($order->order_status == 'complete')
                                                                <span class="complete">{{__('user.waiting')}}</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <p class="inflanar-table__label">
                                                                <a href="{{ route('job-post-applicants', $job_post->id) }}">{{ __('Click here') }} ({{ $job_post->total_job_application }})</a>
                                                            </p>
                                                        </td>

                                                        <td>
                                                            @if ($job_post->checkJobStatus($job_post->id) == 'approved')
                                                                <span class="active">{{__('user.Hired')}}</span>
                                                            @elseif ($job_post->checkJobStatus($job_post->id) == 'pending')
                                                                <span class="complete">{{__('user.Pending')}}</span>
                                                            @else
                                                                <span class="cancel">{{__('user.Rejected')}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('jobpost.edit',$job_post->id) }}" class="p-1 text-info"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#open_ticket{{$job_post->id}}" class="p-1"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>

                                                    <!-- Support Ticket -->
                                                    <div class="modal fade" id="open_ticket{{$job_post->id}}" tabindex="-1" aria-labelledby="OpenTicketModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="OpenTicketModalLabel">{{ __('Confirmation') }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('jobpost.destroy', $job_post->id) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="mb-3">
                                                                            <p>{{ __('Are you sure you want to delete this item?') }}</p>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <button type="submit" class="btn btn-danger">{{ __('Yes, Delete') }}</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Support Ticket -->

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        {{ $job_posts->links('custom_pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('user.Confirm')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('frontend/images/logout_img.png') }}" alt="Logout" class="img-fluid w-100">
                        <p>{{__('user.Are you sure you want to Logout')}} <b>{{__('user.Kingserv')}}</b></p>
                    </div>
                    <div class="modal-footer">
                        <a class="common_btn" href="{{ route('user.logout') }}">{{__('user.Yes! Logout')}}</a>

                        <button type="button" class="del_btn" data-bs-dismiss="modal">{{__('user.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="accountDelete" tabindex="-1" aria-labelledby="accountDelete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">

                        <p>{{__('user.Are you sure you want to delete your account')}} <b>{{__('user.Kingserv')}}</b></p>
                    </div>
                    <div class="modal-footer">
                        <a class="common_btn" href="{{ route('user.delete-account') }}">{{__('user.Yes, Delete')}}</a>

                        <button type="button" class="del_btn" data-bs-dismiss="modal">{{__('user.cancel')}}</button>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        DASHBOARD END
    ==========================-->
@endsection
