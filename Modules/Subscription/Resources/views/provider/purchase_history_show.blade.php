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

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">

                                        <tr>
                                            <td>{{__('user.Plan')}}</td>
                                            <td>{{ $history->plan_name }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Expiration')}}</td>
                                            <td>{{ $history->expiration }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Expirated Date')}}</td>
                                            <td>{{ $history->expiration_date }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Remaining day')}}</td>
                                            <td>
                                                @if ($history->status == 'active')
                                                    @if ($history->expiration_date == 'lifetime')
                                                        {{__('user.Lifetime')}}
                                                    @else
                                                        @php
                                                            $date1 = new DateTime(date('Y-m-d'));
                                                            $date2 = new DateTime($history->expiration_date);
                                                            $interval = $date1->diff($date2);
                                                            $remaining = $interval->days;
                                                        @endphp

                                                        @if ($remaining > 0)
                                                            {{ $remaining }} {{__('user.Days')}}
                                                        @else
                                                            {{__('user.Expired')}}
                                                        @endif

                                                    @endif
                                                @else
                                                    {{__('user.Expired')}}
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Number of service')}}</td>
                                            <td>{{ $history->maximum_service }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Payment Method')}}</td>
                                            <td>{{ $history->payment_method }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Transaction')}}</td>
                                            <td>{!! nl2br($history->transaction) !!}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('user.Status')}}</td>
                                            <td>
                                                @if ($history->status == 'active')
                                                    <div class="badge badge-success">{{__('user.Active')}}</div>
                                                @elseif ($history->status == 'pending')
                                                    <div class="badge badge-danger">{{__('user.Pending')}}</div>
                                                @elseif ($history->status == 'expired')
                                                <div class="badge badge-danger">{{__('user.Expired')}}</div>

                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{__('user.Payment')}}
                                            </td>
                                            <td>
                                                @if ($history->payment_status == 'success')
                                                    <div class="badge badge-success">{{__('user.Success')}}</div>
                                                @else
                                                    <div class="badge badge-danger">{{__('user.Pending')}}</div>
                                                @endif
                                            </td>
                                        </tr>

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


