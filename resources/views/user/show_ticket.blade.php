<div class="row">
    <div class="col-xl-8">
        <div class="ticket_list_view_area dashboard_review">
            <a class="go_ticket"><i class="fas fa-long-arrow-alt-left"></i>
                {{__('user.go back')}}</a>

                <div class="message-list">
                    @foreach ($messages as $message)
                        @if ($message->admin_id == 0)
                            <div class="wsus__support_ticket_single author_message">
                                <h5>{{ $ticket->user->name }} <small>({{__('user.Author')}})</small> <span>{{ $message->created_at->diffForHumans() }}</span></h5>
                                <p>{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                @if ($message->documents)
                                    <div class="gallery">
                                        @foreach ($message->documents as $document)
                                            <a href="{{ route('download-file', $document->file_name) }}" class="upload_photo"><i class="fas fa-link"></i> {{ $document->file_name }}</a>
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                        @else
                            <div class="wsus__support_ticket_single">
                                <h5>{{ $message->admin ? $message->admin->name : '' }} <small>({{__('user.Administrator')}})</small>  <span>{{ $message->created_at->diffForHumans() }}</span></h5>
                                <p>{!! html_decode(clean(nl2br($message->message))) !!}</p>

                                @if ($message->documents)
                                    <div class="gallery">
                                        @foreach ($message->documents as $document)
                                            <a href="{{ route('download-file', $document->file_name) }}" class="upload_photo"><i class="fas fa-link"></i> {{ $document->file_name }}</a>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        @endif
                    @endforeach
                </div>

            <form class="ticket_list_view_form" id="ticket_message_form">
                @csrf
                <textarea required name="message" rows="4"
                    placeholder="{{__('user.Typing Here')}}..."></textarea>
                <input type="file" name="documents[]" multiple>

                <input type="hidden" value="{{ $ticket->id }}" name="ticket_id">
                <input type="hidden" value="{{ $ticket->user->id }}" name="user_id">

                <p>{{__('user.Maximum file size 2MB')}}</p>
                <button type="submit" class="common_btn">{{__('user.Submit Now')}}</button>
            </form>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="ticket_list_view_sidebar dashboard_review">
            <h4>{{__('user.Ticket Information')}}</h4>

            <p>{{__('user.Subject')}}: {{ html_decode($ticket->subject) }}</p>
            <p>{{__('user.Ticket Id')}}: {{ $ticket->ticket_id }}</p>
            <p>{{__('user.Booking Id')}}: <a href="javascript:;">{{ $ticket->order->order_id }}</a></p>
            <p>{{__('user.Created')}}: {{ $ticket->created_at->format('h:m A, d-M-Y') }}</p>
            <p>{{__('user.Status')}}:
                @if($ticket->status == 'pending')
                <b><span class="closed">{{__('user.Pending')}}</span></b>
                @elseif ($ticket->status == 'in_progress')
                <b><span class="active">{{__('user.In Progress')}}</span></b>
                @elseif ($ticket->status == 'closed')
                <b><span class="closed">{{__('user.Closed')}}</span></b>
                @endif
            </p>
        </div>
    </div>
</div>



<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $(".go_ticket").on("click", function () {
                $(".support_ticket").fadeIn();
            });

            $(".go_ticket").on("click", function () {
                $(".wsus__ticket_list_view").fadeOut();
            });

            $("#ticket_message_form").on("submit", function(e){
                e.preventDefault();

                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                $.ajax({
                    url: "{{ route('send-ticket-message') }}",
                    type: "post",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response){
                        $(".message-list").html(response)
                        $("#ticket_message_form").trigger("reset");
                    },
                    error:function(err){

                    }
                });
            })


        });
    })(jQuery);
</script>
