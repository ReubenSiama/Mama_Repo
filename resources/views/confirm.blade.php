@extends('layouts.app')

@section('content')

<div class="col-md-4 col-md-offset-4">
	<div class="panel panel-default">
		<div class="panel-heading">Order details</div>
		<div class="panel-body">
			<form method="POST" action="{{ URL::to('/') }}/{{ $id }}/confirmOrder">
				{{ csrf_field() }}
				<table class="table">
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="email" class="form-control input-sm" placeholder="Owner Email" required></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td>:</td>
						<td><input type="number" class="form-control input-sm" placeholder="Owner Phone Number" required></td>
					</tr>
				</table>
			<table class="table table-hover">
				<th>Item</th>
				<th>Price</th>
				<th>Qnty.</th>
				<th>Total</th>
				<p class="hidden">{{ $total = 0}}</p>
				<tbody>
					@foreach($orders as $order)
					<tr>
						<td>{{ $order->main_category }} 
							@if($order->sub_category != NULL)
								{{ $order->sub_category }}
							@endif
						</td>
						<td>{{ $order->unit_price }}</td>
						<td>{{ $order->quantity }}</td>
						<td>{{ $order->total }}</td>
					</tr>
					<p class="hidden">{{ $total = $total + $order->total }}</p>
					@endforeach
				</tbody>
			</table>
			<table class="table table-hover">
				<th>Grand Total</th>
				<th>{{ $total }}</th>
			</table>
			<button type="submit" class="btn btn-sm btn-primary form-control">Confirm Order</button>
			</form>
	</div>
</div>

@endsection