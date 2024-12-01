@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Section Content')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Section Content')}}</h1>

          </div>

          @foreach ($contents as $content)
          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <h5 class="home_border">{{ $content->section_name }}</h5>
                        <hr>
                        <form action="{{ route('admin.update-section-content', $content->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">


                                    <div class="form-group col-12">
                                        <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ $content->title }}" class="form-control">
                                    </div>
                                    <div class="form-group col-12">
                                        <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                                        <textarea name="description" id="" cols="30" rows="3" class="form-control text-area-3">{{ $content->description }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary">{{__('admin.Save')}}</button>
                                    </div>



                            </div>

                        </form>
                    </div>
                  </div>
                </div>
          </div>

          @endforeach
        </section>
      </div>
@endsection
