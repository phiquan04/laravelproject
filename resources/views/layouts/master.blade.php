<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Hotel Dashboard</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets_admin/img/favicon.png') }}">
	<link rel="stylesheet" href="{{asset('assets_admin/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{asset('assets_admin/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{asset('assets_admin/plugins/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" href="{{asset('assets_admin/css/feathericon.min.css') }}">
	<link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
	<link rel="stylesheet" href="{{asset('assets_admin/plugins/morris/morris.css') }}">
	<link rel="stylesheet" href="{{asset('assets_admin/css/bootstrap-datetimepicker.min.css') }}">
	<link rel="stylesheet" href="{{asset('assets_admin/plugins/fullcalendar/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{asset('assets_admin/css/style.css') }}"> 
</head>


	{{-- message toastr --}}
	<link rel="stylesheet" href="{{asset('assets_admin/css/toastr.min.css') }}">
	<script src="{{asset('assets_admin/js/toastr_jquery.min.js') }}"></script>
	<script src="{{asset('assets_admin/js/toastr.min.js') }}"></script>

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="{{ route('Load_dashboard') }}" class="logo"> <img src="{{asset('assets/images/cart/15.png') }}" width="100" height="100" alt="logo"> <span class="logoclass">HOTEL</span> </a>
				<a href="{{ route('Load_dashboard') }}" class="logo logo-small"> <img src="{{asset('assets/images/cart/15.png') }}" alt="Logo" width="30" height="30"> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown noti-dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">  <span class="badge badge-pill"></span> </a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('assets_admin/img/profiles/avatar-02.jpg') }}">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Carlson Tech</span> has approved <span class="noti-title">your estimate</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('assets_admin/img/profiles/avatar-11.jpg') }}">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">International Software
													Inc</span> has sent you a invoice in the amount of <span class="noti-title">$218</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('assets_admin/img/profiles/avatar-17.jpg') }}">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone
													XR</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('assets_admin/img/profiles/avatar-13.jpg') }}">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Mercury Software
												Inc</span> added a new product <span class="noti-title">Apple
												MacBook Pro</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="#">View all Notifications</a> </div>
					</div>
				</li>
				<li class="nav-item dropdown has-arrow">
					<a href="" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> </div>
								<div class="user-text">
									<h6>
									<?php 
							         $name = Session::get('name');
							         if($name)
							         echo $name;
							         ?>
									</h6>
									<p class="text-muted mb-0">Administrator</p>
								</div>
							</div>
						<a class="dropdown-item" href="{{ route('profile') }}">My Profile</a> 
						<a class="dropdown-item" href="settings.html">Account Settings</a> 
						<a class="dropdown-item" href="{{ route('adminlogout') }}">Logout</a>
					</div>
				</li>
			</ul>
			<div class="top-nav-search">
				<form>
					<input type="text" class="form-control" placeholder="Search here">
					<button class="btn" type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>
		</div>
		@yield('menu')
        @yield('content')
	</div>
	<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="{{asset('assets_admin/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{asset('assets_admin/js/popper.min.js') }}"></script>
	<script src="{{asset('assets_admin/js/bootstrap.min.js') }}"></script>
	<script src="{{asset('assets_admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{asset('assets_admin/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{asset('assets_admin/js/moment.min.js') }}"></script>
	<script src="{{asset('assets_admin/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{asset('assets_admin/js/script.js') }}"></script>
	<script src="{{asset('assets_admin/js/moment.min.js') }}"></script>
	<script src="{{asset('assets_admin/plugins/morris/morris.min.js') }}"></script>
	<script src="{{asset('assets_admin/js/chart.morris.js') }}"></script>
	<script src="{{asset('assets_admin/js/jquery-ui.min.js') }}"></script>
	<script src="{{asset('assets_admin/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
	<script src="{{asset('assets_admin/plugins/fullcalendar/jquery.fullcalendar.js') }}"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

	@yield('script')
	
</body>

</html>