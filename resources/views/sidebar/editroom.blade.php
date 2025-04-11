<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class=""> <a href="{{ route('Load_dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
                <li class="list-divider"></li>
                <li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{ route('form/allbooking') }}"> All Booking </a></li>
              
                        <li><a href="{{ route('form/booking/add') }}"> Confirm Booking </a></li>
                    </ul>
                </li>
                
                <li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Rooms </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{ route('form/allrooms/page') }}">All Rooms </a></li>
                  
                        <li><a href="{{ route('form/addroom/page') }}"> Add Rooms </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Hotels </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{ route('All-Hotels') }}">All Hotel </a></li>
                
                        <li><a href="{{ route('Add-Hotels') }}"> Add Hotel </a></li>
                    </ul>
                </li>
               
                <li> <a href="{{URL::to('/calendar')}}"><i class="fas fa-calendar-alt"></i> <span> Calendar </span></a>
                </li>
                <li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{Route('form/allinvoices')}}">Invoices </a></li>
                        <li><a href="payments.html">Payments </a></li>
       
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fa fa-user-plus"></i> 
                        <span> User Management </span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{Route('form/allusers')}}">All User</a></li>
                   
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>