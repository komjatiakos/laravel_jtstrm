<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Multipic;
use Image;

class MultiPicController extends Controller
{
    public function Multipic(){
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }

    public function MultiPicAdd(Request $request){
        /*$valdidateData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please fill the brand name input field.',
                'brand_name.min' => 'Brand name must be over 4 characters.',
            ]
        );*/

        $image = $request->file('image');
        foreach ($image as $multi_image) {
            $generated_name = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(300,300)->save('img/multi/'. $generated_name);
            $last_image = 'img/multi/'.$generated_name;

            MultiPic::insert([
                'image' => $last_image,
                'created_at' => Carbon::now()
            ]);
        }

        return Redirect()->back()->with('success','Multiple pictures inserted successfully.');
    }
}
