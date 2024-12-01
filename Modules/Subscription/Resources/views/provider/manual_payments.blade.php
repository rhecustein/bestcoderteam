@extends('frontend.layout.master')
@section('breadcrumb')
 <section class="section">
          <div class="section-header">

            <h1>@changeLang('Bank Payments Log')</h1>

          </div>
</section>
@endsection
@section('content')

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>@changeLang('Sl')</th>

                                <th>@changeLang('User')</th>
                                <th>@changeLang('Amount')</th>
                                <th>@changeLang('status')</th>
                                <th>@changeLang('Action')</th>
                            </tr>
                            @forelse ($manuals as $key => $manual)
                                <tr>

                                    <td>{{ $key + $manuals->firstItem() }}</td>

                                    <td>{{ __($manual->user->fullname) }}</td>
                                    <td>{{ __($general->currency_icon . '  ' . $manual->amount) }}</td>

                                    <td>

                                        @if($manual->payment_confirmed == 2)

                                            <span class="badge badge-warning">@changeLang('Pending')</span>

                                        @elseif($manual->payment_confirmed == 1)
                                             <span class="badge badge-success">@changeLang('Approved')</span>


                                        @elseif($manual->payment_confirmed == 3)
                                             <span class="badge badge-danger">@changeLang('Rejected')</span>


                                        @endif


                                    </td>


                                    <td>

                                        <a class="btn btn-info details" href="{{route('user.manual.trx', $manual->trx)}}">@changeLang('Details')</a>

                                        @if($manual->payment_confirmed == 2)

                                            <button class="btn btn-primary accept" data-url="{{route('user.manual.accept', $manual->trx)}}" >@changeLang('Accept')</button>
                                            <button class="btn btn-danger reject" data-url="{{route('user.manual.reject',$manual->trx)}}">@changeLang('Reject')</button>

                                        @endif


                                    </td>




                                </tr>
                            @empty

                                <tr>

                                    <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>

                                </tr>

                            @endforelse
                        </table>
                    </div>
                </div>
                @if ($manuals->hasPages())
                    {{ $manuals->links('admin.partials.paginate') }}
                @endif
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

           <form action="" method="post">
           @csrf
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">@changeLang('Payment Accept')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <p>@changeLang('Are you sure to Accept this Payment request')?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                    <button type="submit" class="btn btn-primary" >@changeLang('Accept')</button>

                </div>
            </div>
           </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">

           <form action="" method="post">
           @csrf
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">@changeLang('Payment Reject')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <p>@changeLang('Are you sure to reject this payment')?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@changeLang('Close')</button>
                    <button type="submit" class="btn btn-danger" >@changeLang('Reject')</button>

                </div>
            </div>
           </form>
        </div>
    </div>



@endsection


@push('custom-script')

    <script>

        $(function(){
            'use strict'


            $('.accept').on('click',function(){
                 const modal = $('#accept');

                 modal.find('form').attr('action', $(this).data('url'));
                 modal.modal('show');
            })

            $('.reject').on('click',function(){
                 const modal = $('#reject');

                 modal.find('form').attr('action', $(this).data('url'));
                 modal.modal('show');
            })

        })


    </script>

@endpush

