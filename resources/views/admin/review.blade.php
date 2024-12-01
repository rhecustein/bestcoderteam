@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Review List')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Review List')}}</h1>

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
                                    <th width="5%">{{__('admin.SN')}}</th>
                                    <th width="15%">{{__('admin.Client')}}</th>
                                    <th width="30%">{{__('admin.Service')}}</th>
                                    <th width="5%">{{__('admin.Rating')}}</th>
                                    <th width="10%">{{__('admin.Status')}}</th>
                                    <th width="20%">{{__('admin.Created At')}}</th>
                                    <th width="10%">{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $index => $review)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><a href="{{ route('admin.customer-show', $review->user_id) }}">{{ $review->user ? $review->user->name : '' }}</a></td>
                                        <td><a href="{{ route('admin.service.edit', $review->service_id) }}">{{ $review->service->name }}</a></td>

                                        <td>{{ $review->rating }}</td>
                                        <td>
                                            @if ($review->status==1)
                                            <span class="badge badge-success">{{__('admin.Active')}}</span>
                                            @else
                                            <span class="badge badge-danger">{{__('admin.Inactive')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $review->created_at->format('H:i A, d-m-Y') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.show-review',$review->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $review->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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


<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-service-review/") }}'+"/"+id)
    }
</script>
@endsection
