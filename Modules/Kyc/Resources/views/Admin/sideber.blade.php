<li class="nav-item dropdown {{ Route::is('admin.kyc.*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>{{__('admin.Manage KYC')}}</span></a>

    <ul class="dropdown-menu">
        <li class="{{ Route::is('admin.kyc.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.kyc.index') }}">{{__('admin.kyc Type')}}</a></li>

        <li class="{{ Route::is('admin.kyc-list*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.kyc-list') }}">{{__('admin.Kyc Approval')}}</a></li>

    </ul>
  </li>

