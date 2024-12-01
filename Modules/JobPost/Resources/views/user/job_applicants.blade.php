@extends($active_theme)
@section('title')
    <title>{{__('user.Dashboard')}}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('admin.Job Applications') }}">
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
                            <h1>{{ __('admin.Job Applications') }}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Job Applications') }}</li>
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
                                <div class="row py-1">
                                    <div class="col-md-6 py-1">
                                        <h3>{{__('admin.All Job Applications')}}</h3>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a href="{{route('jobpost.index')}}" class="common_btn order_request_btn">{{__('admin.Go Back')}}</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="wsus_dashboard_order">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr class="t_header">
                                                    <th>{{__('admin.SN')}}</th>
                                                    <th>{{__('admin.Name')}}</th>
                                                    <th>{{__('admin.Phone')}}</th>
                                                    <th>{{__('admin.Email')}}</th>
                                                    <th>{{__('admin.Status')}}</th>
                                                    <th>{{__('admin.Action')}}</th>
                                                </tr>
                                                @foreach ($job_requests as $index => $job_request)
                                                    <tr>
                                                        <td>
                                                            <h5>#{{ ++$index }}</h5>
                                                        </td>
                                                        <td>
                                                            <p>{{ html_decode($job_request?->seller?->name) }} </p>
                                                        </td>
                                                        <td>
                                                            {{ html_decode($job_request?->seller?->phone) }}
                                                        </td>

                                                        <td>
                                                            {{ html_decode($job_request?->seller?->email) }}
                                                        </td>

                                                        <td>
                                                            @if ($job_request->status == 'approved')
                                                                <span class="active">{{__('user.Hired')}}</span>
                                                            @elseif ($job_request->status == 'pending')
                                                                <span class="complete">{{__('user.Pending')}}</span>
                                                            @else ($order->order_status == 'complete')
                                                                <span class="complete">{{__('user.Rejected')}}</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if($job_request->status == 'pending')
                                                            <a class="p-1 text-info " href="javascript:;" data-bs-toggle="modal" data-bs-target="#approvedOrder{{$job_request->id}}"><i class="fas fa-check"></i></a>
                                                            @endif
                                                            <a class="p-1" href="javascript:;" data-bs-toggle="modal" data-bs-target="#open_ticket{{$job_request->id}}">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <!-- Support Ticket -->

                                                    <div class="modal fade" id="approvedOrder{{$job_request->id}}" tabindex="-1" aria-labelledby="OpenTicketmodal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="OpenTicketmodal">{{__('user.Confirmation')}}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('job-application-approval',$job_request->id) }}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <img src="{{ asset('frontend/images/logout_img.png') }}" alt="Logout" class="img-fluid w-100">



                                                                        <p>{{__('user.Are you sure you want to Approved Application')}} <b>{{__('user.?')}}</b></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="common_btn">{{__('user.Yes! Approved')}}</button>

                                                                        <button type="button" class="del_btn" data-bs-dismiss="modal">{{__('user.cancel')}}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <!-- Support TIcket  -->
                                                        <div class="inflanar-preview__modal modal fade" id="open_ticket{{$job_request->id}}" tabindex="-1" aria-labelledby="OpenTicketmodal" aria-hidden="true" >
                                                            <div class="modal-dialog modal-dialog-centered inflanar-preview__ticket">
                                                                <div class="modal-content">
                                                                    <div class="modal-header inflanar__modal__header">
                                                                        <h4 class="modal-title inflanar-preview__modal-title" id="OpenTicketmodal">{{__('admin.Application')}}</h4>
                                                                        <button type="button" class="inflanar-preview__modal--close btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-remove"></i></button>
                                                                    </div>
                                                                    <div class="modal-body inflanar-modal__body">
                                                                        {{__('admin.Name')}} : {{ html_decode($job_request?->seller?->name) }} <hr>
                                                                        {{__('admin.Phone')}} : {{ html_decode($job_request?->seller?->phone) }} <hr>
                                                                        {{__('admin.Email')}} : {{ html_decode($job_request?->seller?->email) }} <hr>
                                                                        {{__('admin.Created At')}} : {{ $job_request->created_at->format('Y-m-d') }} <hr>
                                                                        {{__('admin.Comment')}} : {{$job_request->description}} <hr>
                                                                        {{__('admin.Status')}} :
                                                                        @if ($job_request->status == 'approved')
                                                                        <span class="badge bg-success text-white">{{ __('Hired') }}</span>
                                                                        @elseif ($job_request->status == 'pending')
                                                                            <span class="badge bg-danger text-white">{{ __('Pending') }}</span>
                                                                        @else
                                                                            <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                                                        @endif
                                                                        <hr>
                                                                        {{__('admin.Resume')}} : <a href="{{ asset($job_request->resume) }}">Downlode Resume <i class="fas fa-file"></i></a> <hr>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Support TIcket  -->


                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        {{ $job_requests->links('custom_pagination') }}
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
