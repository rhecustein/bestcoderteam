@foreach ($messages as $message)
    @if ($message->send_by == 'buyer')
        @if ($message->service)
            <div class="wsus__show_product">
                <div class="img">
                    <img src="{{ asset($message->service->image) }}" alt="user" class="img-fluid w-100">
                </div>
                <a href="{{ route('service', $message->service->slug) }}">{{ $message->service->name }}</a>
            </div>
            <div class="wsus__single_chat chat_right">
                <span>{{ $message->created_at->diffForHumans() }}</span>
            </div>
        @else
            <div class="wsus__single_chat chat_right">
                <p>{{ html_decode($message->message) }}</p>
                <span>{{ $message->created_at->diffForHumans() }}</span>
            </div>
        @endif

    @else
        <div class="wsus__single_chat">
            <p>{{ html_decode($message->message) }} </p>
            <span>{{ $message->created_at->diffForHumans() }}</span>
        </div>
    @endif
@endforeach
