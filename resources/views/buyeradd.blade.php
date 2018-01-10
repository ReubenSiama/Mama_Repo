@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @if(!$subwards)
                  No Subward assigned
                  @else
                  You're Assigned Ward is  {{$subwards->sub_ward_name}}
                  @endif
                  @if(session('Success'))
                    <div class="alert-success pull-right">{{ session('Success')}} </div>
                  @endif
                  @if(session('Error'))
                    <div class="alert-danger pull-right">{{ session('Error')}} </div>
                  @endif
                </div>
                @if($subwards)
                <div class="panel-body">
                    <center>
                    <label>Project Details</label>
                    <br>
                        <button id="getBtn" class="btn btn-success btn-sm" onclick="getLocation()">Get Location</button>
                    </center><br>
                   <form method="POST" action="{{ URL::to('/') }}/addProject" enctype="multipart/form-data">
                    <div id="first">
                    {{ csrf_field() }}
                           <table class="table">
                               <tr>
                                   <td>Project Name</td>
                                   <td>:</td>
                                   <td><input id="pName" required type="text" placeholder="Project Name" class="form-control input-sm" name="pName" value="{{ old('pName') }}" ></td>
                               </tr>
                               <tr>
                                   <td>Location</td>
                                   <td>:</td>
                                   <td id="x">
                                    <div class="col-sm-6">
                                        <input placeholder="Longitude" class="form-control input-sm" required type="text" name="longitude" value="{{ old('longitude') }}" id="longitude">
                                    </div>
                                    <div class="col-sm-6">
                                        <input placeholder="latitude" class="form-control input-sm" required type="text" name="latitude" value="{{ old('latitude') }}" id="latitude">
                                    </div>
                                   </td>
                               </tr>
                               <tr>
                                   <td>Road Name</td>
                                   <td>:</td>
                                   <td><input id="road" required type="text" placeholder="Road Name" class="form-control input-sm" name="rName" value="{{ old('rName') }}"></td>
                               </tr>
                               <tr class="{{ $errors->has('address') ? ' has-error' : '' }}">
                                   <td>Address</td>
                                   <td>:</td>
                                   <td><input id="address" required type="text" placeholder="Address" class="form-control input-sm" name="address" value="{{ old('address') }}"></td>
                               </tr>
                               <tr>
                                   <td>Municipal Approval</td>
                                   <td>:</td>
                                   <td><input type="file" accept="image/*" class="form-control input-sm" name="mApprove"></td>
                               </tr>
                               <tr>
                                   <td>Other Approvals</td>
                                   <td>:</td>
                                   <td><input type="file" accept="image/*" class="form-control input-sm" name="oApprove"></td>
                               </tr>
                               <tr>
                                   <td>Project Status</td>
                                   <td>:</td>
                                   <td>
                                       <select id="status" required name="status" class="form-control input-sm">
                                           <option value="">--Select--</option>
                                           <option value="Planning">Planning</option>
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical &amp; Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                       </select>
                                   </td>
                               </tr>
                               <tr>
                                   <td>Project Type</td>
                                   <td>:</td>
                                   <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                          <input value="{{ old('basement') }}" onkeyup="check('basement')" id="basement" name="basement" type="text" autocomplete="off" class="form-control input-sm" placeholder="Basement" id="email">
                                        </div>
                                        <div class="col-md-2">
                                          <b style="font-size: 20px; text-align: center">+</b>
                                        </div>
                                      <div class="col-md-3">
                                        <input value="{{ old('ground') }}" onkeyup="check('ground');" autocomplete="off" name="ground" id="ground" type="text" class="form-control" placeholder="Ground">
                                      </div>
                                      <div class="col-md-3">
                                        <p id="total"></p>
                                      </div>
                                    </div>
                                    </td>
                               </tr>
                               <tr>
                                   <td>Project Size (Approx.)</td>
                                   <td>:</td>
                                   <td><input value="{{ old('pSize') }}" id="pSize" required placeholder="Project Size in Sq. Ft." type="text" class="form-control input-sm" name="pSize" onkeyup="check('pSize')"></td>
                               </tr>
                               <tr>
                                   <td>Budget (Approx.)</td>
                                   <td>:</td>
                                   <td><input value="{{ old('budget') }}" id="budget" required placeholder="Budget in Crores" type="text" onkeyup="check('budget')" class="form-control input-sm" name="budget"></td>
                               </tr>
                               <tr>
                                   <td>Project Image</td>
                                   <td>:</td>
                                   <td><input id="img" required type="file" accept="image/*" class="form-control input-sm" name="pImage"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="second" class="hidden">
                           <label>Owner Details</label>
                           <table class="table">
                               <tr>
                                   <td>Owner Name</td>
                                   <td>:</td>
                                   <td><input value="{{ old('oName') }}" type="text" placeholder="Owner Name" class="form-control input-sm" name="oName" id="oName"></td>
                               </tr>
                               <tr>
                                   <td>Owner Email</td>
                                   <td>:</td>
                                   <td><input value="{{ old('oEmail') }}" onblur="checkmail('oEmail')" placeholder="Owner Email" type="email" class="form-control input-sm" name="oEmail" id="oEmail"></td>
                               </tr>
                               <tr>
                                   <td>Owner Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ old('oContact') }}" id="oPhone" onkeyup="check('oContact')" maxlength="10"  minlength="10" placeholder="Owner Contact No." type="text" class="form-control input-sm" name="oContact" id="oContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="third" class="hidden">
                           <label>Contractor Details</label>
                           <table class="table">
                               <tr>
                                   <td>Contractor Name</td>
                                   <td>:</td>
                                   <td><input value="{{ old('cName') }}" type="text" placeholder="Contractor Name" class="form-control input-sm" name="cName" id="cName"></td>
                               </tr>
                               <tr>
                                   <td>Contractor Email</td>
                                   <td>:</td>
                                   <td><input value="{{ old('cEmail') }}" placeholder="Contractor Email" type="email" class="form-control input-sm" name="cEmail" id="cEmail" onblur="checkmail('cEmail')" ></td>
                               </tr>
                               <tr>
                                   <td>Contractor Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ old('cContact') }}" id="cPhone" onkeyup="check('cPhone')" placeholder="Contractor Contact No." type="text" class="form-control input-sm" name="cContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="fourth" class="hidden">
                           <label>Consultant Details</label>
                           <table class="table">
                               <tr>
                                   <td>Consultant Name</td>
                                   <td>:</td>
                                   <td><input value="{{ old('coName') }}" type="text" placeholder="Consultant Name" class="form-control input-sm" name="coName"></td>
                               </tr>
                               <tr>
                                   <td>Consultant Email</td>
                                   <td>:</td>
                                   <td><input value="{{ old('coEmail') }}" placeholder="Consultant Email" type="email" class="form-control input-sm" name="coEmail" id="coEmail" onblur="checkmail('coEmail')"></td>
                               </tr>
                               <tr>
                                   <td>Consultant Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ old('coContact') }}" placeholder="Consultant Contact No." type="text" class="form-control input-sm" name="coContact" id="coContact" onkeyup="check('coContact')"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="fifth" class="hidden">
                           <label>Site Engineer Details</label>
                           <table class="table">
                               <tr>
                                   <td>Site Engineer Name</td>
                                   <td>:</td>
                                   <td><input value="{{ old('eName') }}" type="text" placeholder="Site Engineer Name" class="form-control input-sm" name="eName"></td>
                               </tr>
                               <tr>
                                   <td>Site Engineer Email</td>
                                   <td>:</td>
                                   <td><input value="{{ old('eEmail') }}" placeholder="Site Engineer Email" type="email" class="form-control input-sm" name="eEmail" id="eEmail" onblur="checkmail('eEmail')"></td>
                               </tr>
                               <tr>
                                   <td>Site Engineer Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ old('eContact') }}"  id="sePhone" placeholder="Site Engineer Contact No." type="text" class="form-control input-sm" name="eContact" id="eContact" onkeyup="check('eContact')"></td>
                               </tr>
                           </table>
                       </div> 
                       <div id="sixth" class="hidden">
                           <label>Procurement Details</label>
                           <table class="table">
                               <tr>
                                   <td>Procurement Name</td>
                                   <td>:</td>
                                   <td><input id="prName" required type="text" placeholder="Procurement Name" class="form-control input-sm" name="prName" value="{{ old('prName') }}"></td>
                               </tr>
                               <tr>
                                   <td>Procurement Email</td>
                                   <td>:</td>
                                   <td><input value="{{ old('pEmail') }}" placeholder="Procurement Email" type="email" class="form-control input-sm" name="pEmail" id="pEmail" onblur="checkmail('pEmail')"></td>
                               </tr>
                               <tr>
                                   <td>Procurement Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ old('pContact') }}"  required placeholder="Procurement Contact No." type="text" class="form-control input-sm" name="pContact" id="prPhone" onkeyup="check('prPhone')"></td>
                               </tr>
                           </table>
                       </div> 
                       <div id="seventh" class="hidden">
                            <textarea class="form-control" placeholder="Remarks (Optional)" name="remarks"></textarea><br>
                            <button type="submit" class="form-control btn btn-primary">Submit Data</button>
                       </div>                        
                       <ul class="pager">
                          <li class="previous"><a onclick="pagePrevious()" href="#">Previous</a></li>
                          <li class="next"><a id="next" href="#" onclick="pageNext()">Next</a></li>
                        </ul>
                   </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--This line by Siddharth -->
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
<!--This line by Siddharth -->
<!-- get location -->
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" charset="utf-8">
  function getLocation(){
      document.getElementById("getBtn").className = "hidden";
      console.log("Entering getLocation()");
      if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(
        displayCurrentLocation,
        displayError,
        { 
          maximumAge: 3000, 
          timeout: 5000, 
          enableHighAccuracy: true 
        });
    }else{
      alert("Oops.. No Geo-Location Support !");
    } 
      //console.log("Exiting getLocation()");
  }
    
    function displayCurrentLocation(position){
      //console.log("Entering displayCurrentLocation");
      var latitude  = position.coords.latitude;
      var longitude = position.coords.longitude;
      document.getElementById("longitude").value = longitude;
      document.getElementById("latitude").value  = latitude;
      //console.log("Latitude " + latitude +" Longitude " + longitude);
      getAddressFromLatLang(latitude,longitude);
      //console.log("Exiting displayCurrentLocation");
    }
   
  function  displayError(error){
    console.log("Entering ConsultantLocator.displayError()");
    var errorType = {
      0: "Unknown error",
      1: "Permission denied by user",
      2: "Position is not available",
      3: "Request time out"
    };
    var errorMessage = errorType[error.code];
    if(error.code == 0  || error.code == 2){
      errorMessage = errorMessage + "  " + error.message;
    }
    alert("Error Message " + errorMessage);
    console.log("Exiting ConsultantLocator.displayError()");
  }
  function getAddressFromLatLang(lat,lng){
    //console.log("Entering getAddressFromLatLang()");
    var geocoder = new google.maps.Geocoder();
    var latLng = new google.maps.LatLng(lat, lng);
    geocoder.geocode( { 'latLng': latLng}, function(results, status) {
        // console.log("After getting address");
        // console.log(results);
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        //console.log(results[1]);
        document.getElementById("address").value = results[1].formatted_address;
      }
    }else{
        alert("Geocode was not successful for the following reason: " + status);
     }
    });
    //console.log("Entering getAddressFromLatLang()");
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGSf_6gjXK-5ipH2C2-XFI7eUxbHg1QTU"></script>

