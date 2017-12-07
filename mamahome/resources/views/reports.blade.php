@extends('layouts.app')

@section('content')

<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading">Report of {{ $loginTimes->logindate }}</div>
		<div class="panel-body">
			Login Time: {{ $loginTimes->loginTime }}<br>
			No. Of Projects Listed:
		</div>
	</div>
</div>

@endsection