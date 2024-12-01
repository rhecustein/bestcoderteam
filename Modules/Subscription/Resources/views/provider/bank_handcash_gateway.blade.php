@extends('provider.master_layout')
@section('title')
<title>{{__('user.Bank & Handcash')}}</title>
@endsection
@section('provider-content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('user.Bank & Handcash')}}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($bank_handcash)
                                    <form action="{{ route('provider.store-bank-handcash-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">

                                            <label for="">{{__('user.Bank Instruction')}}</label>

                                            <textarea name="bank_instruction" class="form-control text-area-5" id="" cols="30" rows="3">{{ $bank_handcash->bank_instruction }}</textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Bank Status')}}</label>
                                            <select name="bank_status" id="" class="form-control">
                                                <option {{ $bank_handcash->bank_status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                                <option {{ $bank_handcash->bank_status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Handcash Status')}}</label>
                                            <select name="handcash_status" id="" class="form-control">
                                                <option {{ $bank_handcash->handcash_status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                                <option {{ $bank_handcash->handcash_status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>

                                    </form>
                                @else
                                    <form action="{{ route('provider.store-bank-handcash-gateway') }}" method="POST">
                                        @csrf

                                        <div class="form-group">

                                            <label for="">{{__('user.Bank Instruction')}}</label>

                                            <textarea name="bank_instruction" class="form-control text-area-5" id="" cols="30" rows="3"></textarea>

                                        </div>


                                        <div class="form-group">
                                            <label for="">{{__('user.Bank Status')}}</label>
                                            <select name="bank_status" id="" class="form-control">
                                                <option value="1">{{__('user.Active')}}</option>
                                                <option value="0">{{__('user.Inactive')}}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">{{__('user.Handcash Status')}}</label>
                                            <select name="handcash_status" id="" class="form-control">
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


