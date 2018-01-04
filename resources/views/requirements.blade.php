@extends('layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">
<div class="panel panel-info">
	<div class="panel-heading">
		Enquiry
		<button class="pull-right btn btn-sm btn-success" id="btn1" style="color:white;" onclick="show()">Add</button>
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
							<input required type="date" name="rDate" id="rDate" class="form-control" >
						</td>
					</tr>
					<tr><!-- This line by Siddharth -->
						<td>Delivery Notes</td>
						<td>:</td>
						<td>
							<input placeholder="Delivery Notes..." required type="textarea" name="Delivnote" class="form-control">
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
						<td><input placeholder="Quantity" id="quantity" onkeyup="calculate()" type="text" class="form-control" name="quantity"></td>
					</tr>
					<tr>
						<td>Total Amount</td>
						<td>:</td>
						<td><input placeholder="Total" id="total" type="text" class="form-control" name="total"></td>
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
		<div id="req" class="col-md-12">
			@if(count($requirements) == 0)
				<p id="Heading">No requirements found yet! Please add some. </p>
			@elseif(count($requirements) == 1)
				<p id="Heading">This is your requirement</p>
			@else
				<p id="Heading">These are your requirements</p>
			@endif
			@if(session('Error'))
			<div class="alert-danger pull-right">{{ session('Error')}}</div>
			@endif
			@if(session('Success'))
			<div class="alert-success pull-right">{{ session('Success')}}</div>
			@endif
			<form method="POST" action="{{ URL::to('/') }}/{{ $id }}/placeOrder">
				{{ csrf_field() }}
				<!--These lines by Siddharth  copy the ids attribute here-->
				<table class="table">
					<thead>
						<th id="rqno">Requirement No.</th>
						<th>Main Category</th>
						<th>Sub-Category</th>
						<th>Qnty.</th>
						<th id="statusth">Status</th>
						<th></th>		
					</thead>
					<tbody>
						@foreach($requirements as $requirement)
							<tr id="tr{{ $requirement->id }}">
								<td id='rq{{$requirement->id}}'>{{ $requirement->id }}</td>
								<td>{{ $requirement->main_category }}</td>
								<td>{{ $requirement->sub_category }}</td>
								<td>{{ $requirement->quantity }} {{ $requirement->measurement_unit }}</td>
								<td id="status{{ $requirement->id }}">{{ $requirement->status }}</td>
								<td id="check{{ $requirement->id }}"><input type="checkbox" name="requirement[]" id="requirement[]" value="{{ $requirement->id }}"></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<input type="submit" class="btn btn-success" name="Submit" id="submitform" value="Place Order">
			</form>
		</div>
	</div>
</div>
<!--This section by Siddharth -->
</div>
<div style="margin-top:9%; background-color:transparent;border:none;left:-3%" class="col-md-1 panel panel-primary" id="dontprint">
	<div class="panel-body">
		@foreach($requirements as $requirement)
		<button style="margin-top:6px;" class="btn btn-sm btn-primary" onclick="return printthis('{{$requirement->id}}')">Print {{ $requirement->id }}</button><br>
		@endforeach
	</div>
</div>
<!--This section by Siddharth -->
<script type="text/javascript">

	function calculate(){
		var price = parseInt(document.getElementById("price").value);
		var qnty  = parseInt(document.getElementById("quantity").value);
		if(document.getElementById("price").value != "" && document.getElementById("quantity").value != ""){
			var total = price * qnty;
			document.getElementById("total").value = total;
		}
	}
	function show(){
		document.getElementById("req").className  = "hidden"
		document.getElementById("add").className  = "";
		document.getElementById("btn2").className = "pull-right btn btn-sm btn-success";
		document.getElementById("btn1").className = "hidden";
		document.getElementById('dontprint').style.visibility = 'hidden';
		var today 	     = new Date();
		var day 	  	 = (today.getDate().length ==1 ? "0"+today.getDate() : "0"+today.getDate()); //This line by Siddharth
		var month 	  	 = parseInt(today.getMonth())+1;
		month 	  	     = (today.getMonth().length == 1 ? "0"+month : "0"+month);  //This line by Siddharth
		var year 	  	 = today.getFullYear();
		var current_date = new String(year+'-'+month+'-'+day); 
		document.getElementById("rDate").min = current_date;
		//alert(current_date);
	}
	function hide(){
		document.getElementById("add").className  = "hidden";
	 	document.getElementById("req").className  = "";
		document.getElementById("btn1").className = "pull-right btn btn-sm btn-success";
		document.getElementById("btn2").className = "hidden";
		document.getElementById('dontprint').style.visibility = 'visible';	//This line by Siddharth
	}
	//This line by Siddharth start
	function printthis(arg){
        document.getElementById('submitform').style.display = 'none';
        document.getElementById('Heading').style.display    = 'none';
        document.getElementById('dontprint').style.display  = 'none';
        document.getElementById('btn1').style.display       = 'none';
        document.getElementById('rqno').style.display       = 'none';
        document.getElementById('statusth').style.display   = 'none';
        document.getElementById('check'+arg).style.display  = 'none';
        
        var i;
        for(i=1; i<100;i++){
        	if(document.getElementById('tr'+i)){
        		if(i != arg){
        			document.getElementById('tr'+i).style.display='none';

        		}
        	}
        }
        document.getElementById('rq'+arg).style.display     = 'none';
        document.getElementById('status'+arg).style.display = 'none';
        window.print();
        location.reload(true);
        return false;
    //This line by Siddharth end    
    }
</script>
@endsection