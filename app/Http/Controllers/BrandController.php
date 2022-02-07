<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
{

//begin admin
    public function AuthLogin(){
        $admin_id =Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login')->send();
        }
    }

    public function add_brand(){
        $this->AuthLogin();
    	return view('admin.brand.add_brand');
    }

    public function list_brand(){
        $this->AuthLogin();
    	$list_brand = DB::table('brand')->get();
    	$manager_brand = view('admin.brand.list_brand')->with('list_brand',$list_brand);
    	return view('admin_layout')->with('admin.brand.list_brand',$manager_brand);
    }

    public function store_brand(Request $request){
        $this->AuthLogin();
    	
    	$data= array();
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_desc'] = $request->brand_desc;
    	$data['brand_status'] = $request->brand_status;

    	DB::table('brand')->insert($data);
    	Session::put('message','Thêm mới thương hiệu thành công !');
    	return Redirect::to('list-brand');
    }

    public function active_brand($brand_id){
        $this->AuthLogin();
    	DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
    	Session::put('message','Kích hoạt hiển thị thương hiệu');
    	return Redirect::to('list-brand');
    }

    public function unactive_brand($brand_id){
        $this->AuthLogin();
    	DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
    	Session::put('message','Ẩn thương hiệu thành công!');
    	return Redirect::to('list-brand');
    }

    public function edit_brand($brand_id){
        $this->AuthLogin();
    	$edit_brand = DB::table('brand')->where('brand_id',$brand_id)->get();
    	$manager_brand = view('admin.brand.edit_brand')->with('edit_brand',$edit_brand);
    	return view('admin_layout')->with('admin.brand.edit_brand',$manager_brand);
    }

    public function update_brand(Request $request, $brand_id){
        $this->AuthLogin();
    	
    	$data= array();
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_desc'] = $request->brand_desc;

    	DB::table('brand')->where('brand_id',$brand_id)->update($data);
    	Session::put('message','Cập nhật thương hiệu thành công !');
    	return Redirect::to('list-brand');
    }

    public function delete_brand($brand_id){
        $this->AuthLogin();
    	DB::table('brand')->where('brand_id',$brand_id)->delete();
    	Session::put('message','Xóa thương hiệu thành công !');
    	return Redirect::to('list-brand');
    }
//end admin




public function show_brand_home($brand_id){
        $category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $brand_name=DB::table('brand')->where('brand.brand_id',$brand_id)->limit(1)->get();
        $brand_by_id = DB::table('product')->join('brand','product.brand_id','=','brand.brand_id')->where('product.brand_id', $brand_id)->orderby('product_id','desc')->get();
        // dd( $brand_by_id);

        return view('pages.brand.show_brand_product')->with('category',$category_product)->with('brand',$brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }


}
