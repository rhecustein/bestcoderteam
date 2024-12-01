
<div class="wsus__invoice_body mt-2">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <th class="package">{{__('user.Include Services')}}</th>
                    <th class="price"></th>
                    <th class="qnty"></th>
                    <th class="total"></th>
                </tr>
                <tr>
                    <td class="package">
                        @foreach ($package_features as $package_feature)
                            <p>{{ $package_feature }}</p>
                        @endforeach
                    </td>
                    <td class="price"></td>
                    <td class="qnty"></td>
                    <td class="total"></td>
                </tr>
                @if (count($additional_services) > 0)
                <tr class="border_none">
                    <th class="package">{{__('user.Additional Service')}}</th>
                    <th class="qnty">{{__('user.Quantity')}}</th>
                    <th class="total">{{__('user.Total')}}</th>
                </tr>
                @foreach ($additional_services as $additional_service)
                    <tr>
                        <td class="package">
                            <p>{{ $additional_service->service_name }}</p>
                        </td>
                        <td class="qnty">
                            <b>{{ $additional_service->qty }}</b>
                        </td>
                        <td class="total">
                            <b>
                                @if ($setting->currency_position == 'before_price')
                                {{ $currency_icon->icon }}{{ $additional_service->price }}
                                @else
                                {{ $additional_service->price }}{{ $currency_icon->icon }}
                                @endif
                            </b>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="wsus__invoice_footer">
    <div class="row">
        <div class="col-xl-6">
              <div class="wsus__invoice_footer_info">
                <h3>{{__('user.Booking Information')}}</h3>
                <p> <span>{{__('user.Schedule date')}}: </span> {{ date('d-M-Y', strtotime($order->booking_date)) }}</p>

                <p> <span>{{__('user.Schedule Time')}}: </span> {{ $order->schedule_time_slot }}</p>

                <p> <span>{{__('user.Booking Id')}}: </span> {{ $order->order_id }}</p>
                <p> <span>{{__('user.Name')}}: </span> {{ html_decode($booking_address->name) }}</p>
                <p> <span>{{__('user.Phone')}}: </span> {{ html_decode($booking_address->phone) }}</p>
                <p> <span>{{__('user.Email')}}: </span> {{ html_decode($booking_address->email) }}</p>
                <p> <span>{{__('user.Address')}}: </span> {{ html_decode($booking_address->address) }}</p>
                <p> <span>{{__('user.Post Code')}}: </span> {{ html_decode($booking_address->post_code) }}</p>
                <p> <span>{{__('user.Booking Created')}}: </span> {{ $order->created_at->format('d-m-Y') }}</p>
                <p> <span>{{__('user.Booking Created Time')}}: </span> {{ $order->created_at->format('h:i A') }}</p>
                <p> <span>{{__('user.Booking Note')}}: </span> {{ html_decode($order->order_note) }}</p>
                <p> <span>{{__('user.Provider')}} :</span> <a href="{{ route('providers', $provider->user_name) }}">{{ $provider->name }}</a></p>
                <p> <span>{{__('user.Service')}} :</span> <a href="{{ route('service', $order->service->slug) }}">{{ $order->service->name }}</a></p>
            </div>


        </div>
        <div class="col-xl-6">

            <div class="wsus__invoice_footer_info">
                <h3>{{__('user.Payment Information')}}</h3>
                <p> <span>{{__('user.Payment Status')}}: </span>
                    @if ($order->payment_status == 'pending')
                        {{__('user.Pending')}}
                    @elseif ($order->payment_status == 'success')
                        {{__('user.Success')}}
                    @endif
                </p>
                <p> <span>{{__('user.Payment Method')}}: </span> {{ $order->payment_method }}</p>
                <p> <span>{{__('user.Transaction')}}: </span> {{ html_decode($order->transection_id) }}</p>

                <p> <span>{{__('user.Sub Total')}} :</span>

                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $order->package_amount }}
                    @else
                    {{ $order->package_amount }}{{ $currency_icon->icon }}
                    @endif
                </p>
                <p> <span>{{__('user.Additional')}} :</span>

                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $order->additional_amount }}
                    @else
                    {{ $order->additional_amount }}{{ $currency_icon->icon }}
                    @endif

                </p>

                <p> <span>{{__('user.Discount')}} (-) :</span>
                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $order->coupon_discount }}
                    @else
                    {{ $order->coupon_discount }}{{ $currency_icon->icon }}
                    @endif
                </p>

                <p> <span>{{__('user.Total Amount')}} :</span>
                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $order->total_amount }}
                    @else
                    {{ $order->total_amount }}{{ $currency_icon->icon }}
                    @endif
                </p>

                <p> <span>{{__('user.Order Status')}}</span> :
                    @if ($order->order_status == 'awaiting_for_provider_approval')
                    {{__('user.awaiting for provider approval')}}
                    @elseif ($order->order_status == 'approved_by_provider')
                    {{__('user.Approved')}}
                    @elseif ($order->order_status == 'order_decliened_by_provider')
                    {{__('user.Declined by provider')}}
                    @elseif ($order->order_status == 'order_decliened_by_client')
                    {{__('user.Declined by you')}}
                    @elseif ($order->order_status == 'complete')
                    {{__('user.Complete')}}
                    @endif
                </p>


                <div class="order_request_btn_area">
                    @if ($order->order_status == 'approved_by_provider')
                        @if ($order->order_status != 'complete')

                            <button type="button" class="common_btn order_request_btn"
                            data-bs-toggle="modal" data-bs-target="#order_compelete">
                            {{__('user.Mark as complete')}}
                            </button>

                            <button type="button" class="common_btn order_request_btn"
                            data-bs-toggle="modal" data-bs-target="#order_declined">
                            {{__('user.Decliend Order')}}
                            </button>
                        @endif

                    @endif

                    @if ($order->order_status == 'order_decliened_by_client' || $order->order_status == 'order_decliened_by_provider')
                        @if (!$refundRequest)
                            <button type="button" class="common_btn order_request_btn"
                                data-bs-toggle="modal" data-bs-target="#exampleModal_invoice">
                                {{__('user.Send Refund Request')}}
                            </button>
                        @endif

                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@if ($refundRequest)
