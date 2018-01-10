@extends('layouts.app')

@section('content')
<div id="regpage" class="img-responsive" style="background-image:'http://vunature.com/wp-content/uploads/2016/10/leaves-autumn-twig-branch-up-leaf-bokeh-close-beautiful-nature-wallpaper-mobile-1920x1080.jpg'">
<div class="col-md-6 col-md-offset-3" align="center" style="border-radius: 5px;">
	<div class="panel panel-primary" >
		<div class="panel-heading" style="padding:0.5% 1% 0.5% 1%;background-color:rgb(21, 137, 66); ">
		<h4 style="text-align:left;padding-left:2%"><b>Contractor Registration</b></h4>
		</div>
		<div class="panel-body" style="background-color:white">
			<form method="POST" onsubmit="return validateform()" action="{{ URL::to('/') }}/newreg"> 
			<table class="table table-responsive">
				<tbody>
				<tr>
					<td> Name </td>
					<td> : </td>
					<td> <input type="text" autocomplete="off" name="nName" id="nName" class="form-control input-sm" placeholder="Name" required style="width:90%"> </td>
				</tr>
				<tr>
					<td> Mobile No </td>
					<td> : </td>
					<td> <input type="text" autocomplete="off" onkeyup="check('nNumber')" name="nNumber" id="nNumber" class="form-control input-sm" placeholder="10 Digits Phone Number" maxlength="10" minlength="10" required style="width:90%" /> </td>
				</tr>
				<tr>
					<td> Email </td>
					<td> : </td>
					<td> <input type="text" autocomplete="off" onblur="checkmail('nEmail')" name="nEmail" id="nEmail" class="form-control input-sm" placeholder="Valid Email Address" required style="width:90%;"> </td>
				</tr>
				</tbody>
			</table>
			<p><input type="checkbox" name="agree" id="agree" checked>
			 &nbsp;&nbsp;I agree to the Terms and Conditions </p><br><br>
			 <div class="text-center">
			 	<input type="submit" name="register" id='register' class="btn btn-md btn-success" style="width:20%">
			 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 	<input type="reset"  name="resetbtn" id='resetbtn' class="btn btn-md" style="width:20%; background-color:rgba(249, 142, 55, 0.78);color:white; ">
			 </div>
			</form>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	
	function validateform(){
		var x = document.getElementById('nName');
		var y = document.getElementById('nNumber');
		var z = document.getElementById('nEmail');
		if(document.getElementById('agree').checked == true){
			if(x.value.length > 0 && y.value.length > 0 && z.value.length > 0 && y.value.length === 10 ){
				return true;
			}
			else if(x.value.length == 0){
				alert('Please Fill Out Name Field');
				return false;
			}
			else if(y.value.length == 0){
				alert('Please Fill Out Number Field');
				return false;
			}
			else if(z.value.length == 0){
				alert('Please Fill Out Email Field');
				return false;
			}
			else if(y.value.length !== 10) {
				alert('Please Fill Out 10 Digits in Number field');
				y.value='';
				return false;
			}
		}
		else
		{
			alert('You Must Agree To The Terms And Conditions.');
			$('#resetbtn').click();
			return false;
		}
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
        		document.getElementById(arg).focus();
      		}
    	}
     	return false;
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
		
</script>

@endsection