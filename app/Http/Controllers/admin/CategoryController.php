<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\trait\ImageTrait;

use Illuminate\Support\Facades\Storage;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories=Category::all();
       return view("admin.category.index",["categories"=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.category.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",

        ]);

        Category::create([
            'name'=>$request->name,
        ]);
        return redirect()->route('category.index')->with([
            'message' => 'Category Added Successfully',
            'alert' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.category.show",["category"=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("admin.category.edit",["category"=>$category]);
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
        $inputdata=$request->all();
    
        $category->update($inputdata);
        return redirect()->route('category.index')->with([
            'message' => 'Category Updated Successfully',
            'alert' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::disk('category_image')->delete($category->image);
        $category->delete();
        return redirect()->route('category.index')->with([
            'message' => 'Category deleted Successfully',
            'alert' => 'danger'
        ]);
    }
}
