@extends('provider.master_layout')
@section('title')
<title>{{__('user.My Profile')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.My Profile')}}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('provider.dashboard') }}">{{__('user.Dashboard')}}</a></div>
          <div class="breadcrumb-item">{{__('user.My Profile')}}</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-5">
            <div class="col-md-3">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Total Service Sold')}}</h4>
                  </div>
                  <div class="card-body">
                    {{ $total_sold_service }}
                  </div>
                </div>
              </div>
            </div>

                <div class="col-md-3">
                    <a href="{{ route('provider.my-withdraw.index') }}">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{__('user.Total Withdraw')}}</h4>
                            </div>
                            <div class="card-body">

                                @if ($setting->currency_position == 'before_price')
                                {{ $currency_icon->icon }}{{ $total_withdraw }}
                                @else
                                {{ $total_withdraw }}{{ $currency_icon->icon }}
                                @endif

                            </div>
                            </div>
                        </div>
                    </a>
                </div>



            <div class="col-md-3">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Current Balance')}}</h4>
                  </div>
                  <div class="card-body">

                    @if ($setting->currency_position == 'before_price')
                    {{ $currency_icon->icon }}{{ $current_balance }}
                    @else
                    {{ $current_balance }}{{ $currency_icon->icon }}
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('provider.service.index') }}">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>{{__('user.Total Service')}}</h4>
                  </div>
                  <div class="card-body">
                    {{ $total_service }}
                  </div>
                </div>
              </div>
            </a>
            </div>
          </div>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
              <div class="card profile-widget">
                <div class="profile-widget-header">
                    @if ($user->image)
                        <img alt="image" src="{{ asset($user->image) }}" class="rounded-circle profile-widget-picture">
                    @else
                        <img alt="image" src="{{ asset($default_avatar->image) }}" class="rounded-circle profile-widget-picture">
                    @endif
                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">{{__('user.Joined at')}}</div>
                      <div class="profile-widget-item-value">{{ $user->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">{{__('user.Balance')}}</div>
                      <div class="profile-widget-item-value">

                        @if ($setting->currency_position == 'before_price')
                        {{ $currency_icon->icon }}{{ $total_balance }}
                        @else
                        {{ $total_balance }}{{ $currency_icon->icon }}
                        @endif

                    </div>
                    </div>
                  </div>
                </div>
                <div class="profile-widget-description">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>{{__('user.Name')}}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>{{__('user.Email')}}</td>
                                <td>{{ $user->email }}</td>
                            </tr>

                            <tr>
                                <td>{{__('user.User Status')}}</td>
                                <td>
                                    @if($user->status == 1)
                                    <span class="badge badge-success">{{__('user.Active')}}</span>
                                    @else
                                    <span class="badge badge-danger">{{__('user.Inactive')}}</span>
                                @endif
                                </td>
                            </tr>




                        </table>
                    </div>
                </div>

              </div>

              <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{__('user.Provider Action')}}</h1>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">

                                <div class="col-12">
                                    <a href="{{ route('provider.review-list') }}" class="btn btn-primary btn-block btn-lg my-2">{{__('user.My Reviews')}}</a>
                                </div>

                                <div class="col-12">
                                    <a href="{{ route('provider.change-password') }}" class="btn btn-warning btn-block btn-lg my-2">{{__('user.Change Password')}}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>


            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form action="{{ route('provider.update-provider-profile') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>{{__('user.Edit Profile')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('user.New Image')}}</label>
                                    <input type="file" class="form-control-file" name="image">
                                    </div>

                                <div class="form-group col-6">
                                    <label>{{__('user.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('user.Designation')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $user->designation }}" name="designation">
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('user.Email')}} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" name="email" readonly>
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('user.Phone')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $user->phone }}" name="phone">
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('user.Country / Region')}} <span class="text-danger">*</span></label>
                                    <select name="country" id="country_id" class="form-control select2">
                                        <option value="">{{__('user.Select')}}</option>
                                        @if ($user->country_id != 0)
                                            @foreach ($countries as $country)
                                                <option {{ $user->country_id == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('user.State / Province')}} <span class="text-danger">*</span></label>
                                    <select name="state" id="state_id" class="form-control select2">
                                        <option value="">{{__('user.Select')}}</option>
                                        @if ($user->state_id != 0)
                                            @foreach ($states as $state)
                                                <option {{ $user->state_id == $state->id ? 'selected' : '' }} value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('user.Address')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $user->address }}" name="address">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">{{__('user.Update')}}</button>
                        </div>

                    </form>
                </div>
            </div>
          </div>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>{{__('user.Service Area')}}</h4>

                            <a href="{{ route('provider.export-service-area',$user->state_id) }}" class="btn btn-success"> <i class="fa fa-download" aria-hidden="true"></i> {{__('user.Download Demo Area')}}</a>
                        </div>

                        <hr>

                        <div class="table-responsive table-invoice">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{__('user.SN')}}</th>
                                        <th>{{__('user.Area')}}</th>
                                        <th>{{__('user.Action')}}</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service_areas as $index => $service_area)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $service_area->city->name }}</td>

                                            <td>
                                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $service_area->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:;" data-toggle="modal" data-target="#newArea" class="btn btn-primary"> <i class="fa fa-download" aria-hidden="true"></i> {{__('user.New Area')}}</a>


                            <a href="{{ route('provider.export-selected-area') }}" class="btn btn-success"> <i class="fa fa-download" aria-hidden="true"></i> {{__('user.Download Selected Area')}}</a>
                        </div>

                        <hr>

                        <form action="{{ route('provider.store-import-service-area') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">{{__('user.File')}}</label>
                                <input type="file" name="file" class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary">{{__('user.Upload')}}</button>
                        </form>


                        <div class="alert alert-success mt-3" role="alert">
                          <p>{{__('Before import delivery area you have to download area list from left side. In the download file you see 3 column (area id, state id and area name). Then you have to download selected area list from right side. In this file you can see your selected area id. If you import new area id you have to remove previous all area and entry your new area id. You can not provide duplicate area id')}}</p>
                        </div>


                    </div>
                </div>
            </div>


        </div>
      </div>
    </section>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="newArea" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">{{__('user.Create new area')}}</h5>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ route('provider.store-single-area') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">{{__('user.Service Area')}}</label>
                            <select name="delivery_area_id" id="" class="form-control select2">
                                <option value="">{{__('user.Select')}}</option>
                                @if ($user->state_id != 0)
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <button class="btn btn-primary">{{__('user.Save')}}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
  </div>



<script>

    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("provider/remove-single-area/") }}'+"/"+id)
    }

    (function($) {
        "use strict";
        $(document).ready(function () {

            $("#country_id").on("change",function(){
                var countryId = $("#country_id").val();
                if(countryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/provider/state-by-country/')}}"+"/"+countryId,
                        success:function(response){
                            $("#state_id").html(response.states);
                            var response= "<option value=''>{{__('user.Select')}}</option>";
                            $("#city_id").html(response);
                        },
                        error:function(err){
                        }
                    })
                }else{
                    var response= "<option value=''>{{__('user.Select')}}</option>";
                    $("#state_id").html(response);
                    var response= "<option value=''>{{__('user.Select')}}</option>";
                    $("#city_id").html(response);
                }

            })

            $("#state_id").on("change",function(){
                var countryId = $("#state_id").val();
                if(countryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/provider/city-by-state/')}}"+"/"+countryId,
                        success:function(response){
                            $("#city_id").html(response.cities);
                        },
                        error:function(err){
                        }
                    })
                }else{
                    var response= "<option value=''>{{__('user.Select')}}</option>";
                    $("#city_id").html(response);
                }

            })


        });
    })(jQuery);
</script>
@endsection
