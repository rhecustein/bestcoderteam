@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Subscription Plan')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Subscription Plan')}}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
        </div>
      </div>



    <div class="section-body">
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                            <h4>

                                <a href="{{ route('admin.subscription-plan.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>
                                   {{__('admin.Add New')}}</a>
                            </h4>


                    </div>
                    <div class="card-body text-center">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>{{__('admin.Serial')}}</th>
                                    <th>{{__('admin.Name')}}</th>
                                    <th>{{__('admin.Price')}}</th>
                                    <th>{{__('admin.Expiration')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                </tr>

                                @foreach ($plans as $index => $plan)
                                    <tr>
                                        <td>{{ $plan->serial }}</td>
                                        <td>{{ $plan->plan_name }}</td>
                                        <td>{{ $setting->currency_icon }}{{ $plan->plan_price }}</td>
                                        <td>{{ $plan->expiration_date }}</td>

                                        <td>
                                            @if ($plan->status == 1)
                                                <div class="badge badge-success">{{__('admin.Active')}}</div>
                                            @else
                                                <div class="badge badge-danger">{{__('admin.Inactive')}}</div>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.subscription-plan.edit', $plan->id) }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-edit"></i></a>
                                            @if ($plan->SubscriptionPlan->count() == 0)
                                            <a href="" data-url="{{ route('admin.subscription-plan.destroy', $plan->id) }}"
                                            class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                                            @else
                                                <a href="javascript:;" data-toggle="modal" data-target="#canNotDeleteModal" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach


                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</section>
</div>

    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                    <div class="modal-body">
                        {{__('admin.You can not delete this Plan. Because there are one or more Plan has been Purcheced.')}}
                    </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
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
                        <h5 class="modal-title">{{__('admin.Delete Plan')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">{{__('admin.Are You Sure to Delete this Plan ?')}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-success">{{__('admin.Yes, Delete')}}</button>
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


