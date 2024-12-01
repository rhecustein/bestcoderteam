@extends('provider.master_layout')
@section('title')
<title>{{__('user.Booking Details')}}</title>
@endsection
@section('provider-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('user.Booking Details')}}</h1>
          </div>

          <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 >{{__('user.Schedule Date')}}</h6>
                                <hr>
                                <p>{{__('user.Date')}} : {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>
                                <p>{{__('user.Time')}} : {{ $order->schedule_time_slot }}</p>

                                <h6 class="mt-4">{{__('user.Booking Information')}}</h6>
                                <hr>
                                <p>{{__('user.Booking Id')}} : {{ $order->order_id }}</p>
                                <p>{{__('user.Name')}} : {{ html_decode($booking_address->name) }}</p>
                                <p>{{__('user.Phone')}} : {{ html_decode($booking_address->phone) }}</p>
                                <p>{{__('user.Email')}} : {{ html_decode($booking_address->email) }}</p>
                                <p>{{__('user.Address')}} : {{ html_decode($booking_address->address) }}</p>
                                <p>{{__('user.Post Code')}} : {{ html_decode($booking_address->post_code) }}</p>
                                <p>{{__('user.Booking Created')}} : {{ $order->created_at->format('d-m-Y') }}</p>
                                <p>{{__('user.Booking Created Time')}} : {{ $order->created_at->format('h:i A') }}</p>


                                @if ($order->order_note)
                                <h6 class="mt-4">{{__('user.Booking Note')}}</h6>
                                <hr>
                                    <p>{!! html_decode(clean(nl2br($order->order_note))) !!}</p>
                                @endif

                                <h6 class="mt-4">{{__('user.Client Details')}}</h6>
                                <hr>
                                <p>{{__('user.Name')}} : {{ $client->name }}</p>
                                <p>{{__('user.Phone')}} : {{ $client->Phone }}</p>
                                <p>{{__('user.Email')}} : {{ $client->email }}</p>
                                <p>{{__('user.Address')}} : {{ $client->address }}</p>

                                <h6 class="mt-4">{{__('user.Payment Information')}}</h6>
                                <hr>
                                @if ($order->payment_status == 'pending')
                                <p>{{__('user.Payment Status')}} : <span class="badge badge-danger">{{__('user.Pending')}}</span>
                                @elseif ($order->payment_status == 'success')
                                <p>{{__('user.Payment Status')}} : <span class="badge badge-success">{{__('user.Success')}}</span>
                                @endif
                                <p>{{__('user.Payment Gateway')}} : {{ $order->payment_method }}</p>
                                <p>{{__('user.Sub Total')}} :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->package_amount }}
                                    @else
                                    {{ $order->package_amount }}{{ $currency_icon->icon }}
                                    @endif
                                </p>
                                <p>{{__('user.Additional')}} :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->additional_amount }}
                                    @else
                                    {{ $order->additional_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </p>

                                <p>{{__('user.Discount')}} (-) :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->coupon_discount }}
                                    @else
                                    {{ $order->coupon_discount }}{{ $currency_icon->icon }}
                                    @endif

                                </p>

                                <p>{{__('user.Total Amount')}} :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->total_amount }}
                                    @else
                                    {{ $order->total_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </p>

                                @if ($setting->commission_type == 'subscription')

                                    @php
                                        $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                                        $module_status = json_decode($json_module_data);
                                    @endphp

                                    @if ($module_status->Subscription)

                                        @if ($order->payment_status == 'pending')
                                            <button data-toggle="modal" data-target="#approvedPayment-{{ $order->id }}" class="btn btn-success btn-sm">{{__('admin.Approve Payment')}}</button>
                                        @endif
                                    @endif
                                @endif

                                <h6 class="mt-4">{{__('user.Order Status')}}</h6>
                                <hr>
                                <p>{{__('user.Status')}} :
                                    @if ($order->order_status == 'awaiting_for_provider_approval')
                                    {{__('user.awaiting for provider approval')}}
                                    @elseif ($order->order_status == 'approved_by_provider')
                                    {{__('user.Approved')}}
                                    @elseif ($order->order_status == 'order_decliened_by_provider')
                                    {{__('user.Declined by provider')}}
                                    @elseif ($order->order_status == 'complete')
                                    {{__('user.Complete')}}
                                    @elseif ($order->order_status == 'order_decliened_by_client')
                                    <span class="badge badge-danger">{{__('user.Declined by Client')}}</span>
                                    @endif
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{__('user.Include Services')}}</th>
                                        </tr>
                                    </thead>
                                    @if ($package_features)
                                        @foreach ($package_features as $package_feature)
                                        <tr>
                                            <td>{{ $package_feature }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </table>

                                @if (count($additional_services) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{__('user.Additional Service')}}</th>
                                            <th>{{__('user.Quantity')}}</th>
                                            <th>{{__('user.Price')}}</th>
                                        </tr>
                                    </thead>
                                    @foreach ($additional_services as $additional_service)
                                    <tr>
                                        <td>{{ $additional_service->service_name }}</td>
                                        <td>{{ $additional_service->qty }}</td>
                                        <td>

                                            @if ($setting->currency_position == 'before_price')
                                            {{ $currency_icon->icon }}{{ $additional_service->price }}
                                            @else
                                            {{ $additional_service->price }}{{ $currency_icon->icon }}
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @endif

                                @if ($order->order_status == 'awaiting_for_provider_approval')
                                        <a href="javascript:;"  data-toggle="modal" data-target="#approvedOrder-{{ $order->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('user.Approved')}}</a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#declinedOrder-{{ $order->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> {{__('user.Declined')}}</a>
                                @endif

                                @if (!$completeRequest && $order->order_status != 'complete')
                                    @if($order->order_status == 'order_decliened_by_client')
                                        <a href="javascript:;" data-toggle="modal" data-target="#completeRequest" class="btn btn-success btn-sm"><i class="fa fa-rocket"></i> {{__('user.Complete Request')}}</a>
                                    @endif
                                @endif


                            </div>
                        </div>

                        @if ($completeRequest)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6>{{__('user.Order Complete Request by Provider')}}</h6>
                                    <table class="table">
                                        <tr>
                                            <td>{{__('user.Request Date')}}</td>
                                            <td>{{ $completeRequest->created_at->format('h:i A, d-M-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Resone')}}</td>
                                            <td>
                                                {!! clean(nl2br($completeRequest->resone)) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Order status')}}</td>
                                            <td>
                                                @if ($order->complete_by_admin == 'Yes')
                                                {{__('user.Order completed by admin')}}
                                                @endif
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
          </div>



        </section>
      </div>


      <div class="modal fade" tabindex="-1" role="dialog" id="declinedOrder-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('user.Booking Declined Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('user.Are You sure declined this booking')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('provider.booking-declined', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('user.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('user.Yes, Declined')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="approvedOrder-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('user.Booking Approved Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('user.Are You sure approved this booking')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('provider.booking-approved', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('user.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('user.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="completeRequest">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('user.Send Order Complete Request To Admin')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('provider.send-order-complete-request') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{__('user.Resone')}}</label>
                            <textarea name="resone" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                        </div>

                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <button class="btn btn-primary">{{__('user.Send')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="approvedPayment-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('user.Payment Approved Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('user.Are You sure approved this payment')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('provider.payment-approved', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('user.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('user.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
