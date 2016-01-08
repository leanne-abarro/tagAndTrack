@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Tools</h1>
           </div>
       </div>
@stop
@section('content')
       <!-- mobile dashboard -->
       <div class="mobile-content">
          <div class="container">
            @if(Auth::user() -> admin == 'Yes')
              <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('notifications')}}"><i class="fa fa-flag"></i></a>
                   </div>
                   @if(Auth::user() -> notifications -> where('has_read','No') -> count() != 0)
                   <span class="mobile-text"><a href="{{url('notifications')}}">Notifications ({{Auth::user() -> notifications -> where('has_read','No') -> count()}})</a></span>
                   @else
                   <span class="mobile-text"><a href="{{url('notifications')}}">Notifications</a></span>
                   @endif
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools/create')}}"><i class="fa fa-plug"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools/create')}}">Add Tool</a></span>
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools?type=Personal')}}">Tools</a></span>
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('users/'.Auth::user() -> id)}}">Profile</a></span>
               </div>
                <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools?type=Company')}}"><i class="fa fa-list-alt"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools?type=Company')}}">Co. Tools</a></span>
               </div>
            @elseif(Auth::user() -> super == 'Yes')
              <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('notifications')}}"><i class="fa fa-flag"></i></a>
                   </div>
                   @if(Auth::user() -> notifications -> where('has_read','No') -> count() != 0)
                   <span class="mobile-text"><a href="{{url('notifications')}}">Notifications ({{Auth::user() -> notifications -> where('has_read','No') -> count()}})</a></span>
                   @else
                   <span class="mobile-text"><a href="{{url('notifications')}}">Notifications</a></span>
                   @endif
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools/create')}}"><i class="fa fa-plug"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools/create')}}">Add Tool</a></span>
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools?type=Personal')}}">Tools</a></span>
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('users/'.Auth::user() -> id)}}">Profile</a></span>
               </div>
                <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools?type=Company')}}"><i class="fa fa-list-alt"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools?type=Company')}}">Co. Tools</a></span>
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <i class="fa fa-map-marker"></i>
                   </div>
                   <span class="mobile-text"><a href="{{url('sites/create')}}">Add Site</a></span>
               </div>
            @else
              <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('notifications')}}"><i class="fa fa-flag"></i></a>
                   </div>
                   @if(Auth::user() -> notifications -> where('has_read','No') -> count() != 0)
                   <span class="mobile-text"><a href="{{url('notifications')}}">Notifications ({{Auth::user() -> notifications -> where('has_read','No') -> count()}})</a></span>
                   @else
                   <span class="mobile-text"><a href="{{url('notifications')}}">Notifications</a></span>
                   @endif
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools/create')}}"><i class="fa fa-plug"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools/create')}}">Add Tool</a></span>
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('tools?type=Personal')}}">Tools</a></span>
               </div>
               <div class="mobile-links">
                   <div class="icon-wrapper">
                       <a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i></a>
                   </div>
                   <span class="mobile-text"><a href="{{url('users/'.Auth::user() -> id)}}">Profile</a></span>
               </div>
            @endif
           </div>
       </div>
       <!-- main dashboard content -->
       <div class="main-content-wrapper hide">
           <div class="container">
               <!-- top content area -->
               <div class="top-content">
                   <div id="profile-image">
                       <img src="{{asset('images/'.Auth::user() -> image)}}" alt="user-profile-picture" />
                   </div>
                   <div id="dashboard-greeting">
                       <h2>Hello <br> {!!Auth::user() -> firstname!!}!</h2>
                       <div id="cta-area">
                           <div class="cta-button">
                               <a href="{{url('tools/create')}}">Add Tool</a>
                           </div> 
                       </div>
                   </div>
                   
               </div>
               <!-- box content area -->
               <div class="box-content">
                @if(Auth::user() -> admin == 'Yes')
                   <div class="box-area">
                        <svg id="chart1" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                    </div>
                   <div class="box-area">
                       <svg id="chart2" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                       <svg id="chart3" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                        <svg id="chart4" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                    </div>
                   <div class="box-area">
                       <svg id="chart5" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                       <svg id="chart6" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                @elseif(Auth::user() -> super == 'Yes')
                   <div class="box-area">
                        <svg id="chart1" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                    </div>
                   <div class="box-area">
                       <svg id="chart2" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                       <svg id="chart3" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                        <svg id="chart4" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                    </div>
                   <div class="box-area">
                       <svg id="chart5" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                       <svg id="chart6" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                       <svg id="chart7" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                @else
                  <div class="box-area">
                        <svg id="chart1" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                    </div>
                   <div class="box-area">
                       <svg id="chart2" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                   <div class="box-area">
                       <svg id="chart3" viewBox="0 0 230 230" preserveAspectRatio="xMidYMid meet"></svg>
                   </div>
                @endif
               </div>
           </div>
       </div>
@stop