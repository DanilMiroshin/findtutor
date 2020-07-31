@extends('layouts.app')
@section('custom-styles')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/search.js') }}"></script>
@endsection
@section('content')
	  	<div class ='container-fluid'>
	  		<h4 class='display-4'>@lang('views.search.title')</h4>
	  		<div class='container'>
	  			<form method = 'GET' action='/search/find'>
	  				@if (\Session::has('success'))
						<div class="alert alert-success">
							{!! \Session::get('success') !!}
						</div>
					@endif
	  				@if ($errors ->any())
		  				<div class="alert alert-danger" role="alert">
							@foreach ($errors->all() as $error)
								{{$error.' '}}
							@endforeach
						</div>
					@endif
					<div class="form-row">
						<div class="col-3">
							<input type="text" class="form-control" name='subject' placeholder="@lang('views.search.form_subject')" required autofocus>
						</div>
						<div class="col-5 text-dark text-aling-center pt-2">
							<label class='font-weight-bold text-black'>@lang('views.search.form_price')</label>
							<input type="range" name='range' class="range-field w-50" id="priceRange" min="0" max="3000">
							<span class="font-weight-bold text-black ml-2 valueRange"></span>
						</div>
						<div class="col-3">
							<button type="submit" class="btn btn-success btn-block">@lang('views.search.find')</button>
						</div>
					</div>
				</form>
	  		</div>
		</div>
		<div class='container pt-4'>
			@if(isset($results))
				@if($results -> isNotEmpty())
					@foreach ($results as $result)
					<div class='search-result mt-2 mb-4 pb-2'>
						<div class="row mt-4">
							<div class="col-4">
								<div class="avatar mx-auto p-4">
									<img src="{{ asset( $result -> path_to_avatar ) }}" class="rounded-circle z-depth-1" alt="worker-img">
								</div>
							</div>
							<div class="col-8">
								<div class="row text-white">
									<p class="display-4">{{ $result -> first_name }}</p>
								</div>
								<div class="row">
									<p class="lead">@lang('views.search.age') {{ $result -> age }}</p>
								</div>
								<div class="row">
									<p class="lead">@lang('views.search.subject') {{ $result -> subject }}</p>
								</div>
								<div class="row">
									<p class="lead">Skype: {{ empty($result->skype) ? '-' : '+'  }}</p>
								</div>
								<div class="row">
									<p class="lead">@lang('views.search.price') {{ $result->price }} р.</p>
								</div>
								<form method ='post' action="/lesson/create">
									@csrf
									<input type="text" name="id" value='{{$result->user_id}}' hidden>
									<div class="row">
										<button type="submit" class="btn btn-success">@lang('views.search.sign_up')</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					@endforeach		
					{{ $results->appends(request()->query())->links() }}			
				@else 
					<h1 class='display-3'> @lang('views.search.no_results')</h1>
				@endif
			@else
				<h1 class='display-4'> @lang('views.search.enter_search')</h1>
			@endif
		</div>
@endsection

