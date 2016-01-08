@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Job Sites</h1>
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
       <!-- sites list -->
       <div id="sites-area">
           <div class="container">
               <div class="top-content">
                  <div class="cta-button">
                       <a href="sites/create">Add Site</a>
                   </div> 
                   <h2>Job sites registered:</h2>
               </div>
               <div id="site-labels" class="hide">
                   <div class="site-title">
                       Site Name
                   </div>
                   <div class="site-title">
                       Address
                   </div>
                   <div class="site-title">
                       Contact Person
                   </div>
                   <div class="site-title">
                       Contact Number
                   </div>
               </div>
               @foreach($sites as $site)
               <div class="job-sites-wrapper">
                   <div class="site-name"><a href="{{url('sites/'.$site -> id)}}">{{$site -> name}}</a></div>
                   <div class="site-info"><span class="site-label">Address:</span> {{$site -> address}}</div>
                   <div class="site-info"><span class="site-label">Contact Person:</span> {{$site -> contact_person}}</div>
                   <div class="site-info"><span class="site-label">Contact #:</span> {{$site -> contact_number}}</div>
               </div>
               @endforeach
           </div>
       </div>
@stop