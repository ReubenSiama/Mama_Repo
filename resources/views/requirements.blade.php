@extends('layouts.app')

@section('content')

<div class="col-md-10 col-md-offset-1">
<div class="panel panel-primary" style="overflow: scroll;">
	<div class="panel-heading">
		<b style="color:white">Enquiry</b>
		<button class="pull-right btn btn-sm btn-success" id="btn1" style="color:white;" onclick="show()"><b>Add</b></button>
		<button class="hidden" id="btn2" onclick="hide()">Cancel</button>
	</div>
	<div class="panel-body">
		<div id="add" class="hidden">
			<form method="POST" action="{{ URL::to('/') }}/{{$id}}/addRequirement" enctype="multipart/form-data">
				{{ csrf_field() }}
				<table class="table table-responsive">
					<label>Requirement Sheet</label>
					<tr>
						<td>Main Category</td>
						<td>:</td>
						<td>
							<select name="mCategory" id="category" required class="form-control input-sm" onchange="getPrice()">
								<option value="">--Select--</option>
									@foreach($category as $key => $value)
									<option value="{{$value->category}}">{{$value->category}}</option>
									@endforeach
								
							</select>
						</td>
					</tr>
					<tr>
						<td>Sub Category</td>
						<td>:</td>
						<td>
							<select id='supplier' required name="sCategory" class="form-control input-sm" onchange="putvalue()">
								<option value="">--Select--</option>
								
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
						<td><input placeholder="Unit Price" id="uPrice" type="text" onfocus="document.getElementById('uPrice').disabled = true;" onblur="document.getElementById('uPrice').disabled = false;" style="border-style= hidden;" class="form-control" name="uPrice"></td>
					</tr>
					<tr>
						<td>Total Quantity</td>
						<td>:</td>
						<td><input placeholder="Quantity" autocomplete="off" id="quantity" onkeyup="calculate()" type="text" class="form-control" name="quantity"></td>
					</tr>
					<tr>
						<td>Total Amount</td>
						<td>:</td>
						<td><input  placeholder="Total" id="total" type="text" class="form-control" name="total" onfocus="document.getElementById('total').disabled = true;" onblur="document.getElementById('total').disabled = false;"></td>
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
				<p id="Heading">No enquiries found yet! Please add some. </p>
			@elseif(count($requirements) == 1)
				<p id="Heading">This is your enquiry</p>
			@else
				<p id="Heading">These are your enquiries</p>
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
				<table class="table table-responsive table-striped">
					<thead>
						<th style="text-align:center" id="rqno">Enquiry No.</th>
						<th style="text-align:center">Main Category</th>
						<th style="text-align:center">Sub-Category</th>
						<th style="text-align:center">Qnty.</th>
						<th style="text-align:center" id="statusth">Status</th>
						<th style="text-align:center" id='noid'></th>
						<th></th>
						<th style="text-align:center" id='updateth'>Action</th>	
						<th></th>
						<th></th>	
					</thead>
					<tbody>
						@foreach($requirements as $requirement)
							<tr id="tr{{ $requirement->id }}" valign="center" align="center">
								<td style="text-align:center" id='rq{{$requirement->id}}'>{{ $requirement->id }}</td>
								<td style="text-align:center">{{ $requirement->main_category }}</td>
								<td style="text-align:center">{{ $requirement->sub_category }}</td>
								<td style="text-align:center">{{ $requirement->quantity }} {{ $requirement->measurement_unit }}</td>
								<td style="text-align:center" id="status{{ $requirement->id }}">{{ $requirement->status }}</td>
								<td style="text-align:center" id="check{{ $requirement->id }}">
									@if($requirement->status !== 'Order Cancelled' && $requirement->status !== 'Order Confirmed')
									<p id="p{{ $requirement->id }}"><input type="checkbox" style="margin-top:50%" name="requirement[]" id="requirement[]" value="{{ $requirement->id }}"></p>
									@endif
								</td>
								<td>
									@if($requirement->status !== 'Order Cancelled')
									<a style="margin-top:8%;" href="{{ URL::to('/') }}/{{ $id }}/{{$requirement->id}}/editOrder" class="btn btn-sm btn-info text-center
									" id="btnprint{{$requirement->id}}">Edit</a>
									@endif
								</td>
								<td id="view{{$requirement->id}}">
									@if($requirement->status == 'Order Confirmed')
									<a href="{{ URL::to('/') }}/{{ $id }}/{{ $requirement->id }}/viewOrder" class="btn btn-sm btn-success text-center" style="margin-top: 8%" id="status-{{$requirement->id}}">View</a>
									@endif
								</td>
								<td>
									@if($requirement->status !== 'Order Cancelled')
									<a href="{{ URL::to('/') }}/{{$id}}/{{$requirement->id}}/cancelOrder" class="btn btn-sm btn-danger text-center" style="margin-top: 9%" id="status-{{$requirement->id}}">Cancel</a>
									@endif
								</td>
								<td><a style="margin-top:12%;" href="#" class="btn btn-sm btn-primary text-center
									" id="btnprint{{$requirement->id}}" onclick="return printthis('{{$requirement->id}}')">Print</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<input type="submit" class="btn btn-success" name="Submit" id="submitform" value="Place Order">
				<a name="confirmOrder" class="btn btn-md btn-primary" id="confirmOrder" value="Confirm Order" onclick="printChecked()">Confirm Order</a>
				
			</form>
		</div>
	</div>
