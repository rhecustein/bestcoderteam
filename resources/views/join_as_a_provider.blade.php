@extends($active_theme)

@section('title')
    <title>{{__('user.Join as provider')}}</title>
@endsection

@section('title')
    <meta name="description" content="{{__('user.Join as provider')}}">
@endsection

@section('frontend-content')

    <!--=========================
        BREADCRUMB START
    ==========================-->
    <div class="wsus__breadcrumb" style="background: url({{ asset($breadcrumb->image) }});">
        <div class="wsus__breadcrumb_overlay pt_90 xs_pt_60 pb_95 xs_pb_65">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav aria-label="breadcrumb">
                            <h1>{{__('user.Join as provider')}}</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('user.Join as provider')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
        BREADCRUMB END
    ==========================-->


        <!--=========================
        SELLAR JOINING START
    ==========================-->
    <div class="wsus__sellar_joining mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="wsus__sellar_joining_bg">
                <form id="provider_request_form" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__sellar_joining_top">
                            <div class="img">
                                <label for="seller_mg"><i class="far fa-cloud-upload"></i></label>
                                <input name="image" type="file" id="seller_mg" hidden>
                            </div>
                            <div class="text">
                                <h4>{{__('user.Upload Your Image')}}</h4>
                                <p>{{__('user.Choose a image PNG, JPEG, JPG')}}</p>
                                <span><b>{{__('user.Note')}}:</b> {{__('user.Max File Size 2MB')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wsus__review_input">

                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.Provider Name')}}*</legend>
                                    <input type="text" name="name" id="provider_name">
                                </fieldset>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.User Name')}}*</legend>
                                    <input type="text" name="username" id="username">
                                </fieldset>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.Designation')}}*</legend>
                                    <input type="text" name="designation">
                                </fieldset>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.email')}}*</legend>
                                    <input type="email" name="email">
                                </fieldset>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.Password')}}*</legend>
                                    <input type="password" name="password">
                                </fieldset>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.Confirmation Password')}}*</legend>
                                    <input type="password" name="password_confirmation">
                                </fieldset>
                            </div>

                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.phone')}}*</legend>
                                    <input type="text" name="phone">
                                </fieldset>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.Country / Region')}}*</legend>
                                    <select class="select_2" name="country" id="country_id">
                                        <option value="">{{__('user.Select')}}</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.State / Province')}}*</legend>
                                    <select class="select_2" name="state" id="state_id">
                                        <option value="">{{__('user.Select')}}</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <fieldset>
                                    <legend>{{__('user.Service Area')}}*</legend>
                                    <select class="select_2" name="service_area" id="city_id">
                                        <option value="">{{__('user.Select')}}</option>
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-12">
                                <fieldset>
                                    <legend>{{__('user.address')}}*</legend>
                                    <input type="text" name="address">
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <h4>{{__('user.Terms and Conditions')}}</h4>

                                <div class="form-check">
                                    <input name="agree" type="checkbox" id="terms_checkbox">
                                    <label class="form-check-label" for="terms_checkbox">
                                        {{__('user.I agree with')}} <a href="{{ route('terms-and-conditions') }}">{{__('user.Terms and Conditions')}}</a>
                                    </label>
                                </div>
                            </div>

                            @if($recaptchaSetting->status==1)
                                <div class="col-xl-12">
                                    <div class="wsus__single_com mt_20">
                                        <div class="g-recaptcha" data-sitekey="{{ $recaptchaSetting->site_key }}"></div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12">
                                <button type="submit" disabled id="submit_btn" class="common_btn mt_20">{{__('user.Submit')}}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--=========================
        SELLAR JOINING END
    ==========================-->



<script>
    (function($) {
        "use strict";
        $(document).ready(function () {

            $('input[name="agree"]').click(function(){
                if($(this).is(":checked")){
                    $("#submit_btn").attr('disabled', false)
                }
                else if($(this).is(":not(:checked)")){
                    $("#submit_btn").attr('disabled', true)
                }
            });

            $("#provider_request_form").on("submit", function(e){
                e.preventDefault();

                var isChecked = $('#terms_checkbox').is(':checked');

                if(!isChecked){
                    toastr.error("{{__('user.You have to check the chekbox')}}")
                    return;
                }

                $("#submit_btn").attr('disabled', true)
                $("#submit_btn").html("{{__('user.Processing...')}}")

                $.ajax({
                    url: "{{ route('request-provider') }}",
                    type: "post",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response){

                        $("#submit_btn").attr('disabled', false)
                        $("#submit_btn").html("{{__('user.Submit')}}")
                        if(response.status == 1){
                            toastr.success(response.message)
                            $("#provider_request_form").trigger("reset");
                        }
                    },
                    error:function(response){
                        $("#submit_btn").attr('disabled', false)
                        $("#submit_btn").html("{{__('user.Submit')}}")
                        if(response.responseJSON.errors.email)toastr.error(response.responseJSON.errors.email[0])
                        if(response.responseJSON.errors.name)toastr.error(response.responseJSON.errors.name[0])
                        if(response.responseJSON.errors.phone)toastr.error(response.responseJSON.errors.phone[0])
                        if(response.responseJSON.errors.address)toastr.error(response.responseJSON.errors.address[0])
                        if(response.responseJSON.errors.username)toastr.error(response.responseJSON.errors.username[0])
                        if(response.responseJSON.errors.designation)toastr.error(response.responseJSON.errors.designation[0])
                        if(response.responseJSON.errors.country)toastr.error(response.responseJSON.errors.country[0])
                        if(response.responseJSON.errors.state)toastr.error(response.responseJSON.errors.state[0])
                        if(response.responseJSON.errors.service_area)toastr.error(response.responseJSON.errors.service_area[0])
                        if(response.responseJSON.errors.password)toastr.error(response.responseJSON.errors.password[0])

                        if(!response.responseJSON.errors.email && !response.responseJSON.errors.name && !response.responseJSON.errors.phone && !response.responseJSON.errors.address && !response.responseJSON.errors.username && !response.responseJSON.errors.designation && !response.responseJSON.errors.country && !response.responseJSON.errors.state && !response.responseJSON.errors.service_area && !response.responseJSON.errors.password){
                            toastr.error("{{__('user.Please complete the recaptcha to submit the form')}}")
                        }

                    }
                });

            })

            $("#provider_name").on("keyup",function(e){

                $("#username").val(convertToSlug($(this).val()));
                let username = $("#username").val();
                let _token = "{{ csrf_token() }}";
                if(e.target.value == '') return;

                $.ajax({
                    type:"post",
                    data: {username, _token},
                    url:"{{url('/check-username/')}}",
                    success:function(response){
                        if(response.status == 0){
                            toastr.error(response.message);
                        }
                    },
                    error:function(err){
                    }
                })

            })

            $("#username").on("keyup", function(e){
                let username = $(this).val();
                let _token = "{{ csrf_token() }}";
                if(e.target.value == '') return;
                $.ajax({
                    type:"post",
                    data: {username, _token},
                    url:"{{url('/check-username/')}}",
                    success:function(response){
                        if(response.status == 0){
                            toastr.error(response.message);
                        }
                    },
                    error:function(err){
                    }
                })
            })

            $("#country_id").on("change",function(){
                var countryId = $("#country_id").val();
                if(countryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/state-by-country/')}}"+"/"+countryId,
                        success:function(response){
                            $("#state_id").html(response.states);
                            var response= "<option value=''>{{__('user.Select')}}</option>";
                            $("#city_id").html(response);
                        },
                        error:function(err){
                        }
                    })
                }else{
                    var response= "<option value=''>{{__('user.Select')}}</option>";
                    $("#state_id").html(response);
                    var response= "<option value=''>{{__('user.Select')}}</option>";
                    $("#city_id").html(response);
                }

            })

            $("#state_id").on("change",function(){
                var countryId = $("#state_id").val();
                if(countryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/city-by-state/')}}"+"/"+countryId,
                        success:function(response){
                            $("#city_id").html(response.cities);
                        },
                        error:function(err){
                        }
                    })
                }else{
                    var response= "<option value=''>{{__('user.Select')}}</option>";
                    $("#city_id").html(response);
                }

            })


        });
    })(jQuery);

    function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'_');
        }
</script>
@endsection
