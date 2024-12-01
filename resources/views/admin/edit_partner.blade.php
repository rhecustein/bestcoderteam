@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Partner')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Partner')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.partner.index') }}">{{__('admin.Partner List')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Edit Partner')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.partner.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Partner List')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.partner.update',$partner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing Logo')}}</label>
                                    <div>
                                        <img src="{{ asset($partner->logo) }}" width="100px" alt="">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.Logo')}}</label>
                                    <input type="file" class="form-control-file"  name="logo">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Link')}} </label>
                                    <input type="text" id="link" class="form-control"  name="link" value="{{ $partner->link }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option {{ $partner->status==1 ? 'selected': '' }} value="1">{{__('admin.Active')}}</option>
                                        <option {{ $partner->status==0 ? 'selected': '' }}  value="0">{{__('admin.Inactive')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

@endsection
