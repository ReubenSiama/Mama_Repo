@extends('layouts.app')
@section('content')
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Project List</div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<th>Project Name</th>
							<th>Subward</th>
							<th>Address</th>
							<th>Procurement Name</th>
							<th>Contact No.</th>
							<th>Status</th>
							<th>Action</th>
							<th>With/Without Contractor</th>
						</thead>
						<tbody>
							@foreach($projects as $project)
							<tr>
								<td>{{ $project->project_name }}</td>
								<td>{{ $subwards->sub_ward_name}}</td>
								<td style="width:25%">{{ $project->siteaddress->address }}</td>
								<td>{{ $project->procurementdetails->procurement_name }}</td>
								<td><address>{{ $project->procurementdetails->procurement_contact_no }}</address></td>
								<td>Not Confirmed</td>
								<td><button class="btn btn-sm btn-success">Confirm</button></td>
								<td><select class="form-control">
									<option disabled selected>--- Select ---</option>
									<option>With Contractor</option>
									<option>Without Contractor</option>
								</select>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>{{ $projects->links() }}</center>
				</div>
			</div>
		</div>
	

@endsection