@extends('provider.master_layout')
@section('title')
<title>{{__('user.Paypal Gateway')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Paypal Gateway')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                @if ($paypal)
                                    <form action="{{ route('provider.store-paypal-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Paypal Client Id')}}</label>
                                            <input type="text" name="client_id" class="form-control" value="{{ $paypal->client_id }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Paypal Secret Id')}}</label>
                                            <input type="text" name="secret_id" class="form-control" value="{{ $paypal->secret_id }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Status')}}</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $paypal->status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                                <option {{ $paypal->status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-paypal-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Paypal Client Id')}}</label>
                                            <input type="text" name="client_id" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Paypal Secret Id')}}</label>
                                            <input type="text" name="secret_id" class="form-control">
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


