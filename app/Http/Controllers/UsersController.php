<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\category;
use App\Models\tags;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{
    public function index(Request $request){

            $user=  Users::all();


       return $user;











    }





    public function store(Request $request){

        $user = new  Users();
        $user->name = $request->name;
        $user->lastName =  $request->lastName;
        $user->typoDocument =  $request->typoDocument;
        $user->dateBirth =  $request->dateBirth;
        $user->id =$request->id;





        $user->save();
    }


    public function update(Request $request){
        $user =  Users::findOrFail($request->id);
        $user->name = $request->name;
        $user->lastName =  $request->lastName;
        $user->typoDocument =  $request->typoDocument;
        $user->dateBirth =  $request->dateBirth;
        $user->id =$request->id;
        $user->save();
    }



    public function delete (Request $request) {

        $user = Users::find($request->id);

        $user->delete();

    }

}
