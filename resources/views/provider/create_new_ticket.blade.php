@extends('provider.master_layout')
@section('title')
<title>{{__('user.Create Ticket')}}</title>
@endsection
@section('provider-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('user.Create Ticket')}}</h1>
          </div>

          <div class="section-body">
            <a class="btn btn-primary" href="{{ route('provider.ticket') }}"> <i class="fa fa-list" aria-hidden="true"></i> {{__('user.Ticket List')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('provider.store-new-ticket') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">{{__('user.Select Order')}} <span class="text-danger">*</span></label>
                                <select name="order_id" id="" class="form-control select2">
                                    <option value="">{{__('user.Select')}}</option>
                                    @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order_id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('user.Subject')}} <span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('user.Message')}} <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control text-area-5" id="" cols="30" rows="10"></textarea>
                            </div>

                            <button class="btn btn-primary">{{__('user.Save')}}</button>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>




@endsection
