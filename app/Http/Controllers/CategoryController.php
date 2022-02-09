<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public $table = "categories";
    public function AllCat(){
        return view('admin.category.index');
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

        //$data = array();
        //$data['category_name'] = $request->category_name;

        return Redirect()->back()->with('success','Category inserted successfully');
    }
}
