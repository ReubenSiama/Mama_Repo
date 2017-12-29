@extends('layouts.app')

@section('content')

<div class="col-md-6 col-md-offset-3">
<div class="panel panel-default">
	<div class="panel-heading">
		Enquiry
		<button class="pull-right btn btn-sm btn-success" id="btn1" onclick="show()">Add</button>
		<button class="hidden" id="btn2" onclick="hide()">Cancel</button>
	</div>
	<div class="panel-body">
		<div id="add" class="hidden">
			<form method="POST" action="{{ URL::to('/') }}/{{$id}}/addRequirement" enctype="multipart/form-data">
				{{ csrf_field() }}
				<table class="table">
					<label>Requirement Sheet</label>
					<tr>
						<td>Main Category</td>
						<td>:</td>
						<td>
							<select name="mCategory" required class="form-control input-sm">
								<option value="">--Select--</option>
								<optgroup label="Sand">
									<option value="Sand">Sand</option>
									<option value="Cement">Cement</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<td>Sub Category</td>
						<td>:</td>
						<td>
							<select name="sCategory" class="form-control input-sm">
								<option value="">--Select--</option>
								<optgroup label="Sand">
									<option value="Sand">Sand</option>
									<option value="Star Cement">Star Cement</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<td>Material Specification</td>
						<td>:</td>
						<td><textarea name="mSpec" required class="form-control" placeholder="Material Specification"></textarea></td>
					</tr>
					<tr>
						<td>Referral Images</td>
						<td>:</td>
						<td>
							<input type="file" name="rfImage1" class="form-control">
							<br>
							<input type="file" name="rfImage2" class="form-control">
						</td>
					</tr>
					<tr>
						<td>Requirement date</td>
						<td>:</td>
						<td>
							<input required type="date" name="rDate" class="form-control">
						</td>
					</tr>
					<tr>
						<td>Measurement Unit</td>
						<td>:</td>
						<td>
							<select name="mUnit" class="form-control">
								<option value="KG">KG</option>
								<option value="Grams">Grams</option>
								<option value="Bags">Bags</option>
								<option value="Packets">Packets</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Unit Price</td>
						<td>:</td>
						<td><input placeholder="Unit Price" id="price" type="text" class="form-control" name="uPrice"></td>
					</tr>
					<tr>
						<td>Total Quantity</td>
						<td>:</td>
						<td><input placeholder="Quantity" id="quantity" type="text" class="form-control" name="quantity"></td>
					</tr>
					<tr>
						<td>Total Amount</td>
						<td>:</td>
						<td><input placeholder="Total" id="total" onfocus="calculate()" type="text" class="form-control" name="total"></td>
					</tr>
					<tr>
						<td>Notes</td>
						<td>:</td>
						<td>
							<textarea class="form-control" placeholder="Notes" name="notes"></textarea>
						</td>
					</tr>
					<tr>
						<td><button type="submit" class="form-control btn-success">Add</button></td>
						<td><button type="reset" class="form-control btn-warning">Clear</button></td>
						<td><button type="button" class="form-control btn-danger">Cancel</button></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="req" class="">
			@if(count($requirements) == 0)
				No requirements found yet! Please add some.
			@elseif(count($requirements) == 1)
				This is your requirement
			@else
				These are your requirements
			@endif
			@if(session('Error'))
			<div class="alert-danger pull-right">{{ session('Error')}}</div>
			@endif
			@if(session('Success'))
			<div class="alert-success pull-right">{{ session('Success')}}</div>
			@endif
			<form method="POST" action="{{ URL::to('/') }}/{{ $id }}/placeOrder">
				{{ csrf_field() }}
				<table class="table">
					<thead>
						<th>Requirement No.</th>
						<th>Main Category</th>
						<th>Sub-Category</th>
						<th>Qnty.</th>
						<th>Status</th>
					</thead>
					<tbody>
						@foreach($requirements as $requirement)
							<tr>
								<td>{{ $requirement->id }}</td>
								<td>{{ $requirement->main_category }}</td>
								<td>{{ $requirement->sub_category }}</td>
								<td>{{ $requirement->quantity }} {{ $requirement->measurement_unit }}</td>
								<td>{{ $requirement->status }}</td>
								<td><input type="checkbox" name="requirement[]" value="{{ $requirement->id }}"></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<input type="submit" class="btn btn-success" name="" value="Place Order">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function calculate(){
	var price = parseInt(document.getElementById("price").value);
	var qnty = parseInt(document.getElementById("quantity").value);
		if(document.getElementById("price").value != "" && document.getElementById("quantity").value != ""){
			var total = price * qnty;
			document.getElementById("total").value = total;
		}
	}
	function show(){
		document.getElementById("req").className = "hidden"
		document.getElementById("add").className = "";
		document.getElementById("btn2").className = "pull-right btn btn-sm btn-success";
		document.getElementById("btn1").className = "hidden";

	}
	function hide(){
		document.getElementById("add").className = "hidden";
	 	document.getElementById("req").className = "";
		document.getElementById("btn1").className = "pull-right btn btn-sm btn-success";
		document.getElementById("btn2").className = "hidden";
	}
</script>
@endsection