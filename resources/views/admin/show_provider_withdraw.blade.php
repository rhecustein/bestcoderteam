@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Withdraw Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Withdraw Details')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Withdraw Details')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.provider-withdraw') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Provider withdraw')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td width="50%">{{__('admin.Provider')}}</td>
                                <td width="50%">
                                    <a href="{{ route('admin.provider-show', $withdraw->user_id) }}">{{ $withdraw->provider->name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('admin.Withdraw Method')}}</td>
                                <td width="50%">{{ $withdraw->method }}</td>
                            </tr>

                            <tr>
                                <td width="50%">{{__('admin.Withdraw Charge')}}</td>
                                <td width="50%">{{ $withdraw->withdraw_charge }}%</td>
                            </tr>

                            <tr>
                                <td width="50%">{{__('admin.Withdraw Charge Amount')}}</td>
                                <td width="50%">
                                    @if ($setting->currency_position == 'before_price')
                                    {{ $setting->currency_icon }}{{ $withdraw->total_amount - $withdraw->withdraw_amount }}
                                    @else
                                    {{ $withdraw->total_amount - $withdraw->withdraw_amount }}{{ $setting->currency_icon }}
                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <td width="50%">{{__('admin.Total amount')}}</td>
                                <td width="50%">

                                    @if ($setting->currency_position == 'before_price')
                                    {{ $setting->currency_icon }}{{ $withdraw->total_amount }}
                                    @else
                                    {{ $withdraw->total_amount }}{{ $setting->currency_icon }}
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('admin.Withdraw amount')}}</td>
                                <td width="50%">
                                    @if ($setting->currency_position == 'before_price')
                                    {{ $setting->currency_icon }}{{ $withdraw->withdraw_amount }}
                                    @else
                                    {{ $withdraw->withdraw_amount }}{{ $setting->currency_icon }}
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('admin.Status')}}</td>
                                <td width="50%">
                                    @if ($withdraw->status==1)
                                    <span class="badge badge-success">{{__('admin.Success')}}</span>
                                    @else
                                    <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">{{__('admin.Requested Date')}}</td>
                                <td width="50%">{{ $withdraw->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @if ($withdraw->status==1)
                                <tr>
                                    <td width="50%">{{__('admin.Approved Date')}}</td>
                                    <td width="50%">{{ $withdraw->approved_date }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td width="50%">{{__('admin.Account Information')}}</td>
                                <td width="50%">
                                    {!! clean(nl2br($withdraw->account_info)) !!}
                                </td>
                            </tr>

                        </table>

                        @if ($withdraw->status == 0)
                            <a href="javascript:;" data-toggle="modal" data-target="#withdrawApproved" class="btn btn-primary">{{__('admin.Approve withdraw')}}</i></a>
                        @endif

                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger" onclick="deleteData({{ $withdraw->id }})">{{__('admin.Delete withdraw request')}}</a>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>


      <div class="modal fade" tabindex="-1" role="dialog" id="withdrawApproved">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{__('admin.Withdraw Approved Confirmation')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{__('admin.Are You sure approved this withdraw request ?')}}</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('admin.approved-provider-withdraw',$withdraw->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approve')}}</button>
                </form>
            </div>
          </div>
        </div>
      </div>


      <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-provider-withdraw/") }}'+"/"+id)
        }
    </script>
@endsection
