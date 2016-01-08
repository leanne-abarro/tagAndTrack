@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Edit Tool</h1>
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
       <div id="tooledit-area" class="form-wrapper">
           <div class="container">
               <h2>Update tool below:</h2>
               <span class="required-text">(*) Required Fields</span>
               {!! Form::model($tool, ['url' => 'tools/'.$tool -> id, 'id' => 'edit-tool-form', 'method' => 'put']) !!} 
                  <div class="field-type2">
                      {!! Form::label('name', 'Tool Name *', array('class' => 'field-labels')) !!}
                      {!! Form::text('name') !!}
                      {!! $errors -> first('name','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="field-type">
                      @if(Auth::user() -> admin == 'Yes' || Auth::user() -> super == 'Yes' )
                      {!! Form::label('type', 'Type *', array('class' => 'field-labels')) !!}
                      {!! Form::select('type', ['Personal' => 'Personal','Company' => 'Company'],null) !!}
                      {!! $errors -> first('type','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                      @else
                      {!! Form::label('type', 'Type *', array('class' => 'field-labels')) !!}
                      {!! Form::select('type', ['Personal' => 'Personal'],null) !!}
                      {!! $errors -> first('type','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                      @endif
                  </div>
                  <div class="field-type">
                      {!! Form::label('tag_number', 'Tag Number', array('class' => 'field-labels')) !!}
                      {!! Form::text('tag_number') !!}
                      {!! $errors -> first('tag_number','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="field-type">
                      {!! Form::label('plant_number', 'Plant Number', array('class' => 'field-labels')) !!}
                      {!! Form::text('plant_number') !!}
                      {!! $errors -> first('plant_number','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="field-type">
                      {!! Form::label('serial_number', 'Serial Number', array('class' => 'field-labels')) !!}
                      {!! Form::text('serial_number') !!}
                      {!! $errors -> first('serial_number','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  @if(Auth::user() -> site_id != NULL)
                  <div class="field-type">
                    {!! Form::label('site_id', 'Site', array('class' => 'field-labels')) !!}
                    {!! Form::select('site_id', Auth::user()->sites()->lists("name","id"),$tool->user->site_id) !!}
                  </div>
                  @endif
                  <div class="field-type">
                    {!! Form::label('tech_name', 'Serviced By (Full Name of Technician)', array('class' => 'field-labels')) !!}
                    {!! Form::text('tech_name', $tool->technician ? $tool->technician->tech_name : "", array("class"=>"techname")) !!}
                    {!! $errors -> first('tech_name','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="field-type">
                    {!! Form::label('tech_company', 'Service Company', array('class' => 'field-labels')) !!}
                    {!! Form::text('tech_company',$tool->technician ? $tool -> technician -> tech_company:"", array("class"=>"techcompany")) !!}
                    {!! $errors -> first('tech_company','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="field-type">
                      {!! Form::label('contact_number', 'Service Contact Number', array('class' => 'field-labels')) !!}
                    {!! Form::text('contact_number',$tool->technician ? $tool -> technician -> contact_number : "", array("class"=>"technumber")) !!}
                    {!! $errors -> first('contact_number','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="field-type">
                    {!! Form::label('serviced_date', 'Tested Date *', array('class' => 'field-labels')) !!}
                    {!! Form::text('serviced_date', $tool->serviced_date->format("d/m/Y") ,array('class' => 'cal')) !!}
                    {!! $errors -> first('serviced_date','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="field-type">
                    {!! Form::label('retag_date', 'Re-test Date *', array('class' => 'field-labels')) !!}
                    {!! Form::text('retag_date',$tool->retag_date->format("d/m/Y") ,array('class' => 'cal')) !!}
                    {!! $errors -> first('retag_date','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                  </div>
                  <div class="button">
                      {!! Form::submit('Update',["name"=>"submit"])!!}
                  </div>
                {!! Form::close() !!} 
           </div>
       </div>
@stop