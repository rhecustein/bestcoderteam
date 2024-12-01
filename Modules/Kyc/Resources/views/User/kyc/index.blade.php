@extends('provider.master_layout')
@section('title')
<title>{{__('admin.Manage Kyc')}}</title>
@endsection
@section('provider-content')
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
                           @if ($kyc)
                            <div class="card service_card">
                                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                    <img class="service_image" src="{{ asset($kyc->file) }}" alt="">
                                    <div class="service_detail">
                                        <h4>{{ $kyc->influncer->name}}</h4>
                                        <p>{{__('admin.Document Name')}} : {{ $kyc->kyc_type->name}}</p>
                                        <p>{{__('admin.Status')}} :

                                        @if ($kyc->status == 0)
                                            <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                        @endif
                                        @if ($kyc->status == 1)
                                            <span class="badge badge-success">{{__('admin.Approved')}}</span>
                                        @endif
                                        @if ($kyc->status == 2)
                                            <span class="badge badge-danger">{{__('admin.Reject')}}</span>
                                        @endif

                                        </p>
                                    </div>
                                </div>
                            </div>
                           @else
                            <form action="{{ route('provider.kyc-submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>{{__('admin.Select Document Type')}} <span class="text-danger">*</span></label>
                                        <select name="kyc_id" class="form-control select2" id="category">
                                            <option value="">{{__('admin.Select Type')}}</option>
                                            @foreach ($kycType as $type)
                                                <option {{ $type->id == old('kyc_id') ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.File')}} <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control-file"  name="file">
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Message')}}</label>
                                        <textarea name="message" id="" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary">{{__('admin.Save')}}</button>
                                    </div>
                                </div>
                            </form>
                           @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

