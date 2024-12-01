@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Service Area')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create Service Area')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.city.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Service Area')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.city.store') }}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Country / Region')}} <span class="text-danger">*</span></label>
                                    <select name="country" id="country_id" class="form-control select2">
                                        <option value="">{{__('admin.Select')}}</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.State / Province')}} <span class="text-danger">*</span></label>
                                    <select name="state" id="state_id" class="form-control select2">
                                        <option value="">{{__('admin.Select')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Service Area')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1">{{__('admin.Active')}}</option>
                                        <option value="0">{{__('admin.Inactive')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Save')}}</button>
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
                            },
                            error:function(err){

                            }
                        })
                    }else{
                        var response= "<option value=''>{{__('admin.Select a State')}}</option>";
                        $("#state_id").html(response);
                    }

                })
            });
        })(jQuery);
    </script>
@endsection
