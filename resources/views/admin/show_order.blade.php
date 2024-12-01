@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Booking Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Booking Details')}}</h1>
          </div>

          <div class="section-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 >{{__('admin.Schedule Date')}}</h6>
                                <hr>
                                <p>{{__('admin.Date')}} : {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>
                                <p>{{__('admin.Time')}} : {{ $order->schedule_time_slot }}</p>

                                <h6 class="mt-4">{{__('admin.Booking Information')}}</h6>
                                <hr>
                                <p>{{__('admin.Booking Id')}} : {{ $order->order_id }}</p>
                                <p>{{__('admin.Name')}} : {{ html_decode($booking_address->name) }}</p>
                                <p>{{__('admin.Phone')}} : {{ html_decode($booking_address->phone) }}</p>
                                <p>{{__('admin.Email')}} : {{ html_decode($booking_address->email) }}</p>
                                <p>{{__('admin.Address')}} : {{ html_decode($booking_address->address) }}</p>
                                <p>{{__('admin.Post Code')}} : {{ html_decode($booking_address->post_code) }}</p>
                                <p>{{__('admin.Booking Created')}} : {{ $order->created_at->format('d-m-Y') }}</p>
                                <p>{{__('admin.Booking Created Time')}} : {{ $order->created_at->format('h:i A') }}</p>

                                @if ($order->order_note)
                                <h6 class="mt-4">{{__('admin.Booking Note')}}</h6>
                                <hr>
                                    <p>{!! html_decode(clean(nl2br($order->order_note))) !!}</p>
                                @endif

                                <h6 class="mt-4">{{__('admin.Client Details')}}</h6>
                                <hr>
                                <p>{{__('admin.Name')}} : <a href="{{ route('admin.customer-show', $client->id) }}">{{ $client->name }}</a></p>
                                <p>{{__('admin.Phone')}} : {{ $client->Phone }}</p>
                                <p>{{__('admin.Email')}} : {{ $client->email }}</p>
                                <p>{{__('admin.Address')}} : {{ $client->address }}</p>

                                <h6 class="mt-4">{{__('admin.Provider Details')}}</h6>
                                <hr>
                                <p>{{__('admin.Name')}} : <a href="{{ route('admin.provider-show', $provider->id) }}">{{ $provider->name }}</a></p>
                                <p>{{__('admin.Phone')}} : {{ $provider->Phone }}</p>
                                <p>{{__('admin.Email')}} : {{ $provider->email }}</p>
                                <p>{{__('admin.Address')}} : {{ $provider->address }}</p>



                                <h6 class="mt-4">{{__('admin.Payment Information')}}</h6>
                                <hr>

                                <p> {{__('admin.Transaction')}}:  {{ html_decode($order->transection_id) }}</p>

                                @if ($order->payment_status == 'pending')
                                <p>{{__('admin.Payment Status')}} : <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                @elseif ($order->payment_status == 'success')
                                <p>{{__('admin.Payment Status')}} : <span class="badge badge-success">{{__('admin.Success')}}</span>
                                @endif
                                <p>{{__('admin.Payment Gateway')}} : {{ $order->payment_method }}</p>
                                <p>{{__('admin.Sub Total')}} :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->package_amount }}
                                    @else
                                    {{ $order->package_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </p>
                                <p>{{__('admin.Additional')}} :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->additional_amount }}
                                    @else
                                    {{ $order->additional_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </p>
                                <p>{{__('admin.Discount')}} (-) :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->coupon_discount }}
                                    @else
                                    {{ $order->coupon_discount }}{{ $currency_icon->icon }}
                                    @endif

                                </p>

                                <p>{{__('admin.Total Amount')}} :

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $order->total_amount }}
                                    @else
                                    {{ $order->total_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </p>


                                @if ($setting->commission_type != 'subscription')
                                    @if ($order->payment_status == 'pending')
                                        <button data-toggle="modal" data-target="#approvedPayment-{{ $order->id }}" class="btn btn-success btn-sm">{{__('admin.Approve Payment')}}</button>
                                    @endif
                                @endif

                                <h6 class="mt-4">{{__('admin.Order Status')}}</h6>
                                <hr>
                                <p>{{__('admin.Status')}} :
                                    @if ($order->order_status == 'awaiting_for_provider_approval')
                                    {{__('admin.awaiting for provider approval')}}
                                    @elseif ($order->order_status == 'approved_by_provider')
                                    {{__('admin.Approved')}}
                                    @elseif ($order->order_status == 'order_decliened_by_provider')
                                    {{__('admin.Declined by provider')}}
                                    @elseif ($order->order_status == 'order_decliened_by_client')
                                    <span class="badge badge-danger">{{__('admin.Declined by Client')}}</span>
                                    @elseif ($order->order_status == 'complete')
                                    {{__('admin.Complete')}}
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
                                            <th>{{__('admin.Include Services')}}</th>
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
                                                <th>{{__('admin.Additional Service')}}</th>
                                                <th>{{__('admin.Quantity')}}</th>
                                                <th>{{__('admin.Price')}}</th>
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

                                    <a href="javascript:;" data-toggle="modal" data-target="#declinedOrder-{{ $order->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> {{__('admin.Declined')}}</a>

                                    <a href="javascript:;"  data-toggle="modal" data-target="#approvedOrder-{{ $order->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Approved')}}</a>


                                @endif

                                <a data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{ $order->id }})" href="javascript:;" data-toggle="modal" data-target="#declinedOrder-{{ $order->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash    "></i> {{__('admin.Delete Booking')}}</a>


                                @if ($order->order_status != 'complete')
                                <a href="javascript:;"  data-toggle="modal" data-target="#markAsCompelete-{{ $order->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Mark as complete')}}</a>
                                @endif

                            </div>
                        </div>

                        @if ($refundRequest)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6>{{__('admin.Rofund Request by Client')}}</h6>
                                    <table class="table">
                                        <tr>
                                            <td>{{__('admin.Request Date')}}</td>
                                            <td>{{ $refundRequest->created_at->format('h:i A, d-M-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Resone')}}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($refundRequest->resone))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Account Information')}}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($refundRequest->account_information))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Refund Status')}}</td>
                                            <td>
                                                @if ($order->complete_by_admin == 'Yes')
                                                    {{__('admin.Refund request declined and order completed by admin')}}
                                                @else
                                                    @if ($refundRequest->status == 'awaiting_for_admin_approval')
                                                        {{__('admin.awaiting for admin approval')}}
                                                    @elseif ($refundRequest->status == 'decliened_by_admin')
                                                    {{__('admin.Decliened by admin')}}
                                                    @else
                                                    {{__('admin.Complete')}}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>


                                    </table>

                                    @if ($order->complete_by_admin != 'Yes')
                                        @if ($refundRequest->status == 'awaiting_for_admin_approval')
                                            <a href="javascript:;" data-toggle="modal" data-target="#declinedRefundRequest-{{ $refundRequest->id }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> {{__('admin.Declined')}}</a>
                                        @endif


                                        @if ($order->order_status != 'complete')
                                            @if ($refundRequest->status != 'complete')
                                                <a href="javascript:;"  data-toggle="modal" data-target="#approvedRefundRequest-{{ $refundRequest->id }}" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> {{__('admin.Approved')}}</a>
                                            @endif
                                        @endif
                                    @endif



                                </div>
                            </div>
                        @endif

                        @if ($completeRequest)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6>{{__('admin.Order Complete Request by Provider')}}</h6>
                                    <table class="table">
                                        <tr>
                                            <td>{{__('admin.Request Date')}}</td>
                                            <td>{{ $completeRequest->created_at->format('h:i A, d-M-Y') }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Resone')}}</td>
                                            <td>
                                                {!! html_decode(clean(nl2br($completeRequest->resone))) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('admin.Order status')}}</td>
                                            <td>
                                                @if ($order->complete_by_admin == 'Yes')
                                                {{__('admin.Order completed by admin')}}
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
                <h5 class="modal-title">{{__('admin.Booking Declined Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('admin.Are You sure declined this booking')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.booking-declined', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Declined')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="approvedOrder-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('admin.Booking Approved Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('admin.Are You sure approved this booking')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.booking-approved', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="approvedPayment-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('admin.Payment Approved Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('admin.Are You sure approved this payment')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.payment-approved', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="markAsCompelete-{{ $order->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('admin.Booking Complete Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('admin.Are You sure complete this booking')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.booking-mark-as-complete', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, complete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($refundRequest)
        <div class="modal fade" tabindex="-1" role="dialog" id="declinedRefundRequest-{{ $refundRequest->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Refund Request Declined Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>{{__('admin.Are You sure declined this refund request')}}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('admin.refund-request-declined', $refundRequest->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Yes, Declined')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="approvedRefundRequest-{{ $refundRequest->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">{{__('admin.Refund Request Approved Confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>{{__('admin.Are You sure approved this refund request')}}</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <form action="{{ route('admin.refund-request-approved', $refundRequest->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-order/") }}'+"/"+id)
        }
    </script>
@endsection
