@extends('layouts.app')
@section('content')
		<div class="col-md-12">
			<div class="panel panel-default" style="overflow: scroll;">
				<div class="panel-heading">Project List</div>	
				<div class="panel-body">
					<table class="table table-hover table-striped">
						<thead>
							<th>Project Name</th>
							<th>Subward</th>
							<th style="width:15%">Address</th>
							<th>Procurement Name</th>
							<th>Contact No.</th>
							<th>Status</th>
							<th>Action</th>
							<th style="width:8%">Status </th>
							<th style="width:8%">Location </th>
							<th>Materials </th>
							<th>Requirement Date</th>
							<th>Questions</th>
						</thead>
						<tbody>
							@foreach($projects as $project)
							<tr>
								<td>{{ $project->project_name }}</td>
								<td>{{ $subwards->sub_ward_name }}</td>
								<td>{{ $project->siteaddress->address }}</td>
								<td>{{ $project->procurementdetails->procurement_name }}</td>
								<td><address>{{ $project->procurementdetails->procurement_contact_no }}</address></td>
								<td id="conf{{$project->project_id}}">{{$project->status}}</td>
								<td>
									@if($project->project_status == 'null')
									<button id="btn-{{$project->project_id}}" class="btn btn-sm btn-success" onclick="confirmstatus('{{$project->project_id}}')">Confirm</button>
									@else
									<button id="btn-{{$project->project_id}}" disabled title="Already Confirmed" class="btn btn-sm btn-success" onclick="confirmstatus('{{$project->project_id}}')">Confirm</button>
									@endif
								</td>
								<td>
									<select class="form-control" style="width: 100%" id="statusproj-{{$project->project_id}}" onchange="updatestatus('{{$project->project_id}}')">
										<option disabled selected>Select</option>
                                        <option value="Planning" {{ $project->status == 'Planning'? 'selected':''}}>Planning</option>
                                        <option value="Digging" {{ $project->status == 'Digging'? 'selected':''}}>Digging</option>
                                        <option value="Foundation" {{ $project->status == 'Foundation'? 'selected':''}}>Foundation</option>
                                        <option value="Pillars" {{ $project->status == 'Pillars'? 'selected':''}}>Pillars</option>
                                        <option value="Walls" {{ $project->status == 'Walls'? 'selected':''}}>Walls</option>
                                        <option value="Roofing" {{ $project->status == 'Roofing'? 'selected':''}}>Roofing</option>
                                        <option value="Electrical & Plumbing" {{ $project->status == 'Electrical & Plumbing'? 'selected':''}}>Electrical &amp; Plumbing</option>
                                        <option value="Plastering" {{ $project->status == 'Plastering'? 'selected':''}}>Plastering</option>
                                        <option value="Flooring" {{ $project->status == 'Flooring'? 'selected':''}}>Flooring</option>
                                        <option value="Carpentry" {{ $project->status == 'Carpentry'? 'selected':''}}>Carpentry</option>
                                        <option value="Paintings" {{ $project->status == 'Paintings'? 'selected':''}}>Paintings</option>
                                        <option value="Fixtures" {{ $project->status == 'Fixtures'? 'selected':''}}>Fixtures</option>
                                        <option value="Completion" {{ $project->status == 'Completion'? 'selected':''}}>Completion</option>
									</select>
								</td>
								<td>
									<input type="text" class="form-control" id="location-{{$project->project_id}}" onblur="updatelocation('{{$project->project_id}}')" value="{{$project->location}}" name="">
								</td>
								<td>
									<input type="text" class="form-control" id="mat-{{$project->project_id}}" onblur="updatemat('{{$project->project_id}}')" name="">
								</td>
								<td>
									<input style="width:100%" type="date" onblur="checkdate('date-{{$project->project_id}}')" class="form-control" id="date-{{$project->project_id}}" name="">
								</td>
								<td>
									<select style="width: 100%" class="form-control" id="select-{{$project->project_id}}" onchange="confirmthis('{{$project->project_id}}')">	
									@if($project->with_cont == 'null')
										<option disabled selected>--- Select ---</option>
										<option value="NOT INRESTED">NOT INRESTED</option>
										<option value="WRONG NO">WRONG NO</option>
										<option value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option value="CALL BACK LATER">CALL BACK LATER</option>
										<option value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option value="FINISHING">FINISHING</option>
									@elseif($project->with_cont == 'NOT INTERESTED')
										<option disabled selected>--- Select ---</option>
										<option selected value="NOT INRESTED">NOT INRESTED</option>
										<option value="WRONG NO">WRONG NO</option>
										<option value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option value="CALL BACK LATER">CALL BACK LATER</option>
										<option value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option value="FINISHING">FINISHING</option>
									@elseif($project->with_cont == 'WRONG NO')
										<option disabled selected>--- Select ---</option>
										<option value="NOT INRESTED">NOT INRESTED</option>
										<option selected value="WRONG NO">WRONG NO</option>
										<option value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option value="CALL BACK LATER">CALL BACK LATER</option>
										<option value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option value="FINISHING">FINISHING</option>
									@elseif($project->with_cont == 'PROJECT CLOSED')
										<option disabled selected>--- Select ---</option>
										<option value="NOT INRESTED">NOT INRESTED</option>
										<option value="WRONG NO">WRONG NO</option>
										<option selected value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option value="CALL BACK LATER">CALL BACK LATER</option>
										<option value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option value="FINISHING">FINISHING</option>
									@elseif($project->with_cont == 'CALL BACK LATER')
										<option disabled selected>--- Select ---</option>
										<option value="NOT INRESTED">NOT INRESTED</option>
										<option value="WRONG NO">WRONG NO</option>
										<option value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option selected value="CALL BACK LATER">CALL BACK LATER</option>
										<option value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option value="FINISHING">FINISHING</option>
									@elseif($project->with_cont == 'DEY LL CALL BACK WEN REQUIRED')
										<option disabled selected>--- Select ---</option>
										<option value="NOT INRESTED">NOT INRESTED</option>
										<option value="WRONG NO">WRONG NO</option>
										<option value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option value="CALL BACK LATER">CALL BACK LATER</option>
										<option selected value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option value="FINISHING">FINISHING</option>
									@elseif($project->with_cont == 'CALL NOT ANSWERED')
										<option disabled selected>--- Select ---</option>
										<option value="NOT INRESTED">NOT INRESTED</option>
										<option value="WRONG NO">WRONG NO</option>
										<option value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option value="CALL BACK LATER">CALL BACK LATER</option>
										<option value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option selected value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option value="FINISHING">FINISHING</option>
									@else
										<option disabled selected>--- Select ---</option>
										<option value="NOT INRESTED">NOT INRESTED</option>
										<option value="WRONG NO">WRONG NO</option>
										<option value="PROJECT CLOSED">PROJECT CLOSED</option>
										<option value="CALL BACK LATER">CALL BACK LATER</option>
										<option value="DEY LL CALL BACK WEN REQUIRED">DEY LL CALL BACK WEN REQUIRED</option>
										<option value="CALL NOT ANSWERED">CALL NOT ANSWERED</option>
										<option selected value="FINISHING">FINISHING</option>
									@endif
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
	<script type="text/javascript">
		function confirmthis(arg)
		{
			
			var x = confirm('Are You Sure ?');
			if(x){
				var e = document.getElementById("select-"+arg);
				var opt = e.options[e.selectedIndex].value;
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

		function checkdate(arg)
		{
			var today 	     = new Date();
			var day 	  	 = (today.getDate().length ==1?"0"+today.getDate():today.getDate()); //This line by Siddharth
			var month 	  	 = parseInt(today.getMonth())+1;
			month 	  	     = (today.getMonth().length == 1 ? "0"+month : "0"+month);
			var e 			 = parseInt(month);  //This line by Siddharth
			var year 	  	 = today.getFullYear();
			var current_date = new String(year+'-'+month+'-'+day);
		
			//Extracting individual date month and year and converting them to integers
			var val = document.getElementById(arg).value;
			var c 	= val.substring(0, val.length-6);
			c 	  	= parseInt(c);
			var d 	= val.substring(5, val.length-3);
			d     	= parseInt(d);
			var f   = val.substring(8, val.length);
			f       = parseInt(f);
			var select_date = new String(c+'-'+d+'-'+f);
			if (c < year) {
				alert('Previous dates not allowed');
				document.getElementById(arg).value = null; 
				document.getElementById(arg).focus();
				return false; 	
			}
			else if(c === year && d < e){
				alert('Previous dates not allowed');
				document.getElementById(arg).value = null;
				document.getElementById(arg).focus(); 
				return false;	
			}
			else if(c === year && d === e && f < day){
				alert('Previous dates not allowed');
				document.getElementById(arg).value = null;
				document.getElementById(arg).focus(); 
				return false;	
			}
			else{
				return false;
			}
			//document.getElementById('rDate').value = current_date;  	
  		}

		function confirmstatus(arg)
		{
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
			return false;
		}

		function updatestatus(arg)
		{
			var x = confirm('Are You Sure ?');
			if(x)
			{
				var e = document.getElementById('statusproj-'+arg);
				var opt = e.options[e.selectedIndex].value;
				$.ajax({
					type: 'get',
					url: "{{URL::to('/')}}/"+arg+"/updatestatus",
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

		function updatelocation(arg)
		{
			var text = document.getElementById('location-'+arg).value;
			var x = confirm('Do You Want To Save The Changes ?');
			if(x)
			{
				var newtext = document.getElementById('location-'+arg).value;	
				$.ajax({
					type: 'get',
					url: "{{URL::to('/')}}/"+arg+"/updatelocation",
					async: false,
					data: {newtext: newtext},
					success: function(response)
					{
						location.reload(true);
					}
				});
			}
			else
			{
				document.getElementById('location-'+arg).value = text;
			}
		}

		function updatemat(arg)
		{
			var x = confirm('Do You Want To Save Changes ?');
			if(x)
			{

			}
			else
			{

			}
		}
	</script>

@endsection