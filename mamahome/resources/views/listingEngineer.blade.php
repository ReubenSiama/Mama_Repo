@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">You're Assigned Ward is  {{$subwards->sub_ward_name}}</div>
                <div class="panel-body">
                    <center>
                    <label>Project Details</label>
                    <br>
                        <button id="getBtn" class="btn btn-success btn-sm" onclick="getLocation()">Get Location</button>
                    </center><br>
                   <form method="POST" action="/addProject" enctype="multipart/form-data">
                    <div id="first">
                    {{ csrf_field() }}
                           <table class="table">
                               <tr>
                                   <td>Project Name</td>
                                   <td>:</td>
                                   <td><input id="pName" required type="text" placeholder="Project Name" class="form-control input-sm" name="pName"></td>
                               </tr>
                               <tr>
                                   <td>Location</td>
                                   <td>:</td>
                                   <td id="x">
                                    <div class="col-sm-6">
                                        <input placeholder="Longitude" class="form-control input-sm" required type="text" name="longitude" value="" id="longitude">
                                    </div>
                                    <div class="col-sm-6">
                                        <input placeholder="latitude" class="form-control input-sm" required type="text" name="latitude" value="" id="latitude">
                                    </div>
                                   </td>
                               </tr>
                               <tr>
                                   <td>Road Name</td>
                                   <td>:</td>
                                   <td><input id="road" required type="text" placeholder="Road Name" class="form-control input-sm" name="rName"></td>
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
                                          <input id="basement" name="basement" type="number" autocomplete="off" class="form-control input-sm" placeholder="Basement" id="email">
                                        </div>
                                        <div class="col-md-2">
                                          <b style="font-size: 20px; text-align: center">+</b>
                                        </div>
                                      <div class="col-md-3">
                                        <input oninput="sum()" autocomplete="off" name="ground" id="ground" type="number" class="form-control input-sm" placeholder="Ground">
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
                                   <td><input id="pSize" required placeholder="Project Size in Sq." type="number" class="form-control input-sm" name="pSize"></td>
                               </tr>
                               <tr>
                                   <td>Budget</td>
                                   <td>:</td>
                                   <td><input id="budget" required placeholder="Budget in Crores" type="number" class="form-control input-sm" name="budget"></td>
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
                                   <td><input type="text" placeholder="Owner Name" class="form-control input-sm" name="oName"></td>
                               </tr>
                               <tr>
                                   <td>Owner Email</td>
                                   <td>:</td>
                                   <td><input placeholder="Owner Email" type="email" class="form-control input-sm" name="oEmail"></td>
                               </tr>
                               <tr>
                                   <td>Owner Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input id="oPhone" onchange="checkPhone()" placeholder="Owner Contact No." type="text" class="form-control input-sm" name="oContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="third" class="hidden">
                           <label>Contractor Details</label>
                           <table class="table">
                               <tr>
                                   <td>Contractor Name</td>
                                   <td>:</td>
                                   <td><input type="text" placeholder="Contractor Name" class="form-control input-sm" name="cName"></td>
                               </tr>
                               <tr>
                                   <td>Contractor Email</td>
                                   <td>:</td>
                                   <td><input placeholder="Contractor Email" type="email" class="form-control input-sm" name="cEmail"></td>
                               </tr>
                               <tr>
                                   <td>Contractor Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input id="cPhone" onchange="checkPhone1()" placeholder="Contractor Contact No." type="number" class="form-control input-sm" name="cContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="fourth" class="hidden">
                           <label>Consultant Details</label>
                           <table class="table">
                               <tr>
                                   <td>Consultant Name</td>
                                   <td>:</td>
                                   <td><input type="text" placeholder="Consultant Name" class="form-control input-sm" name="coName"></td>
                               </tr>
                               <tr>
                                   <td>Consultant Email</td>
                                   <td>:</td>
                                   <td><input placeholder="Consultant Email" type="email" class="form-control input-sm" name="coEmail"></td>
                               </tr>
                               <tr>
                                   <td>Consultant Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input  id="coPhone" onchange="checkPhone2()" placeholder="Consultant Contact No." type="number" class="form-control input-sm" name="coContact"></td>
                               </tr>
                           </table>
                       </div>
                       <div id="fifth" class="hidden">
                           <label>Site Engineer Details</label>
                           <table class="table">
                               <tr>
                                   <td>Site Engineer Name</td>
                                   <td>:</td>
                                   <td><input type="text" placeholder="Site Engineer Name" class="form-control input-sm" name="eName"></td>
                               </tr>
                               <tr>
                                   <td>Site Engineer Email</td>
                                   <td>:</td>
                                   <td><input placeholder="Site Engineer Email" type="email" class="form-control input-sm" name="eEmail"></td>
                               </tr>
                               <tr>
                                   <td>Site Engineer Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input  id="sePhone" onchange="checkPhone3()" placeholder="Site Engineer Contact No." type="number" class="form-control input-sm" name="eContact"></td>
                               </tr>
                           </table>
                       </div> 
                       <div id="sixth" class="hidden">
                           <label>Procurement Details</label>
                           <table class="table">
                               <tr>
                                   <td>Procurement Name</td>
                                   <td>:</td>
                                   <td><input id="prName" required type="text" placeholder="Procurement Name" class="form-control input-sm" name="pName"></td>
                               </tr>
                               <tr>
                                   <td>Procurement Email</td>
                                   <td>:</td>
                                   <td><input id="pEmail" required placeholder="Procurement Email" type="email" class="form-control input-sm" name="pEmail"></td>
                               </tr>
                               <tr>
                                   <td>Procurement Contact No.</td>
                                   <td>: <p class="pull-right">+91</p></td>
                                   <td><input id="prPhone" onchange="checkPhone4()" required placeholder="Procurement Contact No." type="number" class="form-control input-sm" name="pContact"></td>
                               </tr>
                           </table>
                       </div> 
                       <div id="seventh" class="hidden">
                            <textarea required class="form-control" placeholder="Remarks" name="remarks"></textarea><br>
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
    var floor = basement + ground + 1;
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

<script type="text/javascript">
  function checkPhone(){
  var phone = document.getElementById("oPhone").value;
    if(isNaN(phone)){
      window.alert("Phone Number contains only numbers");
    }else if(phone.length != 10){
      window.alert("Please provide a valid phone number");
    }
  }
  function checkPhone1(){
  var phone = document.getElementById("cPhone").value;
    if(phone.length != 10){
      window.alert("Please provide a valid phone number");
    }
  }
  function checkPhone2(){
  var phone = document.getElementById("coPhone").value;
    if(phone.length != 10){
      window.alert("Please provide a valid phone number");
    }
  }
  function checkPhone3(){
  var phone = document.getElementById("sePhone").value;
    if(phone.length != 10){
      window.alert("Please provide a valid phone number");
    }
  }
  function checkPhone4(){
  var phone = document.getElementById("prPhone").value;
    if(phone.length != 10){
      window.alert("Please provide a valid phone number");
    }
  }
</script>
@endsection
