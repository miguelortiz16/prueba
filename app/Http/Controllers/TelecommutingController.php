<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telecommuting;
use Illuminate\Support\Facades\DB;


class TelecommutingController extends Controller
{
    public function index(Request $request){

           $telecommuting=  Telecommuting::all();


       return $telecommuting;



    }





    public function store(Request $request){

       $telecommuting = new  Telecommuting();
       $telecommuting->idType = $request->idType;
       $telecommuting->status =  $request->status;
       $telecommuting->observation =  $request->observation;

       $telecommuting->idType =$request->idType;





       $telecommuting->save();
    }


    public function update(Request $request){
       $telecommuting =  Telecommuting::findOrFail($request->id);
       $telecommuting->idType = $request->idType;
       $telecommuting->status =  $request->status;
       $telecommuting->observation =  $request->observation;

       $telecommuting->idType =$request->idType;
       $telecommuting->save();
    }



    public function delete (Request $request) {

       $telecommuting = Telecommuting::find($request->id);

       $telecommuting->delete();

    }

}
