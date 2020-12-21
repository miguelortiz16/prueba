<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\category;
use App\Models\tags;
use Illuminate\Support\Facades\DB;


class PetsController extends Controller
{
    public function index(Request $request){
        $aux=[];
        $res="";
        if ($request->petStatus!="") {
            $pet=  Pet::where('status',$request->petStatus )->get();

        }else if($request->idPet!=""){
            $pet =Pet::where('id',$request->idPet )->get();

        }


        foreach ($pet as $key => $value) {
             $category =category::where('id', $value['category'])->get();
             $tag=  tags::where('id', $value['tags'])->get();
         array_push( $aux,[
            'id' =>$value["id"],
            'category'=>$category[0],
            'name'=>$value["name"],
            'status'=>$value["status"],
            "photoUrls"=> [  $value["photoUrls"] ],
            'tags'=> $tag



        ])  ;





    }

    return $aux;

    }

    public function lisCategory(Request $request){
        $catg=  category::all();
        return $catg;
    }

    public function listTags(Request $request){
        $tag=  tags::all();
        return $tag;
    }

    public function store(Request $request){
        $pet = new  Pet();
        $pet->category = $request->category;
        $pet->name =  $request->name;
        $pet->photoUrls =  $request->photoUrls;
        $pet->tags =  $request->tags;
        $pet->status =$request->status;





        $pet->save();
    }


    public function update(Request $request){
        $pet =  Pet::findOrFail($request->id);
        $pet->category = $request->category;
        $pet->name =  $request->name;
        $pet->photoUrls =  $request->photoUrls;
        $pet->tags =  $request->tags;
        $pet->status = $request->status;
        $pet->save();
    }



    public function delete (Request $request) {

        $pet = Pet::find($request->id);

        $pet->delete();

    }

}
