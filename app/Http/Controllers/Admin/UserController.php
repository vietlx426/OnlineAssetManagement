<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(){
        $users = $this->userService->getAll();

        return view('users',compact('users'));
    }public function staffIndex(){

    return view('staff');
}
    public function store(Request $request){

        $data = $request->except('_token');
        $this->userService->create($data);

        return redirect()->back();
    }
    public function update(Request $request){
        $id = $request->ID_edit;
        $data = $request->except('_token');
        $this->userService->update($data,$id);
        return redirect()->back();
    }
    public function destroy($id){
        $this->userService->deleteByID($id);
        return redirect()->back();
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
