<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use DB;
use Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Auth;

class UserController extends Controller
{
    private $parentView = 'user';
    public function index(){
        $data = [];
        $user = Auth::user();
        $emp = User::with('company')->orderBy('created_at', 'desc');

        if($user->company_id != 0 ){
            $emp = $emp->where('company_id', $user->company_id);
        }

        $data['users'] = $emp->paginate(30);

        return view($this->parentView.'.index',$data);
    }

    public function create(Request $request){
        $data = [];
        $data['roles'] = Role::all()->pluck('name');
        $data['companies'] = Company::all();
        return view($this->parentView.'.create',$data);
    }

    public function store(Request $request){ 
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

		DB::beginTransaction();
        $createdUser = User::create([
            'company_id' => $user->company_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $createdUser->assignRole($request->role);

        DB::commit();
        Session::flash('success', 'Successfully  Create');
        return redirect()->back();
		 
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();
            
            $user->syncRoles($request->role);

            DB::commit();
            Session::flash('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'There was an error updating the user.'])->withInput();
        }

        return redirect()->route('user.index');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view($this->parentView.'.show', ['user' => $user]);
    }

    public function edit($id) {
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::all()->pluck('name');

        return view($this->parentView.'.edit', $data);
    }

    public function destroy($id)  {
        $user = User::findOrFail($id);
        
        $user->delete();
        
        Session::flash('success', 'User deleted successfully.');
        
        return redirect()->route('user');
    }
}
