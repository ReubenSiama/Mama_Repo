@extends('layouts.leheader')

@section('content')
<div class="col-md-8 col-md-offset-2" >
<div class="panel panel-primary">
	<div class="panel-heading">
		<b style="color:white">Enquiry</b>
		<button class="pull-right btn btn-sm btn-success" id="btn1" style="color:white;" onclick="show()"><b>Add</b></button>
		<button class="hidden" id="btn2" onclick="hide()">Cancel</button>
	</div>
	<div class="panel-body">
		<div id="add">
			<form method="POST" action="{{ URL::to('/') }}/{{$id}}/addRequirement" enctype="multipart/form-data">
				{{ csrf_field() }}
				<table class="table table-responsive">
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
							<input required type="date" name="rDate" id="rDate" onblur="checkdate()" class="form-control" >
						</td>
					</tr>
					<tr><!-- This line by Siddharth -->
						<td>Delivery Notes</td>
						<td>:</td>
						<td>
							<textarea class="form-control" required placeholder="Notes" name="Dnotes" id="Dnotes"></textarea>
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
						<td><input placeholder="Unit Price" id="uPrice" type="text" onkeyup="check('uPrice')" class="form-control" name="uPrice"></td>
					</tr>
					<tr>
						<td>Total Quantity</td>
						<td>:</td>
						<td><input placeholder="Quantity" autocomplete="off" id="quantity" onkeyup="calculate()" type="text" class="form-control" name="quantity"></td>
					</tr>
					<tr>
						<td>Total Amount</td>
						<td>:</td>
						<td><input  placeholder="Total" id="total" type="text" class="form-control" name="total"></td>
					</tr>
					<tr>
						<td>Notes</td>
						<td>:</td>
						<td>
							<textarea class="form-control" placeholder="Notes" name="notes"></textarea>
						</td>
					</tr>
					<tr align="center">
						
						<td><button type="submit" class="form-control btn-md btn-success">Add</button></td>
						<td><button type="reset" class="btn-md form-control btn-warning">Clear</button></td>
						<td><button type="buton" onclick="hide()" class="btn-md form-control btn-danger">Cancel</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
@endsection