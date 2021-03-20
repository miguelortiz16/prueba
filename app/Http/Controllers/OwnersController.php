<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owners;

use Illuminate\Support\Facades\DB;


class OwnersController extends Controller
{
    public function index(Request $request){

            $user=  Owners::all();


       return $user;


    }





    public function store(Request $request){

        $user = new  Owners();
        $user->name = $request->name;
        $user->phone =  $request->phone;
        $user->id =  $request->id;
        $user->address =  $request->address;
     
        $user->save();
    }


    public function update(Request $request){
        $user =  Owners::findOrFail($request->id);
        $user->name = $request->name;
        $user->phone =  $request->phone;
        $user->id =  $request->id;
        $user->address =  $request->address;
        $user->save();
    }



    public function delete (Request $request) {

        $user = Owners::find($request->id);

        $user->delete();

    }

}
