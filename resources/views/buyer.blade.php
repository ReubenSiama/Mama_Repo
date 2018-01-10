@extends('layouts.leheader')

@section('content')
<div class="container">
<div class="row">  
<div class="panel panel-primary" style="margin-left: 2%;margin-right: 2%">
  <div class="panel-heading">
    <label><b>Please Select One</b></label>
  </div>
  <div class="panel-body">
        <div class="col-md-10 col-md-offset-1"> 
          <table class="table table-responsive table-striped">
          <tbody>
          <br><br>
          <tr style="border-bottom-style: hidden; border-top-style: hidden; background-color: white">
          <td><button class="btn btn-primary btn-md form-control" href="{{ URL::to('/')}}/addprojbuyer">Add New Project</button></td>
          <td><button class="btn btn-success btn-md form-control" href="{{ URL::to('/')}}/updprojbuyer">Update Project</button></td>
          </tr>
          <tr style="border-bottom-style: hidden; border-top-style: hidden; background-color: white;">
            <td></td><td></td>
          </tr> 
          <tr style="border-bottom-style: hidden; border-top-style: hidden; background-color: white">
          <td><button class="btn btn-info btn-md form-control" href="{{ URL::to('/')}}/enqprojbuyer">Project Enquiry</button></td>
          
          </tr>
          </tbody>
          </table>
          <br><br>
        </div>
        <div class="pull-right col-lg-8">
          <?php // <img class="img-thumbnail" src="{{  URL::to('/') }}/subWardImages/{{ $subwards->sub_ward_image }}"> ?>
        </div>
      </div>
    </div>
  </div>
</div>  
<div class="panel panel-default">
<div>You are ahead of time.</div><br>
<div>You are done fohfjhvhr today. Take a rest.</div>
</div>
@endsection