
<div class="sidebar" data-toggle="sidebar" ></div>
    <aside class="app-sidebar" style="overflow: scroll">
      @if(Session::has('profile'))
        @if(Session::has('department'))
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" height="60px" width="60px;" src="{{ URL::To('storage/app/profile/'.Session::get('profile')) }}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{Session::get('department')}}</p>
        </div>
      </div>
      @else
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" height="60px" width="60px;" src="{{ URL::To('public/images/usser.png') }}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{Session::get('department')}}</p>
        </div>
      </div>
      @endif
      @endif
      <ul class="app-menu">
         <li><a class="app-menu__item" href="{{url('/dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
         <li><a class="app-menu__item" href="{{url('/search-employee')}}"><i class="app-menu__icon fa fa-search"></i><span class="app-menu__label">Search Employee</span></a></li>
           @if($agent->isMobile())
         <li><a class="app-menu__item" href="{{url('/attendance')}}"><i class="app-menu__icon fa fa-check"></i><span class="app-menu__label">Mark Attendance</span></a></li>
         @endif

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Employee Zone</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item" href="{{url('/leave')}}"><i class="icon fa fa-calendar"></i>Leave</a></li>
          
              <li><a class="treeview-item" href="{{url('/attendance-view')}}"><i class="icon fa fa-eye"></i>View Attendance</a></li>
             
             <li><a class="treeview-item " href="{{url('/on-duty')}}"><i class="icon fa fa-tag "></i>On-Duty</a></li>
              <li><a class="treeview-item" href="{{url('/conveyance')}}"><i class="icon fa fa-inr"></i>Conveyance</a></li>
               <li><a class="treeview-item" href="{{url('/user-details')}}"><i class="icon fa fa-user"></i>User Profile</a></li>    
          </ul>
        </li>

         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-secret"></i><span class="app-menu__label">Admin Zone</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/user-management/index')}}"><i class="icon fa fa-users"></i>User Management</a></li>
             <li><a class="treeview-item" href="{{url('/hall-of-fame/create')}}"><i class="icon fa fa-trophy"></i>Add Employee of the Month</a></li>
            
            
          </ul>
        </li>
       <!--   <li><a class="app-menu__item " href="{{url('/user-details')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">User Profile</span></a></li>
      
        </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope-open"></i><span class="app-menu__label">Leave</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/leave')}}"><i class="icon fa fa-briefcase"></i>Leave Request</a></li>
             <li><a class="treeview-item" href="{{url('/leave-view')}}"><i class="icon fa fa-eye"></i>Leave Detail</a></li>
            
          </ul>
        </li>
        <li><a class="app-menu__item " href="{{url('/on-duty')}}"><i class="app-menu__icon fa fa-tag "></i><span class="app-menu__label">On-Duty</span></a></li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar"></i><span class="app-menu__label">Attendance</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/attendance')}}"><i class="icon fa fa-briefcase"></i>Mark Attendance</a></li>
             <li><a class="treeview-item" href="{{url('/attendance-view')}}"><i class="icon fa fa-eye"></i>View Attendance </a></li>
            
          </ul>
        </li>
        -->   <!-- <li><a class="app-menu__item" href="{{url('/conveyance')}}"><i class="app-menu__icon fa fa-inr"></i><span class="app-menu__label">Conveyance</span></a></li> -->
            <li><a class="app-menu__item" href="{{url('/hall-of-fame')}}"><i class="app-menu__icon fa fa-trophy"></i><span class="app-menu__label">Hall OF Fame</span></a></li>
             <li><a class="app-menu__item" href="{{url('/photo-album')}}"><i class="app-menu__icon fa fa-file-image-o"></i><span class="app-menu__label">Photo Album</span></a></li>
             <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/conveyance-report')}}"><i class="icon fa fa-inr"></i>Conveyance </a></li>
            <li><a class="treeview-item" href="{{url('/attendance-report')}}"><i class="icon fa fa-calendar"></i> Attendance </a></li>
             <li><a class="treeview-item" href="{{url('/leave-report')}}"><i class="icon fa fa-calendar-o"></i> Leave </a></li>
            
          </ul>
        </li>
         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-secret"></i><span class="app-menu__label">Policy</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon fa fa-file"></i>HR Policies</a></li>
             <li><a class="treeview-item" href="{{url('/conveyance/policy')}}"><i class="icon fa fa-file"></i>Conveyance Policy</a></li>
            
          </ul>
        </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-product-hunt"></i><span class="app-menu__label">Inventory Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('product.index')}}"><i class="icon fa fa-list"></i>  Product</a></li>
             <li><a class="treeview-item" href="{{route('assign.index')}}"><i class="icon fa fa-tasks"></i>Allocate Product</a></li>
            
          </ul>
        </li>
      </ul>
    </aside>