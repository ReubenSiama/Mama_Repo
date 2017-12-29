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
use App\Requirement;
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
    public function authlogin()
    {
        date_default_timezone_set("Asia/Kolkata");
        $check = loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->get();
        if(count($check)==0){
                $login = New loginTime;
                $login->user_id = Auth::user()->id;
                $login->logindate = date('Y-m-d');
                $login->loginTime = date('H:i A');
                $login->logoutTime = "N/A";
                $login->save();
            }
        return redirect('/home');
    }
    public function authlogout(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        loginTime::where('user_id',Auth::user()->id)->where('logindate',date('Y-m-d'))->update(['logoutTime'=>date('H:i A')]);
        Auth()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
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
        }else if($group == "Team Lead" && $dept == "Sales"){
            return redirect('salesTL');
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
        $projects = ProjectDetails::all();
        return view('teamLeader',['users'=>$users,'subwards'=>$subwards,'subwardsAssignment'=>$subwardsAssignment,'wards'=>$wards,'projects'=>$projects]);
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
        $check = loginTime::where('user_id',Auth::user()->id)
            ->where('logindate',date('Y-m-d'))->first();
        if(count($check)==0){
            $login = New loginTime;
            $login->user_id = Auth::user()->id;
            $login->logindate = date('Y-m-d');
            $login->loginTime = date('H:i A');
            $login->logoutTime = "N/A";
            $login->save();   
        }
        $loginTime = mktime(05,00,00);
        $logoutTime = mktime(19,00,00);
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
        $assignment = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $roads = ProjectDetails::where('sub_ward_id',$assignment)->groupBy('road_name')->pluck('road_name');
        return view('roads',['roads'=>$roads]);
    }
    public function viewProjectList($road)
    {
        $assignment = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $projectlist = ProjectDetails::where('road_name',$road)
        ->where('sub_ward_id',$assignment)
        ->get();
        return view('projectlist',['projectlist'=>$projectlist,'pageName'=>"Update"]);
    }
    public function getMyReports()
    {
        date_default_timezone_set("Asia/Kolkata");
        $today = date('Y-m-d');
        $time = date('H:i:s A');
        $projectCount = count(ProjectDetails::where('listing_engineer_id',Auth::user()->id)
            ->where('created_at','like',$today.'%')->get());
        $loginTimes = loginTime::where('user_id',Auth::user()->id)->where('logindate',$today)->first();
        return view('reports',['time'=>$time,'loginTimes'=>$loginTimes,'projectCount'=>$projectCount]);
    }
    public function updateAssignment(){
        WardAssignment::where('user_id',Auth::user()->id)->delete();
        return back();
    }
    public function viewLeReport($id,Request $request)
    {
        if($request->date){
            $loginTimes = loginTime::where('user_id',$id)
                ->where('logindate',$request->date)->first();
            if($loginTimes != NULL){
                return view('lereportbytl',['loginTimes'=>$loginTimes,'userId'=>$id]);             
            }else{
                $loginTimes = loginTime::where('user_id',$id)
                    ->where('logindate',date('Y-m-d'))->first();
                return back()->with('Error','No Records found');
            }
        }
        $loginTimes = loginTime::where('user_id',$id)
            ->where('logindate',date('Y-m-d'))->first();
        return view('lereportbytl',['loginTimes'=>$loginTimes,'userId'=>$id]);
    }
    public function getRequirementRoads()
    {
        $assignment = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $roads = ProjectDetails::where('sub_ward_id',$assignment)->groupBy('road_name')->pluck('road_name');
        return view('requirementsroad',['roads'=>$roads]);
    }
    public function projectRequirement($road)
    {
        $assignment = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $projectlist = ProjectDetails::where('road_name',$road)
            ->where('sub_ward_id',$assignment)
            ->get();
        return view('projectlist',['projectlist'=>$projectlist,'pageName'=>"Requirements"]);
    }
    public function getRequirements($id)
    {
        $requirements = Requirement::where('project_id',$id)->get();
        return view('requirements',['requirements'=>$requirements,'id'=>$id]);
    }
    public function deleteReportImage($id)
    {
        $file = loginTime::where('id',$id)->pluck('morningMeter')->first();
        $file_path = "meters/".$file;
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        loginTime::where('id',$id)->update([
            'morningMeter' => Null,
        ]);
        return back();
    }
    public function deleteReportImage2($id)
    {
        $file = loginTime::where('id',$id)->pluck('morningData')->first();
        $file_path = "data/".$file;
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        loginTime::where('id',$id)->update([
            'morningData' => Null,
        ]);
        return back();
    }
    public function deleteReportImage3($id)
    {
        $file = loginTime::where('id',$id)->pluck('afternoonMeter')->first();
        $file_path = "meters/".$file;
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        loginTime::where('id',$id)->update([
            'afternoonMeter' => Null,
        ]);
        return back();
    }
    public function deleteReportImage4($id)
    {
        $file = loginTime::where('id',$id)->pluck('afternoonData')->first();
        $file_path = "data/".$file;
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        loginTime::where('id',$id)->update([
            'afternoonData' => Null,
        ]);
        return back();
    }
    public function deleteReportImage5($id)
    {
        $file = loginTime::where('id',$id)->pluck('eveningMeter')->first();
        $file_path = "meters/".$file;
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        loginTime::where('id',$id)->update([
            'eveningMeter' => Null,
        ]);
        return back();
    }
    public function deleteReportImage6($id)
    {
        $file = loginTime::where('id',$id)->pluck('eveningData')->first();
        $file_path = "data/".$file;
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        loginTime::where('id',$id)->update([
            'eveningData' => Null,
        ]);
        return back();
    }
    public function getConfirmOrder($id)
    {
        $orders = Requirement::where('project_id',$id)->where('status','Order Confirmed')->get();
        $project = projectdetails::where('project_id',$id)->first();
        return view('confirmed',['orders'=>$orders,'project'=>$project,'id'=>$id]);
    }
    public function getPayment(Request $request)
    {
        $total = $request->total;
        return view('payment.payment',['total'=>$total]);
    }
    public function getPaymentResponse()
    {
        return view('payment.response');
    }

    // Sales
    public function getSalesEngineer()
    {
        $assignment = WardAssignment::where('user_id',Auth::user()->id)->pluck('subward_id')->first();
        $projects = ProjectDetails::where('sub_ward_id',$assignment)->paginate(10);
        return view('salesengineer',['projects'=>$projects]);
    }
    public function getSalesTL(){
        $id = Department::where('dept_name',"Sales")->pluck('id')->first();
        $users = User::where('department_id',$id)->get();
        $subwardsAssignment = WardAssignment::all();
        $subwards = SubWard::all();
        $wards = Ward::all();
        $projects = ProjectDetails::all();
        return view('salestl',['users'=>$users,'subwards'=>$subwards,'subwardsAssignment'=>$subwardsAssignment,'wards'=>$wards,'projects'=>$projects]);
    }
    public function getAMReports()
    {
        $group = Group::where('group_name','Listing Engineer')->pluck('id')->first();
        $users = User::where('group_id',$group)->paginate(10);
        return view('reportsbyam',['users'=>$users]);
    }
    public function getViewReports($id)
    {
        $user = User::where('id',$id)->first();
        $logintimes = loginTime::where('user_id',$id)->orderBy('created_at','DESC')->get();
        return view('amreport',['logintimes'=>$logintimes,'user'=>$user]);
    }
}