<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category_Name;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function InsertCategory(Request $request){

        //Validate Category Details
        $request->validate([
            'category_name' => 'required',
        ]);
 
 
        //Insert Category Details
        Category_Name::insert([
            'category_name' => $request->category_name,
        ]);
        
        return response()->json([
            'status'=>'success',
        ]);  
    }

    public function ShowCategoryList(Request $request){
        $category = Category_Name::orderBy('added_at','asc')->paginate(15);
        return view('category.categories', compact('category'));

    }

    public function CategoryInfo(Request $request){
        $category = Category_Name::where('id', $request->id)->get();
        return response()->json([
            'data'=>view('category.fullDetails', compact('category'))->render(),
        ]);
    }

    //Edit Category
    public function EditCategory(Request $request){
        $category = Category_Name::where('id', $request->id)->first();
        return response()->json([
            'category'=>$category,
        ]);
    }//End Method

    //Update Category
    public function UpdateCategory(Request $request){
        
        $request->validate([
            'category_name' => 'required',
        ]);


        $update = Category_Name::findOrFail($request->id)->update([
     
            'category_name' => $request->category_name,
            "updated_at" => now()
        ]);
       
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Category
    public function DeleteCategory(Request $request){
        Category_Name::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method

    //Category Pagination
    public function CategoryPagination(){
        $category = Category_Name::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('category.categoryPagination', compact('category'))->render(),
        ]);
    }//End Method


    // Search Category by Name
    public function SearchCategory(Request $request){
        if($request->search != ""){
            $category = Category_Name::where('category_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('category_name','asc')
            ->paginate(15);
        }
        else{
            $category = Category_Name::orderBy('category_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $category->links()->toHtml();
        
        if($category->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('category.searchCategory', compact('category'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method

}
