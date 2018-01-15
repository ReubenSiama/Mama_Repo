<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\User;
use App\Group;
use App\Ward;
use App\SubWard;
use App\Country;
use App\Territory;
use App\WardAssignment;
use App\ProjectDetails;
use App\ConsultantDetails;
use App\ContractorDetails;
use App\ProcurementDetails;
use App\OwnerDetails;
use App\SiteAddress;
use App\SiteEngineerDetails;
use App\State;
use App\Zone;
use App\loginTime;
use App\Requirement;
use Auth;
use Validator;

class mamaController extends Controller
{
    public function addDepartment(Request $request)
    {
    	$department = New Department;
    	$department->dept_name = $request->dept_name;
    	if($department->save()){
    		return back()->with('Success','New Department Added');
    	}else{
    		return back()->with('Error','Seems there is some problem in the input');
    	}
    }
    public function deleteDepartment(Request $request)
    {
    	User::where('department_id',$request->id)->update([
    		'department_id' => 1
    	]);
    	Department::where('id',$request->id)->delete();
    	return back()->with('Success','Department deleted');
    }
    public function addEmployee(Request $request)
    {
    	$user = New User;
    	$user->employeeId = $request->emp_id;
    	$user->department_id = $request->dept;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt('mama@home123');
    	if($user->save()){
    		return back()->with('Added','Employee Added Successfully');
    	}else{
    		return back()->with('NotAdded','Employee add unsuccessful');
    	}
    }
    public function deleteEmployee(Request $request)
    {
    	User::where('id',$request->id)->delete();
    	return back()->with('UserSuccess','User deleted');
    }
    public function assignDesignation($id,Request $request)
    {
    	User::where('id',$id)->update([
    		'group_id' => $request->designation
    	]);
    	return back();
    }
    public function addDesignation(Request $request)
    {
    	$group = New Group;
    	$group->group_name = $request->desig_name;
    	if($group->save()){
    		return back();
    	}else{
    		return back();
    	}
    }
    public function deleteDesignation(Request $request)
    {
        Group::where('id',$request->id)->delete();
        return back();
    }
    public function addCountry(Request $request)
    {
        $country = New Country;
        $country->country_code = $request->code;
        $country->country_name = $request->name;
        if($country->save()){
            return back();
        }else{
            return back();
        }
    }
    public function addState(Request $request)
    {
    	$state = New State;
    	$state->zone_id = $request->zone_id;
    	$state->state_name = $request->state_name;
    	$state->save();
    	return back();
    }
    public function addZone(Request $request)
    {
        $check = Zone::where('zone_name',$request->zone_name)->first();
        if(count($check) != 0){
            return back()->with('ErrorZone','Zone Name exists. Try another name');
        }
    	$zone = New Zone;
    	$zone->country_id = $request->sId;
    	$zone->zone_name = $request->zone_name;
    	$zone->save();
    	return back();
    }
    public function addWard(Request $request)
    {
        $cCode = Country::where('id',$request->country)->pluck('country_code')->first();
        $zone = Zone::where('id', $request->zone)->pluck('zone_name')->first();
        $wardname = 
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $request->image->move(public_path('wardImages'),$imageName);
        $ward = New Ward;
        $ward->country_id = $request->country;
        $ward->zone_id = $request->zone;
        $ward->state_id = $request->state;
        $ward->ward_name = "MH_".$cCode."_".$zone."_".$request->name;
        $ward->ward_image = $imageName;
        $ward->save();
        return back();

    }
    public function addSubWard(Request $request)
    {
        $ward = Ward::where('id',$request->ward)->pluck('ward_name')->first();
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $request->image->move(public_path('subWardImages'),$imageName);
        $subWard = New SubWard;
        $subWard->ward_id = $request->ward;
        $subWard->sub_ward_name = $ward.$request->name;
        $subWard->sub_ward_image = $imageName;
        if($subWard->save()){
            return back();
        }else{
            return back();
        }
    }
    public function assignWards($id,Request $request)
    {
        $check = WardAssignment::where('user_id',$id)->get();
        if(count($check) != 0){
            return back()->with('Error','The employee has been already assigned to ward');
        }
        $wardsassignment = New WardAssignment;
        $wardsassignment->user_id = $id;
        $wardsassignment->subward_id = $request->subward;
        if($wardsassignment->save()){
            return back();
        }else{
            return back();
        }
    }
    public function addProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'basement' => 'required',
            'ground' => 'required',
            'pName' => 'required',
            'rName' => 'required',
            'pContact' => 'required'
        ]);
        if ($validator->fails()) {
            return back()
                    ->with('Error','Please check some of the fields again')
                    ->withErrors($validator)
                    ->withInput();
        }
        $basement = $request->basement;
        $ground = $request->ground;
        $floor = $basement + $ground + 1;

        if($request->mApprove != NULL){
            $imageName1 = time().'.'.request()->mApprove->getClientOriginalExtension();
            $request->mApprove->move(public_path('projectImages'),$imageName1);
        }else{
            $imageName1 = "N/A";
        }
        if($request->oApprove != NULL){ 
            $imageName2 = time().'.'.request()->oApprove->getClientOriginalExtension();
            $request->oApprove->move(public_path('projectImages'),$imageName2);
        }else{
            $imageName2 = "N/A";
        }
        $imageName3 = time().'.'.request()->pImage->getClientOriginalExtension();
        $request->pImage->move(public_path('projectImages'),$imageName3);

        $ward = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $projectdetails = New ProjectDetails;
        $projectdetails->sub_ward_id = $ward;
        $projectdetails->project_name = $request->pName;
        $projectdetails->road_name = $request->rName;
        $projectdetails->municipality_approval = $imageName1;
        $projectdetails->other_approvals = $imageName3;
        $projectdetails->project_status = $request->status;
        $projectdetails->basement = $basement;
        $projectdetails->ground = $ground;
        $projectdetails->project_type = $floor;
        $projectdetails->project_size = $request->pSize;
        $projectdetails->budget = $request->budget;
        $projectdetails->image = $imageName3;
        $projectdetails->listing_engineer_id = Auth::user()->id;
        $projectdetails->remarks = $request->remarks;
        $projectdetails->save();

        $siteaddress = New SiteAddress;
        $siteaddress->project_id = $projectdetails->id;
        $siteaddress->latitude = $request->latitude;
        $siteaddress->longitude = $request->longitude;
        $siteaddress->address = $request->address;
        $siteaddress->save();

        $ownerDetails = New OwnerDetails;
        $ownerDetails->project_id = $projectdetails->id;
        $ownerDetails->owner_name = $request->oName;
        $ownerDetails->owner_email = $request->oEmail;
        $ownerDetails->owner_contact_no = $request->oContact;
        $ownerDetails->save();

        $contractorDetails = New ContractorDetails;
        $contractorDetails->project_id = $projectdetails->id;
        $contractorDetails->contractor_name = $request->cName;
        $contractorDetails->contractor_email = $request->cEmail;
        $contractorDetails->contractor_contact_no = $request->cContact;
        $contractorDetails->save();

        $consultantDetails = New ConsultantDetails;
        $consultantDetails->project_id = $projectdetails->id;
        $consultantDetails->consultant_name = $request->coName;
        $consultantDetails->consultant_email = $request->coEmail;
        $consultantDetails->consultant_contact_no = $request->coContact;
        $consultantDetails->save();

        $siteEngineerDetails = New SiteEngineerDetails;
        $siteEngineerDetails->project_id = $projectdetails->id;
        $siteEngineerDetails->site_engineer_name = $request->eName;
        $siteEngineerDetails->site_engineer_email = $request->eEmail;
        $siteEngineerDetails->site_engineer_contact_no = $request->eContact;
        $siteEngineerDetails->save();

        $procurementDetails = New ProcurementDetails;
        $procurementDetails->project_id = $projectdetails->id;
        $procurementDetails->procurement_name = $request->prName;
        $procurementDetails->procurement_email = $request->pEmail;
        $procurementDetails->procurement_contact_no = $request->pContact;
        $procurementDetails->save();
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'lastListingTime' => date('H:i A')
        ]);
        $first = loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->first();
        $assigned = subWard::where('id',$ward)->pluck('sub_ward_name')->first();
        if($first->firstListingTime == NULL){
            loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                'firstListingTime' => date('H:i A')
            ]);
        }
        if($first->allocatedWard == NULL){
            loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                'allocatedWard' => $assigned,
            ]);
        }else if($first->allocatedWard != $assigned){
            $oldassignment = $first->allocatedWard.', '.$assigned;
            loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                'allocatedWard' => $oldassignment,
            ]);
        }
        $check = mktime(12,00,00);
        $checktime = date('H:i:sA',$check);
        $morningcheck=loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->first();
        if(date('H:i:sA') <= $checktime){
            if($morningcheck->noOfProjectsListedInMorning == NULL){
                loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'noOfProjectsListedInMorning' => 1
                ]);                
            }else{
                $number=loginTime::where('user_id',Auth::user()->id)
                    ->where('logindate',date('Y-m-d'))
                    ->pluck('noOfProjectsListedInMorning')
                    ->first();
                loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'noOfProjectsListedInMorning' => $number + 1
                ]); 
            }
        }
        if($morningcheck->TotalProjectsListed == NULL){
             loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'TotalProjectsListed' => 1
                ]);
        }else{
            $number2=loginTime::where('user_id',Auth::user()->id)
                    ->where('logindate',date('Y-m-d'))
                    ->pluck('TotalProjectsListed')
                    ->first();
                loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'TotalProjectsListed' => $number2 + 1
                ]);
        }
        return back()->with('Success','Project added successfully');
    }
    public function updateProject($id, Request $request)
    {
        $basement = $request->basement;
        $ground   = $request->ground;
        $floor    = $basement + $ground + 1;
        if($request->mApprove != NULL){
            $imageName1 = time().'.'.request()->mApprove->getClientOriginalExtension();
            $request->mApprove->move(public_path('projectImages'),$imageName1);
            ProjectDetails::where('project_id',$id)->update([
                'municipality_approval' => $imageName1
            ]);
        }
        if($request->oApprove != NULL){ 
            $imageName2 = time().'.'.request()->oApprove->getClientOriginalExtension();
            $request->oApprove->move(public_path('projectImages'),$imageName2);
            ProjectDetails::where('project_id',$id)->update([
                'other_approvals' => $imageName2
            ]);
        }
        if($request->pImage != NULL){
            $imageName3 = time().'.'.request()->pImage->getClientOriginalExtension();
            $request->pImage->move(public_path('projectImages'),$imageName3);
            ProjectDetails::where('project_id',$id)->update([
                'image' => $imageName3
            ]);
        }
        if($request->remarks != NULL){
            ProjectDetails::where('project_id',$id)->update([
                'remarks' => $request->remarks
            ]);
        }
        ProjectDetails::where('project_id',$id)->update([
            'project_name'   => $request->pName,
            'road_name'      => $request->rName,
            'project_status' => $request->status,
            'basement'       => $basement,
            'ground'         => $ground,
            'project_type'   => $floor,
            'project_size'   => $request->pSize,
            'budget'         => $request->budget
        ]);
        OwnerDetails::where('project_id',$id)->update([
            'owner_name'        => $request->oName,
            'owner_email'       => $request->oEmail,
            'owner_contact_no'  => $request->oContact
        ]);
        ContractorDetails::where('project_id',$id)->update([
            'contractor_name'       => $request->cName,
            'contractor_email'      => $request->cEmail,
            'contractor_contact_no' => $request->cContact
        ]);
        ConsultantDetails::where('project_id',$id)->update([
            'consultant_name'       => $request->coName,
            'consultant_email'      => $request->coEmail,
            'consultant_contact_no' => $request->coContact
        ]);
        SiteEngineerDetails::where('project_id',$id)->update([
            'site_engineer_name'        => $request->eName,
            'site_engineer_email'       => $request->eEmail,
            'site_engineer_contact_no'  => $request->eContact
        ]);
        ProcurementDetails::where('project_id',$id)->update([
            'procurement_name'       => $request->pName,
            'procurement_email'      => $request->pEmail,
            'procurement_contact_no' => $request->pContact
        ]);
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'lastUpdateTime' => date('H:i A')
        ]);
        $ward       = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $first      = loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->first();
        $assigned   = subWard::where('id',$ward)->pluck('sub_ward_name')->first();
        if($first->firstUpdateTime == NULL){
            loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                'firstUpdateTime' => date('H:i A'),
                'allocatedWard' => $assigned,
            ]);
        }
        $check        = mktime(12,00,00);
        $checktime    = date('H:i:sA',$check);
        $morningcheck = loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->first();
        if(date('H:i:sA') <= $checktime){
            if($morningcheck->noOfProjectsUpdatedInMorning == NULL){
                loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'noOfProjectsUpdatedInMorning' => 1
                ]);                
            }else{
                $number=loginTime::where('user_id',Auth::user()->id)
                    ->where('logindate',date('Y-m-d'))
                    ->pluck('noOfProjectsUpdatedInMorning')
                    ->first();
                loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'noOfProjectsUpdatedInMorning' => $number + 1
                ]); 
            }
        }
        if($morningcheck->totalProjectsUpdated == NULL){
             loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'totalProjectsUpdated' => 1
                ]);
        }else{
            $number2=loginTime::where('user_id',Auth::user()->id)
                    ->where('logindate',date('Y-m-d'))
                    ->pluck('totalProjectsUpdated')
                    ->first();
                loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
                    'totalProjectsUpdated' => $number2 + 1
                ]);
        }
        return back()->with('Success','Updated Successfully');
    }
    public function addMorningMeter(Request $request)
    {
        $imageName1 = time().'.'.request()->morningMeter->getClientOriginalExtension();
        $request->morningMeter->move(public_path('meters'),$imageName1);
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'morningMeter' => $imageName1,
            'noOfProjectsListedInMorning' => $request->morningCount
        ]);
        return back();
    }
    public function addMorningData(Request $request)
    {
        $imageName1 = time().'.'.request()->morningData->getClientOriginalExtension().Auth::user()->id;
        $request->morningData->move(public_path('data'),$imageName1);
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'morningData' => $imageName1
        ]);
        return back();
    }
    public function afternoonMeter(Request $request)
    {
        $imageName1 = time().'.'.request()->afternoonmMeterImage->getClientOriginalExtension().Auth::user()->id;
        $request->afternoonmMeterImage->move(public_path('meters'),$imageName1);
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'afternoonMeter' => $imageName1
        ]);
        return back();
    }
    public function afternoonData(Request $request)
    {
        $imageName1 = time().'.'.request()->afternoonDataImage->getClientOriginalExtension().Auth::user()->id;
        $request->afternoonDataImage->move(public_path('data'),$imageName1);
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'afternoonData' => $imageName1
        ]);
        return back();
    }
    public function eveningMeter(Request $request)
    {
        $imageName1 = time().'.'.request()->eveningMeterImage->getClientOriginalExtension().Auth::user()->id;
        $request->eveningMeterImage->move(public_path('meters'),$imageName1);
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'eveningMeter' => $imageName1
        ]);
        return back();
    }
    public function eveningData(Request $request)
    {
        $imageName1 = time().'.'.request()->eveningDataImage->getClientOriginalExtension().Auth::user()->id;
        $request->eveningDataImage->move(public_path('data'),$imageName1);
        date_default_timezone_set("Asia/Kolkata");
        $lastrecord = projectdetails::where('listing_engineer_id',Auth::user()->id)
        ->where('created_at','like',date('Y-m-d').'%')
        ->orderBy('created_at','desc')->first();
        $takeTime = $lastrecord->created_at->format('H:i A');
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update([
            'eveningData' => $imageName1,
            'lastListingTime' => $takeTime
        ]);
        return back();
    }
    public function morningRemark($id, Request $request)
    {
        loginTime::where('id',$id)->update([
            'morningRemarks' => $request->mRemark
        ]);
        return back();
    }
    public function afternoonRemark($id, Request $request)
    {
        loginTime::where('id',$id)->update([
            'afternoonRemarks' => $request->aRemark
        ]);
        return back();
    }
    public function eveningRemark($id, Request $request)
    {
        loginTime::where('id',$id)->update([
            'eveningRemarks' => $request->eRemark
        ]);
        return back();
    }
    public function addRequirement(Request $request,$id)
    {
        $requirement = New Requirement;
        $requirement->project_id = $id;
        $requirement->main_category = $request->mCategory;
        $requirement->sub_category = $request->sCategory;
        $requirement->material_spec = $request->mSpec;
        if($request->rfImage1){
            $imageName1 = time().'.'.request()->rfImage1->getClientOriginalExtension();
            $request->rfImage1->move(public_path('requirements'),$imageName1);
            $requirement->referral_image1 = $imageName1;
        }
        if($request->rfImage2){
            $imageName2 = time().'.'.request()->rfImage2->getClientOriginalExtension();
            $request->rfImage2->move(public_path('requirements'),$imageName2);
            $requirement->referral_image2 = $imageName;
        }
        $requirement->requirement_date  = $request->rDate;
        $requirement->measurement_unit  = $request->mUnit;
        $requirement->unit_price        = $request->uPrice;
        $requirement->quantity          = $request->quantity;
        $requirement->total             = $request->total;
        $requirement->delivery_note     = $request->Dnotes;
        $requirement->notes             = $request->notes;
        $requirement->save();
        return back();
    }
    //This function by Sid
    // public function orderConfirm($id, Request $request){
    //     $counting = count($request->requirement);
    //     if($counting == 0){
    //         return back()->with('Error','Please select requirements to place order');
    //     }else{
    //         for($i = 0; $i<$counting; $i++){
    //             Requirement::where('project_id',$id)->where('id',$request->requirement[$i])->update(['status' => "Order Confrimed"]);
    //         }

    //     //$project = projectdetails::where('project_id',$id)->first();
    //     //Requirement::where('project_id',$id)->where('status','Order Placed')->update(['status' => "Order Confirmed"]);
    //     $orders = Requirement::where('project_id',$id)->where('status','Order Confirmed')->get();
    //     return redirect($id.'/requirements')->with('Confirmed','Order has been confirmed');
    //     }
        
    // }


    public function orderConfirm($id, Request $request)
   {
        $counting = count($request->requirement);
        if($counting == 0){
            return back()->with('Error','Please select orders to be confirmed');
        }else{
        $project = projectdetails::where('project_id',$id)->first();
        Requirement::where('project_id',$id)->where('status','Order Placed')->update(['status' => "Order Confirmed"]);
        $orders = Requirement::where('project_id',$id)->where('status','Order Confirmed')->get();
        return redirect($id.'/requirements')->with('Confirmed','Order has been confirmed');
        }
    }
    //This function by Sid
    public function editOrder($id, $rqid, Request $request){
        $val = Requirement::where('project_id',$id)->where('id', $rqid)->first();
        return view('editOrder', ['val' => $val, 'id'=> $id]); 
    }
    public function cancelOrder($id, $rqid, Request $request)
    {  
        Requirement::where('project_id',$id)->where('id', $rqid)->update(['status' => "Order Cancelled"]);
        $orders = Requirement::where('project_id',$id)->get();
        return redirect($id.'/requirements')->with('Confirmed','Order has been cancelled');
    }
    public function placeOrder($id, Request $request)
    {
        $counting = count($request->requirement);
        if($counting == 0){
            return back()->with('Error','Please select requirements to place order');
        }else{
            for($i = 0;$i<$counting;$i++){
                Requirement::where('project_id',$id)->where('id',$request->requirement[$i])->update(['status' => "Order Placed"]);
            }
        }
        $orders = Requirement::where('project_id',$id)->where('status','Order Placed')->get();
        return view('confirm',['orders'=>$orders,'id'=>$id])->with('Success','Order has been placed successfully');
    }
    public function confirmOrder($id, Request $request)
   {
        $project = projectdetails::where('project_id',$id)->first();
        Requirement::where('project_id',$id)->where('status','Order Placed')->update(['status' => "Order Confirmed"]);
        $orders = Requirement::where('project_id',$id)->where('status','Order Confirmed')->get();
        return redirect($id.'/confirmOrder')->with('Confirmed','Order has been confirmed');
    } 
    public function postOrder(Request $request)
    {
        $secret_key = $request->secretkey;
        return view('payment.posting',['secretkey'=>$secret_key]);
    }
    public function addTracing(Request $request,$id)
    {
        if($request->gTracing){
            $imageName2 = time().'.'.request()->gTracing->getClientOriginalExtension();
            $request->gTracing->move(public_path('uploads'),$imageName2);
            loginTime::where('id',$id)->update([
                'gtracing' => $imageName2
            ]);
        }else if($request->wTracingI){
            $imageName2 = time().'.'.request()->wTracingI->getClientOriginalExtension();
            $request->wTracingI->move(public_path('uploads'),$imageName2);
            loginTime::where('id',$id)->update([
                'ward_tracing_image' => $imageName2
            ]);
        }else if($request->ewTracingI){
            $imageName2 = time().'.'.request()->ewTracingI->getClientOriginalExtension();
            $request->ewTracingI->move(public_path('uploads'),$imageName2);
            loginTime::where('id',$id)->update([
                'evening_ward_tracing_image' => $imageName2
            ]);
        }else if ($request->TracingIWtH) {
            $imageName2 = time().'.'.request()->TracingIWtH->getClientOriginalExtension();
            $request->TracingIWtH->move(public_path('uploads'),$imageName2);
            loginTime::where('id',$id)->update([
                'tracing_image_w_to_h' => $imageName2
            ]);
        }else
        return back();
    }
    public function addComments($id, Request $request)
    {
        if($request->googleKm){
            loginTime::where('id',$id)->update([ 'kmfromhtw' => $request->googleKm ]);
        }else if($request->kmfromts){
            loginTime::where('id',$id)->update([ 'km_from_software' => $request->kmfromts]);
        }else if($request->ekmfromts){
            loginTime::where('id',$id)->update(['evening_km_from_tracking' => $request->ekmfromts]);
        }else if($request->ekmwth){
            loginTime::where('id',$id)->update(['km_from_w_to_h' => $request->ekmwth]);
        }else if($request->loginTimeInWard){
            $check = mktime(12,00);
            $checktime = date('H:i',$check);
            if($request->loginTimeInWard < $checktime){
                $time = 'AM';
            }else{
                $time = 'PM';
            }
            loginTime::where('id',$id)->update([ 'login_time_in_ward' => $request->loginTimeInWard.' '.$time]);
        }else if($request->totalKilometers){
            loginTime::where('id',$id)->update([ 'total_kilometers' => $request->totalKilometers]);
        }
        return back();
    }
    public function giveGrade($userid, $reportid, Request $request)
    {
        loginTime::where('user_id',$userid)->where('id',$reportid)->update(['AmGrade'=>$request->grade]);
        return back();
    }
}
