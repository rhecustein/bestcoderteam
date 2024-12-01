@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Assign Plan')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Assign Plan')}}</h1>

        </div>

        <div class="section-body">
            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <a href="{{ route('admin.purchase-history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                                {{__('admin.Go Back')}}</a>

                        </div>

                        <div class="card-body">

                            <form action="{{route('admin.store-assign-plan')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">


                                    <div class="form-group col-12">
                                        <label for="">{{__('admin.Select Plan')}} <span class="text-danger">*</span></label>
                                        <select name="plan_id" id="" class="form-control">
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="">{{__('admin.Select Provider')}} <span class="text-danger">*</span></label>
                                        <select name="provider_id" id="" class="form-control select2 ">
                                            <option value="">{{__('admin.Select')}}</option>
                                            @foreach ($providers as $provider)
                                                <option value="{{ $provider->id }}">{{ $provider->name }} - {{ $provider->user_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">{{__('admin.Assign Plan')}}</button>
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

