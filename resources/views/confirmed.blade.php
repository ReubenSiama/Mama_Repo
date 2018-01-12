@extends('layouts.app')

@section('content')


<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading">Order details
			<div class="alert-success pull-right">{{ session('Confirmed') }}</div>
		</div>
		<div class="panel-body">
			<table class="table table-hover">
				<tr>
					<td>Project Name</td>
					<td>:</td>
					<td> {{ $project->project_name }} </td>
				</tr>
				<tr>
					<td>Shipping Address</td>
					<td>:</td>
					<td> {{ $project->siteaddress->address }} </td>
				</tr>
			</table>
			<div class="hidden">{{ $total = 0 }}</div>
			<table class="table">
				<label>Items ordered</label>
				@foreach($orders as $order)
				<tr>
					<td>{{ $order->main_category }} </td>
					<td>{{ $order->sub_category }}</td>
					<td>{{ $order->quantity }} {{ $order->measurement_unit }}</td>
					<td>Rs. {{ $order->unit_price }} per {{ $order->measurement_unit }}</td>
					<td>Total</td>
					<td>:</td>
					<td>{{ $order->total }}</td>
				</tr>
				<div class="hidden"> {{ $total = $total + $order->total }}</div>
				@endforeach
			</table>
			<hr>
			<div class="col-md-4">
				<label>Total :</label> {{ $total }}
			</div>
		</div>
		<div class="panel-footer">
			<form method="GET" action="{{URL::to('/') }}/{{ $id }}/payment">
				<input type="hidden" name="total" value="{{ $total }}">
				<button type="submit" class="btn btn-danger btn-sm form-control">Generate D C</button>
				<br>
				<br>
				<button type="submit" class="btn btn-primary btn-sm form-control">Online Payment</button>
				<br>
				<br>

				<button type="submit" class="btn btn-info btn-sm form-control">Offline Payment</button>
			</form>
		</div>
	</div>
</div>

@endsection