@extends('provider.master_layout')
@section('title')
<title>{{__('user.Subscription Plan')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Subscription Plan')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    @foreach ($plans as $index => $plan )
                        <div class="col-12 col-md-4 col-lg-4">
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
                                <div class="pricing-cta">
                                    @if ($plan->plan_price == 0)
                                        <a href="{{ route('provider.subscription.free-enroll', $plan->id) }}">{{__('user.Trail Now')}} <i class="fas fa-arrow-right"></i></a>
                                    @else
                                        <a href="{{ route('provider.subscription-payment', $plan->id) }}">{{__('user.Purchase Now')}} <i class="fas fa-arrow-right"></i></a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

@endsection


