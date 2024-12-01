@extends('provider.master_layout')
@section('title')
<title>{{__('user.Subscription Payment')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Subscription Payment')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            @if ($stripe->status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($stripe->image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                       
                                        <div class="caption text-center mt-3">
                                            <button type="button" data-toggle="modal" data-target="#stripeModal" class="btn btn-primary">{{__('user.Pay via stripe')}}</button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($paypal->status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($paypal->image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <a href="{{ route('provider.subscription.paypal-payment', $plan->id) }}" class="btn btn-primary">
                                                {{__('user.Pay via PayPal')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($razorpay->status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($razorpay->image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <button type="button" id="razorpay_pay_btn" class="btn btn-primary">
                                                {{__('user.Pay via  Razorpay')}}</button>
                                        </div>
                                    </div>
                                </div>


                                <form action="{{ route('provider.subscription.razorpay-payment', $plan->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @php
                                        $plan_price = $plan->plan_price;
                                        $payableAmount = round($plan_price * $razorpay->currency_rate,2);
                                    @endphp
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ $razorpay->key }}"
                                            data-currency="{{ $razorpay->currency_code }}"
                                            data-amount= "{{ $payableAmount * 100 }}"
                                            data-buttontext="{{__('user.Pay via  Razorpay')}}"
                                            data-name="{{ $razorpay->name }}"
                                            data-description="{{ $razorpay->description }}"
                                            data-image="{{ asset($razorpay->image) }}"
                                            data-prefill.name=""
                                            data-prefill.email=""
                                            data-theme.color="{{ $razorpay->theme_color }}">
                                    </script>
                                </form>
                            @endif

                            @if ($flutterwave->status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($flutterwave->logo) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <button type="button" class="btn btn-primary" onclick="paywithFlutterwave()">
                                                {{__('user.Pay via Flutterwave')}}</button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($paystack->paystack_status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($paystack->paystack_image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <button type="submit" class="btn btn-primary" onclick="payWithPaystack()">{{__('user.Pay via Paystack')}}</button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($mollie->mollie_status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($mollie->mollie_image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <a href="{{ route('provider.subscription.mollie-payment', $plan->id) }}" class="btn btn-primary">
                                                {{__('user.Pay via Mollie')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($instamojo->status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($instamojo->image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <a href="{{ route('provider.subscription.instamojo-payment', $plan->id) }}" class="btn btn-primary">
                                                {{__('user.Pay via Instamojo')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($bank_payment->status == 1)
                                <div class="col-md-4 mt-4">
                                    <div class="thumbnail">
                                        <div class="image-area">
                                            <img src="{{ asset($bank_payment->image) }}"
                                            alt="Lights" class="w-100 gateway-image">
                                        </div>
                                        <div class="caption text-center mt-3">
                                            <a href="javascript:;" data-toggle="modal" data-target="#bankPayment" class="btn btn-primary">
                                                {{__('user.Pay via Bank')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing pricing-highlight">
                            <div class="pricing-title">
                                {{ $plan->plan_name }}
                            </div>
                            <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>{{ $setting->currency_icon }}{{ sprintf('%0.2f', $plan->plan_price) }}</div>
                                <div>
                                    @if ($plan->expiration_date == 'monthly')
                                        {{__('user.Monthly')}}

                                    @elseif ($plan->expiration_date == 'yearly')
                                        {{__('user.Yearly')}}

                                    @elseif ($plan->expiration_date == 'lifetime')

                                    {{__('user.Lifetime')}}
                                    @endif
                                </div>
                            </div>
                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>

                                    @if ($plan->maximum_service == -1)
                                        <div class="pricing-item-label">{{__('user.Unlimited Services')}}</div>
                                    @else
                                        <div class="pricing-item-label">{{ $plan->maximum_service }} {{__('user.Services')}}</div>
                                    @endif

                                </div>

                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">{{__('user.Unlimited Booking')}}</div>
                                </div>

                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">{{__('user.Custom Working Schedule')}}</div>
                                </div>

                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">{{__('user.Support Ticket')}}</div>
                                </div>

                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">{{__('user.Live Chat')}}</div>
                                </div>

                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Stripe Modal -->
    <div class="modal fade" id="stripeModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('user.Stripe Payment')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form role="form" action="{{ route('provider.subscription.stripe-payment', $plan->id) }}" method="post" class="require-validation"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{ $stripe->stripe_key }}"
                        id="payment-form">
                        @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group required">
                                        <label for="">{{__('user.Card Number')}}</label>
                                        <input type="text" autocomplete="off" name="card_number" class="form-control card-number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="">{{__('user.Expired Month')}}</label>
                                        <input type="text" autocomplete="off" name="month" class="form-control card-expiry-month">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="">{{__('user.Expired Year')}}</label>
                                        <input type="text" autocomplete="off" name="year" class="form-control card-expiry-year">
                                    </div>
                                </div>

                                <div class="col-12 required">
                                    <div class="form-group">
                                        <label for="">{{__('user.CVC')}}</label>
                                        <input type="text" autocomplete="off" name="cvc" class="form-control card-cvc">
                                    </div>
                                </div>

                                <div class='form-group col-12 error d-none'>
                                    <div class='col-md-12  form-group '>
                                        <div class='alert-danger alert'>
                                            {{__('user.Please provide your valid card information')}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">{{__('user.Pay Now')}}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bank Modal -->
    <div class="modal fade" id="bankPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('user.Bank Payment')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-2">
                            {!! nl2br($bank_payment->account_info) !!}
                        </div>

                        <form action="{{ route('provider.subscription.bank-payment', $plan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">{{__('user.Transaction')}}</label>
                                    <textarea name="transaction" class="form-control text-area-5"></textarea>
                                </div>

                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit">{{__('user.Submit')}}</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



    @php
        $plan_price = $plan->plan_price;

        // start paystack
        $public_key = $paystack->paystack_public_key;
        $currency = $paystack->paystack_currency_code;
        $currency = strtoupper($currency);

        $ngn_amount = $plan_price * $paystack->paystack_currency_rate;
        $ngn_amount = $ngn_amount * 100;
        $ngn_amount = round($ngn_amount);
        // end paystack

        // start fluttewave
        $payable_amount = $plan_price * $flutterwave->currency_rate;
        $payable_amount = round($payable_amount, 2);
    @endphp


    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script>
        'use strict'
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $('.error').removeClass('d-none');

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
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

            $("#razorpay_pay_btn").on("click", function(){

                $(".razorpay-payment-button").click();
            })

        });


        function paywithFlutterwave() {
            FlutterwaveCheckout({
                public_key: "{{ $flutterwave->public_key }}",
                tx_ref: "{{ rand(4444,44444444) }}",
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
                    var plan_id = '{{ $plan->id }}';
                    $.ajax({
                        type: 'post',
                        data : {tnx_id,_token,plan_id},
                        url: "{{ route('provider.subscription.flutterwave-payment') }}",
                        success: function (response) {
                            if(response.status == 'success'){
                                window.location.href = "{{ route('provider.purchase-history') }}";
                            }else{
                                window.location.reload();
                            }
                        },
                        error: function(err) {
                            window.location.reload();
                        }
                    });

                },
                customizations: {
                title: "{{ $flutterwave->title }}",
                logo: "{{ asset($flutterwave->logo)}}",
                },
            });
        }

        function payWithPaystack(){
            var plan_id = '{{ $plan->id }}';

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
                    type: "post",
                    data: {reference, tnx_id, _token, plan_id},
                    url: "{{ route('provider.subscription.paystack-payment') }}",
                    success: function(response) {
                        if(response.status == 'success'){
                            window.location.href = "{{ route('provider.purchase-history') }}";
                        }else{
                            window.location.reload();
                        }
                    }
                });
                },
                onClose: function(){
                    alert('window closed');
                }
            });
            handler.openIframe();
        }
    </script>

@endsection


