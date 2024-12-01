@extends('provider.master_layout')
@section('title')
<title>{{__('user.Appointment Schedule')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Appointment Schedule')}}</h1>
      </div>

        <div class="section-body">
            <a href="{{ route('provider.appointment-schedule.create') }}"  class="btn btn-primary"><i class="fas fa-plus"></i> {{__('user.Add New')}}</a>
            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{__('user.SN')}}</th>
                                            <th>{{__('user.Day')}}</th>
                                            <th>{{__('user.Start time')}}</th>
                                            <th>{{__('user.End time')}}</th>
                                            <th>{{__('user.Status')}}</th>
                                            <th>{{__('user.Action')}}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $index => $schedule)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $schedule->day }}</td>
                                                <td>{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                                                <td>{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                                <td>
                                                    @if ($schedule->status == 1)
                                                    <span class="badge badge-success">{{__('user.Active')}}</span>
                                                    @else

                                                    <span class="badge badge-danger">{{__('user.Inactive')}}</span>

                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="{{ route('provider.appointment-schedule.edit', $schedule->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                    <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $schedule->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        </div>
    </section>
</div>


<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("provider/appointment-schedule/") }}'+"/"+id)
    }

</script>
@endsection

