@extends('layouts.app')

@section('content')

<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading">Report of {{ $loginTimes->logindate }}</div>
		<div class="panel-body">
			
				<label>Morning</label>
				<table class="table">
					<tr>
						<td>Login Time</td>
						<td>:</td>
						<td>{{ $loginTimes->loginTime }}</td>
					</tr>
					<tr>
						<td>Allocated Ward</td>
						<td>:</td>
						<td>{{ $loginTimes->allocatedWard }}</td>
					</tr>
					<tr>
						<td>First Listing Time</td>
						<td>:</td>
						<td>{{ $loginTimes->firstListingTime }}</td>
					</tr>
					<tr>
						<td>First Update Time</td>
						<td>:</td>
						<td>{{ $loginTimes->firstUpdateTime }}</td>
					</tr>
					<tr>
						<td>No. of projects listed <br> in the morning</td>
						<td>:</td>
						<td>{{ $loginTimes->noOfProjectsListedInMorning }}</td>
					</tr>
					<tr>
						<td>No. of projects updated <br> in the morning</td>
						<td>:</td>
						<td>{{ $loginTimes->noOfProjectsUpdatedInMorning }}</td>
					</tr>
					@if($loginTimes->morningMeter != NULL)
					<tr>
						<td>Meter Image</td>
						<td>:</td>
						<td>
							<img src="{{ URL::to('/') }}/meters/{{ $loginTimes->morningMeter }}" height="100" width="200" class="img img-thumbnail">
						</td>
					</tr>
					@endif
					@if($loginTimes->morningData != NULL)
					<tr>
						<td>Data Image</td>
						<td>:</td>
						<td>
							<img src="{{ URL::to('/') }}/data/{{ $loginTimes->morningData }}" height="100" width="200" class="img img-thumbnail">
						</td>
					</tr>
					@endif
				</table>
				@if($loginTimes->morningMeter == NULL)
				<form method="post" action="{{ URL::to('/') }}/addMorningMeter" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="morningCount" value="{{ $projectCount }}">
					<table class="table">		
						<tr>
							<td>Meter Image</td>
							<td>:</td>
							<td><input onchange="this.form.submit()" type="file" accept="image/*" name="morningMeter" class="form-control"></td>
						</tr>
					</table>
				</form>
				@endif
				@if($loginTimes->morningData == NULL)
				<form method="post" action="{{ URL::to('/') }}/addMorningData" enctype="multipart/form-data">
					{{ csrf_field() }}
					<table class="table">		
						<tr>
							<td>Data Image</td>
							<td>:</td>
							<td><input onchange="this.form.submit()" type="file" accept="image/*" name="morningData" class="form-control"></td>
						</tr>
					</table>
				</form>
				@endif
			
			
			<label>Afternoon (12 PM)</label>
			<table class="table">
				@if($loginTimes->afternoonMeter != NULL)
				<tr>
					<td>Meter Image</td>
					<td>:</td>
					<td><img src="{{ URL::to('/') }}/meters/{{ $loginTimes->afternoonMeter }}" height="100" width="200" class="img img-thumbnail"></td>
				</tr>
				@endif
				@if($loginTimes->afternoonData != Null)
				<tr>
					<td>Data Image</td>
					<td>:</td>
					<td><img src="{{ URL::to('/') }}/data/{{ $loginTimes->afternoonData }}" height="100" width="200" class="img img-thumbnail"></td>
				</tr>
				@endif
			</table>
			@if($loginTimes->afternoonMeter == NULL)
			<form method="POST" action="{{ URL::to('/') }}/afternoonMeter" enctype="multipart/form-data">
				{{ csrf_field() }}
				<table class="table">
					<tr>
						<td>Meter Image</td>
						<td>:</td>
						<td><input onchange="this.form.submit()" type="file" accept="image/*" name="afternoonmMeterImage" class="form-control"></td>
					</tr>
				</table>
			</form>
			@endif
			@if($loginTimes->afternoonData == NULL)
			<form method="POST" action="{{ URL::to('/') }}/afternoonData" enctype="multipart/form-data">
				{{ csrf_field() }}
				<table class="table">
						<tr>
							<td>Data Image</td>
							<td>:</td>
							<td><input onchange="this.form.submit()" type="file" accept="image/*" name="afternoonDataImage" class="form-control"></td>
						</tr>
				</table>
			</form>
			@endif
			
			<label>Evening</label>
			<table class="table">
				<tr>
					<td>Last Listing Time</td>
					<td>:</td>
					<td>{{ $loginTimes->lastListingTime }}</td>
				</tr>
				<tr>
					<td>Last Update Time</td>
					<td>:</td>
					<td>{{ $loginTimes->lastUpdateTime }}</td>
				</tr>
				<tr>
					<td>Total Projects Listed</td>
					<td>:</td>
					<td>{{ $loginTimes->TotalProjectsListed }}</td>
				</tr>
				<tr>
					<td>Total Projects Updated</td>
					<td>:</td>
					<td>{{ $loginTimes->totalProjectsUpdated }}</td>
				</tr>
				@if($loginTimes->eveningMeter != NULL)
				<tr>
					<td>Meter Image</td>
					<td>:</td>
					<td><img src="{{ URL::to('/') }}/meters/{{ $loginTimes->eveningMeter }}" height="100" width="200" class="img img-thumbnail"></td>
				</tr>
				@endif
				@if($loginTimes->eveningData != Null)
				<tr>
					<td>Data Image</td>
					<td>:</td>
					<td><img src="{{ URL::to('/') }}/data/{{ $loginTimes->eveningData }}" height="100" width="200" class="img img-thumbnail"></td>
				</tr>
				@endif
			</table>
			@if($loginTimes->eveningMeter == NULL)
			<form method="POST" action="{{ URL::to('/') }}/eveningMeter" enctype="multipart/form-data">
				{{ csrf_field() }}
				<table class="table">
					<tr>
						<td>Meter Image</td>
						<td>:</td>
						<td><input onchange="this.form.submit()" type="file" accept="image/*" name="eveningMeterImage" class="form-control"></td>
					</tr>
				</table>
			</form>
			@endif
			@if($loginTimes->eveningData == Null)
			<form method="POST" action="{{ URL::to('/') }}/eveningData" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="totalCount" value ="{{ $projectCount }}">
				<table class="table">
						<tr>
							<td>Data Image</td>
							<td>:</td>
							<td><input onchange="this.form.submit()" type="file" accept="image/*" name="eveningDataImage" class="form-control"></td>
						</tr>
				</table>
			</form>
			@endif
		</div>
	</div>
</div>

@endsection