@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Tools</h1>
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
       <!-- tools list -->
       @if(Auth::user() -> super != 'Yes')
       <div id="tools-area">
       @else
       <div id="tools-area-super">
       @endif
           <div class="container">
               <div class="top-content">
                  <div class="cta-button">
                       <a href="{{url('tools/create')}}">Add Tool</a>
                   </div>
                   @if(Session::has('message-update')) <div class="success-form2"> {{Session::get('message-update')}} </div> @endif 
                   @if(Request::get("type") == 'Company') 
                   <h2>Company tools registered:</h2>
                   @else
                   <h2>Personal tools registered:</h2>
                   @endif
               </div>
              <!-- admin user for both personal and company tools -->
              @if(Auth::user() -> admin == 'Yes')
                <div id="tool-labels" class="hide">
                   <div class="tool-title">
                       Tool Name
                   </div>
                   <div class="tool-title">
                       Tag Number
                   </div>
                   <div class="tool-title">
                       Tool ID Number
                   </div>
                   <div class="tool-title">
                       Re-test Date
                   </div>
                </div>
                @foreach($tools as $tool)
                 <div class="tool-wrapper">
                     <div class="tool-name"><a href="{{url('tools/'.$tool -> id)}}">{{$tool -> name}}</a></div>
                     <div class="tool-info"><span class="tool-label">Tag #:</span> {{$tool -> tag_number}}</div>
                     <div class="tool-info"><span class="tool-label">Tool ID #:</span> {{$tool -> id}}</div>
                     <div class="tool-info"><span class="tool-label">Re-test Date:</span>{{$tool -> retag_date -> format("d/m/Y")}}</div>
                 </div>
                 @endforeach
              <!-- super user for both tools -->
              @elseif(Auth::user() -> super == 'Yes')
                <div id="tool-labels" class="hide">
                   <div class="tool-title">
                       Tool Name
                   </div>
                   <div class="tool-title">
                       Tag Number
                   </div>
                   <div class="tool-title">
                       Tool ID Number
                   </div>
                   <div class="tool-title">
                       Re-test Date
                   </div>
                   <div class="tool-title">
                       Job Site
                   </div>
                </div>
                @foreach($tools as $tool)
                 <div class="tool-wrapper">
                     <div class="tool-name"><a href="{{url('tools/'.$tool -> id)}}">{{$tool -> name}}</a></div>
                     <div class="tool-info"><span class="tool-label">Tag #:</span> {{$tool -> tag_number}}</div>
                     <div class="tool-info"><span class="tool-label">Tool ID #:</span> {{$tool -> id}}</div>
                     <div class="tool-info"><span class="tool-label">Re-test Date:</span>{{$tool -> retag_date -> format("d/m/Y")}}</div>
                     <div class="tool-info"><span class="tool-label">Job Site:</span> {{$tool -> user -> site_id}}</div>
                 </div>
                 @endforeach
              <!-- normal user for personal tools -->
              @else
                <div id="tool-labels" class="hide">
                   <div class="tool-title">
                       Tool Name
                   </div>
                   <div class="tool-title">
                       Tag Number
                   </div>
                   <div class="tool-title">
                       Tool ID Number
                   </div>
                   <div class="tool-title">
                       Re-test Date
                   </div>
                </div>
                @foreach($tools as $tool)
                 <div class="tool-wrapper">
                     <div class="tool-name"><a href="{{url('tools/'.$tool -> id)}}">{{$tool -> name}}</a></div>
                     <div class="tool-info"><span class="tool-label">Tag #:</span> {{$tool -> tag_number}}</div>
                     <div class="tool-info"><span class="tool-label">Tool ID #:</span> {{$tool -> id}}</div>
                     <div class="tool-info"><span class="tool-label">Re-test Date:</span>{{$tool -> retag_date -> format("d/m/Y")}}</div>
                 </div>
                 @endforeach 
              @endif
           </div>
       </div>
 @stop