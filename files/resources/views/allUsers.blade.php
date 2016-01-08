@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Users</h1>
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
       <!-- users list -->
       <div id="users-area">
           <div class="container">
               <div class="top-content">
                  @if(Auth::user() -> admin == 'Yes')
                   <h2>Users registered within this site:</h2>
                  @else
                    <h2>Users registered within Singer</h2>
                  @endif
               </div>
               @if(Auth::user() -> admin == 'Yes')
               <div id="user-labels" class="hide">
                   <div class="user-title2">
                       Name
                   </div>
                   <div class="user-title2">
                       Contact Number
                   </div>
                   <div class="user-title2">
                       Email
                   </div>
               </div>
               @foreach($users as $user)
               <div class="users-list-wrapper">
                   <div class="name2">{{$user -> firstname}} {{$user -> lastname}}</div>
                   <div class="info2"><span class="user-info-label">Contact #:</span> {{$user -> number}}</div>
                   <div class="info2"><span class="user-info-label">Email:</span> {{$user -> email}}</div>
               </div>
               @endforeach
               @elseif(Auth::user() -> super == 'Yes')
               <div id="user-labels" class="hide">
                   <div class="user-title">
                       Name
                   </div>
                   <div class="user-title">
                       Contact Number
                   </div>
                   <div class="user-title">
                       Email
                   </div>
                   <div class="user-title">
                       Site Number
                   </div>
                   <div class="user-title">
                       Admin
                   </div>
               </div>
               @foreach($users as $user)
               <div class="users-list-wrapper">
                   <div class="icon-wrapper">
                       <i class="edit-button fa fa-pencil"></i>
                   </div>
                   <div class="name">{{$user -> firstname}} {{$user -> lastname}}</div>
                   <div class="info"><span class="user-info-label">Contact #:</span> {{$user -> number}}</div>
                   <div class="info"><span class="user-info-label">Email:</span> {{$user -> email}}</div>
                   <div class="info"><span class="user-info-label">Site #:</span> {{$user -> site_id}}</div>
                   <div class="info" data-field="admin"><span class="user-info-label">Admin:</span> <span data-editable-userid="{{$user->id}}">{{$user -> admin}}</span></div>
               </div>
               @endforeach
               @endif
               <div id="token">{{ csrf_token() }}</div>
           </div>
       </div>
@stop