@extends('layouts.app')

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<b style="color:white">Enquiry</b>
			<button class="pull-right btn btn-sm btn-danger" id="btn1" style="color:white;"><b>Back</b></button>
		</div>
		<div class="panel-body">
			<h4>Confirmed Orders</h4><br>
			<pre>
				
			</pre>
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
				<th style="text-align: center">
					Delivery Status
				</th>
				</thead>
				<tbody>
					@foreach($orders as $order)
						<tr style="border-top-style: hidden;">
							<tbody>
							<td>
								{{$order->main_category}}
							</td>
							<td>
								{{$order->sub_category}}
							</td>
							<td>
								{{$order->quantity}} {{$order->measurement_unit}}
							</td>
							<td>
								{{$order->status}}
							</td>
							<td>
								{{$order->requirement_date}}
							</td>
							<td>
								<select id="pay_{{$order->id}}" name="pay_{{$order->id}}" class="form-control" style="width:80%">
									<option>
										---- Select ----
									</option>
									<option> 
										Payment Received
									</option>
									<option>
										Payment Pending
									</option>
								</select>
							</td>
							<td>
								Item Delivered
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection