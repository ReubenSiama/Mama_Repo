@extends('layouts.leheader')

@section('content')
<div class="container">
<div class="row"> 
<br> 
<div class="panel panel-primary" style="margin-left: 2%;margin-right: 2%">
  <div class="panel-heading">
    <p>Please Select One</p>
  </div>
  <div class="panel-body">
        <div class="col-md-12"> 
          <table class="table table-responsive table-striped">
          <tbody>
              <br><br>
              <tr style="border-bottom-style: hidden; border-top-style: hidden; background-color: white">
                <td><a class="btn btn-primary btn-md form-control" href="{{ URL::to('/')}}/addprojbuyer">Add New Project</a></td>
                <td><a class="btn btn-success btn-md form-control" href="{{ URL::to('/')}}/updprojbuyer">Update Project</a></td>
              </tr>
              <tr style="border-bottom-style: hidden; border-top-style: hidden; background-color: white;">
                <td></td><td></td>
              </tr> 
              <tr style="border-bottom-style: hidden; border-top-style: hidden; background-color: white">
                <td><a style="margin-left: 50%" class="btn btn-info btn-md form-control" href="{{ URL::to('/')}}/enqprojbuyer">Project Enquiry</a></td> 
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

@endsection