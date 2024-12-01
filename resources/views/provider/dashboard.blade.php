@extends('provider.master_layout')
@section('title')
<title>{{__('user.Dashboard')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Dashboard')}}</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
                <h4 class="dashboard_title">{{__('user.Today')}}</h4>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Total Booking')}}</h4>
                  </div>
                  <div class="card-body">
                    {{ $today_total_order }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Awaiting Booking')}}</h4>
                  </div>
                  <div class="card-body">
                    {{ $today_total_awating_order }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Active Booking')}}</h4>
                  </div>
                  <div class="card-body">
                    {{ $today_approved_order }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Complete Booking')}}</h4>
                  </div>
                  <div class="card-body">
                    {{ $today_complete_order }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Total Earnings')}}</h4>
                  </div>
                  <div class="card-body">
                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $today_total_earning }}
                    @else
                    {{ $today_total_earning }}{{ $currency_icon->icon }}
                    @endif

                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Withdraw Request')}}</h4>
                  </div>
                  <div class="card-body">

                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $today_withdraw_request }}
                    @else
                    {{ $today_withdraw_request }}{{ $currency_icon->icon }}
                    @endif
                  </div>
                </div>
              </div>
            </div>


            <div class="col-12">
                <h4 class="dashboard_title">{{__('user.This Month')}}</h4>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>{{__('user.Total Booking')}}</h4>
                    </div>
                    <div class="card-body">
                    {{ $monthly_total_order }}
                    </div>
                </div>
                </div>
            </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Awaiting Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $monthly_total_awating_order }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Active Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $monthly_approved_order }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Complete Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $monthly_complete_order }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Total Earnings')}}</h4>
                    </div>
                    <div class="card-body">

                    @if ($setting->currency_position == 'before_price')
                        {{ $currency_icon->icon }}{{ $monthly_total_earning }}
                    @else
                        {{ $monthly_total_earning }}{{ $currency_icon->icon }}
                    @endif
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Withdraw Request')}}</h4>
                    </div>
                    <div class="card-body">


                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $monthly_withdraw_request }}
                    @else
                    {{ $monthly_withdraw_request }}{{ $currency_icon->icon }}
                    @endif
                    </div>
                  </div>
                </div>
              </div>

            <div class="col-12">
                <h4 class="dashboard_title">{{__('user.This Year')}}</h4>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>{{__('user.Total Booking')}}</h4>
                    </div>
                    <div class="card-body">
                    {{ $yearly_total_order }}
                    </div>
                </div>
                </div>
            </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Awaiting Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $yearly_total_awating_order }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Active Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $yearly_approved_order }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Complete Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $yearly_complete_order }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-danger">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Total Earnings')}}</h4>
                    </div>
                    <div class="card-body">

                        @if ($setting->currency_position == 'before_price')
                        {{ $currency_icon->icon }}{{ $yearly_total_earning }}
                        @else
                        {{ $yearly_total_earning }}{{ $currency_icon->icon }}
                        @endif
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-danger">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Withdraw Request')}}</h4>
                    </div>
                    <div class="card-body">

                    @if ($setting->currency_position == 'before_price')
                      {{ $currency_icon->icon }}{{ $yearly_withdraw_request }}
                    @else
                    {{ $yearly_withdraw_request }}{{ $currency_icon->icon }}
                    @endif
                    </div>
                  </div>
                </div>
              </div>

            <div class="col-12">
                <h4 class="dashboard_title">{{__('user.Total')}}</h4>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>{{__('user.Total Booking')}}</h4>
                    </div>
                    <div class="card-body">
                    {{ $total_total_order }}
                    </div>
                </div>
                </div>
            </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Awaiting Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $total_total_awating_order }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Active Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $total_approved_order }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Complete Booking')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $total_complete_order }}
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Total Earnings')}}</h4>
                    </div>
                    <div class="card-body">

                    @if ($setting->currency_position == 'before_price')
                      {{ $currency_icon->icon }}{{ $total_total_earning }}
                    @else
                    {{ $total_total_earning }}{{ $currency_icon->icon }}
                    @endif
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Withdraw Request')}}</h4>
                    </div>
                    <div class="card-body">

                      @if ($setting->currency_position == 'before_price')
                      {{ $currency_icon->icon }}{{ $total_withdraw_request }}
                    @else
                    {{ $total_withdraw_request }}{{ $currency_icon->icon }}
                    @endif
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                    <i class="fas fa-th-large"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>{{__('user.Service')}}</h4>
                    </div>
                    <div class="card-body">
                      {{ $total_service }}
                    </div>
                  </div>
                </div>
              </div>

          </div>
      </div>

    </section>
</div>
@endsection