<script type="text/javascript">
    var current = "first";
    function pageNext(){
        if(current == 'first'){
          if(document.getElementById("pName").value == ""){
            window.alert("You have not entered Project Name");
          }else if(document.getElementById("longitude").value == ""){
            window.alert("Please click on Get Location button");
          }else if(document.getElementById("latitude").value == ""){
            window.alert("Kindly click on Get location button");
          }else if(document.getElementById("road").value == ""){
            window.alert("You have not entered Road Name");
          }else if(document.getElementById("status").value == ""){
            window.alert("Select Project Status");
          }else if(document.getElementById("basement").value == ""){
            window.alert("You have not entered Project Name");
          }else if(document.getElementById("ground").value == ""){
            window.alert("You have not entered Project Name");
          }else if(document.getElementById("pSize").value == ""){
            window.alert("You have not entered Project Size");
          }else if(document.getElementById("budget").value == ""){
            window.alert("You have not entered Budget");
          }else if(document.getElementById("img").value == ""){
            window.alert("You have not chosen a file to upload");
          }else{ 
            document.getElementById("first").className = "hidden";
            document.getElementById("second").className = "";
            current = "second"
          }
        }else if(current == 'second'){
            document.getElementById("second").className = "hidden";
            document.getElementById("third").className = "";
            current = "third";
        }else if(current == 'third'){
            document.getElementById("third").className = "hidden";
            document.getElementById("fourth").className = "";
            current = "fourth";
        }else if(current == 'fourth'){
            document.getElementById("fourth").className = "hidden";
            document.getElementById("fifth").className = "";
            current = "fifth";
        }else if(current == 'fifth'){
            document.getElementById("fifth").className = "hidden";
            document.getElementById("sixth").className = "";
            current = "sixth";
        }else if(current == 'sixth'){
          if(document.getElementById("prName").value == ""){
            window.alert("Please Enter Procurement Name");
          }else if(document.getElementById("pContact") == ""){
            window.alert("Please enter phone number");
          }else{ 
            document.getElementById("sixth").className = "hidden";
            document.getElementById("seventh").className = "";
            current = "seventh";
          }
        }
    }
    function pagePrevious(){
        if(current == 'seventh'){
            document.getElementById("seventh").className = "hidden";
            document.getElementById("sixth").className = "";
            current = "sixth"
        }else if(current == 'sixth'){
            document.getElementById("sixth").className = "hidden";
            document.getElementById("fifth").className = "";
            current = "fifth"
        }
        else if(current == 'fifth'){
            document.getElementById("fifth").className = "hidden";
            document.getElementById("fourth").className = "";
            current = "fourth"
        }
        else if(current == 'fourth'){
            document.getElementById("fourth").className = "hidden";
            document.getElementById("third").className = "";
            current = "third"
        }
        else if(current == 'third'){
            document.getElementById("third").className = "hidden";
            document.getElementById("second").className = "";
            current = "second"
        }else if(current == 'second'){
            document.getElementById("second").className = "hidden";
            document.getElementById("first").className = "";
            current = "first";
        }else{
            document.getElementById("next").className = "disabled";
        }
    }
</script>

<script type="text/javascript">
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
    //For ground and basement generation
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
