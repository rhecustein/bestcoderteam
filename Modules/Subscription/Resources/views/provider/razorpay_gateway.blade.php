@extends('provider.master_layout')
@section('title')
<title>{{__('user.Razorpay Gateway')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Razorpay Gateway')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($razorpay)
                                    <form action="{{ route('provider.store-razorpay-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Razorpay Key')}}</label>
                                            <input type="text" name="key" class="form-control" value="{{ $razorpay->key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Razorpay Secret Key')}}</label>
                                            <input type="text" name="secret_key" class="form-control" value="{{ $razorpay->secret_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Status')}}</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $razorpay->status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                                <option {{ $razorpay->status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-razorpay-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Razorpay Key')}}</label>
                                            <input type="text" name="key" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Razorpay Secret Key')}}</label>
                                            <input type="text" name="secret_key" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Status')}}</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="1">{{__('user.Active')}}</option>
                                                <option value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>

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


