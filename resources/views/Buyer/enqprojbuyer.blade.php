@extends('layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">
<div class="panel panel-primary" style="overflow-x: scroll">
	<div class="panel-heading">
		<b>Enquiry</b>
		<button class="pull-right btn btn-sm btn-success" id="btn1" style="color:white;" onclick="show()">Add</button>
		<button class="hidden" id="btn2" onclick="hide()">Cancel</button>
	</div>
	<div class="panel-body">
		<div id="add" class="hidden">
			<form method="POST" action="#" enctype="multipart/form-data">
				
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
							<input required type="date" name="rDate" id="rDate" class="form-control" >
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
						<td><input disabled placeholder="Total" id="total" type="text" class="form-control" name="total"></td>
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
			<form method="POST" action="">
				<!--These lines by Siddharth  copy the ids attribute here-->
				<table class="table table-responsive table-striped">
					<thead>
						<th style="text-align:center" id="rqno">Enquiry No.</th>
						<th style="text-align:center">Main Category</th>
						<th style="text-align:center">Sub-Category</th>
						<th style="text-align:center">Qnty.</th>
						<th style="text-align:center" id="statusth">Status</th>
						<th style="text-align:center" id='noid'></th>
						<th style="text-align:center" id='updateth'>Action</th>		
					</thead>
					<tbody>
						
							<tr>
								<td style="text-align:center">Sid</td>
								<td style="text-align:center">123s</td>
								<td style="text-align:center">sub category</td>
								<td style="text-align:center">category</td>
								<td style="text-align:center" id="status">status</td>
								<td style="text-align:center" id="check"><input type="checkbox" name="requirement[]" id="requirement[]" value=""></td>
								<td><a style="margin-top:6px;" href="#" class="btn btn-sm btn-primary text-center
									"  onclick="return printthis('')">Print </a></td>
							</tr>
						
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
		
	</div>
</div>
<!--This section by Siddharth -->
<script type="text/javascript">

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
		var day 	  	 = (today.getDate().length ==1?"0"+today.getDate():"0"+today.getDate()); //This line by Siddharth
		var month 	  	 = parseInt(today.getMonth())+1;
		month 	  	     = (today.getMonth().length == 1 ? "0"+month : "0"+month);  //This line by Siddharth
		var year 	  	 = today.getFullYear();
		var current_date = new String(year+'-'+month+'-'+day); 
		document.getElementById("rDate").min = current_date;
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