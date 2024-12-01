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
            <a href="{{ route('provider.my-withdraw.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('user.New withdraw')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('user.SN')}}</th>
                                    <th >{{__('user.Method')}}</th>
                                    <th >{{__('user.Charge')}}</th>
                                    <th >{{__('user.Total Amount')}}</th>
                                    <th >{{__('user.Withdraw Amount')}}</th>
                                    <th >{{__('user.Status')}}</th>
                                    <th >{{__('user.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraws as $index => $withdraw)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $withdraw->method }}</td>
                                        <td>

                                            @if ($setting->currency_position == 'before_price')
                                            {{ $currency_icon->icon }}{{ $withdraw->total_amount - $withdraw->withdraw_amount }}
                                            @else
                                            {{ $withdraw->total_amount - $withdraw->withdraw_amount }}{{ $currency_icon->icon }}
                                            @endif

                                        </td>
                                        <td>

                                            @if ($setting->currency_position == 'before_price')
                                            {{ $currency_icon->icon }}{{ $withdraw->total_amount }}
                                            @else
                                            {{ $withdraw->total_amount }}{{ $currency_icon->icon }}
                                            @endif

                                        </td>
                                        <td>

                                            @if ($setting->currency_position == 'before_price')
                                            {{ $currency_icon->icon }}{{ $withdraw->withdraw_amount }}
                                            @else
                                            {{ $withdraw->withdraw_amount }}{{ $currency_icon->icon }}
                                            @endif

                                        </td>
                                        <td>
                                            @if ($withdraw->status==1)
                                            <span class="badge badge-success">{{__('user.Success')}}</span>
                                            @else
                                            <span class="badge badge-danger">{{__('user.Pending')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('provider.my-withdraw.show',$withdraw->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>


                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
