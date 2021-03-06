@extends('layouts.leheader')

@section('content')

@if($ldate < $lodate)
  <div>You are ahead of time.</div>
  @elseif($ldate > $outtime)
  <div>You are done for today. Take a rest.</div>
  @else
<div class="container">
    <div class="row">
      @if($subwards)
      
      <div class="col-md-3"> 
        <div class="panel panel-default">
        <div class="panel-heading">
         You are in {{$subwards->sub_ward_name}}</div>
         <div class="panel-body">
         <a class="btn btn-primary form-control" href="{{ URL::to('/')}}/listingEngineer">Add New Project</a><br><br>
         <a class="btn btn-primary form-control" href="{{ URL::to('/')}}/roads">Update Project</a><br><br>
         <a class="btn btn-primary form-control" href="{{ URL::to('/')}}/requirementsroads">Project Enquiry</a><br><br>
         <a class="btn btn-primary form-control" href="{{ URL::to('/')}}/logistics">Logistics</a><br><br>
         <a class="btn btn-primary form-control" href="{{ URL::to('/')}}/reports">My Report</a><br><br>
         </div>
       </div>
     </div>
         <label>
           You have listed <strong>{{ $numbercount }}</strong> projects so far.
         </label>
       </div>
        <div class="pull-right col-lg-8">
          <img class="img-thumbnail" src="{{ URL::to('/') }}/subWardImages/{{ $subwards->sub_ward_image }}">
        </div>
       @else
       No wards assigned to you yet
       @endif
    </div>
</div>

<br><br>

<div class="col-md-8 col-md-offset-2" style="border-style: ridge;">
<div id="map" style="width:100%;height:400px"></div>
</div>

<script type="text/javascript" scr="http://maps.google.com/maps/api/js?sensor=false"></script>

  <script type="text/javascript">
    window.onload = function() {
    var locations = new Array();
    var created = new Array();
    var updated = new Array();
    @foreach($projects as $project)
      locations.push(["<a href=\"https://maps.google.com/?q={{ $project->siteaddress->address }}\">{{ $project->siteaddress->address }}</a>",{{ $project->siteaddress->latitude}}, {{ $project->siteaddress->longitude }}]);
      created.push("{{ $project->created_at}}");
      updated.push("{{ $project->updated_at}}");
    @endforeach

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(locations[0][1], locations[0][2]),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
    if(created[i] == updated[i]){
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
      });
    }else{
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
      });
    }

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  }
  </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGSf_6gjXK-5ipH2C2-XFI7eUxbHg1QTU&callback=myMap"></script>
@endif
@endsection