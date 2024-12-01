@extends('provider.master_layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('provider-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ $title }}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('provider.service.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('user.Add New')}}</a>
            <div class="row mt-4">
                @if($services->count() > 0)
                @foreach ($services as $service)
                    <div class="col-12">
                        <div class="card service_card">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <img class="service_image" src="{{ asset($service->image) }}" alt="">
                                <div class="service_detail">
                                    <h4>{{ $service->name }}</h4>
                                    <h6>{{__('user.Price')}} :
                                        @if ($setting->currency_position == 'before_price')
                                        {{ $currency_icon->icon }}{{ $service->price }}
                                        @else
                                        {{ $service->price }}{{ $currency_icon->icon }}
                                        @endif
                                    </h6>
                                    <p>{{__('user.Category')}} : {{ $service->category->name }}</p>
                                    @if ($service->make_featured == 1 || $service->make_popular == 1)
                                        <p>{{__('user.Highlight')}} :

                                            @if ($service->make_featured == 1)
                                                {{__('user.Featured')}}
                                            @endif
                                            @if ($service->make_featured == 1 && $service->make_popular == 1)
                                                ,
                                            @endif
                                            @if ($service->make_popular == 1)
                                                {{__('user.Popular')}}
                                            @endif
                                        </p>
                                    @endif
                                    <p>{{__('user.Status')}} :

                                        @if ($service->is_banned == 1)
                                            <span class="badge badge-danger">{{__('user.Banned')}}</span>
                                        @elseif ($service->approve_by_admin == 0)
                                        <span class="badge badge-danger">{{__('user.Awaiting for approval')}}</span>
                                        @else
                                            @if ($service->status == 1)
                                                <span class="badge badge-success">{{__('user.Active')}}</span>
                                            @else
                                                <span class="badge badge-danger">{{__('user.Inactive')}}</span>
                                            @endif
                                        @endif

                                    </p>
                                    <a href="{{ route('provider.service.edit', $service->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> {{__('user.Edit')}}</a>

                                    @if ($service->totalOrder == 0)
                                        <a onclick="deleteData({{ $service->id }})" href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> {{__('user.Remove')}}</a>
                                    @else

                                        <a href="javascript:;" data-toggle="modal" data-target="#canNotDeleteModal" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash" aria-hidden="true"></i> {{__('user.Remove')}}</a>
                                    @endif

                                    <a target="_blank" href="{{ route('service', $service->slug) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> {{__('user.View')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @else
                    <div class="col-12 text-center text-danger">
                        <h4>{{__('user.Service not found!')}}</h4>
                    </div>
                @endif


                <div class="col-12">
                    {{ $services->links() }}
                </div>
          </div>
        </section>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="canNotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                      <div class="modal-body">
                          {{__('user.You can not delete this service. Because there are one or more order has been created in this product.')}}
                      </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('user.Close')}}</button>
                </div>
            </div>
        </div>
    </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("provider/service/") }}'+"/"+id)
    }
</script>
@endsection
