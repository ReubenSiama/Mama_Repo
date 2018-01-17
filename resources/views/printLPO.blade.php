@extends('layouts.app')

@section('content')
<div class="col-md-12">
	<div class="panel panel-primary">
		
		<div class="panel-body"><br>
			<img src="{{URL::to('/')}}/logo.png" id="image" />
			<p class="pull-right" style="font-size: 2em; font-weight: bold">PURCHASE ORDER</p><br><br>
			<div style="width:100%">
				<p style="font-weight: bold">Mama Home Pvt Ltd</p>
				<p>#363, 19th Main Road 1st Block,<br>Rajajinagar, Bangalore-560010<br>Ph: 9110636146<br>Email: info@mamahome360.com
			</div>
			<br>
			
		</div>
	</div>
</div>
@endsection