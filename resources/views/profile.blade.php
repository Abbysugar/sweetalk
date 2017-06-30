@extends ('layouts.app')

@section('title', 'Profile')

@section('content')
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header><h3> Your Profile </h3></header>
			<form action="{{ route('saveprofile') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="name"> Name </label>
					<input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
				</div>
				<div class="form-group">
					<label for="image"> Image (.jpg) </label>
					<input type="file" name="image" class="form-control" id="name">
				</div>
				<button type="submit" class="btn btn-primary"> Save Profile </button>
			</form>
		</div>
	</section>
	<!-- @if ($user->image != NULL) -->
		<section class="row new-post">
			<div class="col-md-6 col-md-offset-3">
				<img src="uploads/{{ $user->image }}" alt="" class="img-responsive">	
			</div>
		</section>
	<!-- @endif -->
@endsection