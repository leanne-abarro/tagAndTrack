@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Edit Job Site</h1>
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
       <!-- sites info -->
       <div id="add-area" class="form-wrapper">
           <div class="container">
              <h2>Update site below:</h2>
              <span class="required-text">(*) Required Fields</span>
              {!! Form::model($site, ['url' => 'sites/'.$site -> id, 'id' => 'add-form','method' => 'put']) !!}
                    <div class="field-type">
                      {!! Form::label('name', 'Site Name *', array('class' => 'field-labels')) !!}
                      {!! Form::text('name') !!}
                      {!! $errors -> first('name','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                    </div>
                    <div class="field-type">
                      {!! Form::label('address', 'Address *', array('class' => 'field-labels')) !!}
                      {!! Form::text('address') !!}
                      {!! $errors -> first('address','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                    </div>
                    <div class="field-type">
                      {!! Form::label('contact_person', 'Contact Person *', array('class' => 'field-labels')) !!}
                      {!! Form::text('contact_person') !!}
                      {!! $errors -> first('contact_person','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                    </div>
                    <div class="field-type">
                      {!! Form::label('contact_number', 'Contact Number *', array('class' => 'field-labels')) !!}
                      {!! Form::text('contact_number') !!}
                      {!! $errors -> first('contact_number','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                    </div>
                    <div class="button">
                      {!! Form::submit('Update',["name"=>"submit"])!!}
                    </div>
              {!! Form::close() !!}
           </div>
       </div>
@stop