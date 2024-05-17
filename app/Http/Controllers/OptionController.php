<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use DB;
use Session;
use Illuminate\Validation\Rule;

class OptionController extends Controller
{
    private $parentView = 'option';
    public function index(){
        $data = [];
        $data['options'] = Option::all();
        return view($this->parentView.'.index',$data);
    }

    public function create(Request $request){
        $data = [];
        return view($this->parentView.'.create',$data);
    }

    public function store(Request $request){ 
        $request->validate([
            'category' => 'required',
			'title' => 'required',
			'value' => 'required|unique:options,value',
        ]);
		
		DB::beginTransaction();
        $employee = Option::create([
            'category' => $request->category,
            'title' => $request->title,
            'value' => $request->value
        ]);
        DB::commit();
        Session::flash('success', 'Successfully  Create');
        return redirect()->back();
		 
    }

    public function update(Request $request, $id) {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'value' => ['required', Rule::unique('options')->ignore($id)],
        ]);
    
        $option = Option::findOrFail($id);
    
        $option->update([
            'category' => $request->category,
            'title' => $request->title,
            'value' => $request->value,
        ]);
    
        Session::flash('success', 'Successfully Updated');
        return redirect()->back();
    }

    public function show($id) {
        $option = Option::findOrFail($id);
        return view($this->parentView.'.show', ['option' => $option]);
    }

    public function edit($id) {
        $option = Option::findOrFail($id);
        return view($this->parentView.'.edit', ['option' => $option]);
    }

    public function destroy($id)  {
        $option = Option::findOrFail($id);
        
        $option->delete();
        
        Session::flash('success', 'Option deleted successfully.');
        
        return redirect()->route('option');
    }
}
