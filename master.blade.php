<!doctype html>

<html lang="en">


<head>  


<meta charset="UTF-8">


<title>TimeShare - @yield('title')</title> 

@include('layouts._partial_include_csScripts')  

</head>


<body onload="">

<div></div>

<div class="appMainHeaderMenu">

<div class="pure-g">

<div class="pure-u-1-5">
<img class="ui avatar image mainAppLogo" src="{{URL::asset('storage/images/logo.png')}}">
</div>

@inject('userURL','App\viewUserInboxMessage')    
@inject('userInformation','App\viewAppUserProfileQueries')


<div class="pure-u-3-5 appHeaderSearchBarHolder">
	@if(Auth::check())

      
  @if(!Request::is(Auth::user()->username.'/feeds'))
  {!! Form::open(['url'=>'mainSearchBar','class'=>'ui appMainSearchForm']) !!}
  <div class="field ui icon input fluid mainSearchBarWrapper" >
  {!! Form::text('appSearchBody',null,['autofill'=>'false','Placeholder'=>'Search','class'=>'mainHeaderSearchBar','autocomplete'=>'off'])!!}
  <i class="search icon link"></i>
  </div>
  {!! Form::close() !!}
  {{--<div class="ui messag appMainSearchResultsDisplay" style="display:none;">--}}
  <div class="ui fluid vertical menu appMainSearchResultsDisplay" style="display:none;">
  <script class="userResultsViewLisTemplate" type="text/x-handlebars-template">
  @{{#each this}}
  <a href="{{url('profile')}}/@{{username this}}" class="item">@{{username this}}</a>
  @{{/each}}
  </script>
  </div>
  @endif

  @if(Request::is(Auth::user()->username.'/feeds'))
  {!! Form::open(['url'=>'mainSearchBar','class'=>'ui appMainSearchForm']) !!}
  <div class="mainSearchPadding"></div>
  <div class="right item search-header-item">
  <div class="ui fluid action input" id="header-search-form">
  {!! Form::text('appSearchBody',null,['autofill'=>'false','Placeholder'=>'Search','class'=>'mainHeaderSearchBarFeeds'])!!}
  
  <div tabindex="0" class="ui compact selection dropdown" >
  <select >
  <option value="all" >All</option>
  <option value="Blogs">Blogs</option>
  <option value="People">People</option>
  <option value="Polls">Polls</option>
  <option value="Events">Events</option>
  <option value="Classifieds">Classifieds</option>
  </select>
  <i class="dropdown icon"></i>
  <div class="text">All</div>
  <div tabindex="-1" class="menu" >
  <div class="item" data-value="all">All</div>
  <div class="item" data-value="Blogs">Blogs</div>
  <div class="item" data-value="People">People</div>
  <div class="item" data-value="Polls">Polls</div>
  <div class="item" data-value="Events">Events</div>
  <div class="item" data-value="Classifieds">Classifieds</div>
  </div>
  </div>

  {{--<div class="ui button teal">Search</div>--}}

  </div>
  </div>
  {!! Form::close() !!}
  @endif
  

  {{--</div>--}}

    @endif
</div>

<div class="pure-u-1-5">
@if(Auth::check())
<div class="userMainNavMenu">

@if($userInformation->returnUserInformation(Auth::user()->id)->activation!=(0||null))	
<div class="ui inline dropdown">
@else
<div class="ui inline dropdown disabled">
@endif

<div class="text">
@if($userInformation->returnUserInformation(Auth::user()->id)->profileImage!=(0||null))        
<img class="ui image avatar " src="{{URL::asset('storage/images/profiles/'.$authorprofileImage = DB::table('userprofiles')->where('userID', Auth::user()->id )->value('profileImage') )}}">
@else
<img  class="ui image avatar " src="{{URL::asset('storage/images/user.png')}}" >
@endif 
{{ Auth::user()->username}}
</div>
<i class="dropdown icon"></i>
<div class="menu">
<a class="item"  href="{{url(Auth::user()->username.'/feeds')}}"><i class="newspaper icon"></i>NewsFeeds</a>
@if(!Request::is(Auth::user()->username.'/profile'))
<a class="item"  href="{{url(Auth::user()->username.'/profile')}}"><i class="user icon"></i>MyProfile</a>
@endif
<a class="item"  href="{{url(Auth::user()->username.'/inbox')}}"><i class="inbox icon"></i>Inbox</a>
<a class="item"  href="{{url(Auth::user()->username.'/resources')}}"><i class="book icon"></i>My Resources</a>
<h4 class="ui header divider"></h4>
{{--<a class="item"  href="{{url(Auth::user()->username.'/findfriends')}}"><i class="users icon"></i>Find Friends</a>--}}
<a class="item"  href="{{url('admin')}}"><i class="book icon"></i>Admin</a>
<a class="item"  href="{{url(Auth::user()->username.'/logout')}}"><i class="sign out icon"></i>Logout</a>
</div>
</div>
</div>
@else


<div class="userMainMenuNavLoginButton">
<div class="ui buttons small">
<a  href="{{url('/SignIn')}}"class="ui button"><i class="spy icon"></i>Login</a>
<div class="ui floating dropdown icon button">
<i class="dropdown icon"></i>
<div class="menu">
<a href="{{url('/Registration')}}"class="item"><i class="add user icon"></i> Sign Up</a>
<a class="item"><i class="text telephone icon"></i> Contact Us</a>
<a class="item"><i class="file text icon"></i> About Us</a>
</div>
</div>
</div>

</div>


@endif

</div>
</div>

</div>


@if(Session::has('FlashMessage'))
<div id="server-notification-message" style="position:fixed;" class="{{Session::has('MessageClass') ? Session::get('MessageClass') : 'ui visible message' }}">{{Session::get('FlashMessage')}}</div>
@endif

<div class="MainContentTransitionHolder mainContentHolder">
	
@if(Auth::check())	
@include('layouts._userProfileQuickAccessButton')
@endif

@if(Auth::check())
<div class="appMainWrapper">
@endif

@yield('content')


@if(Auth::check())
</div>
@endif
</div>


@yield('footer')  

</body>
@include('layouts._partial_include_jScripts')

   

</html>		