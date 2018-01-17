@extends('layouts.app')

@section('content')

<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<strong style="color:white">View Record</strong>
			<a class="btn btn-sm btn-danger pull-right" href="{{URL::to('/')}}/{{$id}}/logisticdetails">Back</a>
		</div>
		<div class="panel-body">
			<table class="table table-responsive table-striped">
				<thead>
					<tr>
						<th>Main Category</th>
						<th>Sub Category</th>
						<th>Quantity</th>
						<th>Price</th>
						
						<th>Payment Status</th>
						<th>Delivery Status</th>
					</tr>
				</thead>
				<tbody>
					
					<tr style="border-top-style: hidden;">
						<td>
							{{$view->main_category}}
						</td>
						<td>
							{{$view->sub_category}}
						</td>
						<td>
							{{$view->quantity}} {{$view->measurement_unit}}
						</td>
						<td>
							{{$view->total}}
						</td>
						
						<td>
							{{$view->payment_status}}
						</td>
						<td>
							{{$view->delivery_status}}
						</td>
					</tr>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection