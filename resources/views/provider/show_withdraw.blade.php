@extends('provider.master_layout')
@section('title')
<title>{{__('user.My withdraw')}}</title>
@endsection
@section('provider-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('user.My withdraw')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('provider.dashboard') }}">{{__('user.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('user.My withdraw')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('provider.my-withdraw.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('user.My withdraw')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td width="50%">{{__('user.Withdraw Method')}}</td>
                                <td width="50%">{{ $withdraw->method }}</td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('user.Withdraw Charge')}}</td>
                                <td width="50%">{{ $withdraw->withdraw_charge }}%</td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('user.Withdraw Charge Amount')}}</td>
                                <td width="50%">

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $withdraw->total_amount - $withdraw->withdraw_amount }}
                                    @else
                                    {{ $withdraw->total_amount - $withdraw->withdraw_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <td width="50%">{{__('user.Total amount')}}</td>
                                <td width="50%">

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $withdraw->total_amount }}
                                    @else
                                    {{ $withdraw->total_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('user.Withdraw amount')}}</td>
                                <td width="50%">

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $currency_icon->icon }}{{ $withdraw->withdraw_amount }}
                                    @else
                                    {{ $withdraw->withdraw_amount }}{{ $currency_icon->icon }}
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('user.Status')}}</td>
                                <td width="50%">
                                    @if ($withdraw->status==1)
                                    <span class="badge badge-success">{{__('user.Success')}}</span>
                                    @else
                                    <span class="badge badge-danger">{{__('user.Pending')}}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('user.Requested Date')}}</td>
                                <td width="50%">{{ $withdraw->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @if ($withdraw->status==1)
                                <tr>
                                    <td width="50%">{{__('user.Approved Date')}}</td>
                                    <td width="50%">{{ $withdraw->approved_date }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td width="50%">{{__('user.Account Information')}}</td>
                                <td width="50%">
                                    {!! clean(nl2br($withdraw->account_info)) !!}
                                </td>
                            </tr>

                        </table>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>


@endsection
