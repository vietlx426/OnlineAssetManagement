<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserService
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getAll(){
        return $this->user->get();
    }
    public function getByID($id){
        return $this->user->first($id);
    }

    public function create($data)
    {
        $validatedData = Validator::make($data, [
            'email' => 'required|email|unique:users'
        ]);
        if($validatedData->fails()){
            return response()->json(['error' => $validatedData->errors()], 404);
        }


        $data['password'] = Hash::make(123456);
        $data = $this->user->create($data);
        return $data;

    }
    public function update($data, $id)
    {
        $user = $this->user->find($id);
        $user->update($data);
        return $user;
    }
    public function deleteByID($id)
    {
        $user = $this->user->find($id);
        $user->delete();
    }
}
