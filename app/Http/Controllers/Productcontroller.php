<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Category;
use App\Vendor;
use App\Product_Size_Unit;
use App\Product_Type;
use App\Subcategory;
use App\Undersubcategory;
use Illuminate\Support\Facades\DB;

class Productcontroller extends Controller
{
    public function productList()
    {
        $product = Products::select()
        ->get();
        return view('product_list')->with('product', $product);
    }
    public function addNewProduct(Request $request)
    {
        if($request->id)
        {
            $id = $request->id;
            $product = Products::select()
                ->where('id', $id)
                ->get();
            
                $category = Category::select()
                ->where('status',1)
                ->get();
    
                $vendor = Vendor::select()
                ->where('status',1)
                ->get();
    
                $product_unit = Product_Size_Unit::select()
                ->get();

                $product_type = Product_Type::select()
                ->get();

            return view('new_product')->with('product', $product)->with('id',$id)->with('category',$category)->with('vendor',$vendor)->with('product_unit',$product_unit)->with('productType',$product_type);
        }
        else
        {
            $category = Category::select()
            ->where('status',1)
            ->get();

            $vendor = Vendor::select()
            ->where('status',1)
            ->get();

            $product_unit = Product_Size_Unit::select()
            ->get();

            $product_type = Product_Type::select()
                ->get();

            return view('new_product')->with('id','')->with('category',$category)->with('vendor',$vendor)->with('product_unit',$product_unit)->with('productType',$product_type);
        }
    }
    public function saveProduct(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            'category_id'=>'required',
            'status'=>'required'
        ]);
    
        $imageName = time().'.'.Request()->file->getClientOriginalExtension();
   
        if(Request()->file->move(public_path('product_image'), $imageName))
        {
            $image = $imageName;
        }
        else
        {
            $image = 'default.png';
        }
        $data = $request->input();
        $saveproduct = DB::table('product')->insert(
            [
             'vendor_id' => $data['vendor_id'],
             'product_name' => $data['product_name'],
             'category_id' => $data['category_id'],
             'subcategory_id' => $data['sub_category_id'],
             'sub_subcategory_id' => $data['sub_subcategory_id'],
             'product_type' => $data['product_type'],
             'stock' => $data['stock'],
             'price' => $data['price'],
             'offer_price' => $data['offer_price'],
             'color' => $data['color'],
             'size' => $data['size'],
             'unit' => $data['unit'],
             'product_image' => $image,
             'product_description' => $data['product_description'],
             'status' => $data['status'],
             'created_at'=>date('y-m-d'),
             'updated_at'=>date('y-m-d')
             ]
        );
        if($saveproduct)
        {

            return  redirect('/add-new-product')->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/add-new-product')->with('error', 'Data not saved !');
        }
    }
    public function updateProduct(Request $request)
    {
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            'category_id'=>'required',
            'status'=>'required'
        ]);
        $data = $request->input();

        if($request->hasFile('file'))
        { 
            $imageName = time().'.'.Request()->file->getClientOriginalExtension();
    
            if(Request()->file->move(public_path('product_image'), $imageName))
            {
                $image = $imageName;
            }
            else
            {
                $image = 'default.png';
            }
            $fFilePath = 'public/product_image/'.$data['hidden_image'];
            if(file_exists( public_path().'/product_image/'.$data['hidden_image'])){
                unlink($fFilePath);
            }
        }
        else
        {
                $image = $data['hidden_image'];
        }

        $updateproduct = DB::table('product')
        ->where('id', $data['hidden_id'])
        ->update(
            [
                'vendor_id' => $data['vendor_id'],
                'product_name' => $data['product_name'],
                'category_id' => $data['category_id'],
                'subcategory_id' => $data['sub_category_id'],
                'sub_subcategory_id' => $data['sub_subcategory_id'],
                'product_type' => $data['product_type'],
                'stock' => $data['stock'],
                'price' => $data['price'],
                'offer_price' => $data['offer_price'],
                'color' => $data['color'],
                'size' => $data['size'],
                'unit' => $data['unit'],
                'product_image' => $image,
                'product_description' => $data['product_description'],
                'status' => $data['status'],
                'updated_at'=>date('y-m-d')
            ]
        );
        if($updateproduct)
        {
            return  redirect('/edit-product/'.$data['hidden_id'])->with('success', 'Data saved !');
        }
        else
        {
            return redirect('/edit-product/'.$data['hidden_id'])->with('error', 'Data not saved !');
        }
    }

}
