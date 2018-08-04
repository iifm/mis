
<div class="sidebar" data-toggle="sidebar" ></div>
    <aside class="app-sidebar" style="overflow: scroll">
      @if(Session::has('profile'))
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" height="60px" width="60px;" src="{{ URL::To('storage/app/profile/'.Session::get('profile')) }}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{Auth::user()->email}}</p>
        </div>
      </div>
      @else
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" height="60px" width="60px;" src="{{ URL::asset('images/user.jpeg') }}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{Auth::user()->email}}</p>
        </div>
      </div>
      @endif
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{url('/dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
         <li><a class="app-menu__item active" href="{{url('/user-details')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">User Profile</span></a></li>
      
        </li>
          <li><a class="app-menu__item" href="{{url('/leave')}}"><i class="app-menu__icon fa fa-envelope-open"></i><span class="app-menu__label">Leave</span></a></li>
        <li><a class="app-menu__item " href="{{url('/on-duty')}}"><i class="app-menu__icon fa fa-tag "></i><span class="app-menu__label">On-Duty</span></a></li>
         <li><a class="app-menu__item" href="{{url('/attendance')}}"><i class="app-menu__icon fa fa-calendar"></i><span class="app-menu__label">Attendance</span></a></li>
          <li><a class="app-menu__item" href="{{url('/conveyance')}}"><i class="app-menu__icon fa fa-inr"></i><span class="app-menu__label">Conveyance</span></a></li>
            <li><a class="app-menu__item" href="{{url('/hall-of-fame')}}"><i class="app-menu__icon fa fa-trophy"></i><span class="app-menu__label">Hall OF Fame</span></a></li>
             <li><a class="app-menu__item" href="{{url('/photo-album')}}"><i class="app-menu__icon fa fa-file-image-o"></i><span class="app-menu__label">Photo Album</span></a></li>
             <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/conveyance-report')}}"><i class="icon fa fa-inr"></i>Conveyance Report</a></li>
            
          </ul>
        </li>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Inventory Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('product.index')}}"><i class="icon fa fa-product-hunt"></i>  Product</a></li>
             <li><a class="treeview-item" href="{{route('assign.index')}}"><i class="icon fa fa-tasks"></i>Allocate Product</a></li>
            
          </ul>
        </li>
      </ul>
    </aside>