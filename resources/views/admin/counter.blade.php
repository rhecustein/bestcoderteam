@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Counter')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Counter')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Counter')}}</div>
            </div>
          </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-counter-bg') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Banner')}}</label>
                                        <div>
                                            <img class="w_180_h_100" src="{{ asset($counter_bg_image->counter_bg_image) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Banner')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>

                                    <button type="submit" class="btn btn-success">{{__('admin.Update')}}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


          <div class="section-body">
            <a href="{{ route('admin.counter.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th width="20%">{{__('admin.Title')}}</th>
                                    <th width="10%">{{__('admin.Icon')}}</th>
                                    <th width="30%">{{__('admin.Number')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($counters as $index => $counter)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $counter->title }}</td>
                                        <td>
                                            <img src="{{ asset($counter->icon) }}" alt="" class="w_80">
                                        </td>
                                        <td>{{ $counter->number }}</td>
                                        <td>
                                            @if($counter->status == 1)
                                            <a href="javascript:;" onclick="changeServiceStatus({{ $counter->id }})">
                                                <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>
                                            @else
                                            <a href="javascript:;" onclick="changeServiceStatus({{ $counter->id }})">
                                                <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.counter.edit',$counter->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $counter->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        $("#deleteForm").attr("action",'{{ url("admin/counter/") }}'+"/"+id)
    }
    function changeServiceStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/counter-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
