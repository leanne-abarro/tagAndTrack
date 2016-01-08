@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Profile</h1>
           </div>
       </div>
@stop
@section('quickMenu')
<div class="mobile-quick-menu">
  <div class="container">
    @if(Auth::user() -> admin == 'Yes')
      <div class="icon-wrapper"><a href="{{url('notifications')}}"><i class="fa fa-flag"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools/create')}}"><i class="fa fa-plug"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools?type=Company')}}"><i class="fa fa-list-alt"></i></a></div>
    @elseif(Auth::user() -> super == 'Yes')
      <div class="icon-wrapper"><a href="{{url('notifications')}}"><i class="fa fa-flag"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools/create')}}"><i class="fa fa-plug"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools?type=Company')}}"><i class="fa fa-list-alt"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('sites')}}"><i class="fa fa-map-marker"></i></a></div>
    @else
      <div class="icon-wrapper"><a href="{{url('notifications')}}"><i class="fa fa-flag"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools/create')}}"><i class="fa fa-plug"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('tools?type=Personal')}}"><i class="fa fa-list"></i></a></div>
      <div class="icon-wrapper"><a href="{{url('users/'.Auth::user() -> id)}}"><i class="fa fa-user"></i></a></div>
    @endif
  </div>
</div> <!-- end of quick menu  -->
@stop
@section('content')
    <!-- profile info -->
       <div id="profile-area">
           <div class="container">
               <div class="top-content">
                  <div class="icon-wrapper">
                       <a href="{{url('users/'.$user -> id.'/edit')}}"><i class="fa fa-pencil"></i></a>
                   </div>
                   @if(Session::has('update-success')) <div class="success-form"> {{Session::get('update-success')}} </div> @endif 
                   <h2>{{$user -> firstname}} {{$user -> lastname}}</h2>

               </div>
               <div class="user-info-wrapper">
                  <div id="profile-image">
                       <img src="{{asset('images/'. $user -> image)}}" alt="user-profile-picture" />
                   </div>
                   <div id="user-details">
                       <div class="user-info2"><span class="user-info-label">Occupation:</span> {{$user -> occupation}}</div>
                       <div class="user-info"><span class="user-info-label">Company:</span> {{$user->site ? $user->site->company->name: ""}}</div>
                       <div class="user-info"><span class="user-info-label">Site:</span> {{$user->site ? $user -> site -> name : ""}}</div>
                       <div class="user-info2"><span class="user-info-label">Username:</span> {{$user -> username}}</div>
                       <div class="user-info2"><span class="user-info-label">Email:</span> {{$user -> email}}</div>
                       <div class="user-info2"><span class="user-info-label">Contact #:</span> {{$user -> number}}</div>
                       <!-- <div class="user-info2"><span class="user-info-label">Password:</span> ******</div> -->
                   </div>
               </div>
           </div>
       </div>
@stop