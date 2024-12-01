@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Intro section')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Intro section')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Intro section')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                @if ($selected_theme == 0 || $selected_theme == 1)
                                    <div class="col-12">
                                        <h6 class="home_border">{{__('admin.Home One')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($slider->image) }}" alt="">
                                        </div>
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.New Image')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>
                                @endif

                                @if ($selected_theme == 0 || $selected_theme == 2)
                                    <div class="col-12">
                                        <h6 class="home_border">{{__('admin.Home Two')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($slider->home2_image) }}" alt="">
                                        </div>
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.New Image')}}</label>
                                        <input type="file" name="image2" class="form-control-file">
                                    </div>
                                @endif

                                @if ($selected_theme == 0 || $selected_theme == 3)
                                    <div class="col-12">
                                        <h6 class="home_border">{{__('admin.Home Three')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($slider->home3_image) }}" alt="">
                                        </div>
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.New Image')}}</label>
                                        <input type="file" name="image3" class="form-control-file">
                                    </div>

                                    <div class="col-12">
                                        <hr>
                                    </div>
                                @endif





                                <div class="form-group col-12">
                                    <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Header One')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="header_one" value="{{ $slider->header_one }}" class="form-control">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Header Two')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="header_two" value="{{ $slider->header_two }}" class="form-control">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                                    <textarea name="description" id="" cols="30" rows="3" class="form-control text-area-3">{{ $slider->description }}</textarea>
                                </div>


                                <div class="form-group col-12 {{ $selected_theme == 0 || $selected_theme == 1 ? '' : 'd-none' }}">
                                    <label>{{__('admin.Total sold service')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="total_service_sold" value="{{ $slider->	total_service_sold }}" class="form-control">
                                </div>


                                @if ($selected_theme == 0 || $selected_theme == 3)
                                <div class="form-group col-12">
                                    <label>{{__('admin.Popular search tag for home3')}} </label>
                                    <input type="text" name="popular_tag" value="{{ $slider->popular_tag }}" class="form-control tags">
                                </div>
                                @endif

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Save')}}</button>
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
