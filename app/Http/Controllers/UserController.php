<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    
    public function create(){
        return view('users.create');
    }
    
    public function store(Request $request){
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'max:255', 'confirmed']
        ]);
        
        $user = User::create($request->all());
        
        return redirect()->route('users.show', $user);
    }
    
    public function index(){
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('users.index', compact('users'));
    }
    
    public function show(User $user){
        $roles = Role::all();
        return view('users.profile', compact('user', 'roles'));
    }
    
    public function update(User $user){
        if(request('password') == null){
            $inputs = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
            ]);
        }else{
            $inputs = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'password' => ['min:6', 'max:255', 'confirmed']
            ]);
        }
        $user->update($inputs);
        
        return back();
    }
    
    public function attach(Role $role){
        $role->users()->attach(request('user_id'));
        
        session()->flash('message', 'Потребителят е редактиран');
        
        return redirect()->route('users.index');
    }
    
    public function detach(Role $role){
        $role->users()->detach(request('user_id'));
        
        session()->flash('message', 'Потребителят е редактиран');
        
        return redirect()->route('users.index');
    }
    
    public function destroy(User $user){
        $user->delete();
        
        session()->flash('message', 'Потребителят е изтрит');
        
        return back();
    }
}
