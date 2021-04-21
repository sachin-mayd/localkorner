<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Undersubcategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Session;

class Categorycontroller extends Controller
{
    public function getCategory()
    {
       
        $category = Category::select()
        ->get();
        return view('category_list')->with('category', $category);

    }
    public function addNewCategory(Request $request)
    {
        
        if($request->id)
        {
            $id = $request->id;
            $category = Category::select()
                ->where('id', $id)
                ->get();
            return view('new_category')->with('category', $category)->with('id',$id);
        }
        else
        {
            return view('new_category')->with('id','');;
        }
    }
    public function saveCategory(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'=>'required',
            'status'=>'required'
        ]);
    
        $imageName = time().'.'.Request()->file->getClientOriginalExtension();
   
        if(Request()->file->move(public_path('category_image'), $imageName))
        {
            $image = $imageName;
        }
        else
        {
            $image = 'default.png';
        }

        $data = $request->input();
        $savecategory = DB::table('category')->insert(
            [
             'category' => $data['category'],
             'status' => $data['status'],
             'image_icon' => $image,
             'created_at'=>date('y-m-d'),
             'updated_at'=>date('y-m-d')
             ]
        );
        if($savecategory)
        {
            return  redirect('/add-new-category')->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/add-new-category')->with('error', 'Data not saved !');
        }
    }
    public function updateCategory(Request $request)
    {
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'=>'required',
            'status'=>'required'
        ]);
        $data = $request->input();

        if($request->hasFile('file'))
        { 
            $imageName = time().'.'.Request()->file->getClientOriginalExtension();
    
            if(Request()->file->move(public_path('category_image'), $imageName))
            {
                $image = $imageName;
            }
            else
            {
                $image = 'default.png';
            }
            $fFilePath = 'public/category_image/'.$data['hidden_image'];
            if(file_exists( public_path().'/category_image/'.$data['hidden_image'])){
                unlink($fFilePath);
            }
        }
        else
        {
                $image = $data['hidden_image'];
        }

        $updatecategory = DB::table('category')
                ->where('id', $data['hidden_id'])
                ->update(
                    [
                        'category' => $data['category'],
                        'status' => $data['status'],
                        'image_icon' => $image,
                        'updated_at'=>date('y-m-d')
                    ]
                );
        if($updatecategory)
        {
            return  redirect('/edit-category/'.$data['hidden_id'])->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/edit-category/'.$data['hidden_id'])->with('error', 'Data not saved !');
        }
    }
    public function getSubategory()
    {
        $subcategory = Subcategory::select('subcategory.subcategory', 'category.category', 'subcategory.id','subcategory.status')
            ->join('category', 'category.id', '=', 'subcategory.category')
            ->get();
        return view('sub_category_list')->with('subcategory', $subcategory);

    }
    public function addNewSubategory(Request $request)
    {
        
        if($request->id)
        {
            $category = Category::select()
            ->get();

            $id = $request->id;
            $subcategory = Subcategory::select()
                ->where('id', $id)
                ->get();
            return view('new_sub_category')->with('subcategory', $subcategory)->with('id',$id)->with('category', $category);
        }
        else
        {
            $category = Category::select()
            ->where('status',1)
            ->get();
            return view('new_sub_category')->with('id','')->with('category', $category);
        }
    }
    public function saveSubategory(Request $request)
    {
        $request->validate([
            'category'=>'required',
            'status'=>'required'
        ]);

        $data = $request->input();
        $savecategory = DB::table('subcategory')->insert(
            [
             'subcategory' => $data['subcategory'],
             'category' => $data['category'],
             'status' => $data['status'],
             'created_at'=>date('y-m-d'),
             'updated_at'=>date('y-m-d')
             ]
        );
        if($savecategory)
        {
            return  redirect('/add-new-subcategory')->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/add-new-subcategory')->with('error', 'Data not saved !');
        }
    }
    public function updateSubategory(Request $request)
    {
        $request->validate([
            'subcategory'=>'required',
            'category'=>'required',
            'status'=>'required'
        ]);
        $data = $request->input();

        $updatecategory = DB::table('subcategory')
                ->where('id', $data['hidden_id'])
                ->update(
                    [
                        'subcategory' => $data['subcategory'],
                        'category' => $data['category'],
                        'status' => $data['status'],
                        'updated_at'=>date('y-m-d')
                        ]
                );
        if($updatecategory)
        {
            return  redirect('/edit-subcategory/'.$data['hidden_id'])->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/edit-subcategory/'.$data['hidden_id'])->with('error', 'Data not saved !');
        }
    }
    public function getSubsubategory()
    {
        $subcategory = Undersubcategory::select('undersubcategory.undersubcategory', 'category.category', 'undersubcategory.id','undersubcategory.status','subcategory.subcategory')
            ->join('category', 'category.id', '=', 'undersubcategory.category')
            ->join('subcategory', 'subcategory.id', '=', 'undersubcategory.subcategory')
            ->get();
        return view('sub_subcategory_list')->with('subcategory', $subcategory);

    }
    public function addNewSubsubcategory(Request $request)
    {
        if($request->id)
        {
            $category = Category::select()
            ->get();

            $id = $request->id;
            $subcategory = Undersubcategory::select()
                ->where('id', $id)
                ->get();
            return view('new_sub_subcategory')->with('subcategory', $subcategory)->with('id',$id)->with('category', $category);
        }
        else
        {
            $category = Category::select()
            ->where('status',1)
            ->get();
            return view('new_sub_subcategory')->with('id','')->with('category', $category);
        }
    }
    public function getSubcategoryByAjax(Request $request)
    {
        $category_id = $request->input('category_id');
            $subcategory = Subcategory::select()
            ->where('category', '=', $category_id)
            ->get();
            return json_encode($subcategory);
            exit;
    }
    public function getSubsubcategoryByAjax(Request $request)
    {
        $subcategory_id = $request->input('subcategory_id');
            $subsubcategory = Undersubcategory::select()
            ->where('subcategory', '=', $subcategory_id)
            ->get();
            return json_encode($subsubcategory);
            exit;
    }
    public function saveSubsubcategory(Request $request)
    {
        $request->validate([
            'category'=>'required',
            'subcategory'=>'required',
            'subsubcategory'=>'required',
            'status'=>'required'
        ]);

        $data = $request->input();
        $savesubcategory = DB::table('undersubcategory')->insert(
            [
             'undersubcategory' => $data['subsubcategory'],
             'subcategory' => $data['subcategory'],
             'category' => $data['category'],
             'image_icon' => '',
             'status' => $data['status'],
             'created_at'=>date('y-m-d'),
             'updated_at'=>date('y-m-d')
            ]
        );
        if($savesubcategory)
        {
            return  redirect('/add-new-subsubcategory')->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/add-new-subsubcategory')->with('error', 'Data not saved !');
        }
    }
    public function updateSubsubcategory(Request $request)
    {
        $request->validate([
            'category'=>'required',
            'subcategory'=>'required',
            'subsubcategory'=>'required',
            'status'=>'required'
        ]);
        $data = $request->input();

        $updateundersubcategory = DB::table('undersubcategory')
                ->where('id', $data['hidden_id'])
                ->update(
                    [
                        'undersubcategory' => $data['subsubcategory'],
                        'subcategory' => $data['subcategory'],
                        'category' => $data['category'],
                        'status' => $data['status'],
                        'updated_at'=>date('y-m-d')
                        ]
                );
        if($updateundersubcategory)
        {
            return  redirect('/edit-subsubcategory/'.$data['hidden_id'])->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/edit-subsubcategory/'.$data['hidden_id'])->with('error', 'Data not saved !');
        }
    }
}
