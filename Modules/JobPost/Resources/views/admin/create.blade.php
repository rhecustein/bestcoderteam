@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create Job Post')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create Job Post')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.jobpost.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Job Post List')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.jobpost.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Thumbnail Image')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file" name="thumb_image">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.User/Buyer')}} <span class="text-danger">*</span></label>
                                    <select name="user_id" id="" class="form-control select2">
                                        <option disabled selected>{{ __('admin.Select User') }}</option>
                                        @foreach ($agents as $agent)
                                            <option {{ $agent->id == old('user_id') ? 'selected' : '' }} value="{{ $agent->id }}">{{ $agent->name }} - {{ $agent->email }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Slug')}} <span class="text-danger">*</span></label>
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Category')}} <span class="text-danger">*</span></label>
                                    <select name="category_id" id="" class="form-control select2">
                                        <option disabled selected>{{__('admin.Select Category')}}</option>
                                        @foreach ($categories as $category)
                                            <option  {{ $category->id == old('category_id') ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.City')}} <span class="text-danger">*</span></label>
                                    <select name="city_id" id="" class="form-control select2">
                                        <option disabled selected>{{__('admin.Select City')}}</option>
                                        @foreach ($cities as $city)
                                            <option {{ $city->id == old('city_id') ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Start Price')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="regular_price" id="regular_price" value="{{ old('regular_price') }}">
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Job Type')}} <span class="text-danger">*</span></label>
                                    <select name="job_type" id="" class="form-control">
                                        <option {{ 'Hourly' == old('job_type') ? 'selected' : '' }} value="Hourly">{{ __('Hourly') }}</option>
                                        <option {{ 'Daily' == old('job_type') ? 'selected' : '' }} value="Daily">{{ __('Daily') }}</option>
                                        <option {{ 'Monthly' == old('job_type') ? 'selected' : '' }} value="Monthly">{{ __('Monthly') }}</option>
                                        <option {{ 'Yearly' == old('job_type') ? 'selected' : '' }} value="Yearly">{{ __('Yearly') }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="address" id="address" value="{{ old('address') }}">
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>

                                    <textarea class="crancy__item-input crancy__item-textarea summernote"  name="description" id="description">{{ old('description') }}</textarea>

                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Visibility Status')}} <span class="text-danger">*</span></label><br>
                                    <input name="status" type="checkbox" >
                                </div>

                            </div>

                            <button class="btn btn-primary" type="submit">{{__('admin.Update Data')}}</button>

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
