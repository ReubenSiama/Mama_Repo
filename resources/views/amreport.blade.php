@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">{{ $user->name }}'s Report</div>
			<div class="panel-body table-responsive">
					<table class="table">
						<thead>
							<th>Date</th>
							<th>Login To ward</th>
							<th>First Listing</th>
							<th>First Update</th>
							<th>Allocated Ward(s)</th>
							<th>No. of projects listed(till 12)</th>
							<th>No. of projects updated(till 12)</th>
							<th>Meter Image(Morning)</th>
							<th>Data Image(Morning)</th>
							<th>Google Tracing Image</th>
							<th>Km from home to work</th>
							<th>Remarks (Morning)</th>
							<th>Meter Image(Afternoon)</th>
							<th>Data Image(Afternoon</th>
							<th>Ward Tracing Image</th>
							<th>KM from tracking sw</th>
							<th>Remarks(Afternoon)</th>
							<th>Meter Image(Evening)</th>
							<th>Data Image(Evening)</th>
							<th>Ward Tracing(Evening)</th>
							<th>KM from tacking sw</th>
							<th>Tracking from work to home</th>
							<th>Last Listing Time</th>
							<th>Last Update Time</th>
							<th>Total Projects Listed</th>
							<th>Total Projects Updated</th>
							<th>Total Kilometers</th>
							<th>Remarks(Evening)</th>
							<th>Grades</th>
						</thead>
						<tbody>
							@foreach($logintimes as $time)
							<tr>
								<td>{{ $time->logindate }}</td>
								<td>{{ $time->loginTime }}</td>
								<td>{{ $time->firstListingTime }}</td>
								<td>{{ $time->firstUpdateTime }}</td>
								<td>{{ $time->allocatedWard }}</td>
								<td>{{ $time->noOfProjectsListedInMorning }}</td>
								<td>{{ $time->noOfProjectsUpdatedInMorning }}</td>
								<td><a href="{{ URL::to('/public') }}/meter/{{ $time->morningMeter }}">View</a></td>
								<td><a href="{{ URL::to('/public') }}/data/{{ $time->morningData }}">View</a></td>
								<td><a href="{{ URL::to('/public') }}/uploads/{{ $time->gtracing }}">View</a></td>
								<td>{{ $time->kmfromhtw }}</td>
								<td>{{ $time->morningRemarks }}</td>
								<td><a href="{{ URL::to('/public') }}/meter/{{ $time->afternoonMeter }}">View</a></td>
								<td><a href="{{ URL::to('/public') }}/data/{{ $time->afternoonData }}">View</a></td>
								<td><a href="{{ URL::to('/public') }}/uploads/{{ $time->ward_tracing_image }}">View</a></td>
								<td>{{ $time->km_from_software }}</td>
								<td>{{ $time->afternoonRemarks }}</td>
								<td><a href="{{ URL::to('/public') }}/meter/{{ $time->eveningMeter }}">View</a></td>
								<td><a href="{{ URL::to('/public') }}/data/{{ $time->eveningData }}">View</a></td>
								<td><a href="{{ URL::to('/public') }}/uploads/{{ $time->evening_ward_tracing_image }}">View</a></td>
								<td>{{ $time->evening_km_from_tracking }}</td>
								<td><a href="{{ URL::to('/public') }}/uploads/{{ $time->tracing_image_w_to_h }}">View</a></td>
								<td>{{ $time->lastListingTime }}</td>
								<td>{{ $time->lastUpdateTime }}</td>
								<td>{{ $time->TotalProjectsListed }}</td>
								<td>{{ $time->totalProjectsUpdated }}</td>
								<td>{{ $time->total_kilometers }}</td>
								<td>{{ $time->eveningRemarks }}</td>
								<td>
									@if($time->AmGrade == NULL)
									<form method="POST" action="{{ URL::to('/')}}/{{ $user->id }}/{{ $time->id }}/giveGrade">
										{{ csrf_field() }}
										<select required class="form-control" name="grade" onchange="this.form.submit()">
											<option value="">--</option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
											<option value="D">D</option>
										</select>
									</form>
									@else
									{{ $time->AmGrade }}
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
		
@endsection