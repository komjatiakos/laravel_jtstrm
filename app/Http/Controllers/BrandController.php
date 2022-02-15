<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function AddBrand(Request $request){
        $valdidateData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please fill the brand name input field.',
                'brand_name.min' => 'Brand name must be over 4 characters.',
            ]
        );
        $brand_image = $request->file('brand_image');
        $generated_name = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $generated_name .'.'.$image_ext;
        $up_location = 'img/brand/';
        $last_image = $up_location. $image_name;
        $brand_image->move($up_location,$image_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Brand inserted successfully.');
    }

    public function Edit($id){
        $brands = Brand::find($id);

        return view('admin.brand.edit',compact('brands'));
    }
}