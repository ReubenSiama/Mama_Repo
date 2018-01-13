@extends('layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">
<div class="panel panel-primary" style="overflow:scroll">
	<div class="panel-heading">
		<strong style="color:white">View</strong>
		<a class="pull-right btn btn-sm btn-danger" href="{{ URL::to('/') }}/{{ $id }}/requirements" style="color:white; font-weight: bold; margin-top: -0.4%">Back</a>
	</div>
	<div class="panel-body">
		 <table class="table table-responsive table-striped">
			<thead>
				<tr>
					<th style="text-align: center">
						Main Category
					</th>
					<th style="text-align: center">
						Sub Category				
					</th >
					<th style="text-align: center">
						Requirement Date
					</th>
					<th style="text-align: center">
						Quantity
					</th>
					<th style="text-align: center">
						Unit Price
					</th>
					<th style="text-align: center">
						Total
					</th>
				</tr>	
			</thead>
			<tbody>
				<tr style="text-align: center">
					<td>
						{{ $project->main_category }}
					</td>
					<td>
						{{ $project->sub_category }}
					</td>
					<td>
						{{ $project->requirement_date }}
					</td>
					<td>
						{{ $project->quantity }} {{ $project->measurement_unit }}
					</td>
					<td>
						{{ $project->unit_price }}
					</td>
					<td>
						Rs. {{ $project->total }}
					</td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
</div>
</div>

@endsection