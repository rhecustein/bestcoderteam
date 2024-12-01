@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Manage Kyc Type')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('admin.Manage Kyc Type')}}</h1>
      </div>

        <div class="section-body">
            <a href="javascript:;" data-toggle="modal" data-target="#create_coupon_id"  class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('admin.SN')}}</th>
                                            <th>{{__('admin.Name')}}</th>
                                            <th>{{__('admin.Status')}}</th>
                                            <th>{{__('admin.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kycType as $index => $type)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $type->name }}</td>
                                                <td>
                                                    @if ($type->status == 1)
                                                    <span class="badge badge-success">{{__('admin.Active')}}</span>
                                                    @else

                                                    <span class="badge badge-danger">{{__('admin.Inactive')}}</span>

                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#edit_coupon_id_{{ $type->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    @if ($type->kycinformation->count() == 0)
                                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $type->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="javascript:;" data-toggle="modal" data-target="#canNotDeleteModal" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    @endif
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

@foreach ($kycType as $index => $ktype)
    <div class="modal fade" id="edit_coupon_id_{{ $ktype->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Create Kyc Type')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.kyc.update', $ktype->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{__('admin.name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="name" autocomplete="off" class="form-control" required value="{{ $ktype->name }}">
                            </div>

                            <div class="form-group">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option {{ $ktype->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Active')}}</option>
                                        <option {{ $ktype->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Inactive')}}</option>
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


<!-- Modal -->
<div class="modal fade" id="create_coupon_id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">{{__('admin.Create kyc Type')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ route('admin.kyc.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{__('admin.Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" required autocomplete="off" class="form-control">
                        </div>

                       <div class="form-group">
                            <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                            <select name="status" id="" class="form-control">
                                <option value="1">{{__('admin.Active')}}</option>
                                <option value="0">{{__('admin.Inactive')}}</option>
                            </select>
                       </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/kyc/") }}'+"/"+id)
    }

</script>
@endsection

