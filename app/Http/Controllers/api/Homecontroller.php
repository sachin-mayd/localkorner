<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\menu;
use App\Category;
use App\Subcategory;

class Homecontroller extends Controller
{
    public function index()
    {
        return csrf_token(); 
        die();
    }
    public function getMenus()
    {
        $menus = menu::select()
        ->where('status',1)
        ->get();
        if(count($menus) > 0)
        {
            foreach($menus as $m)
            {
                $mdata['id'] = $m['id'];
                $mdata['name'] = $m['name'];
                $mdata['url'] = $m['url'];
                $menudata[] = $mdata;
            }
            $data = array(
                'status'=>true,
                'data'=>$menudata
            );
        }
        else
        {
            $data = array(
                'status'=>true,
                'data'=>array()
            );
        }
        return $data;
        
    }
    public function getCategory()
    {

        $Category = Category::select()
        ->where('status',1)
        ->get();
        if(count($Category) > 0)
        {
            foreach($Category as $m)
            {
                $Subategory = Subcategory::select('id','subcategory','image_icon')
                ->where('status',1)
                ->where('category',$m['id'])
                ->get();
                $subcatArr = array(
                    'category'=>$m['category'],
                    'image_icon'=>url('/public/category_image').'/'.$m['image_icon'],
                    'id'=>$m['id'],
                    'subcategory'=>$Subategory
                    );
                $catdata[] = $subcatArr;
            }
            $data = array(
                'status'=>true,
                'data'=>$catdata
            );
        }
        else
        {
            $data = array(
                'status'=>true,
                'data'=>array()
            );
        }
        return $data;
    }
}
