@php
    $setting = App\Models\Setting::first();
@endphp


<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_sm_header }}</a>
      </div>
      <ul class="sidebar-menu">
          <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> <span>{{__('admin.Dashboard')}}</span></a></li>

          <li class="nav-item dropdown {{ Route::is('admin.all-booking') || Route::is('admin.booking-show') || Route::is('admin.awaiting-booking') || Route::is('admin.complete-request') || Route::is('admin.active-booking') || Route::is('admin.completed-booking') || Route::is('admin.declined-booking')  ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>{{__('admin.All Bookings')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.all-booking') || Route::is('admin.booking-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.all-booking') }}">{{__('admin.All Bookings')}}</a></li>

                <li class="{{ Route::is('admin.awaiting-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.awaiting-booking') }}">{{__('admin.Awaiting Approval')}}</a></li>

                <li class="{{ Route::is('admin.active-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.active-booking') }}">{{__('admin.Active Bookings')}}</a></li>

                <li class="{{ Route::is('admin.completed-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.completed-booking') }}">{{__('admin.Completed Bookings')}}</a></li>

                <li class="{{ Route::is('admin.complete-request') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.complete-request') }}">{{__('admin.Complete Request')}}</a></li>
                <li class="{{ Route::is('admin.declined-booking') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.declined-booking') }}">{{__('admin.Declined Bookings')}}</a></li>

              </ul>
            </li>
          </li>

          @if ($setting->commission_type == 'subscription')

            @php
                $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                $module_status = json_decode($json_module_data);
            @endphp

            <li class="nav-item dropdown {{ Route::is('admin.subscription-plan.*') || Route::is('admin.purchase-history') || Route::is('admin.assign-plan') || Route::is('admin.purchase-history-show') || Route::is('admin.pending-plan-payment') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>{{__('admin.Subscription')}}
                    @if (env('APP_VERSION') == 'demo')
                    <span class="badge badge-danger addon_text">{{__('Addon')}}</span>
                    @endif
                </span>

                </a>
                <ul class="dropdown-menu">
                    <li class="{{  Route::is('admin.subscription-plan.*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.subscription-plan.index')}}">{{__('admin.Subscription Plan')}}</a></li>

                    <li class="{{ Route::is('admin.purchase-history') || Route::is('admin.purchase-history-show') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.purchase-history')}}">{{__('admin.Purchase History')}}</a></li>

                    <li class="{{ Route::is('admin.pending-plan-payment') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.pending-plan-payment')}}">{{__('admin.Pending Payment')}}</a></li>

                    <li {{ Route::is('admin.assign-plan') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.assign-plan')}}">{{__('admin.Assign Plan')}}</a></li>

                </ul>
            </li>

        @endif

          <li class="nav-item dropdown {{ Route::is('admin.service.*') || Route::is('admin.awaiting-for-approval-service') || Route::is('admin.active-service') ||  Route::is('admin.banned-service') || Route::is('admin.review-list') || Route::is('admin.show-review') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Manage Services')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.service.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.service.index') }}">{{__('admin.All Service')}}</a></li>

                <li class="{{ Route::is('admin.awaiting-for-approval-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.awaiting-for-approval-service') }}">{{__('admin.Awaiting for Approval')}}</a></li>

                <li class="{{ Route::is('admin.active-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.active-service') }}">{{__('admin.Active Service')}}</a></li>

                <li class="{{ Route::is('admin.banned-service') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.banned-service') }}">{{__('admin.Banned Service')}}</a></li>


                <li class="{{ Route::is('admin.review-list') || Route::is('admin.show-review') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.review-list') }}">{{__('admin.Service Review')}}</a></li>


            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.coupon.*') || Route::is('admin.coupon-history') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('user.Manage Coupon')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.coupon.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.coupon.index') }}">{{__('Coupon')}}</a></li>

                <li class="{{ Route::is('admin.coupon-history') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.coupon-history') }}">{{__('Coupon Histories')}}</a></li>

            </ul>
          </li>

          <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.category.index') }}"><i class="fas fa-th-large"></i> <span>{{__('admin.Categories')}}</span></a></li>

          <li class="nav-item dropdown {{  Route::is('admin.provider') || Route::is('admin.send-email-to-all-provider') || Route::is('admin.send-email-to-provider') || Route::is('admin.pending-provider') || Route::is('admin.provider-show') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Providers')}}</span></a>
            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.provider') || Route::is('admin.provider-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.provider') }}">{{__('admin.Provider List')}}</a></li>

                <li class="{{ Route::is('admin.pending-provider') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-provider') }}">{{__('admin.Pending Provider')}}</a></li>

            </ul>
          </li>

          @if (Module::isEnabled('Kyc'))
            @include('kyc::Admin.sideber')
          @endif

          @if (Module::isEnabled('JobPost'))
            <li class="{{ Route::is('admin.jobpost.*') || Route::is('admin.job-post-applicants') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.jobpost.index') }}"><i class="fas fa-file-signature"></i> <span>{{__('admin.All Job Post')}}</span></a></li>
          @endif

          <li class="nav-item dropdown {{  Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.pending-customer-list') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{__('admin.Users')}}</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.customer-list') }}">{{__('admin.User List')}}</a></li>

                <li class="{{ Route::is('admin.pending-customer-list') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-customer-list') }}">{{__('admin.Pending User')}}</a></li>
            </ul>
          </li>

          <li class="{{ Route::is('admin.refund-request') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.refund-request') }}"><i class="fas fa-undo"></i> <span>{{__('admin.Refund Request')}}</span></a></li>

          @php
                $unseenMessages = App\Models\TicketMessage::where('unseen_admin', 0)->groupBy('ticket_id')->get();
                $count = $unseenMessages->count();
            @endphp

          <li class="{{ Route::is('admin.ticket') || Route::is('admin.ticket-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.ticket') }}"><i class="fas fa-envelope-open-text"></i> <span>{{__('admin.Support Ticket')}} <sup class="badge badge-danger">{{ $count }}</sup></span></a></li>


          <li class="nav-item dropdown {{ Route::is('admin.withdraw-method.*') || Route::is('admin.provider-withdraw') || Route::is('admin.pending-provider-withdraw') || Route::is('admin.show-provider-withdraw')  ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-newspaper"></i><span>{{__('admin.Withdraw Payment')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.withdraw-method.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.withdraw-method.index') }}">{{__('admin.Withdraw Method')}}</a></li>

                <li class="{{ Route::is('admin.provider-withdraw') || Route::is('admin.show-provider-withdraw') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.provider-withdraw') }}">{{__('admin.Provider Withdraw')}}</a></li>

                <li class="{{ Route::is('admin.pending-provider-withdraw') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-provider-withdraw') }}">{{__('admin.Withdraw Request')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.maintainance-mode') ||  Route::is('admin.mega-menu-category.*') || Route::is('admin.mega-menu-sub-category') || Route::is('admin.create-mega-menu-sub-category') || Route::is('admin.edit-mega-menu-sub-category') || Route::is('admin.mega-menu-banner') || Route::is('admin.banner-image.index') || Route::is('admin.cart-bottom-banner') || Route::is('admin.shop-page') || Route::is('admin.seo-setup') || Route::is('admin.menu-visibility') || Route::is('admin.product-detail-page') || Route::is('admin.default-avatar') || Route::is('admin.login-page') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-globe"></i><span>{{__('admin.Manage Website')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.seo-setup') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seo-setup') }}">{{__('admin.SEO Setup')}}</a></li>

                <li class="{{ Route::is('admin.menu-visibility') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.menu-visibility') }}">{{__('admin.Menu Visibility')}}</a></li>

                <li class="{{ Route::is('admin.maintainance-mode') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.maintainance-mode') }}">{{__('admin.Maintainance Mode')}}</a></li>

                <li class="{{ Route::is('admin.banner-image.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.banner-image.index') }}">{{__('admin.Banner Image')}}</a></li>

                <li class="{{ Route::is('admin.login-page') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.login-page') }}">{{__('admin.Login Page')}}</a></li>

                <li class="{{ Route::is('admin.default-avatar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.default-avatar') }}">{{__('admin.Default Avatar')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.mobile-slider.*') || Route::is('admin.slider.*') || Route::is('admin.counter.*') || Route::is('admin.testimonial.*') || Route::is('admin.join-as-a-provider') || Route::is('admin.mobile-app') || Route::is('admin.subscriber-section') || Route::is('admin.partner.*') || Route::is('admin.home2-contact') || Route::is('admin.how-it-work') || Route::is('admin.section-content') || Route::is('admin.section-control') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.All Section')}}</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.section-content') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.section-content') }}">{{__('admin.Section Content')}}</a></li>

                <li class="{{ Route::is('admin.section-control') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.section-control') }}">{{__('admin.Section Control')}}</a></li>

                <li class="{{ Route::is('admin.slider.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.slider.index') }}">{{__('admin.Intro section')}}</a></li>

                <li class="{{ Route::is('admin.mobile-slider.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.mobile-slider.index') }}">{{__('admin.Mobile Slider')}}</a></li>

                <li class="{{ Route::is('admin.counter.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.counter.index') }}">{{__('admin.Counter')}}</a></li>

                <li class="{{ Route::is('admin.testimonial.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.testimonial.index') }}">{{__('admin.Testimonial')}}</a></li>

                <li class="{{ Route::is('admin.join-as-a-provider') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.join-as-a-provider') }}">{{__('admin.Join as a Provider')}}</a></li>

                <li class="{{ Route::is('admin.mobile-app') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.mobile-app') }}">{{__('admin.Mobile App')}}</a></li>

                <li class="{{ Route::is('admin.subscriber-section') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscriber-section') }}">{{__('admin.Subscription Box')}}</a></li>

                <li class="{{ Route::is('admin.partner.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.partner.index') }}">{{__('admin.Partner')}}</a></li>

                @php
                    $setting = App\Models\Setting::first();
                    $selected_theme = $setting->selected_theme;
                @endphp

                @if ($selected_theme == 0 || $selected_theme == 2)
                <li class="{{ Route::is('admin.home2-contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.home2-contact') }}">{{__('admin.Home 2 Contact')}}</a></li>
                @endif

                @if ($selected_theme == 0 || $selected_theme == 3)
                <li class="{{ Route::is('admin.how-it-work') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.how-it-work') }}">{{__('admin.Home 3 How it work')}}</a></li>
                @endif

            </ul>
          </li>


          <li class="nav-item dropdown {{ Route::is('admin.footer.*') || Route::is('admin.social-link.*') || Route::is('admin.footer-link.*') || Route::is('admin.second-col-footer-link') || Route::is('admin.third-col-footer-link') || Route::is('admin.topbar-contact') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Header & Footer')}}</span></a>

            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.topbar-contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.topbar-contact') }}">{{__('admin.Header')}}</a></li>

                <li class="{{ Route::is('admin.footer.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.footer.index') }}">{{__('admin.Footer')}}</a></li>

                <li class="{{ Route::is('admin.social-link.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.social-link.index') }}">{{__('admin.Social Link')}}</a></li>

                <li class="{{ Route::is('admin.footer-link.*') ? 'active' : '' }} d-none"><a class="nav-link" href="{{ route('admin.footer-link.index') }}">{{__('admin.Footer First Column')}}</a></li>

                <li class="{{ Route::is('admin.second-col-footer-link') ? 'active' : '' }} d-none"><a class="nav-link" href="{{ route('admin.second-col-footer-link') }}">{{__('admin.Footer Second Column')}}</a></li>

            </ul>
          </li>


          <li class="nav-item dropdown {{ Route::is('admin.country.*') || Route::is('admin.state.*') || Route::is('admin.city.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i><span>{{__('admin.Locations')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.country.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.country.index') }}">{{__('admin.Country / Region')}}</a></li>
                <li class="{{ Route::is('admin.state.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.state.index') }}">{{__('admin.State / Province')}}</a></li>
                <li class="{{ Route::is('admin.city.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.city.index') }}">{{__('admin.Service Area')}}</a></li>

            </ul>
          </li>



          <li class="{{ Route::is('admin.reports') ? 'active' : '' }}"><a class="nav-link d-none" href="{{ route('admin.reports') }}"><i class="fas fa-file"></i> <span>{{__('admin.Provider/Client Reports')}}</span></a></li>




          <li class="{{ Route::is('admin.payment-method') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.payment-method') }}"><i class="fas fa-dollar-sign"></i> <span>{{__('admin.Payment Method')}}</span></a></li>



          <li class="nav-item dropdown {{ Route::is('admin.about-us.*') || Route::is('admin.custom-page.*') || Route::is('admin.terms-and-condition.*') || Route::is('admin.privacy-policy.*') || Route::is('admin.faq.*') || Route::is('admin.error-page.*') || Route::is('admin.contact-us.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i><span>{{__('admin.Pages')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.about-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-us.index') }}">{{__('admin.About Us')}}</a></li>

                <li class="{{ Route::is('admin.contact-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-us.index') }}">{{__('admin.Contact Us')}}</a></li>

                <li class="{{ Route::is('admin.custom-page.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.custom-page.index') }}">{{__('admin.Custom Page')}}</a></li>

                <li class="{{ Route::is('admin.terms-and-condition.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.terms-and-condition.index') }}">{{__('admin.Terms And Conditions')}}</a></li>

                <li class="{{ Route::is('admin.privacy-policy.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.privacy-policy.index') }}">{{__('admin.Privacy Policy')}}</a></li>

                <li class="{{ Route::is('admin.faq.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.faq.index') }}">{{__('admin.FAQ')}}</a></li>

                <li class="{{ Route::is('admin.error-page.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.error-page.index') }}">{{__('admin.Error Page')}}</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') || Route::is('admin.popular-blog.*') || Route::is('admin.blog-comment.*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Blogs')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.blog-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-category.index') }}">{{__('admin.Categories')}}</a></li>

                <li class="{{ Route::is('admin.blog.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog.index') }}">{{__('admin.Blogs')}}</a></li>

                <li class="{{ Route::is('admin.popular-blog.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.popular-blog.index') }}">{{__('admin.Popular Blogs')}}</a></li>

                <li class="{{ Route::is('admin.blog-comment.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-comment.index') }}">{{__('admin.Comments')}}</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown {{ Route::is('admin.email-configuration') || Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i><span>{{__('admin.Email Configuration')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.email-configuration') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-configuration') }}">{{__('admin.Setting')}}</a></li>

                <li class="{{ Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-template') }}">{{__('admin.Email Template')}}</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown {{ Route::is('admin.admin-language') || Route::is('admin.admin-validation-language') || Route::is('admin.website-language') || Route::is('admin.website-validation-language') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Language')}}</span></a>

            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.admin-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin-language') }}">{{__('admin.Admin Language')}}</a></li>

                <li class="{{ Route::is('admin.admin-validation-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin-validation-language') }}">{{__('admin.Admin Validation')}}</a></li>

                <li class="{{ Route::is('admin.website-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.website-language') }}">{{__('admin.Frontend Language')}}</a></li>
                <li class="{{ Route::is('admin.website-validation-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.website-validation-language') }}">{{__('admin.Frontend Validation')}}</a></li>
            </ul>
          </li>

          <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.general-setting') }}"><i class="fas fa-cog"></i> <span>{{__('admin.Setting')}}</span></a></li>

          @php
              $logedInAdmin = Auth::guard('admin')->user();
          @endphp
          @if ($logedInAdmin->admin_type == 1)
          <li  class="{{ Route::is('admin.clear-database') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.clear-database') }}"><i class="fas fa-trash"></i> <span>{{__('admin.Clear Database')}}</span></a></li>
          @endif

          <li class="{{ Route::is('admin.subscriber') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscriber') }}"><i class="fas fa-fire"></i> <span>{{__('admin.Subscribers')}}</span></a></li>

          <li class="{{ Route::is('admin.contact-message') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-message') }}"><i class="fas fa-fa fa-envelope"></i> <span>{{__('admin.Contact Message')}}</span></a></li>

          @if ($logedInAdmin->admin_type == 1)
            <li class="{{ Route::is('admin.admin.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin.index') }}"><i class="fas fa-user"></i> <span>{{__('admin.Admin list')}}</span></a></li>
          @endif

        </ul>

    </aside>
  </div>
