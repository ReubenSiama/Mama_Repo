@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Listing Engineers
                    @if(session('Error'))
                        <div class="alert-danger pull-right">{{ session('Error')}}</div>
                    @endif
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>Employee Id</th>
                            <th>Name</th>
                            <th>Wards Assigned</th>
                            <th>Images</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <div class="hidden">{{ $true = 0 }}</div>
                            <tr>
                                <td>{{ $user->employeeId }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @foreach($subwardsAssignment as $subward)
                                    @if($user->id == $subward->user_id)
                                        {{ $subward->subward->sub_ward_name}}
                                        <div class="hidden">{{ $true = 1 }}</div>
                                    @endif
                                    @endforeach
                                    @if($true == 0)
                                    <a href="#" data-toggle="modal" data-target="#assignWards{{ $user->id }}">Assign Wards</a>
                                    @endif
                                </td>
                                <td>
                                    @foreach($subwardsAssignment as $subward)
                                    @if($user->id == $subward->user_id)
                                    <a href="{{ URL::to('/') }}/subWardImages/{{ $subward->subward->sub_ward_image }}">Click here to view image</a>
                                    @endif
                                    @endforeach
                                </td>
                                <td><a href="{{ URL::to('/') }}/{{ $user->id }}/viewReport" class="btn btn-primary btn-sm">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Main Wards</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>Ward Name</th>
                            <th>Ward Image</th>
                        </thead>
                        <tbody>
                            @foreach($wards as $ward)
                            <tr>
                                <td>{{ $ward->ward_name }}</td>
                                <td><a href="{{ URL::to('/')}}/wardImages/{{ $ward->ward_image }}">Image</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($users as $user)
<!-- Modal -->
<form method="POST" action="{{ URL::to('/') }}/{{ $user->id }}/assignWards">
{{ csrf_field() }}    
    <div id="assignWards{{ $user->id }}" class="modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Assign Wards</h4>
          </div>
          <div class="modal-body">
            Choose Wards:<br>
            <select name="subward" class="form-control">
                <option value="">--Select--</option>
                @foreach($subwards as $subward)
                <option value="{{ $subward->id }}">{{ $subward->sub_ward_name }}</option>
                @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success pull-left">Assign</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</form>
@endforeach

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


@endsection
