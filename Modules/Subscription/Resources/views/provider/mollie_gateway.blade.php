@extends('provider.master_layout')
@section('title')
<title>{{__('user.Mollie Gateway')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Mollie Gateway')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($mollie)
                                    <form action="{{ route('provider.store-mollie-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Mollie Key')}}</label>
                                            <input type="text" name="mollie_key" class="form-control" value="{{ $mollie->mollie_key }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Status')}}</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $mollie->status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                                <option {{ $mollie->status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-mollie-gateway') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{__('user.Mollie Key')}}</label>
                                            <input type="text" name="mollie_key" class="form-control">
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


