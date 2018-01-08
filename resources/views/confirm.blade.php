@extends('layouts.app')

@section('content')

<div class="col-md-4 col-md-offset-4">
	<div class="panel panel-default">
		<div class="panel-heading">Order details</div>
		<div class="panel-body">
			<form method="POST" onsubmit="return validateform()" action="{{ URL::to('/') }}/{{ $id }}/confirmOrder">
				{{ csrf_field() }}
				<table class="table">
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" onblur="checkmail('oEmail')" name="oEmail" id="oEmail" class="form-control input-sm" placeholder="Owner Email" required></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td>:</td>
						<td><input type="text" onkeyup="check('oPhone')" class="form-control input-sm" placeholder="Owner Phone Number" required name="oPhone" id="oPhone"></td>
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
<script type="text/javascript">
	function validateform(){
		var x = document.getElementById('oEmail').value;
		var y = document.getElementById('oPhone').value;
		if(x.length == 0){
			alert('Please fill out the Email field.');
			return false;
		}
		if(y.length != 10){
			alert('Please fill 10 digits the Phone Number field.');
			return false;
		}
			return true;
	}
	function checkmail(arg){
    	var mail = document.getElementById(arg);
    	if(mail.value.length > 0 ){
      		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value))  {  
        		return true;  
      		}  
      		else{
        		alert("Invalid Email Address!");  
        		mail.value = '';
      		}
    	}
     return false;
  	}
</script>
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
    if(arg == 'ground' || arg == 'basement'){
      var basement = parseInt(document.getElementById("basement").value);
      var ground   = parseInt(document.getElementById("ground").value);
      if(!isNaN(basement) && !isNaN(ground)){
        var floor    = 'B('+basement+')' + ' + G + ('+ground+') = ';
        sum          = basement+ground+1;
        floor       += sum;
      
        if(document.getElementById("total").innerHTML != null)
          document.getElementById("total").innerHTML = floor;
        else
          document.getElementById("total").innerHTML = '';
      }
    }
    return false;
  }
</script>

@endsection