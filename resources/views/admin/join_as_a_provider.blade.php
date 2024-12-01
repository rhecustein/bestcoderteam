@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Join as a Provider')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Join as a Provider')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Join as a Provider')}}</div>
            </div>
          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-join-as-a-provider') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    @if ($selected_theme == 0 || $selected_theme == 1)
                                    <div>
                                        <h6 class="home_border">{{__('admin.Home One')}}</h6>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Banner')}}</label>
                                        <div>
                                            <img width="200px" src="{{ asset($join_as_a_provider->image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Banner')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 2)
                                    <div>
                                        <h6 class="home_border">{{__('admin.Home Two')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Banner')}}</label>
                                        <div>
                                            <img width="200px" src="{{ asset($join_as_a_provider->home2_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Banner')}}</label>
                                        <input type="file" name="image2" class="form-control-file">
                                    </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 3)

                                    <div>
                                        <h6 class="home_border">{{__('admin.Home Three')}}</h6>
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Banner')}}</label>
                                        <div>
                                            <img width="200px" src="{{ asset($join_as_a_provider->home3_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Banner')}}</label>
                                        <input type="file" name="image3" class="form-control-file">
                                    </div>


                                    <div>
                                        <hr>
                                    </div>

                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="title" class="form-control" value="{{ $join_as_a_provider->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{__('admin.Button Text')}}</label>
                                        <input type="text" name="button_text" class="form-control" value="{{ $join_as_a_provider->button_text }}">
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
