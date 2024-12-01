@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit mobile slider')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit mobile slider')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.mobile-slider.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Slider List')}}</a>

            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.mobile-slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing Image')}}</label>
                                    <div>
                                        <img src="{{ asset($slider->image) }}" class="mobile_slider_image" alt="">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Image')}} </label>
                                    <input type="file" name="image" class="form-control-file">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Title one')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="title_one" class="form-control" value="{{ $slider->title_one }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Title two')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="title_two" class="form-control" value="{{ $slider->title_two }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                    <input type="number" name="serial" class="form-control" value="{{ $slider->serial }}">
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
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
