<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('backend.user.index',[
            'users' => User::get()
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(UserRequest $request){
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return back()->with('Success', ' User Has Been Created');

        // dd($request);
    }

    public function Update(UserUpdateRequest $request, $id){
        $data = $request->validated();

        
        if ($data['password'] != '' ){
            $data['password'] = bcrypt($data['password']);
            User::find($id)->update($data);
        }
        else{
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'access' => $request->access
            ]);
        }

        

        return back()->with('Success', ' User Has Been Update');

        // dd($request);
    }


    public function destroy(string $id){

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('Success', ' User Has Been Deleted');
    }
}