<div class="wsus__invoice_footer_request">
    <h4>{{__('user.Rofund Request')}}</h4>
    <p><span>{{__('user.Request Date')}}</span> {{ $refundRequest->created_at->format('h:i A, d-M-Y') }}</p>
    <p><span>{{__('user.Resone')}}</span> {!! html_decode(clean(nl2br($refundRequest->resone))) !!}</p>
    <p><span>{{__('user.Account Information')}}</span> {!! html_decode(clean(nl2br($refundRequest->account_information))) !!}</p>
    <p><span>{{__('user.Refund Status')}}</span>
        @if ($order->complete_by_admin == 'Yes')
            {{__('user.Refund request declined and order completed by admin')}}
        @else
            @if ($refundRequest->status == 'awaiting_for_admin_approval')
                {{__('user.awaiting for admin approval')}}
            @elseif ($refundRequest->status == 'decliened_by_admin')
            {{__('user.Decliened by admin')}}
            @else
            {{__('user.Complete')}}
            @endif
        @endif
    </p>
</div>
@endif


<!-- Modal -->
<div class="modal fade" id="exampleModal_invoice" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('user.Refund Request')}}
                </h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="wsus__review_input">
                    <form action="{{ route('send-refund-request') }}" method="POST">
                        @csrf

                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <div class="row">
                            <div class="col-xl-12">
                                <fieldset>
                                    <legend>{{__('user.Resone')}}*</legend>
                                    <textarea required rows="5"
                                        name="resone"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-xl-12">
                                <fieldset>
                                    <legend>{{__('user.Account Information for get payment')}}*</legend>
                                    <textarea required rows="5"
                                        name="account_information"></textarea>
                                </fieldset>
                                <button type="submit"
                                    class="common_btn mt_20">{{__('user.Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="order_compelete" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{__('user.Are you realy want to complete this booking ?')}}
                </h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="wsus__review_input">
                    <a href="{{ route('mark-as-a-complete', $order->id) }}" class="common_btn mt_20">{{__('user.Yes, Complete')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="order_declined" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{__('user.Are you realy want to Declined this booking ?')}}
                </h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="wsus__review_input">
                    <a href="{{ route('mark-as-a-declined', $order->id) }}" class="common_btn mt_20">{{__('user.Yes, Declined')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>




