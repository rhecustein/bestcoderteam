@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Mobile App')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Mobile App')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Mobile App')}}</div>
            </div>
          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-mobile-app') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    @if ($selected_theme == 0 || $selected_theme == 1)
                                    <div class="col-12">
                                        <h6 class="home_border">{{__('admin.Home One')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($mobile_app->image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 2)

                                    <div class="col-12">
                                        <h6 class="home_border">{{__('admin.Home Two')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($mobile_app->home2_app_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="image2" class="form-control-file">
                                    </div>

                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 3)


                                    <div class="col-12">
                                        <h6 class="home_border">{{__('admin.Home Three')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($mobile_app->home3_app_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="image3" class="form-control-file">
                                    </div>

                                    <div class="col-12">
                                        <hr>
                                    </div>

                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Short Title')}}</label>
                                        <input type="text" name="short_title" class="form-control" value="{{ $mobile_app->short_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="full_title" class="form-control" value="{{ $mobile_app->full_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $mobile_app->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Google Play Store Link')}}</label>
                                        <input type="text" name="play_store" class="form-control" value="{{ $mobile_app->play_store }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.App Store Link')}}</label>
                                        <input type="text" name="app_store" class="form-control" value="{{ $mobile_app->app_store }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
@endsection
