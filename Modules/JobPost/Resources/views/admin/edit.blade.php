@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Job Post')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Job Post')}}</h1>
          </div>

          <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.jobpost.update', $job_post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="form-group col-md-12 col-12">
                                    <img id="view_img" height="100" width="100" src="{{ asset($job_post->thumb_image) }}"><br>
                                    <label>{{__('admin.Thumbnail Image')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file" name="thumb_image">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.User/Buyer')}} <span class="text-danger">*</span></label>
                                    <select name="user_id" id="" class="form-control select2">
                                        <option value="">{{__('admin.Select Influencer')}}</option>
                                        @foreach ($agents as $agent)
                                            <option  {{ $agent->id == $job_post->user_id ? 'selected' : '' }} value="{{ $agent->id }}">{{ $agent->name }} - {{ $agent->email }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                    <input id="title" type="text" class="form-control" name="title" value="{{ html_decode($job_post->title) }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ html_decode($job_post->slug) }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                                    <select name="category_id" id="" class="form-control select2">
                                        <option value="">{{__('admin.Select Category')}}</option>
                                        @foreach ($categories as $category)
                                            <option  {{ $category->id == $job_post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.City')}} <span class="text-danger">*</span></label>
                                    <select name="city_id" id="" class="form-control select2">
                                        <option value="">{{__('admin.Select City')}}</option>
                                        @foreach ($cities as $city)
                                            <option  {{ $city->id == $job_post->city_id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Start Price')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="regular_price" id="regular_price" value="{{ html_decode($job_post->regular_price) }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Job Type')}} <span class="text-danger">*</span></label>
                                    <select name="job_type" id="" class="form-control">
                                        <option {{ 'Hourly' == $job_post->job_type ? 'selected' : '' }} value="Hourly">{{ __('Hourly') }}</option>
                                        <option {{ 'Daily' == $job_post->job_type ? 'selected' : '' }} value="Daily">{{ __('Daily') }}</option>
                                        <option {{ 'Monthly' == $job_post->job_type ? 'selected' : '' }} value="Monthly">{{ __('Monthly') }}</option>
                                        <option {{ 'Yearly' == $job_post->job_type ? 'selected' : '' }} value="Yearly">{{ __('Yearly') }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="address" id="address" value="{{ $job_post->address }}">
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>

                                    <textarea class="crancy__item-input crancy__item-textarea summernote"  name="description" id="description">{!! html_decode($job_post->description) !!}</textarea>

                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Visibility Status')}} <span class="text-danger">*</span></label><br>
                                    <input {{ $job_post->status == 'enable' ? 'checked' : '' }} name="status" type="checkbox" >
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

      <script>
        (function($) {
            "use strict"
            $(document).ready(function () {
                $("#title").on("keyup",function(e){
                    let inputValue = $(this).val();
                    let slug = inputValue.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
                    $("#slug").val(slug);
                })
            });
        })(jQuery);
    </script>

@endsection
