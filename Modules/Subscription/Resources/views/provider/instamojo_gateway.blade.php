@extends('provider.master_layout')
@section('title')
<title>{{__('user.Instamojo Gateway')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Instamojo Gateway')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($instamojo)
                                    <form action="{{ route('provider.store-instamojo-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="">{{__('user.Account Mode')}}</label>
                                            <select name="account_mode" id="" class="form-control">
                                                <option {{ $instamojo->account_mode == 'Sandbox' ? 'selected' : '' }} value="Sandbox">{{__('user.Sandbox')}}</option>
                                                <option {{ $instamojo->account_mode == 'Live' ? 'selected' : '' }} value="Live">{{__('user.Live')}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.API Key')}}</label>
                                            <input type="text" name="api_key" class="form-control" value="{{ $instamojo->api_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Auth Token')}}</label>
                                            <input type="text" name="auth_token" class="form-control" value="{{ $instamojo->auth_token }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Status')}}</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $instamojo->status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                                <option {{ $instamojo->status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-instamojo-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="">{{__('user.Account Mode')}}</label>
                                            <select name="account_mode" id="" class="form-control">
                                                <option value="Sandbox">{{__('user.Sandbox')}}</option>
                                                <option value="Live">{{__('user.Live')}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.API Key')}}</label>
                                            <input type="text" name="api_key" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Auth Token')}}</label>
                                            <input type="text" name="auth_token" class="form-control">
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


