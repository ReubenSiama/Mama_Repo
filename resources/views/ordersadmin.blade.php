@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="panel panel-primary" style="overflow-x: scroll;">
		<div class="panel-heading">
			<b style="color:white">Enquiry</b>
			<a class="pull-right btn btn-sm btn-danger" href="{{URL::to('/')}}/home" id="btn1" style="color:white;"><b>Back</b></a>
		</div>
		<div class="panel-body">
			<h4>Confirmed Orders</h4><br>
			<table class="table table-responsive table-striped">
				<thead>
					<th>
						Main Category
					</th>
					<th>
						Sub Category
					</th>
					<th>
						Quantity
					</th>
					<th>
						Status
					</th>
					<th>
						Requirement Date
					</th>
					<th>
						Payment Status
					</th>
					<th>
						Dispatch Status
					</th>
					<th >
						Delivery Status
					</th>
					<th>
						Action
					</th>
				</thead>
				<tbody>
					@foreach($view as $rec)
					<tr id="row-{{$rec->id}}">
						<td>
							{{$rec -> main_category}}
						</td>
						<td>
							{{$rec -> sub_category}}
						</td>
						<td>
							{{$rec->quantity}} {{$rec->measurement_unit}}
						</td>
						<td>
							{{$rec->status}}
						</td>
						<td>
							{{$rec -> requirement_date}}
						</td>

						@if($rec->payment_status == 'null')
							<td id="paymenttd-{{$rec->id}}">	
								<select id="payment-{{$rec->id}}" onchange="pay('{{$rec->id}}')" class="form-control">
									<option value="null" id="payment-{{$rec->id}}" selected>
										---- Select ----
									</option>
									<option value="Payment Received">
										Payment Received
									</option>
									<option value="Payment Pending">
										Payment Pending
									</option>
								</select>
							</td>
						@endif

						@if($rec->payment_status == 'Payment Pending')
						<td>	
							<select id="payment-{{$rec->id}}" onchange="pay('{{$rec->id}}')" class="form-control">
								<option value="null" id="payment-{{$rec->id}}">
									---- Select ----
								</option>
								<option value="Payment Received">
									Payment Received
								</option>
								<option value="Payment Pending" selected>
									Payment Pending
								</option>
							</select>
						</td>
						@endif

						@if($rec->payment_status == 'Payment Received')
						<td>
								{{$rec->payment_status}}
						</td>
						@endif

						@if($rec->dispatch_status == 'null')
						<td id="dispatchtd-{{$rec->id}}">
							<select id="transit-{{$rec->id}}" onchange="dispatch('{{$rec->id}}')" class="form-control">
								<option value="null" selected>
									---- Select ----
								</option>
								<option value="Initiated">
									Initiated
								</option>
								<option value="Transit">
									Transit
								</option>
							</select>
						</td>
						@endif

						@if($rec->dispatch_status == 'Initiated')
						<td id="dispatchtd-{{$rec->id}}">
							<select id="transit-{{$rec->id}}" onchange="dispatch('{{$rec->id}}')" class="form-control">
								<option value="null">
									---- Select ----
								</option>
								<option value="Initiated" selected>
									Initiated
								</option>
								<option value="Transit">
									Transit
								</option>
							</select>
						</td>
						@endif

						@if($rec->dispatch_status == 'Transit')
						<td id="dispatchtd-{{$rec->id}}">
							<select id="transit-{{$rec->id}}" onchange="dispatch('{{$rec->id}}')" class="form-control">
								<option value="null">
									---- Select ----
								</option>
								<option value="Initiated">
									Initiated
								</option>
								<option value="Transit" selected>
									Transit
								</option>
							</select>
						</td>
						@endif
						<td>
							{{$rec -> delivery_status}}
						</td>
						<td>
							<a href="{{URL::to('/')}}/{{$rec->id}}/printLPO" target="_blank" class="btn btn-sm btn-primary" >Print LPO</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	function pay(arg)
	{
		var e = document.getElementById("payment-"+arg);
		var strUser = e.options[e.selectedIndex].value;
		var ans = confirm('Are You Sure ? Note: Changes Made Once CANNOT Be Undone');
		if(ans){
			$.ajax({
				type: 'GET',
				url: "{{URL::to('/')}}/"+arg+"/updateampay",
				data: {payment: strUser},
				async: false,
				success: function(response){
					if(response == 'Payment Received'){
						document.getElementById('paymenttd-'+arg).innerHTML = response;
					}
				}
			});
			location.reload(true);
		}
		else
		{
			location.reload(true);
		}
		return false;
	}

	function dispatch(arg)
	{
		var e = document.getElementById("transit-"+arg);
		var strUser = e.options[e.selectedIndex].value;
		$.ajax({
			type: 'GET',
			url: "{{URL::to('/')}}/"+arg+"/updateamdispatch",
			data: {dispatch: strUser},
			async: false,
			success: function(response){
					location.reload(true);	
			}
		});
		return false;	
	}

</script>
@endsection