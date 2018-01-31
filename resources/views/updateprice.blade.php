@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<b style="color:white">Enquiry</b>
				<button class="pull-right btn btn-sm btn-danger">Back</button>
			</div>
			<div class="panel-body">
				<div id="addpage">
					<h4 style="text-align: center">
						<b>Add Details</b>
					</h4>
					<br>
					<form>
						<div style="margin-left:5%;margin-right: 5%">
							<table class="table table-responsive">
								<tr style="border-top-style: hidden">
									<td style="width:20%">
										<label> Category </label>
									</td>
									<td style="width:80%">
										<input type="text" name="category" id="category" class="form-control" placeholder="Category Name..." />
									</td>
								</tr>
								<tr style="border-top-style: hidden">	
									<td style="width:20%">
										<label> Sub Category </label>
									</td>
									<td style="width:80%">
										<input type="text" name="subcategory" id="subcategory" class="form-control" placeholder="Sub Category Name..." />
									</td>
								</tr>
								<tr style="border-top-style: hidden">
									<td style="width:20%">
										<label> Price </label>
									</td>
									<td style="width:80%">
										<input type="text" onkeyup="check('price')" name="price" id="price" class="form-control" placeholder="Amount" />
									</td>
								</tr>	
							</table>
							<br>
							<table class="table table-responsive">
								<tr style="border-top-style: hidden">
									<td style="width: 45%" class="text-right">
									<input type="submit" value="Submit" class="btn btn-md btn-success" name="submitbtn" id="submitbtn" style="width:60%;font-weight: bold" />
									</td>
									<td style="width: 45%">
									<input type="reset" value="Reset" name="resetbtn" id="resetbtn" class="btn btn-md btn-warning" style="width:60%;font-weight: bold" />
									</td>
								</tr>
							</table>
						</div>
						<br>		
					</form>
				</div>
			</div>
		</div>
	</div>
<div class="col-md-6">
	<table class="table table-responsive table-striped" border="1">
		<thead>
			<tr>
				<th>
					Category	
				</th>
				<th>
					Sub-Category
				</th>
				<th>
					Price
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $row)
			<tr>
				<td>
					{{$row->main_category}}
				</td>
				<td>
					{{$row->sub_category}}
				</td>
				<td>
					{{$row->unit_price}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
</div>
</div>

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
</script>
@endsection