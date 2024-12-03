@extends($active_theme)
@section('title')
    <title>{{ $service->name }}</title>
    <title>{{ $service->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $service->seo_description }}">
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
                            <h1>{{__('user.Booking Information')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Booking Information')}}</li>
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

    @php
        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * $extra_services->total;
        }
    @endphp

    <!--=========================
        BOOKING CONFIRM START
    ==========================-->
    <section class="wsus__booking_confirm mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="wsus__booking_area">
                        <ul class="booking_bar d-flex flex-wrap">
                            <li class="active">1 <span>{{__('user.Service')}}</span></li>
                            <li class="active">2 <span>{{__('user.Information')}}</span></li>
                            <li class="active">3 <span>{{__('user.Confirmation')}}</span></li>
                        </ul>
                        <div class="wsus__booking_img">
                            <img src="{{ asset($service->image) }}" alt="booking images" class="img-fluid w-100">
                        </div>
                        <div class="wsus__service_booking">
                            <h3>{{__('user.Booking Information')}}</h3>
                            <p><span>{{__('user.Name')}}:</span> {{ html_decode($customer->name) }}</p>
                            <p><span>{{__('user.Email')}}:</span> {{ html_decode($customer->email) }}</p>
                            <p><span>{{__('user.Phone')}}:</span> {{ html_decode($customer->phone) }}</p>
                            <p><span>{{__('user.Address')}}:</span> {{ html_decode($customer->address) }}</p>
                            <p><span>{{__('user.Date')}}:</span> {{ $extra_services->date }}</p>
                            <p><span>{{__('user.Post Code')}}:</span> {{ html_decode($customer->post_code) }}</p>
                            <p><span>{{__('user.Order Note')}}:</span> {{ html_decode($customer->order_note) }}</p>
                        </div>
                    </div>

                    <ul class="wsus__booking_payment d-flex flex-wrap">
                        <li>
                            <a href="{{route('user.sub.pay-with-midtrans',$service->slug)}}">
                                <img src="{{asset($midtrans->image)}}"
                                    alt="payment img" class="img-fluid w-100">
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.sub.pay-with-paypal', $service->slug) }}">
                                <img src="{{ asset($paypal->image) }}" alt="payment img" class="img-fluid w-100">
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.sub.handcash-payment', $service->slug) }}">
                                <img src="{{ asset($bankPayment->handcash_image) }}" alt="payment img"
                                    class="img-fluid w-100">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__sidebar" id="sticky_sidebar">
                        <div class="wsus__booking_summery m-0">
                            <h3>{{__('user.Booking Summery')}}</h3>
                            <ul>
                                @foreach ($package_features as $package_feature)
                                    <li>{{ $package_feature }}</li>
                                @endforeach
                            </ul>
                            <div class="wsus__booking_cost">
                                <p>{{__('user.Package Fee')}} <span>
                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $service->price }}
                                    @else
                                    {{ $service->price }}{{ $currency_icon->icon }}
                                    @endif


                                </span></p>
                                <ul>
                                    @if ($extra_services->ids)
                                        @foreach ($extra_services->ids as $index => $id)
                                            <li>
                                                <p>{{ $extra_services->names[$index] }} <b>x{{ $extra_services->quantities[$index] }}</b></p> <span>{{ $currency_icon->icon }}{{ $extra_services->prices[$index] }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <h4>{{__('user.Extra Service')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $extra_services->extra_total }}
                                    @else
                                    {{ $extra_services->extra_total }}{{ $currency_icon->icon }}
                                    @endif

                                </span></h4>
                                <p>{{__('user.Subtotal')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $extra_services->sub_total }}
                                    @else
                                    {{ $extra_services->sub_total }}{{ $currency_icon->icon }}
                                    @endif

                                </span></p>

                                <p>{{__('user.Discount')}} (-) <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $coupon_discount }}
                                    @else
                                    {{ $coupon_discount }}{{ $currency_icon->icon }}
                                    @endif

                                </span></p>

                                <h5>{{__('user.Total')}} <span>

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $extra_services->total - $coupon_discount }}
                                    @else
                                    {{ $extra_services->total - $coupon_discount }}{{ $currency_icon->icon }}
                                    @endif

                                </span></h5>

                                <form action="{{ route('apply-coupon') }}">
                                    <input type="text" name="coupon" placeholder="{{__('user.Coupon Code')}}" autocomplete="off" required>

                                    <input type="hidden" value="{{ $service->provider_id }}" name="provider_id">

                                    <button class="common_btn ">{{__('user.Apply')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
        BOOKING CONFIRM END
    ==========================-->

    {{-- start stripe payment --}}

    @if ($provider_stripe)
        @if ($provider_stripe->status == 1)
            <div class="wsus__payment_modal modal fade" id="stripePayment" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="stripePaymentLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="stripePaymentLabel">{{__('user.Pay with stripe')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="{{ route('pay-with-stripe', $service->slug) }}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ $provider_stripe->stripe_key }}" id="payment-form">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="text" class="card-number" name="card_number" placeholder="{{__('user.Card Number')}}">
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <input type="text" class="card-expiry-month" name="month" placeholder="{{__('user.Expired Month')}}">
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <input type="text" class="card-expiry-year" name="year" placeholder="{{__('user.Expired Year')}}">
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" class="card-cvc" name="cvc" placeholder="{{__('user.CVV')}}">
                                    </div>
                                </div>

                                <div class='form-row row mt-4'>
                                    <div class='col-md-12 error d-none form-group '>
                                        <div class='alert-danger alert '>{{__('user.Please provide your valid card information')}}</div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('user.Close')}}</button>
                            <button type="submit" class="btn btn-danger">{{__('user.Checkout')}}</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        @endif
    @endif
    {{-- end stripe payment --}}



    @if ($provider_bank_handcash)
        @if ($provider_bank_handcash->bank_status == 1)
            {{-- start bank payment modal --}}
            <div class="wsus__payment_modal modal fade" id="bankPayment" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="bankPaymentLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bankPaymentLabel">{{__('user.Bank Payment')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('user.sub.bank-payment', $service->slug) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 mb-4">
                                        <p>{!! clean(nl2br($provider_bank_handcash->bank_instruction)) !!}</p>
                                    </div>

                                    <div class="col-xl-12">
                                        <textarea required cols="3" rows="3" name="tnx_info"  placeholder="{{__('user.Type your transaction information')}}"></textarea>
                                    </div>

                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('user.Close')}}</button>
                            <button type="submit" class="btn btn-danger">{{__('user.Submit')}}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end bank payment --}}
        @endif
    @endif

    {{-- start stripe payment --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]',
                                'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
            $errorMessage.addClass('d-none');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

        $("#razorpayBtn").on("click", function(){
            $.ajax({
                type: 'get',
                url: "{{ url('check-schedule-during-payment') }}" + "/" + "{{ $service->slug }}",
                success: function (response) {
                    if(response.is_available){
                        $(".razorpay-payment-button").click();
                    }else{
                        toastr.error(response.message);
                        window.location.href = "{{ route('ready-to-booking', $service->slug) }}";
                    }
                },
                error: function(err) {}
            });


        })
    });
