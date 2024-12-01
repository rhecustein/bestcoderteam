@extends('provider.master_layout')
@section('title')
<title>{{__('user.Purchase History')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Purchase History')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            {{-- <th>@changeLang('Sl')</th>
                                            <th>@changeLang('Plan')</th>
                                            <th>@changeLang('Expiration')</th>
                                            <th>@changeLang('Expired Date')</th>
                                            <th>@changeLang('Status')</th>
                                            <th>@changeLang('Payment')</th>
                                            <th>@changeLang('Action')</th> --}}

                                            <th>{{__('user.Serial')}}</th>
                                            <th>{{__('user.Plan')}}</th>
                                            <th>{{__('user.Expiration')}}</th>
                                            <th>{{__('user.Expired Date')}}</th>
                                            <th>{{__('user.Status')}}</th>
                                            <th>{{__('user.Payment')}}</th>
                                            <th>{{__('user.Action')}}</th>
                                        </tr>

                                        @foreach ($histories as $index => $history)
                                            <tr>
                                                <td>{{ ++$index }}</td>

                                                <td>{{ $history->plan_name }}</td>

                                                <td>{{ $history->expiration }}</td>
                                                <td>{{ $history->expiration_date }}</td>

                                                <td>
                                                    @if ($history->status == 'active')
                                                        <div class="badge badge-success">{{__('user.Active')}}</div>
                                                    @elseif ($history->status == 'pending')
                                                        <div class="badge badge-danger">{{__('user.Pending')}}</div>
                                                    @elseif ($history->status == 'expired')
                                                    <div class="badge badge-danger">{{__('user.Expired')}}</div>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($history->payment_status == 'success')
                                                        <div class="badge badge-success">{{__('user.Success')}}</div>
                                                    @else
                                                        <div class="badge badge-danger">{{__('user.Pending')}}</div>
                                                    @endif
                                                </td>



                                                <td>
                                                    <a href="{{ route('provider.purchase-history-show', $history->id) }}" class="btn btn-primary btn-sm"><i
                                                        class="fa fa-eye"></i></a>

                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                            </div>

                            @if($histories->hasPages())

                                <div class="card-footer">

                                    {{ $histories->links('admin.partials.paginate') }}

                                </div>

                             @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection


