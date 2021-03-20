<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Owners;

use Illuminate\Support\Facades\DB;


class CarsController extends Controller
{
    public function index(Request $request){

      $car=  Cars::all();
       return $car;


    }


    public function listOption(Request $request){

     

        if ($request->plateCars!="") {
            $car=  Cars::where('plate',$request->plateCars )->get();

        }else if($request->idOwner!=""){
            $car =Cars::where('idOwner',$request->idOwner )->get();

        }else if($request->NameOwner!=""){
            $car =Cars::where('nameOwner',$request->NameOwner )->get();

        }
         return $car;


      
  
  
      }


      public function listBrand(Request $request){
       $aux=[];
       $brandAux=[];
        $car=  Cars::all();

        foreach ($car as $key => $value) {
           
            array_push($aux,$value["brand"]);
        }
     $unique=array_unique($aux);

     foreach ($unique as $key => $value2) {
        $car =Cars::where('brand', $value2 )->get();

       $count= count($car); 

       $final = [
        'id' => $key,
        'count' => $count,
        'brand' =>ucwords(strtolower( $value2)),
    ];

       array_push($brandAux, $final);
     }
    
         return $brandAux;

      }
    public function store(Request $request){

      
        $user =  Owners::findOrFail($request->users_id);
        $car = new  Cars();
        $car->plate = $request->plate;
        $car->brand =  $request->brand;
        $car->id =  $request->id;
        $car->kind =  $request->kind;
        $car->nameOwner =  $user["name"];
        $car->idOwner =  $user["id"];

        $car->save();
    }


   


    public function update(Request $request){
        $user =  Owners::findOrFail($request->users_id);
        $car =  Cars::findOrFail($request->id);
        $car->plate = $request->plate;
        $car->brand =  $request->brand;
        $car->id =  $request->id;
        $car->kind =  $request->kind;
        $car->nameOwner =  $user["name"];
        $car->idOwner =  $user["id"];
        $car->save();
    }



    public function delete (Request $request) {

        $car = Cars::find($request->id);

        $car->delete();

    }

}
