<p style="text-align: center">Please wait. Your order is processing....</p>
<p style="text-align: center">Do not press browser back or forward button while you are in current page</p>

<script src="https://checkout.flutterwave.com/v3.js"></script>

<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>

@php
    $payable_amount = $total_price * $flutterwave->currency_rate;
    $payable_amount = round($payable_amount, 2);
    $tx_ref = uniqid();

@endphp

<script>
    makePayment();
    function makePayment() {
      FlutterwaveCheckout({
        public_key: "{{ $flutterwave->public_key }}",
        tx_ref: "{{ $tx_ref }}",
        amount: {{ $payable_amount }},
        currency: "{{ $flutterwave->currency_code }}",
        country: "{{ $flutterwave->country_code }}",
        payment_options: " ",
        customer: {
            email: "{{ $user->email }}",
            phone_number: "{{ $user->phone ? $user->phone : '00000000' }}",
            name: "{{ $user->name }}",
        },
        callback: function (data) {
            // $("iframe").addClass('')

            // $('iframe').attr('style', 'display: none !important');

            let tnx_id = data.transaction_id;
            let _token = "{{ csrf_token() }}";
            let frontend_success_url = "{{ $frontend_success_url }}";
            let frontend_faild_url = "{{ $frontend_faild_url }}";
            let request_from = "{{ $request_from }}";
            let token = "{{ $token }}";
            let slug = "{{ $slug }}";
            $.ajax({
                type: 'post',
                data : {tnx_id, _token, token, slug},
                url: "{{ route('pay-with-flutterwave-webview') }}",
                success: function (response) {
                    if(response.status == 'success'){
                        let order_id = response.order_id;
                        if(request_from == 'react_web'){
                            let success_url = frontend_success_url+"/"+ order_id;
                            window.location.href = success_url;
                        }else{
                            let mobile_success_url = "{{ route('webview-payment-success') }}";
                            window.location.href = mobile_success_url;
                        }
                    }else{
                        if(request_from == 'react_web'){
                            window.location.href = frontend_faild_url;
                        }else{
                            let mobile_faild_url = "{{ route('webview-payment-faild') }}";
                            window.location.href = mobile_faild_url;
                        }
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
    }
</script>






