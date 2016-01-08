<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Tag and Track - the easiest online tagged tool management system.">
    <meta name="keywords" content="tag and track, electricians, trades, tradesmen, tools, safety, compliance, plumbers, construction, tool management system">
    
    <!-- view port -->
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- google fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- style sheets -->
	<link rel="stylesheet" href="{{asset('css/normalize.css')}}">
	<link rel="stylesheet" href="{{asset('css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">
	
	<!-- date picker files -->
    <link rel="stylesheet" href="{{asset('css/datepicker.css')}}" />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
	
	<title>Tag and Track</title>
</head>
<body>
  <div class="se-pre-con"></div>
    <header>
           <!-- mobile navigation -->
           <div id="mobile-nav">
               <div class="container">
                   <div class="icon-wrapper"><i id="hamburger" class="fa fa-bars"></i></div>
                   <div id="mobile-logo">
                       <img src="{{asset('images/tag-track-logo-white.png')}}" alt="tag-and-track-logo" />
                   </div>
                   <div class="icon-wrapper"><a href="{{url('tools/create')}}"><i id="cross" class="fa fa-plus"></i></a></div>
               </div>
           </div>
           <!-- header -->
           <div id="main-header" class="hide">
              <div class="container">
                  <div id="main-logo">
                      <img src="{{asset('images/tag-track-logo-white.png')}}" alt="tag-and-track-logo" />
                  </div>
                  
                  <span id="username">Welcome {!!Auth::user() -> firstname!!}!</span>
    
              </div>
           </div>
           <!-- H1 area -->
           
           @yield('h1')
           
    <!-- menu overlay -->
       <div id="menu-overlay" class="hide">
          <div class="container">
              <div id="menu-close"><i class="fa fa-times"></i></div>
                <nav id="nav">
                    <ul>
                        @if(Auth::user() -> admin == 'Yes')
                          <li class="animate-list"><a href="{{url('dashboard')}}"><i class="fa fa-tachometer"></i> <span class="link-hide">Dashboard</span></a></li>
                          <li class="animate-list"><a href="{{url('notifications')}}"><i class="fa fa-flag"></i> <span class="link-hide">Notifications</span></a></li>
                          <li class="animate-list"><a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i> <span class="link-hide">Tools</span></a></li>
                          <li class="animate-list"><a href="{{url('tools?type=Company')}}"><i class="fa fa-list-alt"></i> <span class="link-hide">Company Tools</span></a></li>       
                          <li class="animate-list"><a href="{{url('users')}}"><i class="fa fa-users"></i> <span class="link-hide">Users</span></a></li>                       
                          <li class="animate-list"><a href="{{url('sites/'.Auth::user() -> site_id)}}"><i class="fa fa-compass"></i> <span class="link-hide">Job Site</span></a></li>
                          <li class="animate-list"><a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i> <span class="link-hide">Profile</span></a></li>                        
                          <li class="animate-list"><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> <span class="link-hide">Logout</span></a></li>
                        @elseif(Auth::user() -> super == 'Yes')
                          <li class="animate-list"><a href="{{url('dashboard')}}"><i class="fa fa-tachometer"></i> <span class="link-hide">Dashboard</span></a></li>
                          <li class="animate-list"><a href="{{url('notifications')}}"><i class="fa fa-flag"></i> <span class="link-hide">Notifications</span></a></li>
                          <li class="animate-list"><a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i> <span class="link-hide">Tools</span></a></li>
                          <li class="animate-list"><a href="{{url('tools?type=Company')}}"><i class="fa fa-list-alt"></i> <span class="link-hide">Company Tools</span></a></li>       
                          <li class="animate-list"><a href="{{url('users')}}"><i class="fa fa-users"></i> <span class="link-hide">Users</span></a></li>                       
                          <li class="animate-list"><a href="{{url('sites')}}"><i class="fa fa-compass"></i> <span class="link-hide">Job Sites</span></a></li>
                          <li class="animate-list"><a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i> <span class="link-hide">Profile</span></a></li>                        
                          <li class="animate-list"><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> <span class="link-hide">Logout</span></a></li>
                        @else
                          <li class="animate-list"><a href="{{url('dashboard')}}"><i class="fa fa-tachometer"></i> <span class="link-hide">Dashboard</span></a></li>
                          <li class="animate-list"><a href="{{url('notifications')}}"><i class="fa fa-flag"></i> <span class="link-hide">Notifications</span></a></li>
                          <li class="animate-list"><a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i> <span class="link-hide">Tools</span></a></li>
                          <li class="animate-list"><a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i> <span class="link-hide">Profile</span></a></li>
                          <li class="animate-list"><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> <span class="link-hide">Logout</span></a></li>
                        @endif
                    </ul>
                </nav>
          </div>
      </div> <!-- end of menu overlay -->
   </header>
   <main>
       <!-- mobile quick menu -->
       @yield('quickMenu')
       <!-- page content -->
       @yield('content')
       
  </main>
   <!-- footer content -->
    <footer>
       <div class="container">
           <div id="footer-wrapper">
               2015 &copy; Tag &amp; Track
           </div>
       </div>
    </footer>
    <div id="rooturl" class="hide">{{url("/")}}</div>
<!-- scripts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
<!-- datepicker -->
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- d3 -->
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<!-- jquery editable -->
<script src="{{asset('js/jquery.editable.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>


</body>
</html>