<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){
        //$categories = Category::latest()->get(); //Itt is lehet paginate(x)
        $categories =DB::table('categories')->latest()->paginate(10);
        return view('admin.category.index',compact('categories'));
    }

    public function AddCat(Request $request){
        $valdidateData = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:25',
            ],
            [
                'category_name.required' => 'Please fill the category name input field.',
                'category_name.max' => 'Max characters are 25.',
            ]
        );

        /*Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);*/

        /*$category = new Category;
        $category -> category_name = $request->category_name;
        $category -> user_id = Auth::user()->id;
        $category -> save();
        //ITT NEM KELL KÜLÖN A CARBON*/

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category inserted successfully');
    }
}
