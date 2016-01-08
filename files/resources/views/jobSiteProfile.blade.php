@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Job Site</h1>
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
       <!-- job site info -->
       <div id="job-site-area">
           <div class="container">
               <div class="top-content">
                  <div class="icon-wrapper">
                       <a href="{{url('sites/'.$site -> id.'/edit')}}"><i class="fa fa-pencil"></i></a>
                   </div>
                   @if(Session::has('message-success')) <div class="success-form"> {{Session::get('message-success')}} </div> @endif
                   @if(Session::has('update-success')) <div class="success-form"> {{Session::get('update-success')}} </div> @endif 
                   <h2>{{$site -> name}}</h2>
               </div>
               <div class="job-site-wrapper">
                   <div class="site-info"><span class="site-info-label">Address:</span> {{$site -> address}}</div>
                   <div class="site-info"><span class="site-info-label">Site Number:</span> {{$site -> id}}</div>
                   <div class="site-info"><span class="site-info-label">Contact Person:</span> {{$site -> contact_person}}</div>
                   <div class="site-info"><span class="site-info-label">Contact Number:</span> {{$site -> contact_number}}</div>
               </div>
           </div>
       </div>
@stop