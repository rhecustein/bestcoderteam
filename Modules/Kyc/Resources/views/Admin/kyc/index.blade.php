@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Manage Kyc')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Manage Kyc')}}</h1>
      </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('admin.SN')}}</th>
                                            <th>{{__('admin.Document')}}</th>
                                            <th>{{__('admin.Name')}}</th>
                                            <th>{{__('admin.Document Name')}}</th>
                                            <th>{{__('admin.Status')}}</th>
                                            <th>{{__('admin.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kycs as $index => $kyc)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>
                                                    <a href="{{ asset($kyc->file) }}">
                                                        <img width="120" src="{{ asset($kyc->file) }}" alt="">
                                                    </a>
                                                </td>
                                                <td><a href="{{ route('providers',$kyc->influncer->user_name) }}">{{ $kyc->influncer->name}}</a></td>
                                                <td>{{ $kyc->kyc_type->name}}</td>
                                                <td>
                                                    @if ($kyc->status == 0)
                                                    <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                                    @endif
                                                    @if ($kyc->status == 1)
                                                        <span class="badge badge-success">{{__('admin.Approved')}}</span>
                                                    @endif
                                                    @if ($kyc->status == 2)
                                                        <span class="badge badge-danger">{{__('admin.Reject')}}</span>
                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#edit_coupon_id_{{ $kyc->id }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $kyc->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        </div>
    </section>
</div>

@foreach ($kycs as $index => $kyc1)
    <div class="modal fade" id="edit_coupon_id_{{ $kyc1->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{ $kyc->influncer->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.update-kyc-status', $kyc1->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <p><b>Message:</b>{{$kyc1->message}}</p>


                            <div class="form-group">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option {{ $kyc1->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Pending')}}</option>
                                        <option {{ $kyc1->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Approved')}}</option>
                                        <option {{ $kyc1->status == 2 ? 'selected' : '' }} value="2">{{__('admin.Reject')}}</option>
                                    </select>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endforeach



<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-kyc-info/") }}'+"/"+id)
    }

</script>
@endsection

