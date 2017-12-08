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
use Auth;

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
        $procurementDetails->procurement_name = $request->pName;
        if($request->pEmail){
        $procurementDetails->procurement_email = $request->pEmail;
        }else{
            $procurementDetails->procurement_email = 'N/A';
        }
        $procurementDetails->procurement_contact_no = $request->pContact;
        $procurementDetails->save();
        return back();
    }
    public function updateProject($id, Request $request)
    {
        $basement = $request->basement;
        $ground = $request->ground;
        $floor = $basement + $ground + 1;
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
            'project_name' => $request->pName,
            'road_name' => $request->rName,
            'project_status' => $request->status,
            'basement' => $basement,
            'ground' => $ground,
            'project_type' => $floor,
            'project_size' => $request->pSize,
            'budget' => $request->budget
        ]);
        OwnerDetails::where('project_id',$id)->update([
            'owner_name' => $request->oName,
            'owner_email' => $request->oEmail,
            'owner_contact_no' => $request->oContact
        ]);
        ContractorDetails::where('project_id',$id)->update([
            'contractor_name' => $request->cName,
            'contractor_email' => $request->cEmail,
            'contractor_contact_no' => $request->cContact
        ]);
        ConsultantDetails::where('project_id',$id)->update([
            'consultant_name' => $request->coName,
            'consultant_email' => $request->coEmail,
            'consultant_contact_no' => $request->coContact
        ]);
        SiteEngineerDetails::where('project_id',$id)->update([
            'site_engineer_name' => $request->eName,
            'site_engineer_email' => $request->eEmail,
            'site_engineer_contact_no' => $request->eContact
        ]);
        ProcurementDetails::where('project_id',$id)->update([
            'procurement_name' => $request->pName,
            'procurement_email' => $request->pEmail,
            'procurement_contact_no' => $request->pContact
        ]);
        return back()->with('Success','Updated Successfully');
    }
}