</div>
<!--This section by Siddharth -->
</div>
<div style="margin-top:9%; background-color:transparent;border:none;left:-3%" class="col-md-1 panel panel-primary" id="dontprint">
	<div class="panel-body">
		@foreach($requirements as $requirement)
		<br>
		@endforeach
	</div>
</div>
<!--This section by Siddharth -->
<script type="text/javascript">
  	function putvalue(){
  		var sel = document.getElementById("supplier");
		var text= sel.options[sel.selectedIndex].value;
  		document.getElementById('uPrice').value = text;
  		return false;
  	}
  	function getPrice(){
  		var cat;
  		var e = document.getElementById("category");
		var strUser = e.options[e.selectedIndex].text;
		$.ajax({
			type: 'get',
			url: "{{ URL::to('/') }}/subcat",
			data: {strUser: strUser},
			async: false,
			success: function(response){
				document.getElementById('supplier').innerHTML = '<option value="">--Select--</option>';
				for(var i=0; i<response.length; i++){
					document.getElementById('supplier').innerHTML +='<option value='+response[i]['price']+'>'+response[i]['supplier']+'</option>';
				}
			}
		});
		return false;
  	}
	
	function printChecked(){
		var items=document.getElementsByName('requirement[]');
		var selectedItems='';
		//console.log(items.length);
		for(var i=0; i<items.length; i++){
			if(items[i].type=='checkbox' && items[i].checked==true)
			{
				selectedItems=items[i].value;
				$.ajax({
					type: 'GET',
					url: "{{ URL::to('/') }}/orderConfirm",
					data: {select: selectedItems},
					async: false,
					success: function(response){
						document.getElementById('status'+response['select']).innerHTML = 'Order Confirmed';
						document.getElementById('p'+response['select']).style.display='none';
						document.getElementById('view'+response['select']).innerHTML="<a href=\"{{ URL::to('/') }}/{{ $id }}/{{ $requirement->id }}/viewOrder\" class=\"btn btn-sm btn-success text-center\" style=\"margin-top: 8%\" id=\"status-{{$requirement->id}}\">View</a>";
					}	
				});
			}
		}
	}			

  	function checkdate(){
		var today 	     = new Date();
		var day 	  	 = (today.getDate().length ==1?"0"+today.getDate():today.getDate()); //This line by Siddharth
		var month 	  	 = parseInt(today.getMonth())+1;
		month 	  	     = (today.getMonth().length == 1 ? "0"+month : "0"+month);
		var e 			 = parseInt(month);  //This line by Siddharth
		var year 	  	 = today.getFullYear();
		var current_date = new String(year+'-'+month+'-'+day);
	
		//Extracting individual date month and year and converting them to integers
		var val = document.getElementById('rDate').value;
		var c 	= val.substring(0, val.length-6);
		c 	  	= parseInt(c);
		var d 	= val.substring(5, val.length-3);
		d     	= parseInt(d);
		var f   = val.substring(8, val.length);
		f       = parseInt(f);
		var select_date = new String(c+'-'+d+'-'+f);
		if (c < year) {
			alert('Previous dates not allowed');
			document.getElementById('rDate').value = null; 
			document.getElementById('rDate').focus();
			return false; 	
		}
		else if(c === year && d < e){
			alert('Previous dates not allowed');
			document.getElementById('rDate').value = null;
			document.getElementById('rDate').focus(); 
			return false;	
		}
		else if(c === year && d === e && f < day){
			alert('Previous dates not allowed');
			document.getElementById('rDate').value = null;
			document.getElementById('rDate').focus(); 
			return false;	
		}
		else{
			return false;
		}
		//document.getElementById('rDate').value = current_date;  	
  	}

	function check(arg){
	    var input = document.getElementById(arg).value;
	    if(isNaN(input)){
	      	while(isNaN(document.getElementById(arg).value)){
	      	var str = document.getElementById(arg).value;
	      	str     = str.substring(0, str.length - 1);
	      	document.getElementById(arg).value = str;
	      	}
	    }
	    else{
	      	input = input.trim();
	      	document.getElementById(arg).value = input;
	    }
	    return false;
	}

	function calculate(){
		var price = document.getElementById("uPrice").value;
		var qnty  = document.getElementById("quantity").value;
		if(!(qnty)) qnty = 0;
		if(!isNaN(qnty)){
			if(document.getElementById("uPrice").value != "" && document.getElementById("quantity").value != ""){
				
				var total = price * qnty;
				document.getElementById("total").value = total;
			}
			else{
				document.getElementById("total").value = '';
			}
		}
		else{
			while(isNaN(document.getElementById('quantity').value)){
      			var str = document.getElementById('quantity').value;
      			str     = str.substring(0, str.length - 1);
      			document.getElementById('quantity').value = str;
      		}
		}
	}

	function show(){
		document.getElementById("req").className  			  = "hidden"
		document.getElementById("add").className  			  = "";
		document.getElementById("btn2").className 			  = "pull-right btn btn-sm btn-success";
		document.getElementById("btn1").className 			  = "hidden";
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
		document.getElementById("add").className  			  = "hidden";
	 	document.getElementById("req").className  			  = "";
		document.getElementById("btn1").className 			  = "pull-right btn btn-sm btn-success";
		document.getElementById("btn2").className 			  = "hidden";
		document.getElementById('dontprint').style.visibility = 'visible';	//This line by Siddharth
	}
	
	//This line by Siddharth start
	function printthis(arg){
        document.getElementById('submitform').style.display 	= 'none';
        document.getElementById('Heading').style.display    	= 'none';
        document.getElementById('dontprint').style.display  	= 'none';
        document.getElementById('btn1').style.display       	= 'none';
        document.getElementById('rqno').style.display       	= 'none';
        document.getElementById('statusth').style.display   	= 'none';
        document.getElementById('check'+arg).style.display  	= 'none';
        document.getElementById('confirmOrder').style.display  	= 'none';
        
        var i;
        for(i=1; i<100;i++){
        	if(document.getElementById('tr'+i)){
        		if(i != arg){
        			document.getElementById('tr'+i).style.display = 'none';
        		}
        	}
        }

        document.getElementById('rq'+arg).style.display       = 'none';
        document.getElementById('status'+arg).style.display   = 'none';
        document.getElementById('btnprint'+arg).style.display = 'none';
        document.getElementById('updateth').style.display     = 'none';
        document.getElementById('noid').style.display 		  = 'none';
        window.print();
        location.reload(true);
        return false;
    	//This line by Siddharth end    
    }
</script>
@endsection