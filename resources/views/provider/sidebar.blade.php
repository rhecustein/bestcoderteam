@php
    $setting = App\Models\Setting::first();
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('provider.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('provider.dashboard') }}">{{ $setting->sidebar_sm_header }}</a>
      </div>
      <ul class="sidebar-menu">
          <li class="{{ Route::is('provider.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.dashboard') }}"><i class="fas fa-home"></i> <span>{{__('user.Dashboard')}}</span></a></li>

          <li class="nav-item dropdown {{ Route::is('provider.all-booking') || Route::is('provider.pending-booking') || Route::is('provider.booking-show') || Route::is('provider.awaiting-booking') || Route::is('provider.active-booking')  || Route::is('provider.completed-booking') || Route::is('provider.declined-booking') || Route::is('provider.complete-request') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>{{__('user.My Bookings')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('provider.all-booking') || Route::is('provider.booking-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.all-booking') }}">{{__('user.All Bookings')}}</a></li>

                <li class="{{ Route::is('provider.awaiting-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.awaiting-booking') }}">{{__('user.Awaiting Approval')}}</a></li>

                <li class="{{ Route::is('provider.active-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.active-booking') }}">{{__('user.Active Bookings')}}</a></li>

                <li class="{{ Route::is('provider.completed-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.completed-booking') }}">{{__('user.Completed Bookings')}}</a></li>

                <li class="{{ Route::is('provider.complete-request') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.complete-request') }}">{{__('user.Complete Request')}}</a></li>

                <li class="{{ Route::is('provider.declined-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.declined-booking') }}">{{__('user.Declined Bookings')}}</a></li>


            </ul>
          </li>

          @php
                $user = Auth::guard('web')->user();
                $unseenMessages = App\Models\TicketMessage::where(['unseen_user' => 0, 'user_id' => 5])->groupBy('ticket_id')->get();
                $count = $unseenMessages->count();
            @endphp

          <li class="{{ Route::is('provider.ticket') || Route::is('provider.ticket-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.ticket') }}"><i class="fas fa-envelope-open-text"></i> <span>{{__('user.Support Ticket')}} <sup class="badge badge-danger">{{ $count }}</sup></span></a></li>


          <li class="nav-item dropdown {{ Route::is('provider.service.*') || Route::is('provider.awaiting-for-approval-service') || Route::is('provider.active-service') ||  Route::is('provider.banned-service') ||  Route::is('provider.review-list') || Route::is('provider.show-review') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('user.Manage Services')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('provider.service.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.service.index') }}">{{__('user.All Service')}}</a></li>

                <li class="{{ Route::is('provider.awaiting-for-approval-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.awaiting-for-approval-service') }}">{{__('user.Awaiting for Approval')}}</a></li>

                <li class="{{ Route::is('provider.active-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.active-service') }}">{{__('user.Active Service')}}</a></li>

                <li class="{{ Route::is('provider.banned-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.banned-service') }}">{{__('user.Banned Service')}}</a></li>


                <li class="{{ Route::is('provider.review-list') || Route::is('provider.show-review') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.review-list') }}">{{__('user.Service Review')}}</a></li>



            </ul>
          </li>

          <li class="{{ Route::is('provider.appointment-schedule.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.appointment-schedule.index') }}"><i class="far fa-newspaper"></i> <span>{{__('user.Appointment Schedule')}}</span></a></li>

          <li class="{{ Route::is('provider.live-chat') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.live-chat') }}"><i class="far fa-newspaper"></i> <span>{{__('user.Live Chat')}}</span></a></li>

          <li class="nav-item dropdown {{ Route::is('provider.coupon.*') || Route::is('provider.coupon-history') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('user.Manage Coupon')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('provider.coupon.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.coupon.index') }}">{{__('user.Coupon')}}</a></li>

                <li class="{{ Route::is('provider.coupon-history') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.coupon-history') }}">{{__('user.Coupon Histories')}}</a></li>

            </ul>
          </li>


          @if ($setting->commission_type == 'commission')
            <li class="{{ Route::is('seller.my-withdraw.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.my-withdraw.index') }}"><i class="far fa-newspaper"></i> <span>{{__('user.My Withdraw')}}</span></a></li>
          @endif


          @if ($setting->commission_type == 'subscription')

                @php
                    $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                    $module_status = json_decode($json_module_data);
                @endphp

                @if ($module_status->Subscription)
                    <li class="nav-item dropdown {{ Route::is('provider.subscription-plan') || Route::is('provider.purchase-history') || Route::is('provider.purchase-history-show') || Route::is('provider.pending-plan-payment') || Route::is('provider.subscription-payment') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>{{__('user.Subscription Plan')}}</span></a>
                        <ul class="dropdown-menu">

                            <li class="{{  Route::is('provider.subscription-plan') || Route::is('provider.subscription-payment') ? 'active' : '' }}"><a class="nav-link" href="{{route('provider.subscription-plan')}}">{{__('user.Subscription Plan')}}</a></li>

                            <li class="{{  Route::is('provider.purchase-history') || Route::is('provider.purchase-history-show') || Route::is('provider.pending-plan-payment') ? 'active' : '' }}"><a class="nav-link" href="{{route('provider.purchase-history')}}">{{__('user.Purchase History')}}</a></li>

                            <li class="{{ Route::is('provider.pending-plan-payment') ? 'active' : '' }}"><a class="nav-link" href="{{route('provider.pending-plan-payment')}}">{{__('user.Pending Payment')}}</a></li>

                        </ul>
                    </li>


                    <li class="nav-item dropdown {{ Route::is('provider.paypal-gateway') || Route::is('provider.stripe-gateway') || Route::is('provider.razorpay-gateway') || Route::is('provider.flutterwave-gateway') || Route::is('provider.paystack-gateway') || Route::is('provider.mollie-gateway') || Route::is('provider.instamojo-gateway') || Route::is('provider.bank-handcash-gateway') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>{{__('user.Payment Gateway')}}</span></a>
                        <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{route('provider.paypal-gateway')}}">{{__('user.Paypal Gateway')}}</a></li>

                        <li><a class="nav-link" href="{{route('provider.stripe-gateway')}}">{{__('user.Stripe Gateway')}}</a></li>

                        <li><a class="nav-link" href="{{route('provider.razorpay-gateway')}}">{{__('user.Razorpay Gateway')}}</a></li>

                        <li><a class="nav-link" href="{{route('provider.flutterwave-gateway')}}">{{__('user.Flutterwave Gateway')}}</a></li>

                        <li><a class="nav-link" href="{{route('provider.paystack-gateway')}}">{{__('user.Paystack Gateway')}}</a></li>

                        <li><a class="nav-link" href="{{route('provider.mollie-gateway')}}">{{__('user.Mollie Gateway')}}</a></li>

                        <li><a class="nav-link" href="{{route('provider.instamojo-gateway')}}">{{__('user.Instamojo Gateway')}}</a></li>

                        <li><a class="nav-link" href="{{route('provider.bank-handcash-gateway')}}">{{__('user.Bank & Handcash')}}</a></li>


                        </ul>
                    </li>
                @endif
        @endif

        @if (Module::isEnabled('Kyc'))
            <li class="{{ Route::is('provider.kyc') ? 'active' : '' }}"><a class="nav-link" href="{{ route('provider.kyc') }}"><i class="far fa-newspaper"></i> <span>{{__('admin.KYC Verifaction')}}</span></a></li>
        @endif
        </ul>

    </aside>
  </div>

