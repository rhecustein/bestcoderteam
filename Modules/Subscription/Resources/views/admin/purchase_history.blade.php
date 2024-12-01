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
                        <div class="card-header">
                                <h4>

                                    <a href="{{ route('admin.assign-plan') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>{{__('admin.Assign Plan')}}</a>
                                </h4>


                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>{{__('admin.Serial')}}</th>
                                        <th>{{__('admin.Provider')}}</th>
                                        <th>{{__('admin.Plan')}}</th>
                                        <th>{{__('admin.Expiration')}}</th>
                                        <th>{{__('admin.Status')}}</th>
                                        <th>{{__('admin.Payment')}}</th>
                                        <th>{{__('admin.Action')}}</th>
                                    </tr>

                                    @foreach ($histories as $index => $history)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td><a href="{{ route('admin.provider-show', $history->provider_id) }}">{{ $history->provider->name }}</a></td>
                                            <td>{{ $history->plan_name }}</td>

                                            <td>{{ $history->expiration }}</td>

                                            <td>
                                                @if ($history->status == 'active')
                                                    <div class="badge badge-success">{{__('admin.Active')}}</div>
                                                @elseif ($history->status == 'pending')
                                                    <div class="badge badge-danger">{{__('admin.Pending')}}</div>
                                                @elseif ($history->status == 'expired')
                                                <div class="badge badge-danger">{{__('admin.Expired')}}</div>

                                                @endif
                                            </td>

                                            <td>
                                                @if ($history->payment_status == 'success')
                                                    <div class="badge badge-success">{{__('admin.Success')}}</div>
                                                @else
                                                    <div class="badge badge-danger">{{__('Pending')}}</div>
                                                @endif
                                            </td>



                                            <td>
                                                <a href="{{ route('admin.purchase-history-show', $history->id) }}" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-eye"></i></a>
                                                <a href="" data-url="{{ route('admin.delete-plan-payment', $history->id) }}"
                                                class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>

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

