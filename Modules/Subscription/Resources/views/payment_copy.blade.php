@extends('frontend.layout.master')
@section('breadcrumb')
 <section class="section">
          <div class="section-header">

            <h1>@changeLang('Payment')</h1>



          </div>
</section>
@endsection
@section('content')

<div class="row">

    <div class="col-md-8">
        <div class="row">

            @if ($provider_stripe)
                @if ($provider_stripe->status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $stripe->gateway_image) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                <button type="button" data-toggle="modal" data-target="#stripeModal" class="btn btn-primary">{{changeDynamic('Pay Via '.$stripe->gateway_name)}}</button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif


            @if ($paypal->status == 1)
                <div class="col-md-4 mt-4">
                    <div class="thumbnail">
                        <div class="image-area">
                            <img src="{{ getFile('gateways' , $paypal->gateway_image) }}"
                            alt="Lights" class="w-100 gateway-image">
                        </div>
                        <div class="caption text-center mt-3">
                            <a href="{{ route('user.sub.paypal-payment', $booking->id) }}" class="btn btn-primary">
                                {{changeDynamic('Pay Via '.$paypal->gateway_name)}}</a>
                        </div>
                    </div>
                </div>
            @endif

            @if ($provider_razorpay)
                @if ($provider_razorpay->status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $razorpay->image) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                <button type="button" id="razorpay_pay_btn" class="btn btn-primary">
                                    {{changeDynamic('Pay Via  Razorpay')}}</button>
                            </div>
                        </div>
                    </div>


                    <form action="{{ route('user.sub.razorpay-payment', $booking->id) }}" method="POST" class="d-none" id="razorpay_form">
                        @csrf
                        @php
                            $booking_amount = $booking->amount;
                            $payableAmount = round($booking_amount * $razorpay->currency_rate,2);
                        @endphp
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ $provider_razorpay->key }}"
                                data-currency="{{ $razorpay->currency_code }}"
                                data-amount= "{{ $payableAmount * 100 }}"
                                data-buttontext="{{changeDynamic('Pay')}} {{ $payableAmount }} {{ $razorpay->currency_code }}"
                                data-name="{{ $razorpay->name }}"
                                data-description="{{ $razorpay->description }}"
                                data-image="{{ asset($razorpay->image) }}"
                                data-prefill.name=""
                                data-prefill.email=""
                                data-theme.color="{{ $razorpay->theme_color }}">
                        </script>
                    </form>
                @endif
            @endif


            @if ($provider_flutterwave)
                @if ($provider_flutterwave->status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $flutterwave->logo) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                @if ($booking->payment_confirmed == 0)
                                <button type="button" class="btn btn-primary" onclick="paywithFlutterwave()">
                                    {{changeDynamic('Pay Via Flutterwave')}}</button>
                                @else
                                <button type="button" class="btn btn-primary" onclick="alert('@changeLang('Aready payment')')">
                                    {{changeDynamic('Pay Via Flutterwave')}}</button>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($provider_paystack)
                @if ($provider_paystack->status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $paystack->image) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                @if ($booking->payment_confirmed == 0)
                                <button type="submit" class="btn btn-primary" onclick="payWithPaystack()">{{changeDynamic('Pay Via Paystack')}}</button>
                                @else
                                <button type="submit" class="btn btn-primary" onclick="alert('@changeLang('Aready payment')')">{{changeDynamic('Pay Via Paystack')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endif


            @if ($provider_mollie)
                @if ($provider_mollie->status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $mollie->image) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                <a href="{{ route('user.sub.mollie-payment', $booking->id) }}" class="btn btn-primary">
                                    {{changeDynamic('Pay Via Mollie')}}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($provider_instamojo)
                @if ($provider_instamojo->status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $instamojo->image) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                <a href="{{ route('user.sub.instamojo-payment', $booking->id) }}" class="btn btn-primary">
                                    {{changeDynamic('Pay Via Instamojo')}}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($provider_ban_handcash)
                @if ($provider_ban_handcash->bank_status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $bank_payment->gateway_image) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                <a href="javascript:;" data-toggle="modal" data-target="#bankPayment" class="btn btn-primary">
                                    {{changeDynamic('Pay Via Bank')}}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            @if ($provider_ban_handcash)
                @if ($provider_ban_handcash->handcash_status == 1)
                    <div class="col-md-4 mt-4">
                        <div class="thumbnail">
                            <div class="image-area">
                                <img src="{{ getFile('gateways' , $handcash->handcash_image) }}"
                                alt="Lights" class="w-100 gateway-image">
                            </div>
                            <div class="caption text-center mt-3">
                                <a href="javascript:;" data-toggle="modal" data-target="#handcashPayment" class="btn btn-primary">
                                    {{changeDynamic('Pay Via Handcash')}}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif






        </div>
    </div>
    <div class="col-md-4">
        <div class="card credit-card-box">
            <div class="card-header text-center">
                <h5>@changeLang('Payment Preview')</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">

                    <li class="list-group-item d-flex justify-content-between">
                        <span>@changeLang('Service Name'):</span>
                        <span>{{$booking->service->name}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@changeLang('Amount'):</span>
                        <span>{{$booking->amount.' '.$general->site_currency}}</span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between">
                        <span>@changeLang('Total Payable Amount'):</span>
                        <span>{{$booking->amount.' '.$general->site_currency}}</span>
                    </li>



                </ul>
            </div>
        </div>
    </div>

</div>


@if ($provider_stripe)
 <!-- Modal -->
 <div class="modal fade" id="stripeModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">@changeLang('Stripe Payment')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form role="form" action="{{ route('user.sub.stripe-payment', $booking->id) }}" method="post" class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ $provider_stripe->stripe_key }}"
                    id="payment-form">
                    @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group required">
                                    <label for="">@changeLang('Card Number')</label>
                                    <input type="text" autocomplete="off" name="card_number" class="form-control card-number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label for="">@changeLang('Expired Month')</label>
                                    <input type="text" autocomplete="off" name="month" class="form-control card-expiry-month">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required">
                                    <label for="">@changeLang('Expired Year')</label>
                                    <input type="text" autocomplete="off" name="year" class="form-control card-expiry-year">
                                </div>
                            </div>

                            <div class="col-12 required">
                                <div class="form-group">
                                    <label for="">@changeLang('CVC')</label>
                                    <input type="text" autocomplete="off" name="cvc" class="form-control card-cvc">
                                </div>
                            </div>

                            <div class='form-group col-12 error d-none'>
                                <div class='col-md-12  form-group '>
                                    <div class='alert-danger alert'>
                                    @changeLang('Please correct the errors and try again.')</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">@changeLang('Pay Now')</button>
                            </div>





                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endif


@if ($provider_ban_handcash)
    @if ($provider_ban_handcash->bank_status == 1)
        <!-- Modal -->
        <div class="modal fade" id="bankPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">@changeLang('Bank Payment')</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">

                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>@changeLang('Bank Name')</td>
                                    <td>{{ $provider_ban_handcash->bank_name }}</td>
                                </tr>

                                <tr>
                                    <td>@changeLang('Account Number')</td>
                                    <td>{{ $provider_ban_handcash->account_number }}</td>
                                </tr>

                                <tr>
                                    <td>@changeLang('Routing Number')</td>
                                    <td>{{ $provider_ban_handcash->routing_number }}</td>
                                </tr>

                                <tr>
                                    <td>@changeLang('Branch Name')</td>
                                    <td>{{ $provider_ban_handcash->branch_name }}</td>
                                </tr>

                            </table>
                            <form action="{{ route('user.sub.bank-payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    @foreach ($bank_payment->user_proof_param as $proof)
                                        @if($proof['type'] == 'text')

                                            <div class="form-group col-md-12">
                                                <label for="">{{__($proof['field_name'])}}</label>
                                                <input type="text" name="{{strtolower(str_replace(' ', '_',$proof['field_name']))}}" class="form-control" {{$proof['validation'] == 'required' ? 'required' :''}} autocomplete="off">
                                            </div>

                                        @endif
                                        @if($proof['type'] == 'textarea')

                                            <div class="form-group col-md-12">
                                                <label for="">{{__($proof['field_name'])}}</label>
                                                <textarea name="{{strtolower(str_replace(' ', '_',$proof['field_name']))}}" class="form-control" {{$proof['validation'] == 'required' ? 'required' :''}} ></textarea>
                                            </div>

                                        @endif

                                        @if($proof['type'] == 'file')

                                            <div class="form-group col-md-12">
                                                <label for="">{{__($proof['field_name'])}}</label>
                                                <input type="file" name="{{strtolower(str_replace(' ', '_',$proof['field_name']))}}" class="form-control" {{$proof['validation'] == 'required' ? 'required' :''}} >
                                            </div>

                                        @endif
                                    @endforeach
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">@changeLang('Submit')</button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endif

@if ($provider_ban_handcash)
    @if ($provider_ban_handcash->handcash_status == 1)
    <!-- Modal -->
    <div class="modal fade" id="handcashPayment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">@changeLang('Handcash Payment')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-4">
                            {!! nl2br($provider_ban_handcash->handcash_instruction) !!}
                        </div>
                        <a href="{{ route('user.sub.handcash-payment', $booking->id) }}" class="btn btn-primary btn-lg btn-block" type="submit">@changeLang('Payment')</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
@endif


@php
$booking_amount = $booking->amount;

// start paystack
$public_key = $provider_paystack->public_key;
$currency = $paystack->currency_code;
$currency = strtoupper($currency);

$ngn_amount = $booking_amount * $paystack->currency_rate;
$ngn_amount = $ngn_amount * 100;
$ngn_amount = round($ngn_amount);
// end paystack

// start fluttewave
$payable_amount = $booking_amount * $flutterwave->currency_rate;
$payable_amount = round($payable_amount, 2);
@endphp

@endsection




@push('custom-script')
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
                public_key: "{{ $provider_flutterwave->public_key }}",
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
                    var booking_id = '{{ $booking->id }}';
                    $.ajax({
                        type: 'post',
                        data : {tnx_id,_token,booking_id},
                        url: "{{ route('user.sub.flutterwave-payment') }}",
                        success: function (response) {
                            if(response.status == 'success'){
                                window.location.href = "{{ route('user.bookings') }}";
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
                logo: "{{ getFile('gateways' , $flutterwave->logo) }}",
                },
            });
        }

        function payWithPaystack(){
            var booking_id = '{{ $booking->id }}';
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
                    data: {reference, tnx_id, _token, booking_id},
                    url: "{{ route('user.sub.paystack-payment') }}",
                    success: function(response) {
                        if(response.status == 'success'){
                            window.location.href = "{{ route('user.bookings') }}";
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

@endpush
