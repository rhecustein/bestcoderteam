@extends('provider.master_layout')
@section('title')
<title>{{__('user.Schedule')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Schedule')}}</h1>

      </div>
      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card profile-widget">
              <div class="profile-widget-description">
                <form action="{{ route('provider.update-schedule') }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="row">
                        @if($schedules->count() == 0)
                            @foreach ($days as $day)
                                <div class="form-group col-md-3">
                                    <label>{{__('user.Day')}}</label>

                                    <input type="text" class="form-control" name="days[]" value="{{ $day }}" readonly>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('user.Start')}}</label>
                                    <input type="text" class="form-control clockpicker" data-align="top" data-autoclose="true" name="start[]" autocomplete="off">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('user.End')}}</label>
                                    <input type="text" class="form-control clockpicker" data-align="top" data-autoclose="true" name="end[]" autocomplete="off">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('user.Status')}}</label>
                                    <select name="status[]" id="" class="form-control">
                                        <option value="1">{{__('user.On')}}</option>
                                        <option value="0">{{__('user.Off')}}</option>
                                    </select>
                                </div>



                            @endforeach
                        @else
                        @foreach ($schedules as $schedule)
                        <input type="hidden" value="{{ $schedule->id }}" name="ids[]">
                            <div class="form-group col-md-3">
                                <label>{{__('user.Day')}}</label>

                                <input type="text" class="form-control" name="days[]" value="{{ $schedule->day }}" readonly>
                            </div>

                            <div class="form-group col-md-3">
                                <label>{{__('user.Start')}}</label>
                                <input type="text" class="form-control clockpicker" data-align="top" data-autoclose="true" name="start[]" autocomplete="off" value="{{ $schedule->start }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label>{{__('user.End')}}</label>
                                <input type="text" class="form-control clockpicker" data-align="top" data-autoclose="true" name="end[]" autocomplete="off" value="{{ $schedule->end }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label>{{__('user.Status')}}</label>
                                <select name="status[]" id="" class="form-control">
                                    <option {{ $schedule->status == 1 ? 'selected' : '' }} value="1">{{__('user.On')}}</option>
                                    <option {{ $schedule->status == 0 ? 'selected' : '' }} value="0">{{__('user.Off')}}</option>
                                </select>
                            </div>
                         @endforeach
                        @endif


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
