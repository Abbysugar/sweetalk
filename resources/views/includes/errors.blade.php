@if (count($errors))

	<div class="form-group">

		<div class="alert alert-danger">

			<ul>
				@foreach ($errors->all() as $error)		

					<li>{{ $error }}</li>

				@endforeach	
			</ul>

		</div>

	</div>

@endif

@if (Session::has('message'))
	<div class="form-group">

		<div class="alert alert-success">

			{{ Session::get('message')}}

		</div>

	</div>
@endif