</script>
    {{-- end stripe payment --}}


@if ($provider_flutterwave)
    @if ($provider_flutterwave->status == 1)
        {{-- start flutterwave payment --}}
        <script src="https://checkout.flutterwave.com/v3.js"></script>
        @php
            $payable_amount = ($total_price - $coupon_discount) * $flutterwave->currency_rate;
            $payable_amount = round($payable_amount, 2);

        @endphp

        <script>
            function flutterwavePayment() {

                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                $.ajax({
                    type: 'get',
                    url: "{{ url('check-schedule-during-payment') }}" + "/" + "{{ $service->slug }}",
                    success: function (response) {
                        if(response.is_available){
                            FlutterwaveCheckout({
                                public_key: "{{ $provider_flutterwave->public_key }}",
                                tx_ref: "{{ substr(rand(0,time()),0,10) }}",
                                amount: {{ $payable_amount }},
                                currency: "{{ $flutterwave->currency_code }}",
                                country: "{{ $flutterwave->country_code }}",
                                payment_options: " ",
                                customer: {
                                email: "{{ $user->email }}",
                                phone_number: "{{ $user->phone }}",
                                name: "{{ $user->name }}",
                                },
                                callback: function (data) {

                                    var tnx_id = data.transaction_id;
                                    var _token = "{{ csrf_token() }}";
                                    $.ajax({
                                        type: 'post',
                                        data : {tnx_id,_token},
                                        url: "{{ url('user/sub/pay-with-flutterwave') }}" + "/" + "{{ $service->slug }}",
                                        success: function (response) {



                                            if(response.status == 'success'){
                                                toastr.success(response.message);
                                                window.location.href = "{{ route('dashboard') }}";
                                            }else{
                                                toastr.error(response.message);
                                                window.location.reload();
                                            }
                                        },
                                        error: function(err) {

                                        }
                                    });
                                },
                                customizations: {
                                title: "{{ $flutterwave->title }}",
                                logo: "{{ asset($flutterwave->logo) }}",
                                },
                            });
                        }else{
                            toastr.error(response.message);
                            window.location.href = "{{ route('ready-to-booking', $service->slug) }}";
                        }
                    },
                    error: function(err) {}
                });



            }
        </script>
        {{-- end flutterwave payment --}}
    @endif
