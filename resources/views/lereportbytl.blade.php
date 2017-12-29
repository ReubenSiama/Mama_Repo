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
					<td>Login Time to ward</td>
					<td>:</td>
					<td>
						@if($loginTimes->login_time_in_ward != NULL)
						{{ $loginTimes->login_time_in_ward }}
						@else
						<form method="post" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addComment">
							{{ csrf_field() }}
						  <div class="input-group">
						    <input type="time" class="form-control" name="loginTimeInWard">
						    <div class="input-group-btn">
						      <button class="btn btn-default" type="submit">Submit</button>
						    </div>
						  </div>
						</form>
						@endif
					</td>
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
				<tr>
					<td>Google tracing image</td>
					<td>:</td>
					<td>
						@if($loginTimes->gtracing == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addTracing" enctype="multipart/form-data">
							<input type="file" class="form-control" accept="image/*" onchange="this.form.submit()" name="gTracing">
							{{ csrf_field() }}
						</form>
						@else
						<img src="{{ URL::to('/') }}/uploads/{{ $loginTimes->gtracing }}" height="100" width="200" class="img img-thumbnail">
						@endif
					</td>
				</tr>
				<tr>
					<td>KM from google H to W</td>
					<td>:</td>
					<td>
						@if($loginTimes->kmfromhtw == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addComment">
							{{ csrf_field() }}
						  <div class="input-group">
						    <input type="text" class="form-control" name="googleKm" placeholder="KM from google">
						    <div class="input-group-btn">
						      <button class="btn btn-default" type="submit">Submit</button>
						    </div>
						  </div>
						</form>
						@else
						{{ $loginTimes->kmfromhtw }}
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
					<td>Ward tracing image</td>
					<td>:</td>
					<td>
						@if($loginTimes->ward_tracing_image == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addTracing" enctype="multipart/form-data">
							<input type="file" class="form-control" accept="image/*" onchange="this.form.submit()" name="wTracingI">
							{{ csrf_field() }}
						</form>
						@else
						<img src="{{ URL::to('/') }}/uploads/{{ $loginTimes->ward_tracing_image }}" height="100" width="200" class="img img-thumbnail">
						@endif
					</td>
				</tr>
				<tr>
					<td>Km from tracking software</td>
					<td>:</td>
					<td>
						@if($loginTimes->km_from_software == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addComment">
							{{ csrf_field() }}
						  <div class="input-group">
						    <input type="text" class="form-control" name="kmfromts" placeholder="KM from google">
						    <div class="input-group-btn">
						      <button class="btn btn-default" type="submit">Submit</button>
						    </div>
						  </div>
						</form>
						@else
						{{ $loginTimes->km_from_software }}
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
					<td>Ward Tracing Image</td>
					<td>:</td>
					<td>
						@if($loginTimes->evening_ward_tracing_image == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addTracing" enctype="multipart/form-data">
							<input type="file" class="form-control" accept="image/*" onchange="this.form.submit()" name="ewTracingI">
							{{ csrf_field() }}
						</form>
						@else
						<img src="{{ URL::to('/') }}/uploads/{{ $loginTimes->evening_ward_tracing_image }}" height="100" width="200" class="img img-thumbnail">
						@endif
					</td>
				</tr>
				<tr>
					<td>Km From tracking software</td>
					<td>:</td>
					<td>
						@if($loginTimes->evening_km_from_tracking == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addComment">
							{{ csrf_field() }}
						  <div class="input-group">
						    <input type="text" class="form-control" name="ekmfromts" placeholder="KM from google">
						    <div class="input-group-btn">
						      <button class="btn btn-default" type="submit">Submit</button>
						    </div>
						  </div>
						</form>
						@else
						{{ $loginTimes->evening_km_from_tracking }}
						@endif
					</td>
				</tr>
				<tr>
					<td>Tracking image from work to home</td>
					<td>:</td>
					<td>@if($loginTimes->tracing_image_w_to_h == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addTracing" enctype="multipart/form-data">
							<input type="file" class="form-control" accept="image/*" onchange="this.form.submit()" name="TracingIWtH">
							{{ csrf_field() }}
						</form>
						@else
						<img src="{{ URL::to('/') }}/uploads/{{ $loginTimes->tracing_image_w_to_h }}" height="100" width="200" class="img img-thumbnail">
						@endif</td>
				</tr>
				<tr>
					<td>Km from work to home</td>
					<td>:</td>
					<td>
						@if($loginTimes->km_from_w_to_h == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addComment">
							{{ csrf_field() }}
						  <div class="input-group">
						    <input type="text" class="form-control" name="ekmwth" placeholder="KM from google">
						    <div class="input-group-btn">
						      <button class="btn btn-default" type="submit">Submit</button>
						    </div>
						  </div>
						</form>
						@else
						{{ $loginTimes->km_from_w_to_h }}
						@endif	
					</td>
				</tr>
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
					<td>Total Projects Listed today</td>
					<td>:</td>
					<td>{{ $loginTimes->TotalProjectsListed }}</td>
				</tr>
				<tr>
					<td>Total Projects Updated today</td>
					<td>:</td>
					<td>{{ $loginTimes->totalProjectsUpdated }}</td>
				</tr>
				<tr>
					<td>Total Kilometers</td>
					<td>:</td>
					<td>
						@if($loginTimes->total_kilometers == NULL)
						<form method="POST" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/addComment">
							{{ csrf_field() }}
						  <div class="input-group">
						    <input type="text" class="form-control" name="totalKilometers" placeholder="Total Kilometers">
						    <div class="input-group-btn">
						      <button class="btn btn-default" type="submit">Submit</button>
						    </div>
						  </div>
						</form>
						@else
							{{ $loginTimes->total_kilometers }}
						@endif
					</td>
				</tr>
				<tr>
					<td>Evening Remarks</td>
					<td>:</td>
					<td>
						@if($loginTimes->eveningRemarks == NULL)
						<form method="post" action="{{ URL::to('/') }}/{{ $loginTimes->id }}/eveningRemark">
							{{ csrf_field() }}
							<textarea required class="form-control" name="eRemark" placeholder="Evening Remarks"></textarea><br>
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