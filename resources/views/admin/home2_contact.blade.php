@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Home page 2 contact section')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Home page 2 contact section')}}</h1>

          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-home2-contact') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="">{{__('admin.Background Banner')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($contact->background) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Background')}}</label>
                                        <input type="file" name="background_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Foreground Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($contact->foreground) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Foreground')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Call as now')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="call_as_now" class="form-control" value="{{ $contact->call_as_now }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" value="{{ $contact->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Available time')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="available_time" class="form-control" value="{{ $contact->available_time }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Form title')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="form_title" class="form-control" value="{{ $contact->form_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Form Description')}} <span class="text-danger">*</span></label>
                                        <textarea name="form_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $contact->form_description }}</textarea>
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
