        @extends('layouts.master')

        @section('title')
        Profile
        @stop

        @section('content')

        @inject('userInformation','App\viewAppUserProfileQueries') 
        <div class="container" id="crop-avatar">

        <div class="pure-g boundary">

        <div class="pure-u-1-5">

        </div>

        <div href="{{url('profile')}}" class="pure-u-3-5 grid-padding-sides postsContainer">


        @include('pages.profile._userProfileCard')


        <div class="app-feeds-main-content">
        @if(count($userInformation->checkIfFollowing(Auth::user()->id,$information['profiles']->userID))!=0||$information['profiles']->userID==Auth::user()->id)
      
        @foreach($information['postInformation'] as $postInformation)

        @if(count($postInformation->pictures))  
        @include('pages.profile._userProfilePostPictures')
        @endif

        @if(count($postInformation->pictures)==0)  
        @include('pages.profile._userProfilePostText')
        @endif 

        @endforeach

        @else

        <h2 class="ui icon header center aligned ">
        <i class="ui lock icon huge grey"></i></span>
        <div class="content">
        Private
        <div class="sub header">You can only view {{$information['profiles']->username}}'s posts when they accept your request.</div>
        </div>
        </h2>


        
        @endif
        </div>
        

        </div>

        <div class="pure-u-1-5 boundarySection">
        </div>



        </div>


        </div>
        @stop