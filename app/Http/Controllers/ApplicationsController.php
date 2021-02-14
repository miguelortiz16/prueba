<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications;
use Illuminate\Support\Facades\DB;


class ApplicationsController extends Controller
{
    public function index(Request $request){

          $Applications=  Applications::all();


       return$Applications;



    }





    public function store(Request $request){

      $Applications = new  Applications();
      $Applications->id = $request->id;
      $Applications->typeJob =  $request->typeJob;
      $Applications->employee =  $request->employee;

      $Applications->day =$request->day;

      $Applications->startDate =$request->startDate;
      $Applications->endDate =$request->endDate;
      $Applications->observation =$request->observation;
      $Applications->status =0;

      $Applications->save();
      return $Applications;
    }


    public function update(Request $request){
      $Applications =  Applications::findOrFail($request->id);
      $Applications->id = $request->id;
      $Applications->typeJob =  $request->typeJob;
      $Applications->employee =  $request->employee;

      $Applications->day =$request->day;

      $Applications->startDate =$request->startDate;
      $Applications->endDate =$request->endDate;
      $Applications->observation =$request->observation;
      $Applications->status =0;
      $Applications->save();

      return $Applications;
    }



    public function delete (Request $request) {

      $Applications = Applications::find($request->id);

      $Applications->delete();

    }


    public function Approve (Request $request) {

        $Applications = Applications::find($request->id);
        $Applications->status =1;
        $Applications->save();
        return $Applications;
      }

      public function disapprove (Request $request) {

        $Applications = Applications::find($request->id);
        $Applications->status =0;
        $Applications->save();
        return $Applications;
      }

}
