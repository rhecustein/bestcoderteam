@extends('provider.master_layout')
@section('title')
<title>{{__('user.Edit Service')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Edit Service')}}</h1>

      </div>

      <form action="{{ route('provider.service.update', $service->id) }}" method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf
        @method('PUT')
      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('user.Basic Information')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">


                        <div class="form-group col-12">
                            <label>{{__('user.Existing Image')}}</label>
                            <div>
                                <img class="w_120" src="{{ asset($service->image) }}" alt="">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('user.Image')}}</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group col-12">
                            <label>{{__('user.Service Name')}} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $service->name }}">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('user.Slug')}} <span class="text-danger">*</span> <span id="editSlug" class="badge badge-danger"><i class="fas fa-edit    "></i> edit</span></label>
                            <input readonly id="slug" type="text" class="form-control" name="slug" value="{{ $service->slug }}">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('user.Price')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="price" value="{{ $service->price }}">
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('user.Category')}} <span class="text-danger">*</span></label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="">{{__('user.Select')}}</option>
                                @foreach ($categories as $category)
                                <option {{ $service->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label>{{__('user.Details')}} <span class="text-danger">*</span></label>
                            <textarea name="details" id="" class="summernote" cols="30" rows="10">{!! clean($service->details) !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('user.Package Features')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row" id="package_feature_box">
                        @foreach ($package_features as $package_feature)
                            <div class="col-12 pacakge_feature_row">
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>{{__('user.Service')}}</label>
                                        <input type="text" class="form-control" name="package_features[]" autocomplete="off" value="{{ $package_feature }}">
                                    </div>
                                    <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn_mt_33 delete_package_feature"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>{{__('user.Service')}}</label>
                                    <input type="text" class="form-control" name="package_features[]" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" type="button" id="addNewPackageFeature" class="btn btn-success btn_mt_33"><i class="fa fa-plus" aria-hidden="true"></i> {{__('user.Add New')}}</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>


      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('user.What you will provide ?')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row" id="provide_item_box">
                        @foreach ($what_you_will_provides as $what_you_will_provide)
                            <div class="col-12 provide_item_row">
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>{{__('user.Title')}}</label>
                                        <input type="text" class="form-control" name="what_you_will_provides[]" autocomplete="off" value="{{ $what_you_will_provide }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn_mt_33 delete_provide_item"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>{{__('user.Title')}}</label>
                                    <input type="text" class="form-control" name="what_you_will_provides[]" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" type="button" id="addNewProvideItem" class="btn btn-success btn_mt_33"><i class="fa fa-plus" aria-hidden="true"></i> {{__('user.Add New')}}</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('user.Benifits of the Package')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row" id="benifit_box">
                        @foreach ($benifits as $benifit)
                            <div class="col-12 benitfit_item_row">
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>{{__('user.Title')}}</label>
                                        <input value="{{ $benifit }}" type="text" class="form-control" name="benifits[]" autocomplete="off">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" type="button" class="btn btn-danger btn_mt_33 delete_benifit_item"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>{{__('user.Title')}}</label>
                                    <input type="text" class="form-control" name="benifits[]" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="addNewBenifitItem" class="btn btn-success btn_mt_33"><i class="fa fa-plus" aria-hidden="true"></i> {{__('user.Add New')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('user.Additional service')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row" id="additional_box">
                        @foreach ($additional_services as $additional_service)
                        <div class="col-12 additional_item_box">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">{{__('user.Existing Image')}}</label>
                                    <div>
                                        <img class="w_120" src="{{ asset($additional_service->image) }}" alt="">
                                    </div>
                                </div>
                                <input type="hidden" name="ids[]" value="{{ $additional_service->id }}">
                                <div class="form-group col-md-3">
                                    <label>{{__('user.Image')}}</label>
                                    <input type="file" class="form-control" name="exist_additional_feature_image_{{ $additional_service->id }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('user.Service')}}</label>
                                    <input type="text" class="form-control" name="exist_additional_services[]" autocomplete="off" value="{{ $additional_service->service_name }}">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>{{__('user.Quantity')}}</label>
                                    <input type="text" class="form-control" name="exist_additional_quantities[]" autocomplete="off" value="{{ $additional_service->qty }}">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>{{__('user.Price')}}</label>
                                    <input type="text" class="form-control" name="exist_additional_prices[]" autocomplete="off" value="{{ $additional_service->price }}">
                                </div>

                                <div class="col-md-2">
                                    <button type="button" type="button" class="btn btn-danger btn_mt_33 delete_additional_service"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>{{__('user.Image')}}</label>
                                    <input type="file" class="form-control" name="additional_feature_images[]">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('user.Service')}}</label>
                                    <input type="text" class="form-control" name="additional_services[]" autocomplete="off">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>{{__('user.Quantity')}}</label>
                                    <input type="text" class="form-control" name="additional_quantities[]" autocomplete="off">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>{{__('user.Price')}}</label>
                                    <input type="text" class="form-control" name="additional_prices[]" autocomplete="off">
                                </div>

                                <div class="col-md-2">
                                    <button type="button" id="addNewAdditionalService" class="btn btn-success btn_mt_33"><i class="fa fa-plus" aria-hidden="true"></i> {{__('user.Add New')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="section-body">
        <div class="row mt-sm-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('user.Seo Information')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>{{__('user.Seo Title')}}</label>
                            <input type="text" class="form-control" name="seo_title" autocomplete="off"  value="{{ $service->seo_title }}">
                        </div>
                        <div class="form-group col-12">
                            <label>{{__('user.Seo Description')}}</label>
                            <textarea name="seo_description" class="form-control text-area-5" id="" cols="30" rows="10">{{ $service->seo_description }}</textarea>
                        </div>

                        @if ($service->approve_by_admin == 1)
                            <div class="form-group col-12">
                                <label>{{__('user.Status')}}</label>
                                <select name="status" id="" class="form-control">
                                    <option {{ $service->status == 1 ? 'selected' : '' }} value="1">{{__('user.Active')}}</option>
                                    <option {{ $service->status == 0 ? 'selected' : '' }} value="0">{{__('user.Inactive')}}</option>
                                </select>
                            </div>
                        @endif

                    </div>

                    <button class="btn btn-primary" type="submit">{{__('user.Update Service')}}</button>
                </div>


            </div>
          </div>
        </div>
      </div>

    </form>

    </section>
  </div>

 <script>
    (function($) {
        "use strict";
        $(document).ready(function () {

            // start package feature section
            $("#addNewPackageFeature").on("click", function(){
                let package_feature = `
                    <div class="col-12 pacakge_feature_row">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>{{__('user.Service')}}</label>
                                <input type="text" class="form-control" name="package_features[]" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn_mt_33 delete_package_feature"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                            </div>
                        </div>
                    </div>`;
                $("#package_feature_box").append(package_feature)
            });

            $(document).on('click', '.delete_package_feature', function () {
                $(this).closest('.pacakge_feature_row').remove();
            });

            // end package feature

            // start provide item
            $("#addNewProvideItem").on("click", function(){
                let provide_item = `
                    <div class="col-12 provide_item_row">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label>{{__('user.Title')}}</label>
                                <input type="text" class="form-control" name="what_you_will_provides[]" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn_mt_33 delete_provide_item"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                            </div>
                        </div>
                    </div>`;
                    $("#provide_item_box").append(provide_item)
            })

            $(document).on('click', '.delete_provide_item', function () {
                $(this).closest('.provide_item_row').remove();
            });
            // end provide item

            // start benifit item
            $("#addNewBenifitItem").on("click", function(){
                let provide_item = `
                    <div class="col-12 benitfit_item_row">
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>{{__('user.Title')}}</label>
                                    <input type="text" class="form-control" name="benifits[]" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" type="button" class="btn btn-danger btn_mt_33 delete_benifit_item"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                                </div>
                            </div>
                    </div>`;
                $("#benifit_box").append(provide_item)
            })

            $(document).on('click', '.delete_benifit_item', function () {
                $(this).closest('.benitfit_item_row').remove();
            });
            // end benifit

            $("#addNewAdditionalService").on("click", function(){
                let additional_service = `
                    <div class="col-12 additional_item_box">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>{{__('user.Image')}}</label>
                                <input type="file" class="form-control" name="additional_feature_images[]">
                            </div>

                            <div class="form-group col-md-3">
                                <label>{{__('user.Service')}}</label>
                                <input type="text" class="form-control" name="additional_services[]" autocomplete="off">
                            </div>

                            <div class="form-group col-md-2">
                                <label>{{__('user.Quantity')}}</label>
                                <input type="text" class="form-control" name="additional_quantities[]" autocomplete="off">
                            </div>

                            <div class="form-group col-md-2">
                                <label>{{__('user.Price')}}</label>
                                <input type="text" class="form-control" name="additional_prices[]" autocomplete="off">
                            </div>

                            <div class="col-md-2">
                                <button type="button" type="button" class="btn btn-danger btn_mt_33 delete_additional_service"><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</button>
                            </div>
                        </div>
                    </div>
                `;
                $("#additional_box").append(additional_service)
            })

            $(document).on('click', '.delete_additional_service', function () {
                $(this).closest('.additional_item_box').remove();
            });


            $("#editSlug").on("click", function(e){
                e.preventDefault();
                if($('#slug').attr('readOnly')) {
                    $("#slug").attr('readOnly', false)
                } else {
                    $("#slug").attr('readOnly', true)
                }
            })

        })
    })(jQuery);
</script>

@endsection
