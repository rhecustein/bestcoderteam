@extends('admin.master_layout')
@section('title')
<title>{{__('admin.About Us')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.About Us')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.About Us')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3">
                                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">


                                    <li class="nav-item border rounded mb-1">
                                        <a class="nav-link active" id="general-setting-tab" data-toggle="tab" href="#generalSettingTab" role="tab" aria-controls="generalSettingTab" aria-selected="true">{{__('admin.How It Works')}}</a>
                                    </li>

                                    <li class="nav-item border rounded mb-1">
                                        <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logoTab" role="tab" aria-controls="logoTab" aria-selected="true">{{__('admin.About Us')}}</a>
                                    </li>

                                    <li class="nav-item border rounded mb-1">
                                        <a class="nav-link" id="themeColor-tab" data-toggle="tab" href="#themeColorTab" role="tab" aria-controls="themeColorTab" aria-selected="true">{{__('admin.Why Choose Us')}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-9">
                                <div class="border rounded">
                                    <div class="tab-content no-padding" id="settingsContent">

                                        <div class="tab-pane fade show active" id="generalSettingTab" role="tabpanel" aria-labelledby="general-setting-tab">
                                            <div class="card m-0">
                                                <div class="card-body">
                                                  <form action="{{ route('admin.update-header') }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Header')}}</label>
                                                        <input type="text" name="header" class="form-control" value="{{ $about->header }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Header Description')}}</label>
                                                        <input type="text" name="header_description" class="form-control" value="{{ $about->header_description }}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                                  </form>

                                                  <hr>
                                                  <h5>{{__('admin.How It Works Item')}}</h5>
                                                  <hr>
                                                  <table class="table mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th width="25%">{{__('admin.Title')}}</th>
                                                            <th width="15%">{{__('admin.Image')}}</th>
                                                            <th width="40%">{{__('admin.Description')}}</th>
                                                            <th width="20%">{{__('admin.Action')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($how_it_works as $how_it_work)
                                                            <tr>
                                                                <td>{{ $how_it_work->title }}</td>
                                                                <td>
                                                                    <img class="w_80" src="{{ asset($how_it_work->image) }}" alt="">
                                                                </td>
                                                                <td>{{ $how_it_work->description }}</td>
                                                                <td>
                                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteHowItWorkData({{ $how_it_work->id }})" ><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                                    <a data-toggle="modal" data-target="#editNewHowItWorkItem-{{ $how_it_work->id }}" href="javascript:;" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                  </table>

                                                  <button data-toggle="modal" data-target="#addNewHowItWorkItem" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> {{__('admin.Add New')}}</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="logoTab" role="tabpanel" aria-labelledby="logo-tab">
                                            <div class="card m-0">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.update-about-us') }}" method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="">{{__('admin.About Us Title')}}</label>
                                                            <input type="text" name="about_us_title" class="form-control" value="{{ $about_us_section['about_us_title'] }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.About Us')}}</label>
                                                            <textarea name="about_us" id="" class="summernote" cols="30" rows="10">{!! clean($about_us_section['about_us']) !!}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Background Image')}}</label>
                                                            <div>
                                                                <img class="w_220"  src="{{ asset($about_us_section['background_image']) }}" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.New Background')}}</label>
                                                            <input type="file" name="background_image" class="form-control-file">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Foreground Image')}}</label>
                                                            <div>
                                                                <img class="height_165" src="{{ asset($about_us_section['foreground_image']) }}" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.New Foreground')}}</label>
                                                            <input type="file" name="foreground_image" class="form-control-file">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Client Image One')}}</label>
                                                            <div>
                                                                <img class="w_70" src="{{ asset($about_us_section['client_image_one']) }}" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.New Image')}}</label>
                                                            <input type="file" name="client_image_one" class="form-control-file">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Client Image Two')}}</label>
                                                            <div>
                                                                <img class="w_70" src="{{ asset($about_us_section['client_image_two']) }}" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.New Image')}}</label>
                                                            <input type="file" name="client_image_two" class="form-control-file">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Client Image Three')}}</label>
                                                            <div>
                                                                <img class="w_70" src="{{ asset($about_us_section['client_image_three']) }}" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.New Image')}}</label>
                                                            <input type="file" name="client_image_three" class="form-control-file">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Total Rating')}}</label>
                                                            <input type="text" name="total_rating" class="form-control" value="{{ $about_us_section['total_rating'] }}">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                                      </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="themeColorTab" role="tabpanel" aria-labelledby="themeColor-tab">
                                            <div class="card m-0">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.update-why-choose-use') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Title')}}</label>
                                                            <input type="text" class="form-control" name="why_choose_us_title" value="{{ $why_choose_us['why_choose_us_title'] }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Description')}}</label>
                                                            <textarea name="why_choose_desciption" id="" class="summernote" cols="30" rows="10">{!! clean($why_choose_us['why_choose_desciption']) !!}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Background Image')}}</label>
                                                            <div>
                                                                <img class="w_220"  src="{{ asset($why_choose_us['background_image']) }}" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.New Background')}}</label>
                                                            <input type="file" name="background_image" class="form-control-file">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Foreground Image')}}</label>
                                                            <div>
                                                                <img class="w_220" src="{{ asset($why_choose_us['foreground_image']) }}" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.New Foreground')}}</label>
                                                            <input type="file" name="foreground_image" class="form-control-file">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Item One')}}</label>
                                                            <input type="text" name="item_one" class="form-control" value="{{ $why_choose_us['item_one'] }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Description One')}}</label>
                                                            <textarea name="description_one" id="" class="form-control text-area-3" cols="30" rows="10">{{ $why_choose_us['description_one'] }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Item Two')}}</label>
                                                            <input type="text" name="item_two" class="form-control" value="{{ $why_choose_us['item_two'] }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Description Two')}}</label>
                                                            <textarea name="description_two" id="" class="form-control text-area-3" cols="30" rows="10">{{ $why_choose_us['description_two'] }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Item Three')}}</label>
                                                            <input type="text" name="item_three" class="form-control" value="{{ $why_choose_us['item_three'] }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">{{__('admin.Description Three')}}</label>
                                                            <textarea name="description_three" id="" class="form-control text-area-3" cols="30" rows="10">{{ $why_choose_us['description_three'] }}</textarea>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="addNewHowItWorkItem" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Add New')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.store-how-it-work') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">{{__('admin.Image')}}</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <textarea name="description" id="" class="form-control text-area-5" cols="30" rows="10"></textarea>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </div>


      @foreach ($how_it_works as $how_it_work)
      <div class="modal fade" id="editNewHowItWorkItem-{{ $how_it_work->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Edit Item')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.update-how-it-work', $how_it_work->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Image')}}</label>
                               <div>
                                <img src="{{ asset($how_it_work->image) }}" alt="" class="w_80">
                               </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Image')}}</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>



                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="title" class="form-control" value="{{ $how_it_work->title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <textarea name="description" id="" class="form-control text-area-5" cols="30" rows="10">{{ $how_it_work->description }}</textarea>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </div>
      @endforeach


      <script>
        function deleteHowItWorkData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-how-it-work/") }}'+"/"+id)
        }

        </script>
@endsection
