@extends('layouts.app')
@section('content')
		<div class="col-md-12">
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
							<th>Email id</th>
							
							<th>With/Without Contractor</th>
						</thead>
						<tbody>
							@foreach($projects as $project)
							<tr>
								<td>{{ $project->project_name }}{{$project->project_id}}</td>
								<td>{{ $subwards->sub_ward_name }}</td>
								<td style="width:25%">{{ $project->siteaddress->address }}</td>
								<td>{{ $project->procurementdetails->procurement_name }}</td>
								<td><address>{{ $project->procurementdetails->procurement_contact_no }}</address></td>
								<td id="conf{{$project->project_id}}">
									{{$project->status}}
								</td>
								<td>
									<button id="btn-{{$project->project_id}}" class="btn btn-sm btn-success" onclick="confirmstatus('{{$project->project_id}}')">Confirm</button>
								</td>
								
								@if($project->with_cont == 'null')
								<td>
									<select class="form-control" id="select-{{$project->project_id}}" onchange="confirmthis('{{$project->project_id}}')">
										<option disabled selected>--- Select ---</option>
										<option value="With Contractor">With Contractor</option>
										<option value="Without Contractor">Without Contractor</option>
									</select>
								</td>
								@endif
								@if($project->with_cont == 'With Contractor')
								<td>
									<select class="form-control" id="select-{{$project->project_id}}" onchange="confirmthis('{{$project->project_id}}')">
										<option disabled >--- Select ---</option>
										<option value="With Contractor" selected>With Contractor</option>
										<option value="Without Contractor">Without Contractor</option>
									</select>
								</td>
								@endif
								@if($project->with_cont == 'Without Contractor')
								<td>
									<select class="form-control" id="select-{{$project->project_id}}" onchange="confirmthis('{{$project->project_id}}')">
										<option disabled >--- Select ---</option>
										<option value="With Contractor" >With Contractor</option>
										<option value="Without Contractor" selected>Without Contractor</option>
									</select>
								</td>
								@endif
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
	<script type="text/javascript">
		function confirmthis(arg)
		{
			var e = document.getElementById("select-"+arg);
			var opt = e.options[e.selectedIndex].value;
			var x = confirm('Are You Sure ?');
			if(x){
				$.ajax({
					type: 'get',
					url: "{{URL::to('/')}}/"+arg+"/confirmthis",
					data: {opt: opt},
					async: false,
					success: function(response)
					{
						location.reload(true);
					}
				});
			}
			return false;
		}

		function confirmstatus(arg){
			var x = confirm('Are You Sure To Confirm Status ?');
			if(x)
			{
				$.ajax({
					type: 'get',
					url: "{{URL::to('/')}}/"+arg+"/confirmstatus",
					data: {opt: arg},
					async: false,
					success: function(response)
					{
						location.reload(true);
					}
				});

			}

		}
	</script>

@endsection