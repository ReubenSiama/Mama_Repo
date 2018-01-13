@extends('layouts.app')

@section('content')

<div class="col-md-10 col-lg-10 col-sm-10 col-sm-offset-1 col-lg-offset-1 col-md-offset-1">
<div class="panel panel-primary" style="overflow:scroll">
	<div class="panel-heading">
		<strong style="color:white">View</strong>
		<a class="pull-right btn btn-sm btn-danger" href="{{ URL::to('/') }}/{{ $id }}/requirements" id="back" name="back" style="color:white; font-weight: bold; margin-top: -0.4%">Back</a>	
	</div>
	<div class="panel-body" style="margin-left:2%;margin-right:2%;"><br>
		<a class="btn btn-sm btn-primary" id="lpo" name="lpo" style="color:white; font-weight: bold; margin-top: -0.4%;padding-left: 5%;padding-right: 5%;padding-top:1%;padding-bottom: 1%">Generate LPO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a class="btn btn-sm btn-success" id="print" name="print" onclick="printview()" style="color:white; font-weight: bold; margin-top: -0.4%;padding-left: 5%;padding-right: 5%;padding-top:1%;padding-bottom: 1%">Print</a>
		<br>
		<table class="table table-responsive table-striped" style="width:100%">
			<thead>
				<tr>
					<th style="text-align: center">
						Project Name
					</th>
					<th style="text-align: center">
						Project Road Name
					</th>
					<th style="text-align: center">
						Project Status
					</th>
					<th style="text-align: center">
						Main Category
					</th>
					<th style="text-align: center">
						Sub Category
					</th>
					<th style="text-align: center">
						Requirement Date
					</th>
				</tr>
				
			</thead>
			<tbody>
				<tr style="text-align: center">
					<td>
						{{$project->project_name}}
					</td>
					<td>
						{{$project->road_name}}
					</td>
					<td>
						{{$project->project_status}}
					</td>
					<td>
						{{$req->main_category}}
					</td>
					<td>
						{{$req->sub_category}}
					</td>
					<td>
						{{$req->requirement_date}}
					</td>
				</tr>
				
			</tbody>
		</table>
		<br>
	</div>
</div>
</div>
<script type="text/javascript">
	function printview(){
		document.getElementById('print').style.display = 'none';
		document.getElementById('lpo').style.display = 'none';
		document.getElementById('back').style.display = 'none';
		window.print();
        document.getElementById('print').style.display = 'initial';
		document.getElementById('lpo').style.display = 'initial';
		document.getElementById('back').style.display = 'initial';
        return false;
	}
</script>
@endsection