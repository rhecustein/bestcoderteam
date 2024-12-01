@extends('provider.master_layout')
@section('title')
<title>{{__('user.Stripe Gateway')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Stripe Gateway')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($stripe)
                                    <form action="{{ route('provider.store-stripe-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Stripe Publishable Key')}}</label>
                                            <input type="text" name="stripe_key" class="form-control" value="{{ $stripe->stripe_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Stripe Secret Key')}}</label>
                                            <input type="text" name="stripe_secret" class="form-control" value="{{ $stripe->stripe_secret }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Status')}}</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $stripe->status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                                <option {{ $stripe->status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-stripe-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Stripe Publishable Key')}}</label>
                                            <input type="text" name="stripe_key" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Stripe Secret Key')}}</label>
                                            <input type="text" name="stripe_secret" class="form-control">
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


