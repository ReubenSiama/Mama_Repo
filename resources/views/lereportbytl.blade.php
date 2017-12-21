@extends('layouts.app')

@section('content')

<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			@if($loginTimes)
			Report of {{ $loginTimes->logindate }}
			@else
			User may have failed to log in today
			@endif
			@if(session('Error'))
			<div class="alert-danger pull-right">{{ session('Error') }} </div>
			@endif
		</div>
		<div class="panel-body">
			<div class="row">
				<form method="GET" action="{{ URL::to('/') }}/{{ $userId }}/viewReport">
					<div class="col-md-3">
						Choose Date:
					</div>
					<div class="col-md-4">
						<input required type="date" name="date" class="form-control input-sm">
					</div>
					<div>
						<button type="submit">Submit</button>
					</div>
				</form>
			</div>
			<br>
			@if($loginTimes)
			<label>Morning</label>
			<table class="table">
				<tr>
					<td>Login Time</td>
					<td>:</td>
					<td>{{ $loginTimes->loginTime }}</td>
				</tr>
				<tr>
					<td>Logout Time</td>
					<td>:</td>
					<td>{{ $loginTimes->logoutTime }}</td>
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
					<td>No. of projects listed <br> in the morning</td>
					<td>:</td>
					<td>{{ $loginTimes->noOfProjectsListedInMorning }}</td>
				</tr>
				<tr>
					<td>Remarks</td>
					<td>:</td>
					<td>
					@if($loginTimes->morningRemarks == NULL)
					<form method="post" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/morningRemark">
						{{ csrf_field() }}
						<textarea required class="form-control" name="mRemark"></textarea><br>
						<button class="form-control" type="submit">Save</button>
					</form>
					@else
						{!! nl2br($loginTimes->morningRemarks) !!}
					@endif
					</td>

				</tr>
				<tr>
					<td>Meter Image</td>
					<td>:</td>
					<td>
					    @if($loginTimes->morningMeter != NULL)
						<img src="{{ URL::to('/') }}/public/meters/{{ $loginTimes->morningMeter }}" height="100" width="200" class="img img-thumbnail">
						<a href="{{ URL::to('/') }}/{{ $loginTimes->id }}/deleteReportImage" class="btn btn-danger">Delete</a>
						@endif
					</td>
				</tr>
				<tr>
					<td>Data Image</td>
					<td>:</td>
					<td>
					    @if($loginTimes->morningData != NULL)
					    <img src="{{ URL::to('/') }}/public/data/{{ $loginTimes->morningData }}" height="100" width="200" class="img img-thumbnail">
					    <a href="{{ URL::to('/') }}/{{ $loginTimes->id }}/deleteReportImage2" class="btn btn-danger">Delete</a>
					    @endif
					</td>
				</tr>
			</table>
			<label>Afternoon (12 PM)</label>
			<table class="table">
				<tr>
					<td>Meter Image</td>
					<td>:</td>
					<td>
					    @if($loginTimes->afternoonMeter != NULL)
					    <img src="{{ URL::to('/') }}/public/meters/{{ $loginTimes->afternoonMeter }}" height="100" width="200" class="img img-thumbnail">
					    <a href="{{ URL::to('/') }}/{{ $loginTimes->id }}/deleteReportImage3" class="btn btn-danger">Delete</a>
					    @endif
					 </td>
				</tr>
				<tr>
					<td>Data Image</td>
					<td>:</td>
					<td>
					    @if($loginTimes->afternoonData != NULL)
					    <img src="{{ URL::to('/') }}/public/data/{{ $loginTimes->afternoonData }}" height="100" width="200" class="img img-thumbnail">
					    <a href="{{ URL::to('/') }}/{{ $loginTimes->id }}/deleteReportImage4" class="btn btn-danger">Delete</a>
					    @endif
				    </td>
				</tr>
				<tr>
					<td>Afternoon Remarks</td>
					<td>:</td>
					<td>
				@if($loginTimes->afternoonRemarks == NULL)
					<form method="post" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/afternoonRemark">
						{{ csrf_field() }}
						<textarea required class="form-control" name="aRemark"></textarea><br>
						<button class="form-control" type="submit">Save</button>
					</form>
					@else
						{!! nl2br($loginTimes->afternoonRemarks) !!}
					@endif
					</td>
				</tr>
			</table>
			<label>Evening</label>
			<table class="table">
				<tr>
					<td>Meter Image</td>
					<td>:</td>
					<td>
					    @if($loginTimes->eveningMeter != NULL)
					    <img src="{{ URL::to('/') }}/public/meters/{{ $loginTimes->eveningMeter }}" height="100" width="200" class="img img-thumbnail">
					<a href="{{ URL::to('/') }}/{{ $loginTimes->id }}/deleteReportImage5" class="btn btn-danger">Delete</a>
					@endif
					</td>
				</tr>
				<tr>
					<td>Data Image</td>
					<td>:</td>
					<td>
					    @if($loginTimes->eveningData != NULL)
					    <img src="{{ URL::to('/') }}/public/data/{{ $loginTimes->eveningData }}" height="100" width="200" class="img img-thumbnail">
					<a href="{{ URL::to('/') }}/{{ $loginTimes->id }}/deleteReportImage6" class="btn btn-danger">Delete</a>
					    @endif
					</td>
				</tr>
				<tr>
					<td>Last Listing Time</td>
					<td>:</td>
					<td>{{ $loginTimes->lastListingTime }}</td>
				</tr>
				<tr>
					<td>Total Projects Listed today</td>
					<td>:</td>
					<td>{{ $loginTimes->TotalProjectsListed }}</td>
				</tr>
				<tr>
					<td>Evening Remarks</td>
					<td>:</td>
					<td>
						@if($loginTimes->eveningRemarks == NULL)
						<form method="post" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/eveningRemark">
							{{ csrf_field() }}
							<textarea required class="form-control" name="eRemark"></textarea><br>
							<button class="form-control" type="submit">Save</button>
						</form>
						@else
							{!! nl2br($loginTimes->eveningRemarks) !!}
						@endif
					</td>
				</tr>
			</table>
		</div>
		@endif
	</div>
</div>

@endsection