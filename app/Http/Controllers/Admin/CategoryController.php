<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validate_data = $request->validate([
            'name' => 'required|unique:categories'
        ]);
        //dd($validate_data);
        $validate_data['slug'] = Str::slug($request->name);
        Category::create($validate_data);
        return redirect()->back()->with('status',"Category Added Successfully");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
         //dd($request->all());
         $validate_data = $request->validate([
            'name' => 'required|unique:categories'
        ]);

        //dd($validate_data);
        $validate_data['slug'] = Str::slug($request->name);
        $category->update($validate_data);
        return redirect()->back()->with('status', "Category $category->name Update SuccessFully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        
        $category->delete();
        return redirect()->back()->with('status',"Category $category->name Delete Succesfully");
    }
}
