@foreach ($messages as $message)
    @if ($message->admin_id == 0)
        <div class="wsus__support_ticket_single author_message">
            <h5>{{ $ticket->user->name }} <small>({{__('user.Author')}})</small> <span>{{ $message->created_at->diffForHumans() }}</span></h5>
            <p>{!! clean(nl2br($message->message)) !!}</p>

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
            <h5>{{ $message->admin ? $message->admin->name : '' }} <small>({{__('user.Admin')}})</small>  <span>{{ $message->created_at->diffForHumans() }}</span></h5>
            <p>{!! clean(nl2br($message->message)) !!}</p>

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
