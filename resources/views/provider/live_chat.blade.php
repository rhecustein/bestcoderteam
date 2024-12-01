@extends('provider.master_layout')
@section('title')
<title>{{__('user.Live Chat')}}</title>
@endsection
@section('provider-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>{{__('user.Live Chat')}}</h1>
      </div>

        <div class="section-body">
            <div class="row ustify-content-center">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                          <h4>{{__('user.Buyer List')}}</h4>
                        </div>
                        <div class="card-body seller_chat_list">
                          <ul class="list-unstyled list-unstyled-border" id="my_buyer_list">

                            @foreach ($buyers as $buyer)
                                <li id="customer-list-{{ $buyer->buyer_id }}" class="media mt-2 buyer-list" onclick="loadChatBox({{ $buyer->buyer_id }},'{{ $buyer->buyer->name }}')" style="cursor: pointer" data-buyer-id="{{ $buyer->buyer_id }}">
                                    @if ($buyer->buyer->image)
                                    <img alt="image" class="mr-3 ml-3 rounded-circle" width="50" src="{{ asset($buyer->buyer->image) }}">
                                    @else
                                    <img alt="image" class="mr-3 ml-3 rounded-circle" width="50" src="{{ asset($default_avatar->image) }}">
                                    @endif

                                    @php
                                        $un_read = App\Models\Message::where(['provider_id' => $provider->id, 'buyer_id' => $buyer->buyer_id, 'provider_read_msg' => 0])->count();
                                    @endphp
                                    <span class="pending {{ $un_read == 0 ? 'd-none' : ''}}" id="pending-{{ $buyer->buyer_id }}">{{ $un_read }}</span>
                                    <div class="media-body mt-4">
                                        <div class="font-weight-bold">{{ $buyer->buyer->name }}</div>
                                    </div>
                                </li>
                            @endforeach

                          </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-8">
                    <div class="card chat-box" id="mychatbox">
                        <div class="card-header buyer_name">
                            <h4>{{__('user.Please choose one')}}</h4>
                        </div>

                        <div class="card-body chat-content">

                        </div>

                        <div class="card-footer chat-form">
                            <form id="chat-form">
                                @csrf
                                <input name="message" autocomplete="off" type="text" class="form-control" id="customer_message" placeholder="{{__('user.Type message')}}" readonly>
                                <input type="hidden" id="buyer_id" name="buyer_id">
                                <button type="submit" class="btn btn-primary send-message-button" disabled>
                                <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>


@php
    $active_user_for_message = Auth::guard('web')->user();
@endphp

@endsection

@section('message-box')
<script>
    let active_buyer_id = 0;
    (function($) {
    "use strict";
        $(document).ready(function () {
            $("#chat-form").on("submit", function(e){
                e.preventDefault();
                let message = $("#customer_message").val();
                if(message == '')return;
                $.ajax({
                    type:"post",
                    data: $('#chat-form').serialize(),
                    url: "{{ url('provider/send-message-to-buyer/') }}",
                    success:function(response){
                        $(".chat-content").html(response)
                        $("#customer_message").val('');
                        scrollToBottomFunc();
                    },
                    error:function(err){
                    }
                })
            })

            Echo.private("buyer-to-provider.{{$active_user_for_message->id}}")
            .listen('BuyerProviderMessage', (e) => {

                let sender_buyer_id = e.message[0].buyer_id;

                if(parseInt(sender_buyer_id) == parseInt(active_buyer_id)){
                    $("#pending-"+sender_buyer_id).addClass('d-none');
                    $.ajax({
                        type:"get",
                        url: "{{ url('provider/load-chat-box/') }}" + "/" + sender_buyer_id,
                        success:function(response){
                            $(".chat-content").html(response)
                            scrollToBottomFunc();
                        },
                        error:function(err){
                        }
                    })
                }else{

                    let is_exist = false;
                    $('.buyer-list').each(function() {
                        let buyer_Id = $(this).data('buyer-id');
                        if(parseInt(buyer_Id) == parseInt(sender_buyer_id)) is_exist = true;
                    });

                    if(is_exist){
                        let current_qty = $("#pending-"+sender_buyer_id).html();
                        let new_qty = parseInt(current_qty) + parseInt(1);
                        console.log(`new qty ${new_qty}`);
                        $("#pending-"+sender_buyer_id).html(new_qty);

                        $("#pending-"+sender_buyer_id).removeClass('d-none');

                    }else{
                        $.ajax({
                            type:"get",
                            url: "{{ url('provider/find-new-buyer/') }}" + "/" + sender_buyer_id,
                            success:function(response){
                                let new_buyer = response.buyer;
                                let default_avatar = response.default_avatar.image;

                                let root_url = "{{ route('home') }}";
                                let avatar = '';

                                if(new_buyer.image){
                                    avatar = `<img alt="image" class="mr-3 ml-3 rounded-circle" width="50" src="${root_url}/${new_buyer.image}">`
                                }else{
                                    avatar = `<img alt="image" class="mr-3 ml-3 rounded-circle" width="50" src="${root_url}/${default_avatar}">`
                                }

                                let new_item = `
                                    <li id="customer-list-${sender_buyer_id}" class="media mt-2 buyer-list" onclick="loadChatBox(${sender_buyer_id},'${new_buyer.name}')" style="cursor: pointer" data-buyer-id="${sender_buyer_id}">
                                        ${avatar}
                                        <span class="pending" id="pending-${sender_buyer_id}">1</span>
                                        <div class="media-body mt-4">
                                            <div class="font-weight-bold">${new_buyer.name}</div>
                                        </div>
                                    </li>
                                `
                                $("#my_buyer_list").prepend(new_item);

                            },
                            error:function(err){
                            }
                        })
                    }
                }
            });


        });
    })(jQuery);

    function loadChatBox(buyer_id, buyer_name){
        $(".buyer_name").html(`<h4>${buyer_name}</h4>`)
        $(".send-message-button").attr('disabled', false);
        $("#customer_message").attr('readonly', false);
        $("#buyer_id").val(buyer_id);
        active_buyer_id = buyer_id;
        $("#pending-"+buyer_id).addClass('d-none');

        $.ajax({
            type:"get",
            url: "{{ url('provider/load-chat-box/') }}" + "/" + buyer_id,
            success:function(response){
                $(".chat-content").html(response)
                scrollToBottomFunc();
            },
            error:function(err){
            }
        })
    }

    function scrollToBottomFunc() {
        $('.chat-content').animate({
            scrollTop: $('.chat-content').get(0).scrollHeight
        }, 50);
    }
</script>
@endsection

