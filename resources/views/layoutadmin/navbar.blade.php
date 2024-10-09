 <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
     id="layout-navbar">
     <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
         <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
             <i class="bx bx-menu bx-sm"></i>
         </a>
     </div>

     <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

         <ul class="navbar-nav flex-row align-items-center ms-auto">

             <!-- User -->
             <li class="nav-item navbar-dropdown dropdown-user dropdown">
                 <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (auth()->user()->akses == 'Admin' && auth()->user()->admin?->foto != null)
                            <img src="{{ Storage::url(auth()->user()->admin->foto) }}" alt
                                 class="w-px-30 h-auto rounded-circle" />
                        @else
                            <img src="{{ asset('sneat/assets/img/avatars/1.png') }}" alt
                                 class="w-px-30 h-auto rounded-circle" />
                        @endif
                    </div>                    
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end">
                     @if (auth()->user()->akses == 'Admin')
                        <li>
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile Admin</span>
                        </li>
                    @elseif (auth()->user()->akses == 'HR')
                        <li>
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile HR</span>
                        </li>
                    @elseif (auth()->user()->akses == 'Accounting')
                        <li>
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile Accounting</span>
                        </li>
                    @elseif (auth()->user()->akses == 'Payroll')
                        <li>
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile Payroll</span>
                        </li>
                    @elseif (auth()->user()->akses == 'Operator')
                        <li>
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile Operator</span>
                        </li>
                    @endif
                     <li>
                         <div class="dropdown-divider"></div>
                     </li>
                     <li>
                         <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                     </li>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                 </ul>
             </li>
             <!--/ User -->
         </ul>
     </div>
 </nav>
