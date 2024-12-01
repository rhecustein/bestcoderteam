@extends('admin.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $title }}</h1>

          </div>

          <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="">{{__('admin.Provider')}}</label>
                                    <select name="provider" id="" class="form-control select2">
                                        <option value="">{{__('admin.Select')}}</option>
                                        @if (request()->has('provider'))
                                            @foreach ($providers as $provider)
                                                <option {{ request()->get('provider') == $provider->id ? 'selected' : ''}} value="{{ $provider->id }}">{{ $provider->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach ($providers as $provider)
                                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                            @endforeach
                                        @endif


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary plus_btn">{{__('admin.Search')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.service.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                @if($services->count() > 0)
                @foreach ($services as $service)
                    <div class="col-12">
                        <div class="card service_card">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <img class="service_image" src="{{ asset($service->image) }}" alt="">
                                <div class="service_detail">
                                    <h4>{{ $service->name }}</h4>
                                    <h6>{{__('admin.Price')}} :

                                        @if ($setting->currency_position == 'before_price')
                                        {{ $currency_icon->icon }}{{ $service->price }}
                                        @else
                                        {{ $service->price }}{{ $currency_icon->icon }}
                                        @endif

                                    </h6>
                                    <p>{{__('admin.Category')}} : {{ $service->category->name }}</p>
                                    @if ($service->make_featured == 1 || $service->make_popular == 1)
                                        <p>{{__('admin.Highlight')}} :

                                            @if ($service->make_featured == 1)
                                                {{__('admin.Featured')}}
                                            @endif
                                            @if ($service->make_featured == 1 && $service->make_popular == 1)
                                                ,
                                            @endif
                                            @if ($service->make_popular == 1)
                                                {{__('admin.Popular')}}
                                            @endif
                                        </p>
                                    @endif
                                    <p>{{__('admin.Status')}} :

                                        @if ($service->is_banned == 1)
                                            <span class="badge badge-danger">{{__('admin.Banned')}}</span>
                                        @elseif ($service->approve_by_admin == 0)
                                        <span class="badge badge-danger">{{__('admin.Awaiting for approval')}}</span>
                                        @else
                                            @if ($service->status == 1)
                                                <span class="badge badge-success">{{__('admin.Active')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('admin.Inactive')}}</span>
                                            @endif
                                        @endif

                                    </p>

                                    <p>{{__('admin.Provider')}}: <a href="{{ route('admin.provider-show', $service->provider_id) }}">{{ $service->provider->name }}</a></p>
                                    <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> {{__('admin.Edit')}}</a>

                                    @if ($service->totalOrder == 0)
                                    <a onclick="deleteData({{ $service->id }})" href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{__('admin.Remove')}}</a>
                                    @else

                                    <a href="javascript:;" data-toggle="modal" data-target="#canNotDeleteModal" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash" aria-hidden="true"></i> {{__('admin.Remove')}}</a>
                                    @endif

                                    <a target="_blank" href="{{ route('service', $service->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> {{__('admin.View')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12">
                    {{ $services->links() }}
                </div>

                @else
                    <div class="col-12 text-center text-danger">
                        <h4>{{__('admin.Service not found!')}}</h4>
                    </div>
                @endif
          </div>
        </section>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="canNotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                      <div class="modal-body">
                          {{__('admin.You can not delete this service. Because there are one or more order has been created in this product.')}}
                      </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                </div>
            </div>
        </div>
    </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/service/") }}'+"/"+id)
    }
</script>
@endsection
