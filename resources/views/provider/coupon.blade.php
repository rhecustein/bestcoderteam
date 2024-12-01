@extends('provider.master_layout')
@section('title')
<title>{{__('user.Manage Coupon')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Manage Coupon')}}</h1>
      </div>

        <div class="section-body">
            <a href="javascript:;" data-toggle="modal" data-target="#create_coupon_id"  class="btn btn-primary"><i class="fas fa-plus"></i> {{__('user.Add New')}}</a>
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('user.SN')}}</th>
                                            <th>{{__('user.Coupon Code')}}</th>
                                            <th>{{__('user.Offer')}}</th>
                                            <th>{{__('user.End time')}}</th>
                                            <th>{{__('user.Status')}}</th>
                                            <th>{{__('user.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $index => $coupon)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $coupon->coupon_code }}</td>
                                                <td>{{ $coupon->offer_percentage }}%</td>

                                                <td>{{ date('d M Y', strtotime($coupon->expired_date)) }}</td>

                                                <td>
                                                    @if ($coupon->status == 1)
                                                    <span class="badge badge-success">{{__('user.Active')}}</span>
                                                    @else

                                                    <span class="badge badge-danger">{{__('user.Inactive')}}</span>

                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#edit_coupon_id_{{ $coupon->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $coupon->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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

@foreach ($coupons as $index => $coupon)
    <div class="modal fade" id="edit_coupon_id_{{ $coupon->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('user.Create Coupon')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('provider.coupon.update', $coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{__('user.Coupon Code')}} <span class="text-danger">*</span></label>
                                <input type="text" name="coupon_code" autocomplete="off" class="form-control" value="{{ $coupon->coupon_code }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('user.Offer')}}(%) <span class="text-danger">*</span></label>
                                <input type="text" name="offer_percentage" autocomplete="off" class="form-control" value="{{ $coupon->offer_percentage }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('user.End time')}} <span class="text-danger">*</span></label>
                                <input type="text" name="expired_date" autocomplete="off" class="form-control datepicker" value="{{ $coupon->expired_date }}">
                            </div>

                        <div class="form-group">
                                <label>{{__('user.Status')}} <span class="text-danger">*</span></label>
                                <select name="status" id="" class="form-control">
                                    <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                    <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('user.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('user.Update')}}</button>
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
                        <h5 class="modal-title">{{__('user.Create Coupon')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ route('provider.coupon.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{__('user.Coupon Code')}} <span class="text-danger">*</span></label>
                            <input type="text" name="coupon_code" autocomplete="off" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{__('user.Offer')}}(%) <span class="text-danger">*</span></label>
                            <input type="text" name="offer_percentage" autocomplete="off" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">{{__('user.End time')}} <span class="text-danger">*</span></label>
                            <input type="text" name="expired_date" autocomplete="off" class="form-control datepicker">
                        </div>

                       <div class="form-group">
                            <label>{{__('user.Status')}} <span class="text-danger">*</span></label>
                            <select name="status" id="" class="form-control">
                                <option value="1">{{__('user.Active')}}</option>
                                <option value="0">{{__('user.Inactive')}}</option>
                            </select>
                       </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('user.Close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('user.Save')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("provider/coupon/") }}'+"/"+id)
    }

</script>
@endsection

