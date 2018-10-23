<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Leave;
use App\UploadCategory;
use App\OnDuty;
use App\UserDetails;
use App\HallOfFame;
use App\User;
use App\Wishes;
use Mail;
use DB;
use App\Role;
use Session;
use URL;
use App\NewsUpload;

        $id=Auth::id();

        $pressReases=NewsUpload::join('upload_categories','upload_categories.id','=','news_uploads.category')
                                ->where('upload_categories.type','press')
                                ->select('news_uploads.*')->get();

        $announcements=NewsUpload::join('upload_categories','upload_categories.id','=','news_uploads.category')
                                ->where('upload_categories.type','announcement')
                                ->select('news_uploads.*')->get();
                               // dd($pressReases);

        $user_detail=User::where('users.id',$id)
                    ->where('user_details.status','Active')
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->join('departments','departments.id','=','user_details.department')
                    ->select('users.*','user_details.*','users.id as user_id','departments.name as department')
                    ->get();
            $profile=null;
            $department=null;
        foreach ($user_detail as  $value) {    
            $profile=$value->profile; 
            //dd($profile);
            $department=$value->department;
        }
      
        Session::put('profile', $profile);
        Session::put('department',$department);    

        $policyEditType=UploadCategory::where('type','text')->get();     
        Session::put('policyType', $policyEditType);
        
        $downloadType=UploadCategory::where('type','file')->get();     
        Session::put('downloadType', $downloadType);

      
        $userRole=Auth::user()->role;
        $roleDetails=Role::where('id',$userRole)->first();
       
          $access_zones=$roleDetails->access_zone;

          if ($access_zones=='All') {
             Session::put('access_zones', $access_zones);
          }
          else{
            Session::put('access_zones', $access_zones);
          }

         
         $active_user_role=Auth::user()->role;

            $manager_zone_access=Role::where('id',$active_user_role)->get();

            foreach ($manager_zone_access as  $access) {
               $access_zone=$access->access_zone;
               if ($access_zone!=0) {
              $manager_zone='show';
               Session::put('manager_zone', $manager_zone);
                }
            else{
              $manager_zone='hide';
               Session::put('manager_zone', $manager_zone);
                }
            }

          
    ?>
    <aside class="app-sidebar" style="overflow: scroll">
      @if(Session::has('profile')!=null && Session::has('department')!=null )
      
      <div class="app-sidebar__user"><a href="{{url('/user-details')}}"><img class="app-sidebar__user-avatar" height="60px" width="60px;" src="{{ URL::To('storage/app/profile/'.Session::get('profile')) }}" alt="User Image"></a>
        <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{Session::get('department')}}</p>
        </div>
      </div>
    
      @else
      <div class="app-sidebar__user"><a href="{{url('/user-details')}}"><img class="app-sidebar__user-avatar" height="60px" width="60px;" src="{{ URL::To('public/images/usser.png') }}" alt="User Image"></a>
        <div>
          <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
          <p class="app-sidebar__user-designation">{{Session::get('department')}}</p>
        </div>
      </div>
     
      @endif
      <ul class="app-menu">
         <li><a class="app-menu__item" href="{{url('/dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
         <li><a class="app-menu__item" href="{{url('/search-employee')}}"><i class="app-menu__icon fa fa-search"></i><span class="app-menu__label">Search Employee</span></a></li>
           @if($agent->isMobile())
         <li><a class="app-menu__item" href="{{url('/attendance')}}"><i class="app-menu__icon fa fa-check"></i><span class="app-menu__label">Mark Attendance</span></a></li>
         @endif

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Employee Zone</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             <li><a class="treeview-item" href="{{url('/leave')}}"><i class="icon fa fa-calendar"></i>Apply Leave</a></li>
              <li><a class="treeview-item" href="{{url('leave-view')}}/{{Auth::id()}}"><i class="icon fa fa-eye"></i>View Leave</a></li>
          
              <li><a class="treeview-item" href="{{url('/attendance-view')}}"><i class="icon fa fa-eye"></i>View Attendance</a></li>
             
             <li><a class="treeview-item " href="{{url('/on-duty')}}"><i class="icon fa fa-tag "></i>Apply On-Duty</a></li>
              <li><a class="treeview-item" href="{{url('/conveyance')}}"><i class="icon fa fa-inr"></i>Submit Conveyance</a></li>
               <li><a class="treeview-item" href="{{url('/user-details')}}"><i class="icon fa fa-user"></i>User Profile</a></li> 
                <li><a class="treeview-item" href="{{url('/photo-album')}}"><i class="icon fa fa-file-image-o"></i>Photo Album</a></li> 
               
          </ul>
        </li>
        
       @if(Session::get('manager_zone')=='show' || Session::get('access_zones')=='All')

          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Manager Zone</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          
              <li><a class="treeview-item" href="{{url('/manager/index')}}"><i class="icon fa fa-eye"></i>View Team Details</a></li>
              <li><a class="treeview-item" href="{{url('admin/news-upload')}}"><i class="icon fa fa-upload"></i>News Upload/Update</a></li>  
              
               <li><a class="treeview-item" href="{{url('/manager/leave/index')}}"><i class="icon fa fa-paper-plane"></i>Leave Request(s)</a></li> 
               <!--  <li><a class="treeview-item" href="{{url('/manager/attendance/index')}}"><i class="icon fa fa-calendar-o"></i>Attendance Request(s)</a></li> 
 -->  
          </ul>
        </li>
       @endif

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-plus"></i><span class="app-menu__label">Request Zone</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('manager-zone/request')}}"><i class="icon fa fa-users"></i>New Hiring</a></li>
           
          </ul>
        </li>

       @if(Session::get('access_zones')=='All')
         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-secret"></i><span class="app-menu__label">Admin Zone</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/user-management/index')}}"><i class="icon fa fa-users"></i>User Management</a></li>
            <li><a class="treeview-item" href="{{url('/role/index')}}"><i class="icon fa fa-tasks"></i>Role Management</a></li>
             <li><a class="treeview-item" href="{{url('/hall-of-fame/create')}}"><i class="icon fa fa-trophy"></i>Add Employee of the Month</a></li>
               <li><a class="treeview-item" href="{{url('/department/index')}}"><i class="icon fa fa-building-o"></i>Department</a></li> 
                <li><a class="treeview-item" href="{{url('/upload/category/index')}}"><i class="icon fa fa-list"></i>Add Category</a></li>
           <!--   <li><a class="treeview-item" href="{{url('admin/news-upload')}}"><i class="icon fa fa-upload"></i>News Update/Upload</a></li>  -->   
          </ul>
        </li>
      @endif      

         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-download"></i><span class="app-menu__label">Downloads</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
             @if(Session::has('downloadType'))
            @foreach(Session::get('downloadType') as $type)
            <li><a class="treeview-item" href="{{url('/download')}}/{{$type->id}}"><i class="icon fa fa-download"></i>{{$type->name}}
            </a></li>
            @endforeach
            @endif
        
          </ul>
        </li>
      
            <li><a class="app-menu__item" href="{{url('/hall-of-fame')}}"><i class="app-menu__icon fa fa-trophy"></i><span class="app-menu__label">Hall of Fame</span></a></li>
           

          @if(Session::get('manager_zone')=='show' || Session::get('access_zones')=='All')
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Report Zone</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/conveyance-report')}}"><i class="icon fa fa-inr"></i>Conveyance </a></li>
            <li><a class="treeview-item" href="{{url('/attendance-report')}}"><i class="icon fa fa-calendar"></i> Attendance </a></li>
             <li><a class="treeview-item" href="{{url('/leave-report')}}"><i class="icon fa fa-calendar-o"></i> Leave </a></li>
            
          </ul>
        </li>
      @endif
         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-secret"></i><span class="app-menu__label">Policy</span><i class="treeview-indicator fa fa-angle-right"></i></a>
       
          <ul class="treeview-menu">
            @if(Session::has('policyType'))
            @foreach(Session::get('policyType') as $type)
            <li><a class="treeview-item" href="{{url('/policy-view')}}/{{$type->id}}"><i class="icon fa fa-file"></i>{{$type->name}}
            </a></li>
            @endforeach
            @endif
            
            
          </ul>
        </li>
      <!--   @if(Session::get('manager_zone')=='show' || Session::get('access_zones')=='All')
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-product-hunt"></i><span class="app-menu__label">Inventory Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/product-categories/index')}}"><i class="icon fa fa-list"></i>  Product Category</a></li>
            <li><a class="treeview-item" href="{{route('product.index')}}"><i class="icon fa fa-list"></i>  Product Management</a></li>
             <li><a class="treeview-item" href="{{route('assign.index')}}"><i class="icon fa fa-tasks"></i>Allocate Product</a></li>
            
          </ul>
        </li>
      @endif
       -->
          <li><a class="app-menu__item" href="{{url('/change-password')}}"><i class="app-menu__icon fa fa-key"></i><span class="app-menu__label">Change Password</span></a></li>
      </ul>
    </aside>