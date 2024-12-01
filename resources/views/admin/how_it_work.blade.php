@extends('admin.master_layout')
@section('title')
<title>{{__('admin.How It Work')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.How It Work')}}</h1>

          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.home-update-how-it-work') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="">{{__('admin.Background Banner')}}</label>
                                        <div>
                                            <img class="w_200" src="{{ asset($how_it_work->background) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Background')}}</label>
                                        <input type="file" name="background_image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Foreground Image')}}</label>
                                        <div>
                                            <img class="w_120" src="{{ asset($how_it_work->foreground) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Foreground')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ $how_it_work->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="description" class="form-control" value="{{ $how_it_work->description }}">
                                    </div>


                                    <div id="item_box">
                                        @foreach ($how_it_work->items as $item)
                                            <div class="row how_it_work_item my-3">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label for="">{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                                        <input type="text" name="titles[]" class="form-control" value="{{ $item->title }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger plus_btn removeItem"> <i class="fa fa-trash" aria-hidden="true"></i> {{__('admin.Remove')}} </button>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">{{__('admin.Description')}}</label>
                                                    <textarea name="descriptions[]" class="form-control text-area-5" id="" cols="30" rows="10">{{ $item->description }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="">{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                                    <input type="text" name="titles[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-primary plus_btn addNewItem"> <i class="fa fa-plus" aria-hidden="true"></i> {{__('admin.Add New')}} </button>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">{{__('admin.Description')}}</label>
                                                <textarea name="descriptions[]" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>



                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">{{__('admin.Update')}}</button>
                                </form>
                            </div>
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
            $(".addNewItem").on("click", function(e){
                e.preventDefault();
                let html = `
                    <div class="row how_it_work_item mt-3">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                <input type="text" name="titles[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger plus_btn removeItem"> <i class="fa fa-trash" aria-hidden="true"></i> {{__('admin.Remove')}} </button>
                        </div>

                        <div class="col-md-12">
                            <label for="">{{__('admin.Description')}}</label>
                            <textarea name="descriptions[]" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                `;
                $("#item_box").append(html);
            })


            $(document).on('click', '.removeItem', function () {
                $(this).closest('.how_it_work_item').remove();
            });

        });
    })(jQuery);
</script>
@endsection
