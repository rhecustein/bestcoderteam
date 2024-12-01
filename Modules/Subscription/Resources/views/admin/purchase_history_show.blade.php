@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Purchase History')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Purchase History')}}</h1>

        </div>

        <div class="section-body">
            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">

                                    <tr>
                                        <td>{{__('admin.Provider')}}</td>
                                        <td><a href="{{ route('admin.provider-show', $history->provider_id) }}">{{ $history->provider->name }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{__('admin.Plan')}}</td>
                                        <td>{{ $history->plan_name }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('admin.Expiration')}}</td>
                                        <td>{{ $history->expiration }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('admin.Expirated Date')}}</td>
                                        <td>{{ $history->expiration_date }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('admin.Remaining day')}}</td>
                                        <td>
                                            @if ($history->status == 'active')
                                                @if ($history->expiration_date == 'lifetime')
                                                    {{__('admin.Lifetime')}}
                                                @else
                                                    @php
                                                        $date1 = new DateTime(date('Y-m-d'));
                                                        $date2 = new DateTime($history->expiration_date);
                                                        $interval = $date1->diff($date2);
                                                        $remaining = $interval->days;
                                                    @endphp

                                                    @if ($remaining > 0)
                                                        {{ $remaining }} {{__('admin.Days')}}
                                                    @else
                                                        {{__('admin.Expired')}}
                                                    @endif

                                                @endif
                                            @else
                                                {{__('admin.Expired')}}
                                            @endif
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>{{__('admin.Number of service')}}</td>
                                        <td>{{ $history->maximum_service }}</td>
                                    </tr>


                                    <tr>
                                        <td>{{__('admin.Payment Method')}}</td>
                                        <td>{{ $history->payment_method }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('admin.Transaction')}}</td>
                                        <td>{!! nl2br($history->transaction) !!}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('admin.Status')}}</td>
                                        <td>
                                            @if ($history->status == 'active')
                                                <div class="badge badge-success">{{__('admin.Active')}}</div>
                                            @elseif ($history->status == 'pending')
                                                <div class="badge badge-danger">{{__('admin.Pending')}}</div>
                                            @elseif ($history->status == 'expired')
                                            <div class="badge badge-danger">{{__('admin.Expired')}}</div>

                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{__('admin.Payment')}}
                                        </td>
                                        <td>
                                            @if ($history->payment_status == 'success')
                                                <div class="badge badge-success">{{__('admin.Success')}}</div>
                                            @else
                                                <div class="badge badge-danger">{{__('admin.Pending')}}</div>
                                            @endif
                                        </td>
                                    </tr>



                                </table>
                            </div>

                            <a href="" data-url="{{ route('admin.delete-plan-payment', $history->id) }}" class="btn btn-danger delete">{{__('admin.Delete')}}</a>

                            @if ($history->payment_status == 'pending')
                                <a href="javascript:;" data-toggle="modal" data-target="#paymentUpdate" class="btn btn-primary">{{__('admin.Payment approved')}}</a>
                            @endif

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


    <!-- Modal -->
    <div class="modal fade" id="paymentUpdate" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Payment Approved')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <p class="text-danger">{{__('admin.Are you sure approved this payment ?')}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('admin.Close')}}</button>

                    <form action="{{ route('admin.approved-plan-payment', $history->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="delete">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                @method("DELETE")
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('admin.Delete Purchase History')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">{{__('admin.Are You Sure to Delete this Plan?')}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-danger">{{__('admin.Yes, Delete')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(function() {
            'use strict'

            $('.delete').on('click', function(e) {
                e.preventDefault();
                const modal = $('#delete');
                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            })
        })
    </script>
@endsection

