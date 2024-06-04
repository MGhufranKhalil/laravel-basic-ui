<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Country;

use DB;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Auth;
class CompanyController extends Controller
{
    private $parentView = 'company';

    public function index(){
        $data = [];
        $data['companies'] = Company::all();
        return view($this->parentView.'.index',$data);
    }

    public function create(Request $request){
        $data = [];
        $data['countries'] = Country::all();
        return view($this->parentView.'.create',$data);
    }

    public function store(Request $request){ 
        $request->validate([
            'name' => 'required',
            'address' => 'required',
			'phone' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 

        ]);
        $directory = 'company/logo';
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true, true);
        }

        $imagePath = null;
        if ($request->hasFile('logo')) {
            $imageName = Str::uuid()->toString() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('company/logo'), $imageName);
            $imagePath = 'company/logo/' . $imageName;
        }
		
		DB::beginTransaction();
        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zipcode' => $request->zipcode,
            'logo' => $imagePath
        ]);
        DB::commit();
        Session::flash('success', 'Successfully  Create');
        return redirect()->back();
		 
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['required', Rule::unique('companies')->ignore($id)],
            'address' => 'required',
			'phone' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 

        ]);
    
        $company = Company::findOrFail($id);
        $imagePath = $company->logo;

        if ($request->hasFile('logo')) {
            // Delete previous image if exists
            if ($imagePath && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            $imageName = Str::uuid()->toString() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('company/logo'), $imageName);
            $imagePath = 'company/logo/' . $imageName;
        }
        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zipcode' => $request->zipcode,
            'logo' => $imagePath
        ]);
    
        Session::flash('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function show($id) {
        $company = Company::findOrFail($id);
        return view($this->parentView.'.show', ['company' => $company]);
    }

    public function edit($id) {
        $data['company'] = Company::findOrFail($id);
        $data['countries'] = Country::all();
        return view($this->parentView.'.edit', $data);
    }

    public function destroy($id)  {
        $company = Company::findOrFail($id);
        
        $company->delete();
        
        Session::flash('success', 'Company deleted successfully.');
        
        return redirect()->route('company');
    }
}
