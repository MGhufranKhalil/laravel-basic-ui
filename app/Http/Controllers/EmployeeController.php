<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Option;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    private $parentView = 'employee';
    public function index(){
        $data = [];
        $data['employees'] = Employee::all();
        return view($this->parentView.'.index',$data);
    }

    public function create(Request $request){
        $data = [];
        $data['countries'] = Country::all();
        $data['companies'] = Company::all();
        $data['associates'] = Employee::all();
        $data['duties'] = Option::where( 'category', 'duty' )->get();
        $data['jobs'] = Option::where( 'category', 'job' )->get();
        return view($this->parentView.'.create',$data);
    }

    public function store(Request $request){ 
        $request->validate([
            'company_id' => 'required',
            'first_name' => 'required',
			'last_name' => 'required',
			'address' => 'required',
			'phone' => 'required',
			'hiring_date' => 'required',
			'leaving_date' => 'required',
			'email' => 'required|unique:employees,email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $directory = 'employees/images';
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true, true);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = Str::uuid()->toString() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('employees/images'), $imageName);
            $imagePath = 'employees/images/' . $imageName;
        }


		DB::beginTransaction();
        $employee = Employee::create([
            'company_id' => $request->company_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip_code' => $request->zip_code,
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'job' => $request->job,
            'hiring_date' => Carbon::parse($request->hiring_date)->toDateString(),
            'leaving_date' => Carbon::parse($request->leaving_date)->toDateString(),
            'associates' => $request->associates,
            'image' => $imagePath,
            'status' =>  $request->status,
            'duties' => $request->duties ? serialize($request->duties) : '' ,
        ]);

        if($employee){
            DB::commit();
            Session::flash('success', 'Employee updated successfully.');
        }else{
            DB::rollback();
            Session::flash('error', 'There is some error');
        }
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $request->validate([
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'hiring_date' => 'required',
            'leaving_date' => 'required',
            'email' => 'required|unique:employees,email,' . $id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 

        ]);
    
        DB::beginTransaction();
        
        $employee = Employee::findOrFail($id);
        $imagePath = $employee->image;

        if ($request->hasFile('image')) {
            // Delete previous image if exists
            if ($imagePath && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            $imageName = Str::uuid()->toString() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('employees/images'), $imageName);
            $imagePath = 'employees/images/' . $imageName;
        }
    
        $employee->company_id = $request->company_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->address = $request->address;
        $employee->country_id = $request->country_id;
        $employee->state_id = $request->state_id;
        $employee->city_id = $request->city_id;
        $employee->zip_code = $request->zip_code;
        $employee->country_code = $request->country_code;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->job = $request->job;
        $employee->hiring_date = Carbon::parse($request->hiring_date)->toDateString();
        $employee->leaving_date = Carbon::parse($request->leaving_date)->toDateString();
        $employee->associates = $request->associates;
        $employee->image = $imagePath;
        $employee->status = $request->status;
        $employee->duties = $request->duties ? serialize($request->duties) : '';
        if($employee->save()){
            DB::commit();
            Session::flash('success', 'Employee updated successfully.');
        }else{
            DB::rollback();
            Session::flash('error', 'There is some error');
        }
        
        return redirect()->route('employee');
    }

    public function show($id) {
        $employee = Employee::findOrFail($id);
        return view($this->parentView.'.show', ['employee' => $employee]);
    }

    public function edit($id) {
        $data['employee'] = Employee::findOrFail($id);
        $data['companies'] = Company::all();
        $data['countries'] = Country::all();
        $data['associates'] = Employee::all();
        $data['duties'] = Option::where( 'category', 'duty' )->get();
        $data['jobs'] = Option::where( 'category', 'job' )->get();
        return view($this->parentView.'.edit',  $data);
    }

    public function destroy($id)  {
        $employee = Employee::findOrFail($id);
        
        $employee->delete();
        
        Session::flash('success', 'Employee deleted successfully.');
        
        return redirect()->route('employee');
    }
}
