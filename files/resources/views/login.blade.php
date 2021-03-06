<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Tag and Track - the easiest online tagged tool management system.">
    <meta name="keywords" content="tag and track, electricians, trades, tradesmen, tools, safety, compliance, plumbers, construction, tool management system">
    
    <!-- view port -->
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- google fonts -->
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- style sheets -->
	<link rel="stylesheet" href="{{asset('css/normalize.css')}}">
	<link rel="stylesheet" href="{{asset('css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">
	
	<!-- date picker files -->
    <link rel="stylesheet" href="{{asset('css/datepicker.css')}}" />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
	<title>Tag and Track</title>
</head>
<body>
    <div class="se-pre-con"></div>
    <main>
        <div class="form-page">
            <!-- logo and tagline area -->
            <div class="form-header">
                <div class="container">
                    <!-- logo -->
                    <div class="login-logo">
                        <img src="{{asset('images/tag-track-logo-white.png')}}" alt="tag-and-track-logo"/>
                    </div>
                    <!-- tag line area -->
                    <span class="by-line">Manage your tagged tools online.</span>
                </div>
            </div>
            <!-- login form area -->
            <div class="form-wrapper">
                <div class="container">
                    @if(Session::has('message-success')) <div class="success-form"> {{Session::get('message-success')}} </div> @endif
                    @if(Session::has('message'))<div class="error-form">{{Session::get('message')}}</div> @endif
                    @if(Session::has('logout-message'))<div class="success-form">{{Session::get('logout-message')}}</div> @endif
                    <h1>Log In Now:</h1>
                    {!! Form::open(array('url' => 'login', 'id' => 'login-form')) !!}
                        <div class="field-type">
                            {!! Form::label('username', 'Username', array('class' => 'field-labels hide')) !!}
                            {!! Form::text('username', '' ,array('placeholder' => 'Username')) !!}
                            {!! $errors -> first('username','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                        </div>
                        <div class="field-type">
                            {!! Form::label('password', 'Password', array('class' => 'field-labels hide')) !!}
                            {!! Form::password('password',array('placeholder' => 'Password')) !!}
                            {!! $errors -> first('password','<p class="error-style"><i class="fa fa-times"></i>:message</p>')!!}
                        </div>
                        <div class="button">
                            {!! Form::submit('log in')!!}
                        </div>
                    {!! Form::close() !!}
                    <p class="login-account-signup">Don't have an account? <a href="{{url('users/create')}}">Sign up for one now.</a></p>
                </div>
            </div>
        </div> 
    </main>
<!-- scripts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
<!-- datepicker -->
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- d3 -->
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="{{asset('js/script.js')}}"></script>

</body>
</html>