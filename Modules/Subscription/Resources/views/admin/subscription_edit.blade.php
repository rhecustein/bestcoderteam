@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Plan')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Edit Plan')}}</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <a href="{{ route('admin.subscription-plan.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{__('admin.Go Back')}}</a>

                        </div>

                        <div class="card-body">

                            <form action="{{route('admin.subscription-plan.update', $plan->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Plan Name')}} <span class="text-danger">*</span> </label>
                                        <input type="text" name="plan_name" class="form-control form_control" value="{{ $plan->plan_name }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Plan Price')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For free plan use(0)"> <span class="text-danger">*</span></label>
                                        <input type="text" name="plan_price" class="form-control form_control" value="{{ $plan->plan_price }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Expiration Date')}} <span class="text-danger">*</span></label>

                                        <select name="expiration_date" id="" class="form-control">
                                            <option {{ $plan->expiration_date == 'monthly' ? 'selected' : ''}} value="monthly">{{__('admin.Monthly')}}</option>
                                            <option {{ $plan->expiration_date == 'yearly' ? 'selected' : ''}} value="yearly">{{__('admin.Yearly')}}</option>
                                            <option {{ $plan->expiration_date == 'lifetime' ? 'selected' : ''}} value="lifetime">{{__('admin.Lifetime')}}</option>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Maximum Service')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For unlimited service use(-1)"> <span class="text-danger">*</span></label>
                                        <input type="number" name="maximum_service" class="form-control form_control" value="{{ $plan->maximum_service }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="serial" class="form-control form_control" value="{{ $plan->serial }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option {{ $plan->status == 1 ? 'selected' : ''}} value="1">{{__('admin.Active')}}</option>
                                            <option {{ $plan->status == 0 ? 'selected' : ''}} value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

