@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Tool</h1>
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
       <!-- tool info -->
       <div id="toolview-area">
           <div class="container">
               <div class="top-content">
                  <div class="icon-wrapper">
                       <a href="{{url('tools/'.$tool -> id.'/edit')}}"><i class="fa fa-pencil"></i></a>
                   </div>
                   @if(Session::has('message-success')) <div class="success-form"> {{Session::get('message-success')}} </div> @endif
                   @if(Session::has('message-update')) <div class="success-form"> {{Session::get('message-update')}} </div> @endif   
                   <h2>{{$tool -> name}}</h2>
               </div>
               
               <div class="tool-wrapper">
                   <div class="tool-info2"><span class="tool-label">Type:</span> {{$tool -> type}}</div>
                   <div class="tool-info"><span class="tool-label">Tag #:</span> {{$tool -> tag_number ? $tool -> tag_number: ""}}</div>
                   <div class="tool-info"><span class="tool-label">Tool ID #:</span> {{$tool -> id}}</div>
                   <div class="tool-info"><span class="tool-label">Plant #:</span> {{$tool -> plant_number ? $tool -> plant_number: ""}}</div>
                   <div class="tool-info"><span class="tool-label">Serial #:</span> {{$tool -> serial_number ? $tool -> serial_number: ""}}</div>
                   <div class="tool-info2"><span class="tool-label">Job Site:</span> {{$tool -> user ? $tool -> user -> site_id: ""}}</div>
                   <div class="tool-info"><span class="tool-label">Tested Date:</span> {{$tool -> serviced_date -> format("d/m/Y")}}</div>
                   <div class="tool-info"><span class="tool-label">Re-test Date:</span> {{$tool -> retag_date -> format("d/m/Y")}}</div>
                   <div class="tool-info2"><span class="tool-label">Serviced By:</span> {{$tool -> technician ? $tool -> technician -> tech_name: ""}}</div>
                   <div class="tool-info2"><span class="tool-label">Service Company:</span> {{$tool -> technician ? $tool -> technician -> tech_company: ""}}</div>
                   <div class="tool-info2"><span class="tool-label">Service Contact #:</span> {{$tool -> technician ? $tool -> technician -> contact_number: ""}}</div>
               </div>
           </div>
       </div>
@stop