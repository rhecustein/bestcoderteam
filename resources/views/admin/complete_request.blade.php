@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Complete Request')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Complete Request')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Complete Request')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Client')}}</th>
                                    <th >{{__('admin.Total Amount')}}</th>
                                    <th >{{__('admin.Order Id')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($completeRequests as $index => $completeRequest)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <a href="{{ route('admin.provider-show', $completeRequest->provider_id) }}">{{ $completeRequest->provider->name }}</a>
                                        </td>
                                        <td>

                                            @if ($setting->currency_position == 'before_price')
                                            {{ $currency_icon->icon }}{{ $completeRequest->order->total_amount }}
                                            @else
                                            {{ $completeRequest->order->total_amount }}{{ $currency_icon->icon }}
                                            @endif

                                        </td>
                                        <td>{{ $completeRequest->order->order_id }}</td>
                                        <td>

                                        <a href="{{ route('admin.booking-show',$completeRequest->order->order_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

      <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-provider-withdraw/") }}'+"/"+id)
        }
    </script>
@endsection
