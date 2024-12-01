@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Provider Client Reports')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Provider Client Reports')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Provider Client Reports')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped report_table" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.Report Info')}}</th>
                                    <th >{{__('admin.Client')}}</th>
                                    <th >{{__('admin.Provider')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $index => $report)
                                    <tr>
                                        <td>{{ ++$index }}</td>

                                        <td>
                                            <p>{{__('admin.Order ID')}}: <a href="{{ route('admin.booking-show',$report->order->order_id) }}">{{ $report->order->order_id }}</a>
                                            </p>
                                            <p>{{__('admin.Created')}}: {{ $report->created_at->format('h:m A, d-M-Y') }}</p>
                                            <p>{{__('admin.Report From')}}: {{ $report->report_from }}</p>
                                            <p>{{__('admin.Report To')}}: {{ $report->report_to }}</p>
                                        </td>

                                        <td>
                                            <p>
                                                <a href="{{ route('admin.customer-show', $report->client_id) }}">{{ $report->client->name }}</a>
                                            </p>
                                            <p>{{__('admin.Email')}} : {{ $report->client->email }}</p>
                                            <p>{{__('admin.Phone')}} : {{ $report->client->phone }}</p>
                                        </td>

                                        <td>
                                            <p>
                                                <a href="{{ route('admin.provider-show', $report->provider_id) }}">{{ $report->provider->name }}</a>
                                            </p>
                                            <p>{{__('admin.Email')}} : {{ $report->provider->email }}</p>
                                            <p>{{__('admin.Phone')}} : {{ $report->provider->phone }}</p>
                                        </td>

                                        <td>
                                        <a href="javascript:;" data-toggle="modal" data-target="#modelId-{{ $report->id }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a onclick="deleteData({{ $report->id }})" href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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



      @foreach ($reports as $index => $report)
      <!-- Modal -->
      <div class="modal fade" id="modelId-{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Report Details')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {!! clean(nl2br($report->report)) !!}
                    </div>
                </div>
            </div>
        </div>
      </div>
      @endforeach

      <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-client-provider-report/") }}'+"/"+id)
        }
    </script>
@endsection
