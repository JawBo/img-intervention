<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ImageIntervention;
use App\Image;


class ImagesController extends Controller
{
    public function index(){
        $images=Image::all();
        return view ('picture',compact('images'));
    }
    public function store(Request $request){

        $image=$request->file('image');
        $filename=time().$image->hashName();

        $original=ImageIntervention::make($image);
        $original->save('images/originals/'.$filename);

        $resize=ImageIntervention::make($image)->resize(100,100);
        $resize->save('images/thumbnails/'.$filename);

        $table=new Image;
        $table->name=$filename;
        $table->save();

        return redirect()->back();

        
    }
    
    
}
