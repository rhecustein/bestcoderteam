@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Mobile Slider')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Mobile Slider')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Mobile Slider')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.mobile-slider.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{__('admin.SN')}}</th>
                                        <th>{{__('admin.Title one')}}</th>
                                        <th>{{__('admin.Image')}}</th>
                                        <th>{{__('admin.Action')}}</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $index => $slider)
                                        <tr>
                                            <td>{{ $slider->serial }}</td>
                                            <td>{{ $slider->title_one }}</td>
                                            <td>
                                                <img src="{{ asset($slider->image) }}" class="mobile_slider_image" alt="">
                                            </td>

                                            <td>
                                            <a href="{{ route('admin.mobile-slider.edit',$slider->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $slider->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>

                                        </tr>
                                      @endforeach
                                </tbody>
                            </table>
                          </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

      <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/mobile-slider") }}'+"/"+id)
        }

    </script>
@endsection
