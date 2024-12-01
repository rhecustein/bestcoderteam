
@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Provider Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Provider Details')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.provider') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Privider List')}}</a>
            <div class="row mt-5">
                <div class="col-md-3">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>{{__('admin.Total Service Sold')}}</h4>
                      </div>
                      <div class="card-body">
                       {{ $total_sold_service }}
                      </div>
                    </div>
                  </div>
                </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.provider-withdraw',['provider_id' => $provider->id]) }}">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{__('admin.Total Withdraw')}}</h4>
                                </div>
                                <div class="card-body">
                                    @if ($setting->currency_position == 'before_price')
                                    {{ $setting->currency_icon }}{{ $total_withdraw }}
                                    @else
                                    {{ $total_withdraw }}{{ $setting->currency_icon }}
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
                        <h4>{{__('admin.Current Balance')}}</h4>
                      </div>
                      <div class="card-body">
                        @if ($setting->currency_position == 'before_price')
                        {{ $setting->currency_icon }}{{ $current_balance }}
                        @else
                        {{ $current_balance }}{{ $setting->currency_icon }}
                        @endif

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.service.index', ['provider' => $provider->id]) }}">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>{{__('admin.Total Service')}}</h4>
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
                        @if ($provider->image)
                        <img alt="image" src="{{ asset($provider->image) }}" class="rounded-circle profile-widget-picture">
                        @else
                        <img alt="image" src="{{ asset($default_avatar->image) }}" class="rounded-circle profile-widget-picture">
                        @endif
                      <div class="profile-widget-items">
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Joined at')}}</div>
                          <div class="profile-widget-item-value">{{ $provider->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="profile-widget-item">
                          <div class="profile-widget-item-label">{{__('admin.Total Balance')}}</div>
                          <div class="profile-widget-item-value">

                            @if ($setting->currency_position == 'before_price')
                            {{ $setting->currency_icon }}{{ $total_balance }}
                            @else
                            {{ $total_balance }}{{ $setting->currency_icon }}
                            @endif

                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>{{__('admin.Name')}}</td>
                                    <td>{{ html_decode($provider->name) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Email')}}</td>
                                    <td>{{ html_decode($provider->email) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.Phone')}}</td>
                                    <td>{{ html_decode($provider->phone) }}</td>
                                </tr>
                                <tr>
                                    <td>{{__('admin.User Status')}}</td>
                                    <td>
                                        @if($provider->status == 1)
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $provider->id }})">
                                            <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
                                        @else
                                        <a href="javascript:;" onclick="manageCustomerStatus({{ $provider->id }})">
                                            <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                        </a>
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
                                <h1>{{__('admin.Provider Action')}}</h1>
                            </div>
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col-12">
                                        <a target="_blank" href="{{ route('providers', $provider->user_name) }}" class="btn btn-success btn-block btn-lg my-2">{{__('admin.Go to Provider Front Page')}}</a>
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('admin.review-list', ['provider_id' => $provider->id]) }}" class="btn btn-primary btn-block btn-lg my-2">{{__('admin.Provider Reviews')}}</a>
                                    </div>



                                    <div class="col-12">
                                        <a href="{{ route('admin.send-email-to-provider', $provider->id) }}" class="btn btn-warning btn-block btn-lg my-2">{{__('admin.Send Email')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.provider-update',$provider->id) }}">
                            @method('put')
                            @csrf
                            <div class="card-header">
                                <h4>{{__('admin.Edit Profile')}}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>{{__('admin.Name')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($provider->name) }}" name="name">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Desgination')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($provider->designation) }}" name="designation">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="{{ html_decode($provider->email) }}" name="email" readonly>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($provider->phone) }}" name="phone">
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.Country / Region')}} <span class="text-danger">*</span></label>
                                        <select name="country" id="country_id" class="form-control select2">
                                            <option value="">{{__('admin.Select')}}</option>
                                            @if ($provider->country_id != 0)
                                                @foreach ($countries as $country)
                                                    <option {{ $provider->country_id == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>{{__('admin.State / Province')}} <span class="text-danger">*</span></label>
                                        <select name="state" id="state_id" class="form-control select2">
                                            <option value="">{{__('admin.Select')}}</option>
                                            @if ($provider->state_id != 0)
                                                @foreach ($states as $state)
                                                    <option {{ $provider->state_id == $state->id ? 'selected' : '' }} value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>


                                    <div class="form-group col-12">
                                        <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ html_decode($provider->address) }}" name="address">
                                    </div>

                                </div>
                                <button class="btn btn-primary" type="submit">{{__('admin.Save Changes')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
              </div>
          </div>
        </section>
      </div>

<script>
    function manageCustomerStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/customer-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }

    function manageCustomerStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/provider-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }


</script>

<script>
    (function($) {
        "use strict";
        $(document).ready(function () {

            $("#country_id").on("change",function(){
                var countryId = $("#country_id").val();
                if(countryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/admin/state-by-country/')}}"+"/"+countryId,
                        success:function(response){
                            $("#state_id").html(response.states);
                            var response= "<option value=''>{{__('admin.Select')}}</option>";
                            $("#city_id").html(response);
                        },
                        error:function(err){

                        }
                    })
                }else{
                    var response= "<option value=''>{{__('admin.Select')}}</option>";
                    $("#state_id").html(response);
                    var response= "<option value=''>{{__('admin.Select')}}</option>";
                    $("#city_id").html(response);
                }

            })

            $("#state_id").on("change",function(){
                var countryId = $("#state_id").val();
                if(countryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/admin/city-by-state/')}}"+"/"+countryId,
                        success:function(response){
                            $("#city_id").html(response.cities);
                        },
                        error:function(err){
                        }
                    })
                }else{
                    var response= "<option value=''>{{__('admin.Select')}}</option>";
                    $("#city_id").html(response);
                }

            })


        });
    })(jQuery);
</script>
@endsection
