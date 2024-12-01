@extends('admin.master_layout')
@section('title')
<title>{{ __('admin.All Job Post') }}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{ __('admin.All Job Post') }}</h1>

          </div>

          <div class="section-body">
              <a href="{{ route('admin.jobpost.create') }}" class="btn btn-primary">{{ __('admin.Create New') }}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th >{{__('admin.SN')}}</th>
                                    <th >{{__('admin.User')}}</th>
                                    <th >{{__('admin.Title')}}</th>
                                    <th >{{__('admin.Price')}}</th>
                                    <th >{{__('admin.Visibility')}}</th>
                                    <th >{{__('admin.Applications')}}</th>
                                    <th >{{__('admin.Job Status')}}</th>
                                    <th >{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_posts as $index => $job_post)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><a href="{{ route('admin.customer-show',$job_post->user_id) }}">{{ html_decode($job_post?->user?->name) }}</a></td>
                                        <td><a target="blank" href="{{ route('job-detils',$job_post->slug) }}">{{ html_decode($job_post->title) }}</a></td>
                                        <td> {{ $currency_icon->icon }} {{ ($job_post->regular_price) }}</td>
                                        <td>
                                            @if ($job_post->approved_by_admin == 'approved')
                                                <span class="badge bg-success text-white">{{ __('Approved') }}</span>
                                            @else
                                                <span class="badge bg-danger text-white">{{ __('Awaiting') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.job-post-applicants', $job_post->id) }}">{{ __('Click here') }} ({{ $job_post->total_job_application }})</a>
                                        </td>

                                        <td>
                                            @if ($job_post->checkJobStatus($job_post->id) == 'approved')
                                                <span class="badge bg-success text-white">{{ __('Hired') }}</span>
                                            @elseif ($job_post->checkJobStatus($job_post->id) == 'pending')
                                                <span class="badge bg-danger text-white">{{ __('Pending') }}</span>
                                            @else
                                                <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.jobpost.edit',$job_post->id ) }}"  class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $job_post->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>


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

      <!-- Modal -->
      <div class="modal fade" id="canNotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                      <div class="modal-body">
                          {{__('admin.You can not delete this seller. Because there are one or more products and shop account has been created in this seller.')}}
                      </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                </div>
            </div>
        </div>
    </div>

<script>
    "use strict"
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/jobpost/jobpost/") }}'+"/"+id)
    }
</script>

@endsection
