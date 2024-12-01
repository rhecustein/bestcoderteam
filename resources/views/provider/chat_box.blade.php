
@foreach ($messages as $message)
    @if ($message->send_by == 'provider')
        <div class="chat-item chat-right" style="">
            @if ($provider->image)
                <img src="{{ asset($provider->image) }}" />
            @else
                <img src="{{ asset($default_avatar->image) }}" />
            @endif

            <div class="chat-details">
                <div class="chat-text">{{ html_decode($message->message) }}</div>
                <div class="chat-time">{{ $message->created_at->diffForHumans() }}</div>
            </div>
        </div>
    @else
        @if ($message->service)
            <div class="chat-item chat-left" style="">
                @if ($buyer->image)
                    <img src="{{ asset($buyer->image) }}" />
                @else
                    <img src="{{ asset($default_avatar->image) }}" />
                @endif
                <div class="chat-details">
                    <div class="wsus__show_product">
                        <div class="img">
                            <img src="{{ asset($message->service->image) }}" alt="user" class="img-fluid w-100">
                        </div>
                        <a target="_blank" href="{{ route('service', $message->service->slug) }}">{{ $message->service->name }}</a>
                    </div>
                    <div class="chat-time">{{ $message->created_at->diffForHumans() }}</div>
                </div>
            </div>
        @else
            <div class="chat-item chat-left" style="">
                @if ($buyer->image)
                    <img src="{{ asset($buyer->image) }}" />
                @else
                    <img src="{{ asset($default_avatar->image) }}" />
                @endif
                <div class="chat-details">
                    <div class="chat-text">{{ html_decode($message->message) }}</div>
                    <div class="chat-time">{{ $message->created_at->diffForHumans() }}</div>
                </div>
            </div>
        @endif
    @endif
@endforeach

