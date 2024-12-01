@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Settings')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Settings')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
            </div>
          </div>

        <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">


                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link active" id="general-setting-tab" data-toggle="tab" href="#generalSettingTab" role="tab" aria-controls="generalSettingTab" aria-selected="true">{{__('admin.General Setting')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logoTab" role="tab" aria-controls="logoTab" aria-selected="true">{{__('admin.Logo and Favicon')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="themeColor-tab" data-toggle="tab" href="#themeColorTab" role="tab" aria-controls="themeColorTab" aria-selected="true">{{__('admin.Theme color')}}</a>
                                        </li>


                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="cookie-tab" data-toggle="tab" href="#cookieTab" role="tab" aria-controls="cookieTab" aria-selected="true">{{__('admin.Cookie Consent')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="recaptcha-tab" data-toggle="tab" href="#recaptchaTab" role="tab" aria-controls="recaptchaTab" aria-selected="true">{{__('admin.Google Recaptcha')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="pusher-tab" data-toggle="tab" href="#pusherTab" role="tab" aria-controls="pusherTab" aria-selected="true">{{__('admin.Pusher Credential')}}</a>
                                        </li>


                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="blog-comment-tab" data-toggle="tab" href="#blogCommentTab" role="tab" aria-controls="blogCommentTab" aria-selected="true">{{__('admin.Blog Comment')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="tawk-chat-tab" data-toggle="tab" href="#tawkChatTab" role="tab" aria-controls="tawkChatTab" aria-selected="true">{{__('admin.Tawk Chat')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="google-analytic-tab" data-toggle="tab" href="#googleAnalyticTab" role="tab" aria-controls="googleAnalyticTab" aria-selected="true">{{__('admin.Google Analytic')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="custom-pagination-tab" data-toggle="tab" href="#customPaginationTab" role="tab" aria-controls="customPaginationTab" aria-selected="true">{{__('admin.Custom Pagination')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="social-login-tab" data-toggle="tab" href="#socialLoginTab" role="tab" aria-controls="socialLoginTab" aria-selected="true">{{__('admin.Social Login')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="facebook-pixel-tab" data-toggle="tab" href="#facebookPixelTab" role="tab" aria-controls="facebookPixelTab" aria-selected="true">{{__('admin.Facebook Pixel')}}</a>
                                        </li>

                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link" id="database-generate-tab" data-toggle="tab" href="#databaseGenerateTab" role="tab" aria-controls="databaseGenerateTab" aria-selected="true">{{__('admin.Database Generate')}}</a>
                                        </li>



                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9">
                                    <div class="border rounded">
                                        <div class="tab-content no-padding" id="settingsContent">

                                            <div class="tab-pane fade show active" id="generalSettingTab" role="tabpanel" aria-labelledby="general-setting-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                      <form action="{{ route('admin.update-general-setting') }}" method="POST" enctype="multipart/form-data">
                                                          @csrf
                                                          @method('PUT')
                                                          <div class="form-group">
                                                              <label for="">{{__('admin.Select Theme')}}</label>
                                                              <select name="selected_theme" id="" class="form-control">
                                                                  <option {{ $setting->selected_theme == 0 ? 'selected' : '' }} value="0">{{__('admin.All Theme')}}</option>
                                                                  <option {{ $setting->selected_theme == 1 ? 'selected' : '' }} value="1">{{__('admin.Theme One')}}</option>
                                                                  <option {{ $setting->selected_theme == 2 ? 'selected' : '' }} value="2">{{__('admin.Theme Two')}}</option>
                                                                  <option {{ $setting->selected_theme == 3 ? 'selected' : '' }} value="3">{{__('admin.Theme Three')}}</option>
                                                              </select>
                                                          </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Commission Type')}}</label>
                                                                <select name="commission_type" id="" class="form-control">
                                                                    <option {{ $setting->commission_type  == 'commission' ? 'selected' : '' }} value="commission">{{__('admin.Commission')}}</option>
                                                                    <option {{ $setting->commission_type  == 'subscription' ? 'selected' : '' }} value="subscription">{{__('admin.Subscription')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('Live Chat')}}</label>
                                                                <select name="live_chat" id="" class="form-control">
                                                                    <option {{ $setting->live_chat  == 'enable' ? 'selected' : '' }} value="enable">{{__('admin.Enable')}}</option>
                                                                    <option {{ $setting->live_chat  == 'disable' ? 'selected' : '' }} value="disable">{{__('admin.Disable')}}</option>
                                                                </select>
                                                            </div>

                                                          <div class="form-group">
                                                            <label for="">{{__('admin.Show provide contact info')}}</label>
                                                            <select name="show_provider_contact_info" id="" class="form-control">
                                                                <option {{ $setting->show_provider_contact_info  == '1' ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                <option {{ $setting->show_provider_contact_info  == '0' ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                            </select>
                                                        </div>



                                                          <div class="form-group">
                                                              <label for="">{{__('admin.Layout')}}</label>
                                                              <select name="layout" id="" class="form-control">
                                                                  <option {{ $setting->text_direction == 'rtl' ? 'selected' : '' }} value="rtl">{{__('admin.RTL (right to left)')}}</option>
                                                                  <option {{ $setting->text_direction == 'ltr' ? 'selected' : '' }} value="ltr">{{__('admin.LTR (left to right)')}}</option>
                                                              </select>
                                                          </div>

                                                          <div class="form-group">
                                                              <label for="">{{__('admin.Sidebar Large Header')}}</label>
                                                              <input type="text" name="lg_header" class="form-control" value="{{ $setting->sidebar_lg_header }}">
                                                          </div>

                                                          <div class="form-group">
                                                              <label for="">{{__('admin.Sidebar Small Header')}}</label>
                                                              <input type="text" name="sm_header" class="form-control" value="{{ $setting->sidebar_sm_header }}">
                                                          </div>


                                                          <div class="form-group">
                                                              <label for="">{{__('admin.Default Currency Name')}}</label>
                                                              <select name="currency_name" id="" class="form-control select2">
                                                                  <option value="">{{__('admin.Select Default Currency')}}
                                                                </option>
                                                                @foreach ($currencies as $currency)
                                                                <option {{ $setting->currency_name == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->code }}
                                                                </option>
                                                                @endforeach
                                                              </select>
                                                          </div>


                                                          <div class="form-group">
                                                              <label for="">{{__('admin.Currency Icon')}}</label>
                                                              <input type="text" name="currency_icon" class="form-control" value="{{ $setting->currency_icon }}">
                                                          </div>


                                                          <div class="form-group">
                                                            <label for="">{{__('admin.Currency Position')}}</label>
                                                            <select name="currency_position" id="" class="form-control">
                                                                <option {{ $setting->currency_position == 'before_price' ? 'selected' : '' }} value="before_price">{{__('admin.Before Price')}}</option>
                                                                <option {{ $setting->currency_position == 'after_price' ? 'selected' : '' }} value="after_price">{{__('admin.After Price')}}</option>
                                                            </select>
                                                        </div>


                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Timezone')}}</label>
                                                                <select name="timezone" id="" class="form-control select2">
                                                                    <option {{ $setting->timezone == 'Africa/Abidjan' ? 'selected' : '' }} value="Africa/Abidjan" selected>Africa/Abidjan</option>
                                                                    <option {{ $setting->timezone == 'Africa/Accra' ? 'selected' : '' }} value="Africa/Accra" >Africa/Accra</option>
                                                                    <option  {{ $setting->timezone == 'Africa/Addis_Ababa' ? 'selected' : '' }}value="Africa/Addis_Ababa" >Africa/Addis_Ababa</option>
                                                                    <option {{ $setting->timezone == 'Africa/Algiers' ? 'selected' : '' }} value="Africa/Algiers" >Africa/Algiers</option>
                                                                    <option  {{ $setting->timezone == 'Africa/Asmara' ? 'selected' : '' }}value="Africa/Asmara" >Africa/Asmara</option>
                                                                    <option  {{ $setting->timezone == 'Africa/Bamako' ? 'selected' : '' }}value="Africa/Bamako" >Africa/Bamako</option>
                                                                    <option  {{ $setting->timezone == 'Africa/Bangui' ? 'selected' : '' }}value="Africa/Bangui" >Africa/Bangui</option>
                                                                    <option {{ $setting->timezone == 'Africa/Banjul' ? 'selected' : '' }} value="Africa/Banjul" >Africa/Banjul</option>
                                                                    <option {{ $setting->timezone == 'Africa/Bissau' ? 'selected' : '' }} value="Africa/Bissau" >Africa/Bissau</option>
                                                                    <option {{ $setting->timezone == 'Africa/Blantyre' ? 'selected' : '' }} value="Africa/Blantyre" >Africa/Blantyre</option>
                                                                    <option {{ $setting->timezone == 'Africa/Brazzaville' ? 'selected' : '' }} value="Africa/Brazzaville" >Africa/Brazzaville</option>
                                                                    <option {{ $setting->timezone == 'Africa/Bujumbura' ? 'selected' : '' }} value="Africa/Bujumbura" >Africa/Bujumbura</option>
                                                                    <option {{ $setting->timezone == 'Africa/Cairo"' ? 'selected' : '' }} value="Africa/Cairo" >Africa/Cairo</option>
                                                                    <option {{ $setting->timezone == 'Africa/Casablanca' ? 'selected' : '' }} value="Africa/Casablanca" >Africa/Casablanca</option>
                                                                    <option {{ $setting->timezone == 'Africa/Ceuta' ? 'selected' : '' }} value="Africa/Ceuta" >Africa/Ceuta</option>
                                                                    <option {{ $setting->timezone == 'Africa/Conakry' ? 'selected' : '' }} value="Africa/Conakry" >Africa/Conakry</option>
                                                                    <option {{ $setting->timezone == 'Africa/Dakar' ? 'selected' : '' }} value="Africa/Dakar" >Africa/Dakar</option>
                                                                    <option {{ $setting->timezone == 'Africa/Dar_es_Salaam' ? 'selected' : '' }} value="Africa/Dar_es_Salaam" >Africa/Dar_es_Salaam</option>
                                                                    <option {{ $setting->timezone == 'Africa/Djibouti' ? 'selected' : '' }} value="Africa/Djibouti" >Africa/Djibouti</option>
                                                                    <option {{ $setting->timezone == 'Africa/Douala' ? 'selected' : '' }} value="Africa/Douala" >Africa/Douala</option>
                                                                    <option {{ $setting->timezone == 'Africa/El_Aaiun' ? 'selected' : '' }} value="Africa/El_Aaiun" >Africa/El_Aaiun</option>
                                                                    <option {{ $setting->timezone == 'Africa/Freetown' ? 'selected' : '' }} value="Africa/Freetown" >Africa/Freetown</option>
                                                                    <option {{ $setting->timezone == 'Africa/Gaborone' ? 'selected' : '' }} value="Africa/Gaborone" >Africa/Gaborone</option>
                                                                    <option {{ $setting->timezone == 'Africa/Harare' ? 'selected' : '' }} value="Africa/Harare" >Africa/Harare</option>
                                                                    <option {{ $setting->timezone == 'Africa/Johannesburg' ? 'selected' : '' }} value="Africa/Johannesburg" >Africa/Johannesburg</option>
                                                                    <option {{ $setting->timezone == 'Africa/Juba' ? 'selected' : '' }} value="Africa/Juba" >Africa/Juba</option>
                                                                    <option {{ $setting->timezone == 'Africa/Kampala' ? 'selected' : '' }} value="Africa/Kampala" >Africa/Kampala</option>
                                                                    <option {{ $setting->timezone == 'Africa/Khartoum' ? 'selected' : '' }} value="Africa/Khartoum" >Africa/Khartoum</option>
                                                                    <option {{ $setting->timezone == 'Africa/Kigali' ? 'selected' : '' }} value="Africa/Kigali" >Africa/Kigali</option>
                                                                    <option {{ $setting->timezone == 'Africa/Kinshasa' ? 'selected' : '' }} value="Africa/Kinshasa" >Africa/Kinshasa</option>
                                                                    <option {{ $setting->timezone == 'Africa/Lagos' ? 'selected' : '' }} value="Africa/Lagos" >Africa/Lagos</option>
                                                                    <option {{ $setting->timezone == 'Africa/Libreville' ? 'selected' : '' }} value="Africa/Libreville" >Africa/Libreville</option>
                                                                    <option {{ $setting->timezone == 'Africa/Lome' ? 'selected' : '' }} value="Africa/Lome" >Africa/Lome</option>
                                                                    <option {{ $setting->timezone == 'Africa/Luanda' ? 'selected' : '' }} value="Africa/Luanda" >Africa/Luanda</option>
                                                                    <option {{ $setting->timezone == 'Africa/Lubumbashi' ? 'selected' : '' }} value="Africa/Lubumbashi" >Africa/Lubumbashi</option>
                                                                    <option {{ $setting->timezone == 'Africa/Lusaka' ? 'selected' : '' }} value="Africa/Lusaka" >Africa/Lusaka</option>
                                                                    <option {{ $setting->timezone == 'Africa/Malabo' ? 'selected' : '' }} value="Africa/Malabo" >Africa/Malabo</option>
                                                                    <option {{ $setting->timezone == 'Africa/Maputo' ? 'selected' : '' }} value="Africa/Maputo" >Africa/Maputo</option>
                                                                    <option {{ $setting->timezone == 'Africa/Maseru' ? 'selected' : '' }} value="Africa/Maseru" >Africa/Maseru</option>
                                                                    <option {{ $setting->timezone == 'Africa/Mbabane' ? 'selected' : '' }} value="Africa/Mbabane" >Africa/Mbabane</option>
                                                                    <option {{ $setting->timezone == 'Africa/Mogadishu' ? 'selected' : '' }} value="Africa/Mogadishu" >Africa/Mogadishu</option>
                                                                    <option {{ $setting->timezone == 'Africa/Monrovia' ? 'selected' : '' }} value="Africa/Monrovia" >Africa/Monrovia</option>
                                                                    <option {{ $setting->timezone == 'Africa/Nairobi' ? 'selected' : '' }} value="Africa/Nairobi" >Africa/Nairobi</option>
                                                                    <option {{ $setting->timezone == 'Africa/Ndjamena' ? 'selected' : '' }} value="Africa/Ndjamena" >Africa/Ndjamena</option>
                                                                    <option {{ $setting->timezone == 'Africa/Niamey' ? 'selected' : '' }} value="Africa/Niamey" >Africa/Niamey</option>
                                                                    <option {{ $setting->timezone == 'Africa/Nouakchott' ? 'selected' : '' }} value="Africa/Nouakchott" >Africa/Nouakchott</option>
                                                                    <option {{ $setting->timezone == 'Africa/Ouagadougou' ? 'selected' : '' }} value="Africa/Ouagadougou" >Africa/Ouagadougou</option>
                                                                    <option {{ $setting->timezone == 'Africa/Porto-Novo' ? 'selected' : '' }} value="Africa/Porto-Novo" >Africa/Porto-Novo</option>
                                                                    <option {{ $setting->timezone == 'Africa/Sao_Tome' ? 'selected' : '' }} value="Africa/Sao_Tome" >Africa/Sao_Tome</option>
                                                                    <option {{ $setting->timezone == 'Africa/Tripoli' ? 'selected' : '' }} value="Africa/Tripoli" >Africa/Tripoli</option>
                                                                    <option {{ $setting->timezone == 'Africa/Tunis' ? 'selected' : '' }} value="Africa/Tunis" >Africa/Tunis</option>
                                                                    <option {{ $setting->timezone == 'Africa/Windhoek' ? 'selected' : '' }} value="Africa/Windhoek" >Africa/Windhoek</option>
                                                                    <option {{ $setting->timezone == 'America/Adak' ? 'selected' : '' }} value="America/Adak" >America/Adak</option>
                                                                    <option {{ $setting->timezone == 'America/Anchorage' ? 'selected' : '' }} value="America/Anchorage" >America/Anchorage</option>
                                                                    <option {{ $setting->timezone == 'America/Anguilla' ? 'selected' : '' }} value="America/Anguilla" >America/Anguilla</option>
                                                                    <option {{ $setting->timezone == 'America/Antigua' ? 'selected' : '' }} value="America/Antigua" >America/Antigua</option>
                                                                    <option {{ $setting->timezone == 'America/Araguaina' ? 'selected' : '' }} value="America/Araguaina" >America/Araguaina</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Buenos_Aires' ? 'selected' : '' }} value="America/Argentina/Buenos_Aires" >America/Argentina/Buenos_Aires</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Catamarca' ? 'selected' : '' }} value="America/Argentina/Catamarca" >America/Argentina/Catamarca</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Cordoba' ? 'selected' : '' }} value="America/Argentina/Cordoba" >America/Argentina/Cordoba</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Jujuy' ? 'selected' : '' }} value="America/Argentina/Jujuy" >America/Argentina/Jujuy</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/La_Rioja' ? 'selected' : '' }} value="America/Argentina/La_Rioja" >America/Argentina/La_Rioja</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Mendoza' ? 'selected' : '' }} value="America/Argentina/Mendoza" >America/Argentina/Mendoza</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Rio_Gallegos' ? 'selected' : '' }} value="America/Argentina/Rio_Gallegos" >America/Argentina/Rio_Gallegos</option>

                                                                    <option {{ $setting->timezone == 'America/Argentina/Salta' ? 'selected' : '' }}  value="America/Argentina/Salta" >America/Argentina/Salta</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/San_Juan' ? 'selected' : '' }}  value="America/Argentina/San_Juan" >America/Argentina/San_Juan</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/San_Luis' ? 'selected' : '' }}  value="America/Argentina/San_Luis" >America/Argentina/San_Luis</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Tucuman' ? 'selected' : '' }}  value="America/Argentina/Tucuman" >America/Argentina/Tucuman</option>
                                                                    <option {{ $setting->timezone == 'America/Argentina/Ushuaia' ? 'selected' : '' }}  value="America/Argentina/Ushuaia" >America/Argentina/Ushuaia</option>
                                                                    <option {{ $setting->timezone == 'America/Aruba' ? 'selected' : '' }}  value="America/Aruba" >America/Aruba</option>
                                                                    <option {{ $setting->timezone == 'America/Asuncion' ? 'selected' : '' }}  value="America/Asuncion" >America/Asuncion</option>
                                                                    <option {{ $setting->timezone == 'America/Atikokan' ? 'selected' : '' }}  value="America/Atikokan" >America/Atikokan</option>
                                                                    <option {{ $setting->timezone == 'America/Bahia' ? 'selected' : '' }}  value="America/Bahia" >America/Bahia</option>
                                                                    <option {{ $setting->timezone == 'America/Bahia_Banderas' ? 'selected' : '' }}  value="America/Bahia_Banderas" >America/Bahia_Banderas</option>
                                                                    <option {{ $setting->timezone == 'America/Barbados' ? 'selected' : '' }}  value="America/Barbados" >America/Barbados</option>
                                                                    <option {{ $setting->timezone == 'America/Belem' ? 'selected' : '' }}  value="America/Belem" >America/Belem</option>
                                                                    <option {{ $setting->timezone == 'America/Belize' ? 'selected' : '' }}  value="America/Belize" >America/Belize</option>
                                                                    <option {{ $setting->timezone == 'America/Blanc-Sablon' ? 'selected' : '' }}  value="America/Blanc-Sablon" >America/Blanc-Sablon</option>
                                                                    <option {{ $setting->timezone == 'America/Boa_Vista' ? 'selected' : '' }}  value="America/Boa_Vista" >America/Boa_Vista</option>
                                                                    <option {{ $setting->timezone == 'America/Bogota' ? 'selected' : '' }}  value="America/Bogota" >America/Bogota</option>
                                                                    <option {{ $setting->timezone == 'America/Boise' ? 'selected' : '' }}  value="America/Boise" >America/Boise</option>
                                                                    <option {{ $setting->timezone == 'America/Cambridge_Bay' ? 'selected' : '' }}  value="America/Cambridge_Bay" >America/Cambridge_Bay</option>
                                                                    <option {{ $setting->timezone == 'America/Campo_Grande' ? 'selected' : '' }}  value="America/Campo_Grande" >America/Campo_Grande</option>
                                                                    <option {{ $setting->timezone == 'America/Cancun' ? 'selected' : '' }}  value="America/Cancun" >America/Cancun</option>
                                                                    <option {{ $setting->timezone == 'America/Caracas' ? 'selected' : '' }}  value="America/Caracas" >America/Caracas</option>
                                                                    <option {{ $setting->timezone == 'America/Cayenne' ? 'selected' : '' }}  value="America/Cayenne" >America/Cayenne</option>
                                                                    <option {{ $setting->timezone == 'America/Cayman' ? 'selected' : '' }}  value="America/Cayman" >America/Cayman</option>
                                                                    <option {{ $setting->timezone == 'America/Chicago' ? 'selected' : '' }}  value="America/Chicago" >America/Chicago</option>
                                                                    <option {{ $setting->timezone == 'America/Chihuahua' ? 'selected' : '' }}  value="America/Chihuahua" >America/Chihuahua</option>
                                                                    <option {{ $setting->timezone == 'America/Costa_Rica' ? 'selected' : '' }}  value="America/Costa_Rica" >America/Costa_Rica</option>
                                                                    <option {{ $setting->timezone == 'America/Creston' ? 'selected' : '' }}  value="America/Creston" >America/Creston</option>
                                                                    <option {{ $setting->timezone == 'America/Cuiaba' ? 'selected' : '' }}  value="America/Cuiaba" >America/Cuiaba</option>
                                                                    <option {{ $setting->timezone == 'America/Curacao' ? 'selected' : '' }}  value="America/Curacao" >America/Curacao</option>
                                                                    <option {{ $setting->timezone == 'America/Danmarkshavn' ? 'selected' : '' }}  value="America/Danmarkshavn" >America/Danmarkshavn</option>
                                                                    <option {{ $setting->timezone == 'America/Dawson' ? 'selected' : '' }}  value="America/Dawson" >America/Dawson</option>
                                                                    <option {{ $setting->timezone == 'America/Dawson_Creek' ? 'selected' : '' }}  value="America/Dawson_Creek" >America/Dawson_Creek</option>
                                                                    <option {{ $setting->timezone == 'America/Denver' ? 'selected' : '' }}  value="America/Denver" >America/Denver</option>
                                                                    <option {{ $setting->timezone == 'America/Detroit' ? 'selected' : '' }}  value="America/Detroit" >America/Detroit</option>
                                                                    <option {{ $setting->timezone == 'America/Dominica' ? 'selected' : '' }}  value="America/Dominica" >America/Dominica</option>
                                                                    <option {{ $setting->timezone == 'America/Edmonton' ? 'selected' : '' }}  value="America/Edmonton" >America/Edmonton</option>
                                                                    <option {{ $setting->timezone == 'America/Eirunepe' ? 'selected' : '' }}  value="America/Eirunepe" >America/Eirunepe</option>
                                                                    <option {{ $setting->timezone == 'America/El_Salvador' ? 'selected' : '' }}  value="America/El_Salvador" >America/El_Salvador</option>
                                                                    <option {{ $setting->timezone == 'America/Fort_Nelson' ? 'selected' : '' }}  value="America/Fort_Nelson" >America/Fort_Nelson</option>
                                                                    <option {{ $setting->timezone == 'America/Fortaleza' ? 'selected' : '' }}  value="America/Fortaleza" >America/Fortaleza</option>
                                                                    <option {{ $setting->timezone == 'America/Glace_Bay' ? 'selected' : '' }}  value="America/Glace_Bay" >America/Glace_Bay</option>
                                                                    <option {{ $setting->timezone == 'America/Goose_Bay' ? 'selected' : '' }}  value="America/Goose_Bay" >America/Goose_Bay</option>

                                                                    <option {{ $setting->timezone == 'America/Grand_Turk' ? 'selected' : '' }}  value="America/Grand_Turk" >America/Grand_Turk</option>
                                                                    <option {{ $setting->timezone == 'America/Grenada' ? 'selected' : '' }}  value="America/Grenada" >America/Grenada</option>
                                                                    <option {{ $setting->timezone == 'America/Guadeloupe' ? 'selected' : '' }}  value="America/Guadeloupe" >America/Guadeloupe</option>
                                                                    <option {{ $setting->timezone == 'America/Guatemala' ? 'selected' : '' }}  value="America/Guatemala" >America/Guatemala</option>
                                                                    <option {{ $setting->timezone == 'America/Guayaquil' ? 'selected' : '' }}  value="America/Guayaquil" >America/Guayaquil</option>
                                                                    <option {{ $setting->timezone == 'America/Guyana' ? 'selected' : '' }}  value="America/Guyana" >America/Guyana</option>
                                                                    <option {{ $setting->timezone == 'America/Halifax' ? 'selected' : '' }}  value="America/Halifax" >America/Halifax</option>
                                                                    <option {{ $setting->timezone == 'America/Havana' ? 'selected' : '' }}  value="America/Havana" >America/Havana</option>
                                                                    <option {{ $setting->timezone == 'America/Hermosillo' ? 'selected' : '' }}  value="America/Hermosillo" >America/Hermosillo</option>
                                                                    <option {{ $setting->timezone == 'America/Indiana/Indianapolis' ? 'selected' : '' }}  value="America/Indiana/Indianapolis" >America/Indiana/Indianapolis</option>
                                                                    <option {{ $setting->timezone == 'America/Indiana/Knox' ? 'selected' : '' }}  value="America/Indiana/Knox" >America/Indiana/Knox</option>
                                                                    <option {{ $setting->timezone == 'America/Indiana/Marengo' ? 'selected' : '' }}  value="America/Indiana/Marengo" >America/Indiana/Marengo</option>

                                                                    <option {{ $setting->timezone == 'America/Indiana/Petersburg' ? 'selected' : '' }}  value="America/Indiana/Petersburg" >America/Indiana/Petersburg</option>
                                                                    <option {{ $setting->timezone == 'America/Indiana/Tell_City' ? 'selected' : '' }}  value="America/Indiana/Tell_City" >America/Indiana/Tell_City</option>
                                                                    <option {{ $setting->timezone == 'America/Indiana/Vevay' ? 'selected' : '' }}  value="America/Indiana/Vevay" >America/Indiana/Vevay</option>
                                                                    <option {{ $setting->timezone == 'America/Indiana/Vincennes' ? 'selected' : '' }}  value="America/Indiana/Vincennes" >America/Indiana/Vincennes</option>
                                                                    <option {{ $setting->timezone == 'America/Indiana/Winamac' ? 'selected' : '' }}  value="America/Indiana/Winamac" >America/Indiana/Winamac</option>
                                                                    <option {{ $setting->timezone == 'America/Inuvik' ? 'selected' : '' }}  value="America/Inuvik" >America/Inuvik</option>
                                                                    <option {{ $setting->timezone == 'America/Iqaluit' ? 'selected' : '' }}  value="America/Iqaluit" >America/Iqaluit</option>
                                                                    <option {{ $setting->timezone == 'America/Jamaica' ? 'selected' : '' }}  value="America/Jamaica" >America/Jamaica</option>
                                                                    <option {{ $setting->timezone == 'America/Juneau' ? 'selected' : '' }}  value="America/Juneau" >America/Juneau</option>
                                                                    <option {{ $setting->timezone == 'America/Kentucky/Louisville' ? 'selected' : '' }}  value="America/Kentucky/Louisville" >America/Kentucky/Louisville</option>
                                                                    <option {{ $setting->timezone == 'America/Kentucky/Monticello' ? 'selected' : '' }}  value="America/Kentucky/Monticello" >America/Kentucky/Monticello</option>
                                                                    <option {{ $setting->timezone == 'America/Kralendijk' ? 'selected' : '' }}  value="America/Kralendijk" >America/Kralendijk</option>
                                                                    <option {{ $setting->timezone == 'America/La_Paz' ? 'selected' : '' }}  value="America/La_Paz" >America/La_Paz</option>
                                                                    <option {{ $setting->timezone == 'America/Lima' ? 'selected' : '' }}  value="America/Lima" >America/Lima</option>
                                                                    <option {{ $setting->timezone == 'America/Los_Angeles' ? 'selected' : '' }}  value="America/Los_Angeles" >America/Los_Angeles</option>
                                                                    <option {{ $setting->timezone == 'America/Lower_Princes' ? 'selected' : '' }}  value="America/Lower_Princes" >America/Lower_Princes</option>
                                                                    <option {{ $setting->timezone == 'America/Maceio' ? 'selected' : '' }}  value="America/Maceio" >America/Maceio</option>
                                                                    <option {{ $setting->timezone == 'America/Managua' ? 'selected' : '' }}  value="America/Managua" >America/Managua</option>
                                                                    <option {{ $setting->timezone == 'America/Manaus' ? 'selected' : '' }}  value="America/Manaus" >America/Manaus</option>
                                                                    <option {{ $setting->timezone == 'America/Marigot' ? 'selected' : '' }}  value="America/Marigot" >America/Marigot</option>
                                                                    <option {{ $setting->timezone == 'America/Martinique' ? 'selected' : '' }}  value="America/Martinique" >America/Martinique</option>
                                                                    <option {{ $setting->timezone == 'America/Matamoros' ? 'selected' : '' }}  value="America/Matamoros" >America/Matamoros</option>
                                                                    <option {{ $setting->timezone == 'America/Mazatlan' ? 'selected' : '' }}  value="America/Mazatlan" >America/Mazatlan</option>
                                                                    <option {{ $setting->timezone == 'America/Menominee' ? 'selected' : '' }}  value="America/Menominee" >America/Menominee</option>
                                                                    <option {{ $setting->timezone == 'America/Merida' ? 'selected' : '' }}  value="America/Merida" >America/Merida</option>
                                                                    <option {{ $setting->timezone == 'America/Metlakatla' ? 'selected' : '' }}  value="America/Metlakatla" >America/Metlakatla</option>
                                                                    <option {{ $setting->timezone == 'America/Mexico_City' ? 'selected' : '' }}  value="America/Mexico_City" >America/Mexico_City</option>
                                                                    <option {{ $setting->timezone == 'America/Miquelon' ? 'selected' : '' }}  value="America/Miquelon" >America/Miquelon</option>
                                                                    <option {{ $setting->timezone == 'America/Moncton' ? 'selected' : '' }}  value="America/Moncton" >America/Moncton</option>
                                                                    <option {{ $setting->timezone == 'America/Monterrey' ? 'selected' : '' }}  value="America/Monterrey" >America/Monterrey</option>
                                                                    <option {{ $setting->timezone == 'America/Montevideo' ? 'selected' : '' }}  value="America/Montevideo" >America/Montevideo</option>
                                                                    <option {{ $setting->timezone == 'America/Montserrat' ? 'selected' : '' }}  value="America/Montserrat" >America/Montserrat</option>
                                                                    <option {{ $setting->timezone == 'America/Nassau' ? 'selected' : '' }}  value="America/Nassau" >America/Nassau</option>
                                                                    <option {{ $setting->timezone == 'America/New_York' ? 'selected' : '' }}  value="America/New_York" >America/New_York</option>
                                                                    <option {{ $setting->timezone == 'America/Nipigon' ? 'selected' : '' }}  value="America/Nipigon" >America/Nipigon</option>
                                                                    <option {{ $setting->timezone == 'America/Nome' ? 'selected' : '' }}  value="America/Nome" >America/Nome</option>
                                                                    <option {{ $setting->timezone == 'America/Noronha' ? 'selected' : '' }}  value="America/Noronha" >America/Noronha</option>
                                                                    <option {{ $setting->timezone == 'America/North_Dakota/Beulah' ? 'selected' : '' }}  value="America/North_Dakota/Beulah" >America/North_Dakota/Beulah</option>
                                                                    <option {{ $setting->timezone == 'America/North_Dakota/Center' ? 'selected' : '' }}  value="America/North_Dakota/Center" >America/North_Dakota/Center</option>
                                                                    <option {{ $setting->timezone == 'America/North_Dakota/New_Salem' ? 'selected' : '' }}  value="America/North_Dakota/New_Salem" >America/North_Dakota/New_Salem</option>
                                                                    <option {{ $setting->timezone == 'America/Nuuk' ? 'selected' : '' }}  value="America/Nuuk" >America/Nuuk</option>
                                                                    <option {{ $setting->timezone == 'America/Ojinaga' ? 'selected' : '' }}  value="America/Ojinaga" >America/Ojinaga</option>
                                                                    <option {{ $setting->timezone == 'America/Panama' ? 'selected' : '' }}  value="America/Panama" >America/Panama</option>
                                                                    <option {{ $setting->timezone == 'America/Pangnirtung' ? 'selected' : '' }}  value="America/Pangnirtung" >America/Pangnirtung</option>
                                                                    <option {{ $setting->timezone == 'America/Paramaribo' ? 'selected' : '' }}  value="America/Paramaribo" >America/Paramaribo</option>


                                                                    <option {{ $setting->timezone == 'America/Phoenix' ? 'selected' : '' }} value="America/Phoenix" >America/Phoenix</option>
                                                                    <option {{ $setting->timezone == 'America/Port-au-Prince' ? 'selected' : '' }} value="America/Port-au-Prince" >America/Port-au-Prince</option>
                                                                    <option {{ $setting->timezone == 'America/Port_of_Spain' ? 'selected' : '' }} value="America/Port_of_Spain" >America/Port_of_Spain</option>
                                                                    <option {{ $setting->timezone == 'America/Porto_Velho' ? 'selected' : '' }} value="America/Porto_Velho" >America/Porto_Velho</option>
                                                                    <option {{ $setting->timezone == 'America/Puerto_Rico' ? 'selected' : '' }} value="America/Puerto_Rico" >America/Puerto_Rico</option>
                                                                    <option {{ $setting->timezone == 'America/Punta_Arenas' ? 'selected' : '' }} value="America/Punta_Arenas" >America/Punta_Arenas</option>
                                                                    <option {{ $setting->timezone == 'America/Rainy_River' ? 'selected' : '' }} value="America/Rainy_River" >America/Rainy_River</option>
                                                                    <option {{ $setting->timezone == 'America/Rankin_Inlet' ? 'selected' : '' }} value="America/Rankin_Inlet" >America/Rankin_Inlet</option>
                                                                    <option {{ $setting->timezone == 'America/Recife' ? 'selected' : '' }} value="America/Recife" >America/Recife</option>
                                                                    <option {{ $setting->timezone == 'America/Regina' ? 'selected' : '' }} value="America/Regina" >America/Regina</option>
                                                                    <option {{ $setting->timezone == 'America/Resolute' ? 'selected' : '' }} value="America/Resolute" >America/Resolute</option>
                                                                    <option {{ $setting->timezone == 'America/Rio_Branco' ? 'selected' : '' }} value="America/Rio_Branco" >America/Rio_Branco</option>
                                                                    <option {{ $setting->timezone == 'America/Santarem' ? 'selected' : '' }} value="America/Santarem" >America/Santarem</option>
                                                                    <option {{ $setting->timezone == 'America/Santiago' ? 'selected' : '' }} value="America/Santiago" >America/Santiago</option>
                                                                    <option {{ $setting->timezone == 'America/Santo_Domingo' ? 'selected' : '' }} value="America/Santo_Domingo" >America/Santo_Domingo</option>
                                                                    <option {{ $setting->timezone == 'America/Sao_Paulo' ? 'selected' : '' }} value="America/Sao_Paulo" >America/Sao_Paulo</option>
                                                                    <option {{ $setting->timezone == 'America/Scoresbysund' ? 'selected' : '' }} value="America/Scoresbysund" >America/Scoresbysund</option>
                                                                    <option {{ $setting->timezone == 'America/Sitka' ? 'selected' : '' }} value="America/Sitka" >America/Sitka</option>
                                                                    <option {{ $setting->timezone == 'America/St_Barthelemy' ? 'selected' : '' }} value="America/St_Barthelemy" >America/St_Barthelemy</option>
                                                                    <option {{ $setting->timezone == 'America/St_Johns' ? 'selected' : '' }} value="America/St_Johns" >America/St_Johns</option>
                                                                    <option {{ $setting->timezone == 'America/St_Kitts' ? 'selected' : '' }} value="America/St_Kitts" >America/St_Kitts</option>
                                                                    <option {{ $setting->timezone == 'America/St_Lucia' ? 'selected' : '' }} value="America/St_Lucia" >America/St_Lucia</option>
                                                                    <option {{ $setting->timezone == 'America/St_Thomas' ? 'selected' : '' }} value="America/St_Thomas" >America/St_Thomas</option>
                                                                    <option {{ $setting->timezone == 'America/St_Vincent' ? 'selected' : '' }} value="America/St_Vincent" >America/St_Vincent</option>
                                                                    <option {{ $setting->timezone == 'America/Swift_Current' ? 'selected' : '' }} value="America/Swift_Current" >America/Swift_Current</option>
                                                                    <option {{ $setting->timezone == 'America/Tegucigalpa' ? 'selected' : '' }} value="America/Tegucigalpa" >America/Tegucigalpa</option>
                                                                    <option {{ $setting->timezone == 'America/Thule' ? 'selected' : '' }} value="America/Thule" >America/Thule</option>
                                                                    <option {{ $setting->timezone == 'America/Thunder_Bay' ? 'selected' : '' }} value="America/Thunder_Bay" >America/Thunder_Bay</option>
                                                                    <option {{ $setting->timezone == 'America/Tijuana' ? 'selected' : '' }} value="America/Tijuana" >America/Tijuana</option>
                                                                    <option {{ $setting->timezone == 'America/Toronto' ? 'selected' : '' }} value="America/Toronto" >America/Toronto</option>
                                                                    <option {{ $setting->timezone == 'America/Tortola' ? 'selected' : '' }} value="America/Tortola" >America/Tortola</option>
                                                                    <option {{ $setting->timezone == 'America/Vancouver' ? 'selected' : '' }} value="America/Vancouver" >America/Vancouver</option>
                                                                    <option {{ $setting->timezone == 'America/Whitehorse' ? 'selected' : '' }} value="America/Whitehorse" >America/Whitehorse</option>
                                                                    <option {{ $setting->timezone == 'America/Winnipeg' ? 'selected' : '' }} value="America/Winnipeg" >America/Winnipeg</option>
                                                                    <option {{ $setting->timezone == 'America/Yakutat' ? 'selected' : '' }} value="America/Yakutat" >America/Yakutat</option>
                                                                    <option {{ $setting->timezone == 'America/Yellowknife' ? 'selected' : '' }} value="America/Yellowknife" >America/Yellowknife</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Casey' ? 'selected' : '' }} value="Antarctica/Casey" >Antarctica/Casey</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Davis' ? 'selected' : '' }} value="Antarctica/Davis" >Antarctica/Davis</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/DumontDUrville' ? 'selected' : '' }} value="Antarctica/DumontDUrville" >Antarctica/DumontDUrville</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Macquarie' ? 'selected' : '' }} value="Antarctica/Macquarie" >Antarctica/Macquarie</option>


                                                                    <option {{ $setting->timezone == 'Antarctica/Mawson' ? 'selected' : '' }} value="Antarctica/Mawson" >Antarctica/Mawson</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/McMurdo' ? 'selected' : '' }} value="Antarctica/McMurdo" >Antarctica/McMurdo</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Palmer' ? 'selected' : '' }} value="Antarctica/Palmer" >Antarctica/Palmer</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Rothera' ? 'selected' : '' }} value="Antarctica/Rothera" >Antarctica/Rothera</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Syowa' ? 'selected' : '' }} value="Antarctica/Syowa" >Antarctica/Syowa</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Troll' ? 'selected' : '' }} value="Antarctica/Troll" >Antarctica/Troll</option>
                                                                    <option {{ $setting->timezone == 'Antarctica/Vostok' ? 'selected' : '' }} value="Antarctica/Vostok" >Antarctica/Vostok</option>
                                                                    <option {{ $setting->timezone == 'Arctic/Longyearbyen' ? 'selected' : '' }} value="Arctic/Longyearbyen" >Arctic/Longyearbyen</option>
                                                                    <option {{ $setting->timezone == 'Asia/Aden' ? 'selected' : '' }} value="Asia/Aden" >Asia/Aden</option>
                                                                    <option {{ $setting->timezone == 'Asia/Almaty' ? 'selected' : '' }} value="Asia/Almaty" >Asia/Almaty</option>
                                                                    <option {{ $setting->timezone == 'Asia/Amman' ? 'selected' : '' }} value="Asia/Amman" >Asia/Amman</option>
                                                                    <option {{ $setting->timezone == 'Asia/Anadyr' ? 'selected' : '' }} value="Asia/Anadyr" >Asia/Anadyr</option>
                                                                    <option {{ $setting->timezone == 'Asia/Aqtau' ? 'selected' : '' }} value="Asia/Aqtau" >Asia/Aqtau</option>
                                                                    <option {{ $setting->timezone == 'Asia/Aqtobe' ? 'selected' : '' }} value="Asia/Aqtobe" >Asia/Aqtobe</option>
                                                                    <option {{ $setting->timezone == 'Asia/Ashgabat' ? 'selected' : '' }} value="Asia/Ashgabat" >Asia/Ashgabat</option>
                                                                    <option {{ $setting->timezone == 'Asia/Atyrau' ? 'selected' : '' }} value="Asia/Atyrau" >Asia/Atyrau</option>
                                                                    <option {{ $setting->timezone == 'Asia/Baghdad' ? 'selected' : '' }} value="Asia/Baghdad" >Asia/Baghdad</option>
                                                                    <option {{ $setting->timezone == 'Asia/Bahrain' ? 'selected' : '' }} value="Asia/Bahrain" >Asia/Bahrain</option>
                                                                    <option {{ $setting->timezone == 'Asia/Baku' ? 'selected' : '' }} value="Asia/Baku" >Asia/Baku</option>
                                                                    <option {{ $setting->timezone == 'Asia/Bangkok' ? 'selected' : '' }} value="Asia/Bangkok" >Asia/Bangkok</option>
                                                                    <option {{ $setting->timezone == 'Asia/Barnaul' ? 'selected' : '' }} value="Asia/Barnaul" >Asia/Barnaul</option>
                                                                    <option {{ $setting->timezone == 'Asia/Beirut' ? 'selected' : '' }} value="Asia/Beirut" >Asia/Beirut</option>
                                                                    <option {{ $setting->timezone == 'Asia/Bishkek' ? 'selected' : '' }} value="Asia/Bishkek" >Asia/Bishkek</option>
                                                                    <option {{ $setting->timezone == 'Asia/Brunei' ? 'selected' : '' }} value="Asia/Brunei" >Asia/Brunei</option>
                                                                    <option {{ $setting->timezone == 'Asia/Chita' ? 'selected' : '' }} value="Asia/Chita" >Asia/Chita</option>
                                                                    <option {{ $setting->timezone == 'Asia/Choibalsan' ? 'selected' : '' }} value="Asia/Choibalsan" >Asia/Choibalsan</option>
                                                                    <option {{ $setting->timezone == 'Asia/Colombo' ? 'selected' : '' }} value="Asia/Colombo" >Asia/Colombo</option>
                                                                    <option {{ $setting->timezone == 'Asia/Damascus' ? 'selected' : '' }} value="Asia/Damascus" >Asia/Damascus</option>
                                                                    <option {{ $setting->timezone == 'Asia/Dhaka' ? 'selected' : '' }} value="Asia/Dhaka" >Asia/Dhaka</option>
                                                                    <option {{ $setting->timezone == 'Asia/Dili' ? 'selected' : '' }} value="Asia/Dili" >Asia/Dili</option>
                                                                    <option {{ $setting->timezone == 'Asia/Dubai' ? 'selected' : '' }} value="Asia/Dubai" >Asia/Dubai</option>
                                                                    <option {{ $setting->timezone == 'Asia/Dushanbe' ? 'selected' : '' }} value="Asia/Dushanbe" >Asia/Dushanbe</option>
                                                                    <option {{ $setting->timezone == 'Asia/Famagusta' ? 'selected' : '' }} value="Asia/Famagusta" >Asia/Famagusta</option>
                                                                    <option {{ $setting->timezone == 'Asia/Gaza' ? 'selected' : '' }} value="Asia/Gaza" >Asia/Gaza</option>
                                                                    <option {{ $setting->timezone == 'Asia/Hebron' ? 'selected' : '' }} value="Asia/Hebron" >Asia/Hebron</option>
                                                                    <option {{ $setting->timezone == 'Asia/Ho_Chi_Minh' ? 'selected' : '' }} value="Asia/Ho_Chi_Minh" >Asia/Ho_Chi_Minh</option>
                                                                    <option {{ $setting->timezone == 'Asia/Hong_Kong' ? 'selected' : '' }} value="Asia/Hong_Kong" >Asia/Hong_Kong</option>
                                                                    <option {{ $setting->timezone == 'Asia/Hovd' ? 'selected' : '' }} value="Asia/Hovd" >Asia/Hovd</option>
                                                                    <option {{ $setting->timezone == 'Asia/Irkutsk' ? 'selected' : '' }} value="Asia/Irkutsk" >Asia/Irkutsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Jakarta' ? 'selected' : '' }} value="Asia/Jakarta" >Asia/Jakarta</option>
                                                                    <option {{ $setting->timezone == 'Asia/Jayapura' ? 'selected' : '' }} value="Asia/Jayapura" >Asia/Jayapura</option>
                                                                    <option {{ $setting->timezone == 'Asia/Jerusalem' ? 'selected' : '' }} value="Asia/Jerusalem" >Asia/Jerusalem</option>
                                                                    <option {{ $setting->timezone == 'Asia/Kabul' ? 'selected' : '' }} value="Asia/Kabul" >Asia/Kabul</option>
                                                                    <option {{ $setting->timezone == 'Asia/Kamchatka' ? 'selected' : '' }} value="Asia/Kamchatka" >Asia/Kamchatka</option>
                                                                    <option {{ $setting->timezone == 'Asia/Karachi' ? 'selected' : '' }} value="Asia/Karachi" >Asia/Karachi</option>
                                                                    <option {{ $setting->timezone == 'Asia/Kathmandu' ? 'selected' : '' }} value="Asia/Kathmandu" >Asia/Kathmandu</option>
                                                                    <option {{ $setting->timezone == 'Asia/Khandyga' ? 'selected' : '' }} value="Asia/Khandyga" >Asia/Khandyga</option>
                                                                    <option {{ $setting->timezone == 'Asia/Kolkata' ? 'selected' : '' }} value="Asia/Kolkata" >Asia/Kolkata</option>
                                                                    <option {{ $setting->timezone == 'Asia/Krasnoyarsk' ? 'selected' : '' }} value="Asia/Krasnoyarsk" >Asia/Krasnoyarsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Kuala_Lumpur' ? 'selected' : '' }} value="Asia/Kuala_Lumpur" >Asia/Kuala_Lumpur</option>


                                                                    <option {{ $setting->timezone == 'Asia/Kuching' ? 'selected' : '' }} value="Asia/Kuching" >Asia/Kuching</option>
                                                                    <option {{ $setting->timezone == 'Asia/Kuwait' ? 'selected' : '' }} value="Asia/Kuwait" >Asia/Kuwait</option>
                                                                    <option {{ $setting->timezone == 'Asia/Macau' ? 'selected' : '' }} value="Asia/Macau" >Asia/Macau</option>
                                                                    <option {{ $setting->timezone == 'Asia/Magadan' ? 'selected' : '' }} value="Asia/Magadan" >Asia/Magadan</option>
                                                                    <option {{ $setting->timezone == 'Asia/Makassar' ? 'selected' : '' }} value="Asia/Makassar" >Asia/Makassar</option>
                                                                    <option {{ $setting->timezone == 'Asia/Manila' ? 'selected' : '' }} value="Asia/Manila" >Asia/Manila</option>
                                                                    <option {{ $setting->timezone == 'Asia/Muscat' ? 'selected' : '' }} value="Asia/Muscat" >Asia/Muscat</option>
                                                                    <option {{ $setting->timezone == 'Asia/Nicosia' ? 'selected' : '' }} value="Asia/Nicosia" >Asia/Nicosia</option>
                                                                    <option {{ $setting->timezone == 'Asia/Novokuznetsk' ? 'selected' : '' }} value="Asia/Novokuznetsk" >Asia/Novokuznetsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Novosibirsk' ? 'selected' : '' }} value="Asia/Novosibirsk" >Asia/Novosibirsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Omsk' ? 'selected' : '' }} value="Asia/Omsk" >Asia/Omsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Oral' ? 'selected' : '' }} value="Asia/Oral" >Asia/Oral</option>
                                                                    <option {{ $setting->timezone == 'Asia/Phnom_Penh' ? 'selected' : '' }} value="Asia/Phnom_Penh" >Asia/Phnom_Penh</option>
                                                                    <option {{ $setting->timezone == 'Asia/Pontianak' ? 'selected' : '' }} value="Asia/Pontianak" >Asia/Pontianak</option>
                                                                    <option {{ $setting->timezone == 'Asia/Pyongyang' ? 'selected' : '' }} value="Asia/Pyongyang" >Asia/Pyongyang</option>
                                                                    <option {{ $setting->timezone == 'Asia/Qatar' ? 'selected' : '' }} value="Asia/Qatar" >Asia/Qatar</option>
                                                                    <option {{ $setting->timezone == 'Asia/Qostanay' ? 'selected' : '' }} value="Asia/Qostanay" >Asia/Qostanay</option>
                                                                    <option {{ $setting->timezone == 'Asia/Qyzylorda' ? 'selected' : '' }} value="Asia/Qyzylorda" >Asia/Qyzylorda</option>
                                                                    <option {{ $setting->timezone == 'Asia/Riyadh' ? 'selected' : '' }} value="Asia/Riyadh" >Asia/Riyadh</option>
                                                                    <option {{ $setting->timezone == 'Asia/Sakhalin' ? 'selected' : '' }} value="Asia/Sakhalin" >Asia/Sakhalin</option>
                                                                    <option {{ $setting->timezone == 'Asia/Samarkand' ? 'selected' : '' }} value="Asia/Samarkand" >Asia/Samarkand</option>
                                                                    <option {{ $setting->timezone == 'Asia/Seoul' ? 'selected' : '' }} value="Asia/Seoul" >Asia/Seoul</option>
                                                                    <option {{ $setting->timezone == 'Asia/Shanghai' ? 'selected' : '' }} value="Asia/Shanghai" >Asia/Shanghai</option>
                                                                    <option {{ $setting->timezone == 'Asia/Singapore' ? 'selected' : '' }} value="Asia/Singapore" >Asia/Singapore</option>
                                                                    <option {{ $setting->timezone == 'Asia/Srednekolymsk' ? 'selected' : '' }} value="Asia/Srednekolymsk" >Asia/Srednekolymsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Taipei' ? 'selected' : '' }} value="Asia/Taipei" >Asia/Taipei</option>
                                                                    <option {{ $setting->timezone == 'Asia/Tashkent' ? 'selected' : '' }} value="Asia/Tashkent" >Asia/Tashkent</option>
                                                                    <option {{ $setting->timezone == 'Asia/Tbilisi' ? 'selected' : '' }} value="Asia/Tbilisi" >Asia/Tbilisi</option>
                                                                    <option {{ $setting->timezone == 'Asia/Tehran' ? 'selected' : '' }} value="Asia/Tehran" >Asia/Tehran</option>
                                                                    <option {{ $setting->timezone == 'Asia/Thimphu' ? 'selected' : '' }} value="Asia/Thimphu" >Asia/Thimphu</option>
                                                                    <option {{ $setting->timezone == 'Asia/Tokyo' ? 'selected' : '' }} value="Asia/Tokyo" >Asia/Tokyo</option>


                                                                    <option {{ $setting->timezone == 'Asia/Tomsk' ? 'selected' : '' }} value="Asia/Tomsk" >Asia/Tomsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Ulaanbaatar' ? 'selected' : '' }}  value="Asia/Ulaanbaatar" >Asia/Ulaanbaatar</option>
                                                                    <option {{ $setting->timezone == 'Asia/Urumqi' ? 'selected' : '' }}  value="Asia/Urumqi" >Asia/Urumqi</option>
                                                                    <option {{ $setting->timezone == 'Asia/Ust-Nera' ? 'selected' : '' }}  value="Asia/Ust-Nera" >Asia/Ust-Nera</option>
                                                                    <option {{ $setting->timezone == 'Asia/Vientiane' ? 'selected' : '' }}  value="Asia/Vientiane" >Asia/Vientiane</option>
                                                                    <option {{ $setting->timezone == 'Asia/Vladivostok' ? 'selected' : '' }}  value="Asia/Vladivostok" >Asia/Vladivostok</option>
                                                                    <option {{ $setting->timezone == 'Asia/Yakutsk' ? 'selected' : '' }}  value="Asia/Yakutsk" >Asia/Yakutsk</option>
                                                                    <option {{ $setting->timezone == 'Asia/Yangon' ? 'selected' : '' }}  value="Asia/Yangon" >Asia/Yangon</option>
                                                                    <option {{ $setting->timezone == 'Asia/Yekaterinburg' ? 'selected' : '' }}  value="Asia/Yekaterinburg" >Asia/Yekaterinburg</option>
                                                                    <option {{ $setting->timezone == 'Asia/Yerevan' ? 'selected' : '' }}  value="Asia/Yerevan" >Asia/Yerevan</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Azores' ? 'selected' : '' }}  value="Atlantic/Azores" >Atlantic/Azores</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Bermuda' ? 'selected' : '' }}  value="Atlantic/Bermuda" >Atlantic/Bermuda</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Canary' ? 'selected' : '' }}  value="Atlantic/Canary" >Atlantic/Canary</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Cape_Verde' ? 'selected' : '' }}  value="Atlantic/Cape_Verde" >Atlantic/Cape_Verde</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Faroe' ? 'selected' : '' }}  value="Atlantic/Faroe" >Atlantic/Faroe</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Madeira' ? 'selected' : '' }}  value="Atlantic/Madeira" >Atlantic/Madeira</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Reykjavik' ? 'selected' : '' }}  value="Atlantic/Reykjavik" >Atlantic/Reykjavik</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/South_Georgia' ? 'selected' : '' }}  value="Atlantic/South_Georgia" >Atlantic/South_Georgia</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/St_Helena' ? 'selected' : '' }}  value="Atlantic/St_Helena" >Atlantic/St_Helena</option>
                                                                    <option {{ $setting->timezone == 'Atlantic/Stanley' ? 'selected' : '' }}  value="Atlantic/Stanley" >Atlantic/Stanley</option>
                                                                    <option {{ $setting->timezone == 'Australia/Adelaide' ? 'selected' : '' }}  value="Australia/Adelaide" >Australia/Adelaide</option>
                                                                    <option {{ $setting->timezone == 'Australia/Brisbane' ? 'selected' : '' }}  value="Australia/Brisbane" >Australia/Brisbane</option>
                                                                    <option {{ $setting->timezone == 'Australia/Broken_Hill' ? 'selected' : '' }}  value="Australia/Broken_Hill" >Australia/Broken_Hill</option>
                                                                    <option {{ $setting->timezone == 'Australia/Darwin' ? 'selected' : '' }}  value="Australia/Darwin" >Australia/Darwin</option>
                                                                    <option {{ $setting->timezone == 'Australia/Eucla' ? 'selected' : '' }}  value="Australia/Eucla" >Australia/Eucla</option>
                                                                    <option {{ $setting->timezone == 'Australia/Hobart' ? 'selected' : '' }}  value="Australia/Hobart" >Australia/Hobart</option>
                                                                    <option {{ $setting->timezone == 'Australia/Lindeman' ? 'selected' : '' }}  value="Australia/Lindeman" >Australia/Lindeman</option>
                                                                    <option {{ $setting->timezone == 'Australia/Lord_Howe' ? 'selected' : '' }}  value="Australia/Lord_Howe" >Australia/Lord_Howe</option>
                                                                    <option {{ $setting->timezone == 'Australia/Melbourne' ? 'selected' : '' }}  value="Australia/Melbourne" >Australia/Melbourne</option>
                                                                    <option {{ $setting->timezone == 'Australia/Perth' ? 'selected' : '' }}  value="Australia/Perth" >Australia/Perth</option>

                                                                    <option {{ $setting->timezone == 'Australia/Sydney' ? 'selected' : '' }} value="Australia/Sydney" >Australia/Sydney</option>
                                                                    <option {{ $setting->timezone == 'Europe/Amsterdam' ? 'selected' : '' }} value="Europe/Amsterdam" >Europe/Amsterdam</option>
                                                                    <option {{ $setting->timezone == 'Europe/Andorra' ? 'selected' : '' }} value="Europe/Andorra" >Europe/Andorra</option>
                                                                    <option {{ $setting->timezone == 'Europe/Astrakhan' ? 'selected' : '' }} value="Europe/Astrakhan" >Europe/Astrakhan</option>
                                                                    <option {{ $setting->timezone == 'Europe/Athens' ? 'selected' : '' }} value="Europe/Athens" >Europe/Athens</option>
                                                                    <option {{ $setting->timezone == 'Europe/Belgrade' ? 'selected' : '' }} value="Europe/Belgrade" >Europe/Belgrade</option>
                                                                    <option {{ $setting->timezone == 'Europe/Berlin' ? 'selected' : '' }} value="Europe/Berlin" >Europe/Berlin</option>
                                                                    <option {{ $setting->timezone == 'Europe/Bratislava' ? 'selected' : '' }} value="Europe/Bratislava" >Europe/Bratislava</option>
                                                                    <option {{ $setting->timezone == 'Europe/Brussels' ? 'selected' : '' }} value="Europe/Brussels" >Europe/Brussels</option>
                                                                    <option {{ $setting->timezone == 'Europe/Bucharest' ? 'selected' : '' }} value="Europe/Bucharest" >Europe/Bucharest</option>
                                                                    <option {{ $setting->timezone == 'Europe/Budapest' ? 'selected' : '' }} value="Europe/Budapest" >Europe/Budapest</option>
                                                                    <option {{ $setting->timezone == 'Europe/Busingen' ? 'selected' : '' }} value="Europe/Busingen" >Europe/Busingen</option>
                                                                    <option {{ $setting->timezone == 'Europe/Chisinau' ? 'selected' : '' }} value="Europe/Chisinau" >Europe/Chisinau</option>
                                                                    <option {{ $setting->timezone == 'Europe/Copenhagen' ? 'selected' : '' }} value="Europe/Copenhagen" >Europe/Copenhagen</option>
                                                                    <option {{ $setting->timezone == 'Europe/Dublin' ? 'selected' : '' }} value="Europe/Dublin" >Europe/Dublin</option>
                                                                    <option {{ $setting->timezone == 'Europe/Gibraltar' ? 'selected' : '' }} value="Europe/Gibraltar" >Europe/Gibraltar</option>
                                                                    <option {{ $setting->timezone == 'Europe/Guernsey' ? 'selected' : '' }} value="Europe/Guernsey" >Europe/Guernsey</option>
                                                                    <option {{ $setting->timezone == 'Europe/Helsinki' ? 'selected' : '' }} value="Europe/Helsinki" >Europe/Helsinki</option>
                                                                    <option {{ $setting->timezone == 'Europe/Isle_of_Man' ? 'selected' : '' }} value="Europe/Isle_of_Man" >Europe/Isle_of_Man</option>
                                                                    <option {{ $setting->timezone == 'Europe/Istanbul' ? 'selected' : '' }} value="Europe/Istanbul" >Europe/Istanbul</option>
                                                                    <option {{ $setting->timezone == 'Europe/Jersey' ? 'selected' : '' }} value="Europe/Jersey" >Europe/Jersey</option>
                                                                    <option {{ $setting->timezone == 'Europe/Kaliningrad' ? 'selected' : '' }} value="Europe/Kaliningrad" >Europe/Kaliningrad</option>
                                                                    <option {{ $setting->timezone == 'Europe/Kiev' ? 'selected' : '' }} value="Europe/Kiev" >Europe/Kiev</option>
                                                                    <option {{ $setting->timezone == 'Europe/Kirov' ? 'selected' : '' }} value="Europe/Kirov" >Europe/Kirov</option>
                                                                    <option {{ $setting->timezone == 'Europe/Lisbon' ? 'selected' : '' }} value="Europe/Lisbon" >Europe/Lisbon</option>
                                                                    <option {{ $setting->timezone == 'Europe/Ljubljana' ? 'selected' : '' }} value="Europe/Ljubljana" >Europe/Ljubljana</option>
                                                                    <option {{ $setting->timezone == 'Europe/London' ? 'selected' : '' }} value="Europe/London" >Europe/London</option>
                                                                    <option {{ $setting->timezone == 'Europe/Luxembourg' ? 'selected' : '' }} value="Europe/Luxembourg" >Europe/Luxembourg</option>
                                                                    <option {{ $setting->timezone == 'Europe/Madrid' ? 'selected' : '' }} value="Europe/Madrid" >Europe/Madrid</option>
                                                                    <option {{ $setting->timezone == 'Europe/Malta' ? 'selected' : '' }} value="Europe/Malta" >Europe/Malta</option>
                                                                    <option {{ $setting->timezone == 'Europe/Mariehamn' ? 'selected' : '' }} value="Europe/Mariehamn" >Europe/Mariehamn</option>

                                                                    <option {{ $setting->timezone == 'Europe/Minsk' ? 'selected' : '' }} value="Europe/Minsk" >Europe/Minsk</option>
                                                                    <option {{ $setting->timezone == 'Europe/Monaco' ? 'selected' : '' }} value="Europe/Monaco" >Europe/Monaco</option>
                                                                    <option {{ $setting->timezone == 'Europe/Moscow' ? 'selected' : '' }} value="Europe/Moscow" >Europe/Moscow</option>
                                                                    <option {{ $setting->timezone == 'Europe/Oslo' ? 'selected' : '' }} value="Europe/Oslo" >Europe/Oslo</option>
                                                                    <option {{ $setting->timezone == 'Europe/Paris' ? 'selected' : '' }} value="Europe/Paris" >Europe/Paris</option>
                                                                    <option {{ $setting->timezone == 'Europe/Podgorica' ? 'selected' : '' }} value="Europe/Podgorica" >Europe/Podgorica</option>
                                                                    <option {{ $setting->timezone == 'Europe/Prague' ? 'selected' : '' }} value="Europe/Prague" >Europe/Prague</option>
                                                                    <option {{ $setting->timezone == 'Europe/Riga' ? 'selected' : '' }} value="Europe/Riga" >Europe/Riga</option>
                                                                    <option {{ $setting->timezone == 'Europe/Rome' ? 'selected' : '' }} value="Europe/Rome" >Europe/Rome</option>
                                                                    <option {{ $setting->timezone == 'Europe/Samara' ? 'selected' : '' }} value="Europe/Samara" >Europe/Samara</option>
                                                                    <option {{ $setting->timezone == 'Europe/San_Marino' ? 'selected' : '' }} value="Europe/San_Marino" >Europe/San_Marino</option>
                                                                    <option {{ $setting->timezone == 'Europe/Sarajevo' ? 'selected' : '' }} value="Europe/Sarajevo" >Europe/Sarajevo</option>
                                                                    <option {{ $setting->timezone == 'Europe/Saratov' ? 'selected' : '' }} value="Europe/Saratov" >Europe/Saratov</option>
                                                                    <option {{ $setting->timezone == 'Europe/Simferopol' ? 'selected' : '' }} value="Europe/Simferopol" >Europe/Simferopol</option>
                                                                    <option {{ $setting->timezone == 'Europe/Skopje' ? 'selected' : '' }} value="Europe/Skopje" >Europe/Skopje</option>
                                                                    <option {{ $setting->timezone == 'Europe/Sofia' ? 'selected' : '' }} value="Europe/Sofia" >Europe/Sofia</option>
                                                                    <option {{ $setting->timezone == 'Europe/Stockholm' ? 'selected' : '' }} value="Europe/Stockholm" >Europe/Stockholm</option>
                                                                    <option {{ $setting->timezone == 'Europe/Tallinn' ? 'selected' : '' }} value="Europe/Tallinn" >Europe/Tallinn</option>
                                                                    <option {{ $setting->timezone == 'Europe/Tirane' ? 'selected' : '' }} value="Europe/Tirane" >Europe/Tirane</option>
                                                                    <option {{ $setting->timezone == 'Europe/Ulyanovsk' ? 'selected' : '' }} value="Europe/Ulyanovsk" >Europe/Ulyanovsk</option>
                                                                    <option {{ $setting->timezone == 'Europe/Uzhgorod' ? 'selected' : '' }} value="Europe/Uzhgorod" >Europe/Uzhgorod</option>
                                                                    <option {{ $setting->timezone == 'Europe/Vaduz' ? 'selected' : '' }} value="Europe/Vaduz" >Europe/Vaduz</option>
                                                                    <option {{ $setting->timezone == 'Europe/Vatican' ? 'selected' : '' }} value="Europe/Vatican" >Europe/Vatican</option>
                                                                    <option {{ $setting->timezone == 'Europe/Vienna' ? 'selected' : '' }} value="Europe/Vienna" >Europe/Vienna</option>
                                                                    <option {{ $setting->timezone == 'Europe/Vilnius' ? 'selected' : '' }} value="Europe/Vilnius" >Europe/Vilnius</option>
                                                                    <option {{ $setting->timezone == 'Europe/Volgograd' ? 'selected' : '' }} value="Europe/Volgograd" >Europe/Volgograd</option>
                                                                    <option {{ $setting->timezone == 'Europe/Warsaw' ? 'selected' : '' }} value="Europe/Warsaw" >Europe/Warsaw</option>
                                                                    <option {{ $setting->timezone == 'Europe/Zagreb' ? 'selected' : '' }} value="Europe/Zagreb" >Europe/Zagreb</option>
                                                                    <option {{ $setting->timezone == 'Europe/Zaporozhye' ? 'selected' : '' }} value="Europe/Zaporozhye" >Europe/Zaporozhye</option>
                                                                    <option {{ $setting->timezone == 'Europe/Zurich' ? 'selected' : '' }} value="Europe/Zurich" >Europe/Zurich</option>
                                                                    <option {{ $setting->timezone == 'Indian/Antananarivo' ? 'selected' : '' }} value="Indian/Antananarivo" >Indian/Antananarivo</option>
                                                                    <option {{ $setting->timezone == 'Indian/Chagos' ? 'selected' : '' }} value="Indian/Chagos" >Indian/Chagos</option>

                                                                    <option  {{ $setting->timezone == 'Indian/Christmas' ? 'selected' : '' }} value="Indian/Christmas" >Indian/Christmas</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Cocos' ? 'selected' : '' }} value="Indian/Cocos" >Indian/Cocos</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Comoro' ? 'selected' : '' }} value="Indian/Comoro" >Indian/Comoro</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Kerguelen' ? 'selected' : '' }} value="Indian/Kerguelen" >Indian/Kerguelen</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Mahe' ? 'selected' : '' }} value="Indian/Mahe" >Indian/Mahe</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Maldives' ? 'selected' : '' }} value="Indian/Maldives" >Indian/Maldives</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Mauritius' ? 'selected' : '' }} value="Indian/Mauritius" >Indian/Mauritius</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Mayotte' ? 'selected' : '' }} value="Indian/Mayotte" >Indian/Mayotte</option>
                                                                    <option  {{ $setting->timezone == 'Indian/Reunion' ? 'selected' : '' }} value="Indian/Reunion" >Indian/Reunion</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Apia' ? 'selected' : '' }} value="Pacific/Apia" >Pacific/Apia</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Auckland' ? 'selected' : '' }} value="Pacific/Auckland" >Pacific/Auckland</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Bougainville' ? 'selected' : '' }} value="Pacific/Bougainville" >Pacific/Bougainville</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Chatham' ? 'selected' : '' }} value="Pacific/Chatham" >Pacific/Chatham</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Chuuk' ? 'selected' : '' }} value="Pacific/Chuuk" >Pacific/Chuuk</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Easter' ? 'selected' : '' }} value="Pacific/Easter" >Pacific/Easter</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Efate' ? 'selected' : '' }} value="Pacific/Efate" >Pacific/Efate</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Enderbury' ? 'selected' : '' }} value="Pacific/Enderbury" >Pacific/Enderbury</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Fakaofo' ? 'selected' : '' }} value="Pacific/Fakaofo" >Pacific/Fakaofo</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Fiji' ? 'selected' : '' }} value="Pacific/Fiji" >Pacific/Fiji</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Funafuti' ? 'selected' : '' }} value="Pacific/Funafuti" >Pacific/Funafuti</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Galapagos' ? 'selected' : '' }} value="Pacific/Galapagos" >Pacific/Galapagos</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Gambier' ? 'selected' : '' }} value="Pacific/Gambier" >Pacific/Gambier</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Guadalcanal' ? 'selected' : '' }} value="Pacific/Guadalcanal" >Pacific/Guadalcanal</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Guam' ? 'selected' : '' }} value="Pacific/Guam" >Pacific/Guam</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Honolulu' ? 'selected' : '' }} value="Pacific/Honolulu" >Pacific/Honolulu</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Kiritimati' ? 'selected' : '' }} value="Pacific/Kiritimati" >Pacific/Kiritimati</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Kosrae' ? 'selected' : '' }} value="Pacific/Kosrae" >Pacific/Kosrae</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Kwajalein' ? 'selected' : '' }} value="Pacific/Kwajalein" >Pacific/Kwajalein</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Majuro' ? 'selected' : '' }} value="Pacific/Majuro" >Pacific/Majuro</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Marquesas' ? 'selected' : '' }} value="Pacific/Marquesas" >Pacific/Marquesas</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Midway' ? 'selected' : '' }} value="Pacific/Midway" >Pacific/Midway</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Nauru' ? 'selected' : '' }} value="Pacific/Nauru" >Pacific/Nauru</option>
                                                                    <option  {{ $setting->timezone == 'IPacific/Niue' ? 'selected' : '' }} value="Pacific/Niue" >Pacific/Niue</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Norfolk' ? 'selected' : '' }} value="Pacific/Norfolk" >Pacific/Norfolk</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Noumea' ? 'selected' : '' }} value="Pacific/Noumea" >Pacific/Noumea</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Pago_Pago' ? 'selected' : '' }} value="Pacific/Pago_Pago" >Pacific/Pago_Pago</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Palau' ? 'selected' : '' }} value="Pacific/Palau" >Pacific/Palau</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Pitcairn' ? 'selected' : '' }} value="Pacific/Pitcairn" >Pacific/Pitcairn</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Pohnpei' ? 'selected' : '' }} value="Pacific/Pohnpei" >Pacific/Pohnpei</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Port_Moresby' ? 'selected' : '' }} value="Pacific/Port_Moresby" >Pacific/Port_Moresby</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Rarotonga' ? 'selected' : '' }} value="Pacific/Rarotonga" >Pacific/Rarotonga</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Saipan' ? 'selected' : '' }} value="Pacific/Saipan" >Pacific/Saipan</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Tahiti' ? 'selected' : '' }} value="Pacific/Tahiti" >Pacific/Tahiti</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Tarawa' ? 'selected' : '' }} value="Pacific/Tarawa" >Pacific/Tarawa</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Tongatapu' ? 'selected' : '' }} value="Pacific/Tongatapu" >Pacific/Tongatapu</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Wake' ? 'selected' : '' }} value="Pacific/Wake" >Pacific/Wake</option>
                                                                    <option  {{ $setting->timezone == 'Pacific/Wallis' ? 'selected' : '' }} value="Pacific/Wallis" >Pacific/Wallis</option>
                                                                    <option  {{ $setting->timezone == 'UTC' ? 'selected' : '' }} value="UTC" >UTC</option>
                                                                </select>
                                                            </div>

                                                          <button class="btn btn-primary" type="submit">{{__('admin.Update')}}</button>

                                                      </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="logoTab" role="tabpanel" aria-labelledby="logo-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-logo-favicon') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Existing Logo')}}</label>
                                                                <div>
                                                                    <img src="{{ asset($setting->logo) }}" alt="" width="200px">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.New Logo')}}</label>
                                                                <input type="file" name="logo" class="form-control-file">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Footer Logo')}}</label>
                                                                <div>
                                                                    <img src="{{ asset($setting->footer_logo) }}" alt="" width="200px">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.New Logo')}}</label>
                                                                <input type="file" name="footer_logo" class="form-control-file">
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Existing Favicon')}}</label>
                                                                <div>
                                                                    <img src="{{ asset($setting->favicon) }}" alt="" width="50px">
                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="">{{__('admin.New Favicon')}}</label>
                                                                <input type="file" name="favicon" class="form-control-file">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="themeColorTab" role="tabpanel" aria-labelledby="themeColor-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-theme-color') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            @if ($selected_theme == 0 || $selected_theme == 1)
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Theme One Color')}}</label>
                                                                <input type="color" class="form-control" name="theme_one_color" value="{{ $setting->theme_one_color }}">
                                                            </div>
                                                            @endif

                                                            @if ($selected_theme == 0 || $selected_theme == 2)

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Theme Two Color')}}</label>
                                                                <input type="color" class="form-control" name="theme_two_color" value="{{ $setting->theme_two_color }}">
                                                            </div>
                                                            @endif

                                                            @if ($selected_theme == 0 || $selected_theme == 3)

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Theme Three Color')}}</label>
                                                                <input type="color" class="form-control" name="theme_three_color" value="{{ $setting->theme_three_color }}">
                                                            </div>
                                                            @endif

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="tab-pane fade" id="cookieTab" role="tabpanel" aria-labelledby="cookie-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-cookie-consent') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Allow Cookie Consent')}}</label>
                                                                        <select name="allow" id="" class="form-control">
                                                                            <option {{ $cookieConsent->status==1 ? 'selected':'' }} value="1">{{__('admin.Enable')}}</option>
                                                                            <option {{ $cookieConsent->status==0 ? 'selected':'' }} value="0">{{__('admin.Disable')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Border')}}</label>
                                                                        <select name="border" id="" class="form-control">
                                                                            <option {{ $cookieConsent->border=='none' ? 'selected':'' }} value="none">{{__('admin.None')}}</option>
                                                                            <option {{ $cookieConsent->border=='thin' ? 'selected':'' }} value="thin">{{__('admin.Thin')}}</option>
                                                                            <option {{ $cookieConsent->border=='normal' ? 'selected':'' }} value="normal">{{__('admin.Normal')}}</option>
                                                                            <option {{ $cookieConsent->border=='thick' ? 'selected':'' }} value="thick">{{__('admin.Thick')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Corner')}}</label>
                                                                        <select name="corners" id="" class="form-control">
                                                                            <option {{ $cookieConsent->corners=='none' ? 'selected':'' }} value="none">{{__('admin.none')}}</option>
                                                                            <option {{ $cookieConsent->corners=='small' ? 'selected':'' }} value="small">{{__('admin.Small')}}</option>
                                                                            <option {{ $cookieConsent->corners=='normal' ? 'selected':'' }} value="normal">{{__('admin.Normall')}}</option>
                                                                            <option {{ $cookieConsent->corners=='large' ? 'selected':'' }} value="large">{{__('admin.Large')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="bg_color">{{__('admin.Background Color')}}</label>
                                                                        <input class="form-control" type="color" name="background_color" id="bg_color" value="{{ $cookieConsent->background_color }}">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="text_color">{{__('admin.Text Color')}}</label>
                                                                        <input class="form-control" type="color" name="text_color" id="text_color" value="{{ $cookieConsent->text_color }}">
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="border_color">{{__('admin.Border Color')}}</label>
                                                                        <input class="form-control" type="color" name="border_color" id="border_color" value="{{ $cookieConsent->border_color }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="btn_bg_color">{{__('admin.Button Color')}}</label>
                                                                        <input class="form-control" type="color" name="button_color" id="btn_bg_color" value="{{ $cookieConsent->btn_bg_color }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="btn_text_color">{{__('admin.Button Text Color')}}</label>
                                                                        <input class="form-control" type="color" name="btn_text_color" id="btn_text_color" value="{{ $cookieConsent->btn_text_color }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Link Text')}}</label>
                                                                        <input type="text" name="link_text" value="{{ $cookieConsent->link_text }}" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Button Text')}}</label>
                                                                        <input type="text" name="btn_text" value="{{ $cookieConsent->btn_text }}" class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cookie_text">{{__('admin.Message')}}</label>
                                                                <textarea class="form-control text-area-5" name="message" id="cookie_text" cols="30" rows="5">{{ $cookieConsent->message }}</textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="recaptchaTab" role="tabpanel" aria-labelledby="recaptcha-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-google-recaptcha') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Recaptcha')}}</label>
                                                                <select name="allow" id="allow" class="form-control">
                                                                    <option {{ $googleRecaptcha->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                    <option {{ $googleRecaptcha->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Captcha Site Key')}}</label>
                                                                <input type="text" class="form-control" name="site_key" value="{{ $googleRecaptcha->site_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Captcha Secret Key')}}</label>
                                                                <input type="text" class="form-control" name="secret_key" value="{{ $googleRecaptcha->secret_key }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pusherTab" role="tabpanel" aria-labelledby="pusher-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-pusher') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.App Id')}}</label>
                                                                <input type="text" class="form-control" name="app_id" value="{{ $pusher->app_id }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.App Key')}}</label>
                                                                <input type="text" class="form-control" name="app_key" value="{{ $pusher->app_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.App Secret')}}</label>
                                                                <input type="text" class="form-control" name="app_secret" value="{{ $pusher->app_secret }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.App Cluster')}}</label>
                                                                <input type="text" class="form-control" name="app_cluster" value="{{ $pusher->app_cluster }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="tab-pane fade" id="blogCommentTab" role="tabpanel" aria-labelledby="blog-comment-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-facebook-comment') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Blog Comment Type')}}</label>
                                                                <select name="comment_type" id="comment_type" class="form-control">
                                                                    <option {{ $facebookComment->comment_type == 1 ? 'selected' : '' }} value="1">{{__('admin.Manual Comment')}}</option>
                                                                    <option {{ $facebookComment->comment_type == 0 ? 'selected' : '' }} value="0">{{__('admin.Facebook Comment')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Facebook App Id')}}</label>
                                                                <input type="text" class="form-control" name="app_id" value="{{ $facebookComment->app_id }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="tawkChatTab" role="tabpanel" aria-labelledby="tawk-chat-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-tawk-chat') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Live Chat')}}</label>
                                                                <select name="allow" id="tawk_allow" class="form-control">
                                                                    <option {{ $tawkChat->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                    <option {{ $tawkChat->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Tawk Chat Link')}}</label>
                                                                <input type="text" class="form-control" name="chat_link" value="{{ $tawkChat->chat_link }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="googleAnalyticTab" role="tabpanel" aria-labelledby="google-analytic-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-google-analytic') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Google Analytic')}}</label>
                                                                <select name="allow" id="tawk_allow" class="form-control">
                                                                    <option {{ $googleAnalytic->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                    <option {{ $googleAnalytic->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Analytic Tracking Id')}}</label>
                                                                <input type="text" class="form-control" name="analytic_id" value="{{ $googleAnalytic->analytic_id }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="customPaginationTab" role="tabpanel" aria-labelledby="custom-pagination-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-custom-pagination') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="50%">{{__('admin.Section Name')}}</th>
                                                                        <th width="50%">{{__('admin.Quantity')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($customPaginations as $customPagination)
                                                                    <tr>
                                                                        <td>{{ $customPagination->page_name }}</td>
                                                                        <td>
                                                                            <input type="number" value="{{ $customPagination->qty }}" name="quantities[]" class="form-control">
                                                                            <input type="hidden" value="{{ $customPagination->id }}" name="ids[]">
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>


                                                            </table>
                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="socialLoginTab" role="tabpanel" aria-labelledby="social-login-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-social-login') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Login with Facebook')}}</label>
                                                                <div>
                                                                    @if ($socialLogin->is_facebook == 1)
                                                                        <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_login">
                                                                    @else
                                                                        <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_login">
                                                                    @endif

                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Facebook App Id')}}</label>
                                                                <input type="text" value="{{ $socialLogin->facebook_client_id }}" class="form-control" name="facebook_app_id">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Facebook App Secret')}}</label>
                                                                <input type="text" value="{{ $socialLogin->facebook_secret_id }}" class="form-control" name="facebook_app_secret">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Facebook Redirect Url')}}</label>
                                                                <input type="text" value="{{ $socialLogin->facebook_redirect_url}}" class="form-control" name="facebook_redirect_url">
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Login with Gmail')}}</label>
                                                                <div>
                                                                    @if ($socialLogin->is_gmail == 1)
                                                                    <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_gmail_login">
                                                                    @else
                                                                    <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_gmail_login">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Gmail Client Id')}}</label>
                                                                <input type="text" value="{{ $socialLogin->gmail_client_id }}" class="form-control" name="gmail_client_id">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Gmail Secret Id')}}</label>
                                                                <input type="text" value="{{ $socialLogin->gmail_secret_id }}" class="form-control" name="gmail_secret_id">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Gmail Redirect Url')}}</label>
                                                                <input type="text" value="{{ $socialLogin->gmail_redirect_url }}" class="form-control" name="gmail_redirect_url">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="facebookPixelTab" role="tabpanel" aria-labelledby="facebook-pixel-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-facebook-pixel') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Facebook Pixel')}}</label>
                                                                <div>
                                                                    @if ($facebookPixel->status == 1)
                                                                    <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_pixel">
                                                                    @else
                                                                    <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_facebook_pixel">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Facebook App Id')}}</label>
                                                                <input type="text" value="{{ $facebookPixel->app_id }}" class="form-control" name="app_id">
                                                            </div>
                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="databaseGenerateTab" role="tabpanel" aria-labelledby="database-generate-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-database') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="alert alert-warning" role="alert">
                                                              <p>{{__('This feature not a regular feature, this will be use for version update. You can not trigger the button as your mind. When need to trigger the button we will mention on our version documentation')}}</p>
                                                            </div>
                                                            <button class="btn btn-primary">{{__('admin.Update Database')}}</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </section>
      </div>
@endsection
