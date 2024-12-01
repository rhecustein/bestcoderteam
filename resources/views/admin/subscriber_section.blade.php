@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Subscription Box')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Subscription Box')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Subscription Box')}}</div>
            </div>
          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-subscriber-section') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    @if ($selected_theme == 0 || $selected_theme == 1)
                                    <h6 class="home_border">{{__('admin.Home One')}}</h6>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">{{__('admin.Background Banner')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($subscriber->background_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Background')}}</label>
                                        <input type="file" name="background_image" class="form-control-file">
                                    </div>
                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 2)

                                    <h6 class="home_border">{{__('admin.Home Two')}}</h6>
                                    <hr>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Background Banner')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($subscriber->home2_background_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Background')}}</label>
                                        <input type="file" name="background_image2" class="form-control-file">
                                    </div>

                                    @endif

                                    @if ($selected_theme == 0 || $selected_theme == 3)


                                    <h6 class="home_border">{{__('admin.Home Three')}}</h6>
                                    <hr>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Background Banner')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($subscriber->home3_background_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Background')}}</label>
                                        <input type="file" name="background_image3" class="form-control-file">
                                    </div>


                                    <hr>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Foreground Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($subscriber->image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Foreground')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing blog page Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($subscriber->blog_page_subscription_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Blog page subscription box Image')}}</label>
                                        <input type="file" name="blog_page_subscription_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Short Title')}}</label>
                                        <input type="text" name="title" class="form-control" value="{{ $subscriber->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <textarea name="description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $subscriber->description }}</textarea>
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
