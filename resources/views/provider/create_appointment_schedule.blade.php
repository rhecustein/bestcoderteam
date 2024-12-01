@extends('provider.master_layout')
@section('title')
<title>{{__('user.Create Appointment Schedule')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Create Appointment Schedule')}}</h1>
      </div>

        <div class="section-body">
            <a href="{{ route('provider.appointment-schedule.index') }}"  class="btn btn-primary"><i class="fas fa-list"></i> {{__('user.Schedule List')}}</a>
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <form action="{{ route('provider.appointment-schedule.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="">{{__('user.Day')}} <span class="text-danger">*</span></label>
                                        <select name="day" id="" class="form-control">
                                            <option value="">{{__('user.Select Day')}}</option>
                                            @foreach ($days as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-12">
                                        <label for="start_time">{{__('user.Start Time')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="start_time" class="form-control clockpicker" data-align="top" data-autoclose="true" autocomplete="off">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="end_time">{{__('user.End Time')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="end_time" class="form-control clockpicker" data-align="top" data-autoclose="true" autocomplete="off">
                                    </div>

                                    <div class="form-group col-12">
                                        {{-- <div class="control-label">Toggle switch single</div> --}}
                                        <label class="mt-2">
                                          <input type="checkbox" name="schedule_allows" class="custom-switch-input">
                                          <span class="custom-switch-indicator"></span>
                                          <span class="custom-switch-description">{{__('user.This schedule allows all days')}}</span>
                                        </label>
                                      </div>

                                    <div class="form-group col-12">
                                        <label>{{__('user.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option value="1">{{__('user.Active')}}</option>
                                            <option value="0">{{__('user.Inactive')}}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">{{__('user.Save')}}</button>
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
