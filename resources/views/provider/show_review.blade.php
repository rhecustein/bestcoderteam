@extends('provider.master_layout')
@section('title')
<title>{{__('user.Review Details')}}</title>
@endsection
@section('provider-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('user.Review Details')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('provider.review-list') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('user.Review List')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped table-bordered">
                           <tr>
                               <td>{{__('user.Client')}}</td>
                               <td>{{ $review->user->name }}</td>
                           </tr>
                           <tr>
                               <td>{{__('user.Client Email')}}</td>
                               <td>{{ $review->user->email }}</td>
                           </tr>
                           <tr>
                               <td>{{__('user.Service')}}</td>
                               <td><a href="{{ route('provider.service.edit', $review->service_id) }}">{{ $review->service->name }}</a></td>
                           </tr>
                           <tr>
                               <td>{{__('user.Rating')}}</td>
                               <td>{{ $review->rating }}</td>
                           </tr>
                           <tr>
                               <td>{{__('user.Review')}}</td>
                               <td>{{ html_decode($review->review) }}</td>
                           </tr>
                           <tr>
                               <td>{{__('user.Created At')}}</td>
                               <td>{{ $review->created_at->format('H:i A, d-m-Y') }}</td>
                           </tr>
                           <tr>
                               <td>{{__('user.Status')}}</td>
                               <td>
                                    @if ($review->status==1)
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
                </div>
          </div>
        </section>
      </div>

@endsection
