<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
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

        $generated_name = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('img/brand/'. $generated_name);
        $last_image = 'img/brand/'.$generated_name;

        /*
        $generated_name = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $generated_name .'.'.$image_ext;
        $up_location = 'img/brand/';
        $last_image = $up_location. $image_name;
        $brand_image->move($up_location,$image_name);*/

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_image,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Brand inserted successfully.');
    }

    public function EditBrand($id){
        $brands = Brand::find($id);

        return view('admin.brand.edit',compact('brands'));
    }

    public function UpdateBrand(Request $request, $id){
        $valdidateData = $request->validate(
            [
                'brand_name' => 'required|min:4'
            ],
            [
                'brand_name.required' => 'Please fill the brand name input field.',
                'brand_name.min' => 'Brand name must be over 4 characters.',
            ]
        );
        $old_image = $request ->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            /*
            $generated_name = hexdec(uniqid());
            $image_ext = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $generated_name .'.'.$image_ext;
            $up_location = 'img/brand/';
            $last_image = $up_location. $image_name;
            $brand_image->move($up_location,$image_name);
            */

            $generated_name = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('img/brand/'. $generated_name);
            $last_image = 'img/brand/'.$generated_name;
            
    
    
            unlink($old_image);
    
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_image,
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->back()->with('success','Brand updated successfully.');
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->back()->with('success','Brand name updated successfully.');
        }
    }

    public function DeleteBrand($id){
        $delete_image = Brand::find($id);
        $old_image = $delete_image->brand_image;
        unlink($old_image);
        Brand::find($id)->delete();

        return Redirect()->back()->with('success','Brand deleted successfully.');
    }
}
