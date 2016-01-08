@extends('templates.main')
@section('h1')
    <div id="h1-area" class="hide">
           <div class="container">
               <h1>Edit Profile</h1>
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
       <div id="profile-edit-area" class="form-wrapper">
           <div class="container">
              @if(Session::has('old_password_message')) <div class="error-form"> {{Session::get('old_password_message')}} </div> @endif
               <h2>Update profile below:</h2>
               <span class="required-text">(*) Required Fields</span>
               <div id="form1">
                   {!! Form::model($user, ['url' => 'users/'.$user -> id, 'id' => 'edit-personal-profile-form', 'files' => true, 'method' => 'put']) !!} 
                      <div class="image-area">
                          <div class="field-type">
                               <div id="profile-image">
                                   <img src="{{asset('images/'. $user -> image)}}" alt="user-profile-picture" />
                                   {!! Form::label('image', 'Profile Image', array('class' => 'field-labels hide')) !!}
                                   {!! Form::file('image') !!}
                                   {!! $errors -> first('image','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                               </div>
                           </div>
                      </div>
                      <div class="details-area">
                          <div class="field-type">
                                {!! Form::label('firstname', 'First Name *', array('class' => 'field-labels')) !!}
                                {!! Form::text('firstname') !!}
                                {!! $errors -> first('firstname','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                            </div>
                            <div class="field-type">
                                {!! Form::label('lastname', 'Last Name *', array('class' => 'field-labels')) !!}
                                {!! Form::text('lastname') !!}
                                {!! $errors -> first('lastname','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                            </div>
                            <div class="field-type">
                                {!! Form::label('username', 'Username *', array('class' => 'field-labels')) !!}
                                {!! Form::text('username') !!}
                                {!! $errors -> first('lastname','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                            </div>
                            <div class="field-type">
                                {!! Form::label('email', 'Email *', array('class' => 'field-labels')) !!}
                                {!! Form::text('email') !!}
                                {!! $errors -> first('email','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                            </div>
                            <div class="field-type">
                                {!! Form::label('number', 'Contact Number', array('class' => 'field-labels')) !!}
                                {!! Form::text('number', $user -> number ? $user -> number : "") !!}
                                {!! $errors -> first('number','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                            </div>
                            <div class="field-type">
                                {!! Form::label('occupation', 'Occupation', array('class' => 'field-labels')) !!}
                                {!! Form::text('occupation', $user -> occupation ? $user -> occupation : "") !!}
                                {!! $errors -> first('occupation','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                            </div>
                            @if(Auth::user() -> site_id != NULL)
                            <div class="field-type">
                                {!! Form::label('site_id', 'Site', array('class' => 'field-labels')) !!}
                                {!! Form::select('site_id', \App\Models\Site::lists("name","id"),null,['placeholder' => 'Select Job Site']) !!}
                            </div>
                            @endif
                      </div>
                      <div class="button">
                        {!! Form::submit('Update',["name"=>"submit"])!!}
                      </div>
                    {!! Form::close() !!}  
               </div>
               <div id="form2">
                   <h3>Change Password?</h3>
                    {!! Form::open(array('url' => 'users/'.$user->id, 'id' => 'edit-password-form', 'method' => 'put')) !!}
                        <div class="field-type">
                            {!! Form::label('old_password', 'Current Password *', array('class' => 'field-labels hide')) !!}
                            {!! Form::password('old_password',array('placeholder' => 'Current Password *')) !!}
                            {!! $errors -> first('old_password','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                        </div>
                        <div class="field-type">
                            {!! Form::label('password', 'New Password *', array('class' => 'field-labels hide')) !!}
                            {!! Form::password('password',array('placeholder' => 'New Password *')) !!}
                            {!! $errors -> first('password','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                        </div>
                        <div class="field-type">
                            {!! Form::label('password_confirmation', 'Confirm New Password *', array('class' => 'field-labels hide')) !!}
                            {!! Form::password('password_confirmation',array('placeholder' => 'Confirm New Password *')) !!}
                            {!! $errors -> first('password','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                        </div>

                        <div class="button">
                            {!! Form::submit('Change',["name"=>"submit"])!!}
                        </div>
                   {!! Form::close() !!} 
               </div>
                
           </div>
       </div>
@stop
  