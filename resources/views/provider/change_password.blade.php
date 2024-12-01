@extends('provider.master_layout')
@section('title')
<title>{{__('user.Change Password')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Change Password')}}</h1>

      </div>
      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card profile-widget">
              <div class="profile-widget-description">
                <form action="{{ route('provider.password-update') }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="row">

                        <div class="form-group col-12">
                        <label>{{__('user.New Password')}}</label>
                        <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('user.Confirm Password')}}</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary">{{__('user.Update')}}</button>
                        </div>
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
