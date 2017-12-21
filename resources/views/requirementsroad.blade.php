@extends('layouts.app')

@section('content')

<div class="col-md-4 col-md-offset-4">
	<div class="panel panel-default">
		<div class="panel-heading">Select Road</div>
		<div class="panel-body">
			<ul class="list-group">
				@foreach($roads as $road)
				<li class="list-group-item"><a href="{{ URL::to('/') }}/{{ $road }}/projectrequirement">{{ $road }}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection