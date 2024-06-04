<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeIncidentImages;
use App\Models\EmployeeIncident;
use App\Models\Employee;
use DB;
use Str;
use Session;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Auth;

class IncidentController extends Controller
{
    private $parentView = 'incident';
    public function index(){
        $user = Auth::user();
        $data = [];
        $emp = EmployeeIncident::query();

        if($user->company_id != 0 ){
            $emp = $emp->where('company_id', $user->company_id);
        }

        $data['incidents'] = $emp->get();
        return view($this->parentView.'.index',$data);
    }

    public function create(Request $request){
        $user = Auth::user();

        $data = [];
        $data['employees'] = Employee::where('company_id', $user->company_id)->get();
        return view($this->parentView.'.create',$data);
    }

    public function store(Request $request){ 
        $request->validate([
            'employee_id' => 'required',
			'location' => 'required',
			'date' => 'required',
			'time' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
		
		DB::beginTransaction();
        $user = Auth::user();

        $employeeIncident = EmployeeIncident::create([
            'company_id' => $user->company_id,
            'employee_id' => $request->employee_id,
            'location' => $request->location,
            'date' => Carbon::parse($request->date)->toDateString(),
            'time' => $request->time,
            'details' => $request->details
        ]);
        if($employeeIncident){

            foreach ($request->file('images') as $image) {

                $imageName = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('employees/incident_images'), $imageName);
                $imagePath = 'employees/incident_images/' . $imageName;

                EmployeeIncidentImages::create([
                    'company_id' => $user->company_id,
                    'employee_id' => $request->employee_id,
                    'emp_incident_id' => $employeeIncident->id,
                    'image' => $imagePath,
                ]);
            }
        }
        DB::commit();
        Session::flash('success', 'Successfully  Create');
        return redirect()->back();
		 
    }

    public function update(Request $request, $id) {
        $request->validate([
            'category' => 'required',
            'location' => 'required',
            'title' => 'required',
            'value' => ['required', Rule::unique('incidents')->ignore($id)],
        ]);
    
        $incident = EmployeeIncident::findOrFail($id);
    
        $incident->update([
            'category' => $request->category,
            'title' => $request->title,
            'value' => $request->value,
        ]);
    
        Session::flash('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function show($id) {
        $incident = EmployeeIncident::findOrFail($id);
        return view($this->parentView.'.show', ['incident' => $incident]);
    }

    public function edit($id) {
        $user = Auth::user();
        $data = [];
        $data['incident'] = EmployeeIncident::findOrFail($id);
        $data['employees'] = Employee::where('company_id', $user->company_id)->get();

        return view($this->parentView.'.edit', $data);
    }

    public function destroy($id)  {
        $incident = EmployeeIncident::findOrFail($id);
        
        $incident->delete();
        
        Session::flash('success', 'Incident deleted successfully.');
        
        return redirect()->route('incident');
    }
}
