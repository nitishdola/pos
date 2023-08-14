@if(auth()->user())
<div class="header">

   <div class="header-left active">
      <a href="https://dreamspos.dreamguystech.com/html/template/index.html" class="logo logo-normal">
         <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/logo.png" alt>
      </a>
      <a href="https://dreamspos.dreamguystech.com/html/template/index.html" class="logo logo-white">
         <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/logo-white.png" alt>
      </a>
      <a href="https://dreamspos.dreamguystech.com/html/template/index.html" class="logo-small">
         <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/logo-small.png" alt>
      </a>
      <a id="toggle_btn" href="javascript:void(0);">
         <i data-feather="chevrons-left" class="feather-16"></i>
      </a>
</div>


            
   <a id="mobile_btn" class="mobile_btn" href="#sidebar">
   <span class="bar-icon">
   <span></span>
   <span></span>
   <span></span>
   </span>
   </a>
   <ul class="nav user-menu">
      <li class="nav-item nav-searchinputs">
         <div class="top-nav-search">
            
         </div>
      </li>
      <li class="nav-item dropdown has-arrow main-drop">

         <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                                    
                  <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/log-out.svg" class="me-2" alt="img">Hi {{ auth()->user()->name }} {{ __('Logout') }}
               </a>
               
         <!-- <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
         <span class="user-info">
         
         <span class="user-detail">
         <span class="user-name">{{ auth()->user()->name }}</span>
         <span class="user-role">
            
               <a class="dropdown-item logout pb-0" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                                    
                  <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/log-out.svg" class="me-2" alt="img">{{ __('Logout') }}
               </a>
         </span>
         </span>
         </span>
         </a>
         <div class="dropdown-menu menu-drop-user">
            <div class="profilename">
               
               <hr class="m-0">
               
               <a class="dropdown-item" href="#"><i class="me-2" data-feather="settings"></i>Change Password</a>
               <hr class="m-0">

                  <a class="dropdown-item logout pb-0" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                                    
                  <img src="https://dreamspos.dreamguystech.com/html/template/assets/img/icons/log-out.svg" class="me-2" alt="img">{{ __('Logout') }}
               </a>
            </div>
         </div> -->
      </li>
   </ul>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@else
<script>window.location = {{ public_path(); }}."/home";</script>
@endif