@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $user->name }}'s Report (before 12)</div>
				<div class="panel-body table-responsive">
					<table class="table">
						<tr>
							<th>Login To Ward</th>
							<td>:</td>
							<td>{{ $logintimes->logintime }}</td>
						</tr>
						<tr>
							<th>First Listing</th>
							<td>:</td>
							<td>{{ $logintimes->firstListingTime }}</td>
						</tr>
						<tr>
							<th>First Update</th>
							<td>:</td>
							<td>{{ $logintimes->firstUpdateTime }}</td>
						</tr>
						<tr>
							<th>Allocated Ward(s)</th>
							<td>:</td>
							<td>{{ $logintimes->allocatedWard }}</td>
						</tr>
						<tr>
							<th>No. of projects listed(till 12)</th>
							<td>:</td>
							<td>{{ $logintimes->noOfProjectsListedInMorning }}</td>
						</tr>
						<tr>
							<th>No. of projects updated(till 12)</th>
							<td>:</td>
							<td>{{ $logintimes->noOfProjectsUpdatedInMorning }}</td>
						</tr>
						<tr>
							<th>Meter Image(Morning)</th>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<th>Data Image(Morning)</th>
							<td>:</td>
							<td>
								@if($logintimes->morningData != NULL)
								<a href="{{ URL::to('/public') }}/meter/{{ $logintimes->morningData }}">View</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>Google Tracing Image</th>
							<td>:</td>
							<td>
								@if($logintimes->gtracing != NULL)
								<a href="{{ URL::to('/public') }}/uploads/{{ $logintimes->gtracing }}">View</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>Km from home to work</th>
							<td>:</td>
							<td>{{ $logintimes->kmfromhtw }}</td>
						</tr>
						<tr>
							<th>Remarks (Morning)</th>
							<td>:</td>
							<td>{{ $logintimes->morningRemarks }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $user->name }}'s Report (after 12)</div>
				<div class="panel-body table-responsive">
					<table class="table">
						<tr>
							<th>Ward Tracing Image</th>
							<td>:</td>
							<td>
							@if($logintimes->ward_tracing_image != NULL)
							<a href="{{ URL::to('/public') }}/uploads/{{ $logintimes->ward_tracing_image }}">View</a>
							@endif
							</td>
						</tr>
						<tr>
							<th>KM from tracking sw</th>
							<td>:</td>
							<td>{{ $logintimes->km_from_software }}</td>
						</tr>
						<tr>
							<th>Remarks(Afternoon)</th>
							<td>:</td>
							<td>{{ $logintimes->afternoonRemarks }}</td>
						</tr>
						<tr>
							<th>Meter Image(Evening)</th>
							<td>:</td>
							<td>
								@if($logintimes->eveningMeter != NULL)
								<a href="{{ URL::to('/public') }}/meter/{{ $logintimes->eveningMeter }}">View</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>Data Image(Evening)</th>
							<td>:</td>
							<td>
								@if($logintimes->eveningData != NULL)
								<a href="{{ URL::to('/public') }}/data/{{ $logintimes->eveningData }}">View</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>Google Tracing Image</th>
							<td>:</td>
							<td>
								@if($logintimes->evening_ward_tracing_image != NULL)
								<a href="{{ URL::to('/public') }}/uploads/{{ $logintimes->evening_ward_tracing_image }}">View</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>KM from tacking sw</th>
							<td>:</td>
							<td>{{ $logintimes->evening_km_rom_tracking }}</td>
						</tr>
						<tr>
							<th>Tracking from work to home</th>
							<td>:</td>
							<td>
								@if($logintimes->tracing_image_w_to_h)
								<a href="{{ URL::to('/public') }}/uploads/{{ $logintimes->tracing_image_w_to_h }}">View</a>
								@endif
							</td>
						</tr>
						<tr>
							<th>Last Listing Time</th>
							<td>:</td>
							<td>{{ $logintimes->lastListingTime }}</td>
						</tr>
						<tr>
							<th>Last Update Time</th>
							<td>:</td>
							<td>{{ $logintimes->lastUpdateTime }}</td>
						</tr>
						<tr>
							<th>Evening Remarks</th>
							<td>:</td>
							<td>{{ $logintimes->eveningRemarks }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Remarks & Grades</div>
				<div class="panel-body">
					<form method="POST" action="{{ URL::to('/')}}/{{ $user->id }}/{{ $logintimes->id }}/giveGrade">
					<table class="table">
					<tr>
						<td>Total Projecs Listed</td>
						<td>:</td>
						<td>{{ $logintimes->TotalProjectsListed }}</td>
					</tr>
					<tr>
						<td>Total Projects Updated</td>
						<td>:</td>
						<td>{{ $logintimes->totalProjectsUpdated }}</td>
					</tr>
					<tr>
						<td>Total Kilometers</td>
						<td>:</td>
						<td>{{ $logintimes->total_kilometers }}</td>
					</tr>
					@if($logintimes->AmGrade == NULL && $logintimes->AmRemarks == NULL)
					{{ csrf_field() }}
					<tr>
						<td>Remarks</td>
						<td>:</td>
						<td><textarea required name="remarks" cols="30" rows="3" placeholder="Remarks" class="form-control"></textarea></td>
					</tr>
					<tr>
						<td>Grade</td>
						<td>:</td>
						<td>
						<select required class="form-control">
							<option value="">--</option>
							<option value="A">A</option>
							<option value="B">B</option>
						 		<option value="C">C</option>
							<option value="D">D</option>
						</select>
						</td>
					</tr>
					<tr>
						<td><input type="submit" class="form-control"></td>
					</tr>
					@else
					<tr>
						<td>Remarks</td>
						<td>:</td>
						<td>{{ $logintimes->AmRemarks }}</td>
					</tr>
						<tr>
						<td>Grade</td>
						<td>:</td>
						<td>{{ $logintimes->AmGrade }}</td>
					</tr>
					@endif
					</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection