@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  You're Assigned Ward is  {{$subwards->sub_ward_name}}
                  @if(session('Success'))
                    <p class="alert-success pull-right">{{ session('Success') }}</p>
                  @endif
                </div>
                <div class="panel-body">
                    <center>
                    <label>Project Details</label>
                    <br>
                   <form method="POST" action="/{{ $projectdetails->project_id }}/updateProject" enctype="multipart/form-data">
                    <div id="first">
                    {{ csrf_field() }}
                           <table class="table">
                               <tr>
                                   <td>Project Name</td>
                                   <td>:</td>
                                   <td><input disabled id="pName" value="{{ $projectdetails->project_name }}" required type="text" placeholder="Project Name" class="form-control input-sm" name="pName"></td>
                               </tr>
                               <tr>
                                   <td>Location</td>
                                   <td>:</td>
                                   <td id="x">
                                    <div class="col-sm-6">
                                        <input disabled value="{{ $projectdetails->siteaddress->longitude }}" placeholder="Longitude" class="form-control input-sm" required type="text" name="longitude" value="" id="longitude">
                                    </div>
                                    <div class="col-sm-6">
                                        <input disabled value="{{ $projectdetails->siteaddress->latitude }}" placeholder="latitude" class="form-control input-sm" required type="text" name="latitude" value="" id="latitude">
                                    </div>
                                   </td>
                               </tr>
                               <tr>
                                   <td>Road Name</td>
                                   <td>:</td>
                                   <td><input id="road" value="{{ $projectdetails->road_name }}" required type="text" placeholder="Road Name" class="form-control input-sm" name="rName"></td>
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
                                           @if($projectdetails->project_status == "Digging")
                                           <option selected value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Foundation")
                                           <option value="Digging">Digging</option>
                                           <option selected value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Pillars")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option selected value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Walls")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option selected value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Roofing")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option selected value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Electrical & Plumbing")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option selected value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Plastering")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option selected value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Flooring")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option selected value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Carpentry")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option selected value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Painting")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option selected value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Fixtures")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option selected value="Fixtures">Fixtures</option>
                                           <option value="Completion">Completion</option>
                                           @elseif($projectdetails->project_status == "Completion")
                                           <option value="Digging">Digging</option>
                                           <option value="Foundation">Foundation</option>
                                           <option value="Pillars">Pillars</option>
                                           <option value="Walls">Walls</option>
                                           <option value="Roofing">Roofing</option>
                                           <option value="Electrical & Plumbing">Electrical & Plumbing</option>
                                           <option value="Plastering">Plastering</option>
                                           <option value="Flooring">Flooring</option>
                                           <option value="Carpentry">Carpentry</option>
                                           <option value="Paintings">Paintings</option>
                                           <option value="Fixtures">Fixtures</option>
                                           <option selected value="Completion">Completion</option>
                                           @endif
                                       </select>
                                   </td>
                               </tr>
                               <tr>
                                   <td>Project Type</td>
                                   <td>:</td>
                                   <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                          <input value="{{ $projectdetails->basement }}" id="basement" name="basement" type="number" autocomplete="off" class="form-control input-sm" placeholder="Basement">
                                        </div>
                                        <div class="col-md-2">
                                          <b style="font-size: 20px; text-align: center">+</b>
                                        </div>
                                      <div class="col-md-3">
                                        <input value="{{ $projectdetails->ground }}" oninput="sum()" autocomplete="off" name="ground" id="ground" type="number" class="form-control input-sm" placeholder="Ground">
                                      </div>
                                      <div class="col-md-3">
                                        <p id="total"></p>
                                      </div>
                                    </div>
                                    </td>
                               </tr>
                               <tr>
                                   <td>Project Size</td>
                                   <td>:</td>
                                   <td><input id="pSize" value="{{ $projectdetails->project_size }}" required placeholder="Project Size" type="text" class="form-control input-sm" name="pSize"></td>
                               </tr>
                               <tr>
                                   <td>Budget</td>
                                   <td>:</td>
                                   <td><input id="budget" value="{{ $projectdetails->budget }}" required placeholder="Budget" type="text" class="form-control input-sm" name="budget"></td>
                               </tr>
                               <tr>
                                   <td>Project Image</td>
                                   <td>:</td>
                                   <td><input id="img" value="{{ $projectdetails->image }}" type="file" accept="image/*" class="form-control input-sm" name="pImage"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="second" class="hidden">
                           <label>Owner Details</label>
                           <table class="table">
                               <tr>
                                   <td>Owner Name</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->ownerdetails->owner_name }}" type="text" placeholder="Owner Name" class="form-control input-sm" name="oName"></td>
                               </tr>
                               <tr>
                                   <td>Owner Email</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->ownerdetails->owner_email }}" placeholder="Owner Email" type="email" class="form-control input-sm" name="oEmail"></td>
                               </tr>
                               <tr>
                                   <td>Owner Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ $projectdetails->ownerdetails->owner_contact_no }}" placeholder="Owner Contact No." type="text" class="form-control input-sm" name="oContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="third" class="hidden">
                           <label>Contractor Details</label>
                           <table class="table">
                               <tr>
                                   <td>Contractor Name</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->contractordetails->contractor_name }}" type="text" placeholder="Contractor Name" class="form-control input-sm" name="cName"></td>
                               </tr>
                               <tr>
                                   <td>Contractor Email</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->contractordetails->contractor_contact_no }}" placeholder="Contractor Email" type="email" class="form-control input-sm" name="cEmail"></td>
                               </tr>
                               <tr>
                                   <td>Contractor Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ $projectdetails->contractordetails->contractor_email }}" placeholder="Contractor Contact No." type="text" class="form-control input-sm" name="cContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="fourth" class="hidden">
                           <label>Consultant Details</label>
                           <table class="table">
                               <tr>
                                   <td>Consultant Name</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->consultantdetails->consultant_name }}" type="text" placeholder="Consultant Name" class="form-control input-sm" name="coName"></td>
                               </tr>
                               <tr>
                                   <td>Consultant Email</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->consultantdetails->consultant_email }}" placeholder="Consultant Email" type="email" class="form-control input-sm" name="coEmail"></td>
                               </tr>
                               <tr>
                                   <td>Consultant Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ $projectdetails->consultantdetails->consultant_contact_no }}" placeholder="Consultant Contact No." type="text" class="form-control input-sm" name="coContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="fifth" class="hidden">
                           <label>Site Engineer Details</label>
                           <table class="table">
                               <tr>
                                   <td>Site Engineer Name</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->siteengineerdetails->site_engineer_name }}" type="text" placeholder="Site Engineer Name" class="form-control input-sm" name="eName"></td>
                               </tr>
                               <tr>
                                   <td>Site Engineer Email</td>
                                   <td>:</td>
                                   <td><input value="{{ $projectdetails->siteengineerdetails->site_engineer_email }}" placeholder="Site Engineer Email" type="email" class="form-control input-sm" name="eEmail"></td>
                               </tr>
                               <tr>
                                   <td>Site Engineer Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input value="{{ $projectdetails->siteengineerdetails->site_engineer_contact_no }}" placeholder="Site Engineer Contact No." type="text" class="form-control input-sm" name="eContact"></td>
                               </tr>
                           </table>
                       </div> 
                       <div id="sixth" class="hidden">
                           <label>Procurement Details</label>
                           <table class="table">
                               <tr>
                                   <td>Procurement Name</td>
                                   <td>:</td>
                                   <td><input id="prName" value="{{ $projectdetails->procurementdetails->procurement_name }}" required type="text" placeholder="Procurement Name" class="form-control input-sm" name="pName"></td>
                               </tr>
                               <tr>
                                   <td>Procurement Email</td>
                                   <td>:</td>
                                   <td><input id="pEmail" value="{{ $projectdetails->procurementdetails->procurement_email }}" required placeholder="Procurement Email" type="email" class="form-control input-sm" name="pEmail"></td>
                               </tr>
                               <tr>
                                   <td>Procurement Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input id="prPhone" value="{{ $projectdetails->procurementdetails->procurement_contact_no }}" required placeholder="Procurement Contact No." type="text" class="form-control input-sm" name="pContact"></td>
                               </tr>
                           </table>
                       </div> 
                       <div id="seventh" class="hidden">
                            <textarea class="form-control" placeholder="Remarks" name="remarks"></textarea><br>
                            <button type="submit" class="form-control btn btn-primary">Submit Data</button>
                       </div>                        
                       <ul class="pager">
                          <li class="previous"><a onclick="pagePrevious()" href="#">Previous</a></li>
                          <li class="next"><a id="next" href="#" onclick="pageNext()">Next</a></li>
                        </ul>
                   </form>
                </div>
            </div>
        </div>
<a href="/leDashboard" class="btn btn-primary">Back</a>
    </div>
</div>
<script>
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        document.getElementById("getBtn").className = "hidden";
    } else {
        document.getElementById("x").innerHTML = "Please try it later.";
    }
}
function showPosition(position) { 
    document.getElementById("longitude").value = position.coords.longitude;
    document.getElementById("latitude").value = position.coords.latitude;
}
var basement;
var ground;
function sum(){
    basement = parseInt(document.getElementById("basement").value);
    ground = parseInt(document.getElementById("ground").value);
    var floor = basement + ground;
    if(document.getElementById("basement").value != "" && document.getElementById("ground").value != "" && document.getElementById("basement").value != NaN && document.getElementById("ground").value != NaN){
      document.getElementById("total").innerHTML = floor;
    }else{
      document.getElementById("total").innerHTML = "";
    }
}
</script>

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
          }else if(document.getElementById("pEmail").value == ""){
            window.alert("Please Enter Procurement Email");
          }else if(document.getElementById("prPhone") == ""){
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
@endsection