@endif



@if ($provider_paystack)
    @if ($provider_paystack->status == 1)
        {{-- paystack start --}}

        <script src="https://js.paystack.co/v1/inline.js"></script>
        @php
            $public_key = $provider_paystack->public_key;
            $currency = $paystack->paystack_currency_code;
            $currency = strtoupper($currency);

            $ngn_amount = ($total_price - $coupon_discount) * $paystack->paystack_currency_rate;
            $ngn_amount = $ngn_amount * 100;
            $ngn_amount = round($ngn_amount);
        @endphp
        <script>
        function payWithPaystack(){
            var isDemo = "{{ env('APP_MODE') }}"
            if(isDemo == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }
            $.ajax({
                type: 'get',
                url: "{{ url('check-schedule-during-payment') }}" + "/" + "{{ $service->slug }}",
                success: function (response){
                    if(response.is_available){
                        var handler = PaystackPop.setup({
                            key: '{{ $public_key }}',
                            email: '{{ $user->email }}',
                            amount: '{{ $ngn_amount }}',
                            currency: "{{ $currency }}",
                            callback: function(response){
                            let reference = response.reference;
                            let tnx_id = response.transaction;
                            let _token = "{{ csrf_token() }}";
                            $.ajax({
                                type: "get",
                                data: {reference, tnx_id, _token},
                                url: "{{ url('user/sub/pay-with-paystack') }}" + "/" + "{{ $service->slug }}",
                                success: function(response) {
                                    if(response.status == 'success'){
                                        toastr.success(response.message);
                                        window.location.href = "{{ route('dashboard') }}";
                                    }else{
                                        toastr.error(response.message);
                                        window.location.reload();
                                    }
                                },
                                error: function(response){
                                        toastr.error('Server Error');
                                        window.location.reload();
                                }
                            });
                            },
                            onClose: function(){
                                alert('window closed');
                            }
                        });
                        handler.openIframe();
                    }else{
                        toastr.error(response.message);
                        window.location.href = "{{ route('ready-to-booking', $service->slug) }}";
                    }

                },
                error: function(err) {}
            });
        }
        </script>
    @endif
@endif


@endsection
