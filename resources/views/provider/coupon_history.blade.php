@extends('provider.master_layout')
@section('title')
<title>{{__('user.Coupon Histories')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Coupon Histories')}}</h1>
      </div>

        <div class="section-body">

            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('user.SN')}}</th>
                                            <th>{{__('user.Coupon Code')}}</th>
                                            <th>{{__('user.Discount Amount')}}</th>
                                            <th>{{__('user.Date')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupon_histories as $index => $coupon_history)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $coupon_history->coupon_code }}</td>
                                                <td>

                                                    @if ($setting->currency_position == 'before_price')
                                                    {{ $setting->currency_icon }}{{ $coupon_history->discount_amount }}
                                                    @else
                                                    {{ $coupon_history->discount_amount }}{{ $setting->currency_icon }}
                                                    @endif

                                                </td>
                                                <td>{{ date('H:iA, d M Y', strtotime($coupon_history->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

