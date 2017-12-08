<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\User;
use App\Group;
use App\Ward;
use App\Country;
use App\SubWard;
use App\WardAssignment;
use App\ProjectDetails;
use App\Territory;
use App\State;
use App\Zone;
use App\loginTime;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Group::where('id',Auth::user()->group_id)->pluck('group_name')->first();
        $dept = Department::where('id',Auth::user()->department_id)->pluck('dept_name')->first();
        $users = User::where('department_id','!=',0)->get();
        $departments = Department::all();
        $groups = Group::where('group_name','!=','Admin')->get();
        if($group == "Team Lead" && $dept == "Operation"){
            return redirect('teamLead');
        }else if($group == "Listing Engineer" && $dept == "Operation"){
            return redirect('leDashboard');
        }
        return view('home',['departments'=>$departments,'users'=>$users,'groups'=>$groups]);
    }
    public function viewEmployee($id)
    {
        $user = User::where('employeeId',$id)->first();
        return view('viewEmployee',['user'=>$user]);
    }
    public function teamLeadHome(){
        $group = Group::where('group_name','Listing Engineer')->pluck('id')->first();
        $users = User::where('group_id',$group)->get();
        $subwardsAssignment = WardAssignment::all();
        $subwards = SubWard::all();
        $wards = Ward::all();
        return view('teamLeader',['users'=>$users,'subwards'=>$subwards,'subwardsAssignment'=>$subwardsAssignment,'wards'=>$wards]);
    }
    public function masterData()
    {
        $wards = Ward::all();
        $countries = Country::all();
        $subwards = SubWard::all();
        $states = State::all();
        $zones = Zone::all();
        return view('masterData',['wards'=>$wards,'countries'=>$countries,'subwards'=>$subwards,'states'=>$states,'zones'=>$zones]);
    }
    public function listingEngineer()
    {
        $wardsAssigned = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $subwards = SubWard::where('id',$wardsAssigned)->first();
        return view('listingEngineer',['subwards'=>$subwards]);
    }
    public function leDashboard()
    {
        date_default_timezone_set("Asia/Kolkata");
        $loginTime = mktime(07,15,00);
        $logoutTime = mktime(20,45,00);
        $outtime = date('H:i:sA',$logoutTime);
        $ldate = date('H:i:sA');
        $lodate = date('H:i:sA',$loginTime);
        $numbercount = count(ProjectDetails::where('listing_engineer_id',Auth::user()->id)->get());
        $wardsAssigned = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $subwards = SubWard::where('id',$wardsAssigned)->first();
        $projects = ProjectDetails::where('sub_ward_id',$wardsAssigned)->get();
        return view('listingEngineerDashboard',['subwards'=>$subwards,'projects'=>$projects,'numbercount'=>$numbercount,'ldate'=>$ldate,'lodate'=>$lodate,'outtime'=>$outtime]);
    }
    public function projectList()
    {
        $projectlist = ProjectDetails::where('listing_engineer_id',Auth::user()->id)->get();
        return view('projectlist',['projectlist'=>$projectlist]);
    }
    public function editProject($id)
    {
        $projectdetails = ProjectDetails::where('project_id',$id)->first();
        $wardsAssigned = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $subwards = SubWard::where('id',$wardsAssigned)->first();
        return view('update',['subwards'=>$subwards,'projectdetails'=>$projectdetails]);
    }
    public function viewAll()
    {
        $allProjects = ProjectDetails::all();
        return view('allProjects',['allProjects'=>$allProjects]);
    }
    public function viewDetails($id)
    {
        $projectdetails = ProjectDetails::where('project_id',$id)->first();
        return view('viewDetails',['projectdetails'=>$projectdetails]);
    }
    public function getRoads()
    {
        $roads = ProjectDetails::where('listing_engineer_id',Auth::user()->id)->groupBy('road_name')->pluck('road_name');
        return view('roads',['roads'=>$roads]);
    }
    public function viewProjectList($road)
    {
        $projectlist = ProjectDetails::where('road_name',$road)->get();
        return view('projectlist',['projectlist'=>$projectlist]);
    }
    public function getMyReports()
    {
         date_default_timezone_set("Asia/Kolkata");
        $today = date('Y-m-d');
        $loginTimes = loginTime::where('user_id',Auth::user()->id)->where('logindate',$today)->first();
        return view('reports',['loginTimes'=>$loginTimes]);
    }
    public function updateAssignment(){
        WardAssignment::where('user_id',Auth::user()->id)->delete();
        return back();
    }
}
