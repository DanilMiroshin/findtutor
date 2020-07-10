@extends('layouts.app')
@section('custom-styles')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection
@section('content')
		<div class="languages-block row pl-4 pt-4">			
			<a href="" class="language btn btn-link pl-4">
				<img class='pb-1' src="imgs/icons/rus.png">
				<span class='pl-1 pt-1'>Русский</span>
			</a>
			<a href="" class="btn btn-link">
				<img class='pb-1' src="imgs/icons/uk.png">
				<span class='pl-1 pt-1'>English</span>
			</a>
		</div>
		<div class="container p-5">	
	 		<div class="row">
				<div class="col-xs-12 col-sm-6">
					<h1 class="display-4">@lang('messages.welcome_first_part')<br/>			
						<span class ='orng-spn'>@lang('messages.welcome_second_part')</span>
					</h1>
					<p class="text-description">@lang('messages.description')</p>
					<button class='btn-start' onclick="location.href='/search'" >@lang('messages.start')</button>
				</div>
	    		<div class="col-xs-12 col-sm-6">
					<img class='img-responsive' src="imgs/icons/main.png">
	    		</div>
	  		</div>
		</div>
		@if($teachers -> isNotEmpty())
		  	<div class ='container-fluid'>
		  		<h1 class='display-3'><span class='about-us-header'>@lang('messages.our_teachers')</span></h1>
				<div class="row pb-4">
					@foreach ($teachers as $teacher)
					    <div class="col-lg-3 col-md-6 mb-lg-0 mb-5" id='worker-block'>
					   		<div class="avatar mx-auto">
						    	<img src="{{ $teacher->path_to_avatar }}" class="rounded-circle z-depth-1" alt="worker-img">
					    	</div>
					    	<h5 class="font-weight-bold mt-4 mb-3">{{ $teacher->first_name }}</h5>
					    	<p class="text-uppercase">{{ $teacher->getTeacherInfo->subject }}</p>
					    	<p>
					    		<form method ='post' action="/lesson/create">
									@csrf
									<input type="text" name="id" value='{{$teacher->id}}' hidden>
									<button type="submit" class="btn btn-success">@lang('messages.sign_up')</button>
								</form>
					    	</p> 	
					    </div>
				    @endforeach
				</div>
		  	</div>
	  	@endif
	  	<div class ='advantages mb-4'>
	  		<h1 class='display-2 pb-4'>@lang('messages.advantages')</h1>
			<div class="row">
			    <div class="col-lg-3 col-md-6 mb-lg-0 mb-5">
			   		<div class="avatar mx-auto">
				    	<img src="imgs/icons/study-home.png">
			    	</div>
					<h5 class="mt-4 mb-3"><strong>@lang('messages.adv_first')</strong></h5>
					<p class="text-uppercase">@lang('messages.adv_first_desc')</p>
			    </div>
				<div class="col-lg-3 col-md-6 mb-lg-0 mb-5">
					<div class="avatar mx-auto">
						<img src="imgs/icons/research.png">
					</div>
					<h5 class="mt-4 mb-3"><strong>@lang('messages.adv_second')</strong></h5>
					<p class="text-uppercase">@lang('messages.adv_second_desc')</p>
			    </div>
			    <div class="col-lg-3 col-md-6 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="imgs/icons/tutor.png">
					</div>
					<h5 class="mt-4 mb-3"><strong>@lang('messages.adv_third')</strong></h5>
					<p class="text-uppercase">@lang('messages.adv_third_desc')</p>
			    </div>
			    <div class="col-lg-3 col-md-6">
					<div class="avatar mx-auto">
						<img src="imgs/icons/speak.png">
					</div>
					<h5 class="mt-4 mb-3"><strong>@lang('messages.adv_fourth')</strong></h5>
					<p class="text-uppercase">@lang('messages.adv_fourth_desc')</p>
			    </div>
			</div>
	  	</div>
@endsection
