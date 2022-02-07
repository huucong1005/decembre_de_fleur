<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{

// begin admin
    public function AuthLogin(){
        $admin_id =Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login')->send();
        }
    }

    public function add_category(){
        $this->AuthLogin();
    	return view('admin.category.add_category');
    }

    public function list_category(){
        $this->AuthLogin();
    	$list_category = DB::table('category')->get();
    	$manager_category = view('admin.category.list_category')->with('list_category',$list_category);
    	return view('admin_layout')->with('admin.category.list_category',$manager_category);
    }

    public function store_category(Request $request){
        $this->AuthLogin();
    	
    	$data= array();
    	$data['category_name'] = $request->category_name;
    	$data['category_desc'] = $request->category_desc;
    	$data['category_status'] = $request->category_status;

    	DB::table('category')->insert($data);
    	Session::put('message','Thêm mới danh mục thành công !');
    	return Redirect::to('list-category');
    }

    public function active_category($category_id){
        $this->AuthLogin();
    	DB::table('category')->where('category_id',$category_id)->update(['category_status'=>1]);
    	Session::put('message','Kích hoạt hiển thị danh mục');
    	return Redirect::to('list-category');
    }

    public function unactive_category($category_id){
        $this->AuthLogin();
    	DB::table('category')->where('category_id',$category_id)->update(['category_status'=>0]);
    	Session::put('message','Ẩn danh mục thành công!');
    	return Redirect::to('list-category');
    }

    public function edit_category($category_id){
        $this->AuthLogin();
    	$edit_category = DB::table('category')->where('category_id',$category_id)->get();
    	$manager_category = view('admin.category.edit_category')->with('edit_category',$edit_category);
    	return view('admin_layout')->with('admin.category.edit_category',$manager_category);
    }

    public function update_category(Request $request, $category_id){
        $this->AuthLogin();
    	
    	$data= array();
    	$data['category_name'] = $request->category_name;
    	$data['category_desc'] = $request->category_desc;

    	DB::table('category')->where('category_id',$category_id)->update($data);
    	Session::put('message','Cập nhật danh mục thành công !');
    	return Redirect::to('list-category');
    }

    public function delete_category($category_id){
        $this->AuthLogin();
    	DB::table('category')->where('category_id',$category_id)->delete();
    	Session::put('message','Xóa danh mục thành công !');
    	return Redirect::to('list-category');
    }

//end admin


    public function show_category_home($category_id){
        $category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $category_name=DB::table('category')->where('category.category_id',$category_id)->limit(1)->get();
        $category_by_id = DB::table('product')->join('category','product.category_id','=','category.category_id')->where('product.category_id', $category_id)->orderby('product_id','desc')->get();

        // dd($category_by_id);

        return view('pages.category.show_category_product')->with('category',$category_product)->with('brand',$brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }


}
