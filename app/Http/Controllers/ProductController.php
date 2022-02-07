<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
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

    public function add_product(){
        $this->AuthLogin();
     	$category_product=DB::table('category')->orderby('category_id','desc')->get();
     	$brand_product=DB::table('brand')->orderby('brand_id','desc')->get();

    	return view('admin.product.add_product')->with('category_product',$category_product)->with('brand_product', $brand_product);
    }

    public function list_product(){
        $this->AuthLogin();
    	$list_product = DB::table('product')->join('category','category.category_id','=','product.category_id')->join('brand','brand.brand_id','=','product.brand_id')->orderby('product.product_id','desc')->get();
    	$manager_product = view('admin.product.list_product')->with('list_product',$list_product);
    	return view('admin_layout')->with('admin.product.list_product',$manager_product);
    }

    public function store_product(Request $request){
        $this->AuthLogin();
    	
    	$data= array();
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
    	$data['category_id'] = $request->product_category;
    	$data['brand_id'] = $request->product_brand;
    	$data['product_status'] = $request->product_status;
    	$get_image=$request->file('product_image');
    	if ($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
    		$new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('product')->insert($data);
            Session::put('message','Thêm mới sản phẩm thành công !');
            return Redirect::to('list-product');
    	}
        $data['product_image']='';
    	DB::table('product')->insert($data);
    	Session::put('message','Thêm mới sản phẩm thành công !');
    	return Redirect::to('list-product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
    	DB::table('product')->where('product_id',$product_id)->update(['product_status'=>1]);
    	Session::put('message','Kích hoạt hiển thị sản phẩm');
    	return Redirect::to('list-product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
    	DB::table('product')->where('product_id',$product_id)->update(['product_status'=>0]);
    	Session::put('message','Ẩn sản phẩm thành công!');
    	return Redirect::to('list-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $category_product=DB::table('category')->orderby('category_id','desc')->get();
        $brand_product=DB::table('brand')->orderby('brand_id','desc')->get();

    	$edit_product = DB::table('product')->where('product_id',$product_id)->get();

    	$manager_product = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('brand_product', $brand_product)->with('category_product', $category_product);
    	return view('admin_layout')->with('admin.product.edit_product',$manager_product);
    }

    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
    	
    	$data= array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $get_image=$request->file('product_image');

        if ($get_image) {
            $get_name_image=$get_image->getClientOriginalName();
            $name_image= current(explode('.',$get_name_image));
            $new_image = $name_image.rand(1000,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công !');
            return Redirect::to('list-product');
        }

    	DB::table('product')->where('product_id',$product_id)->update($data);
    	Session::put('message','Cập nhật sản phẩm thành công !');
    	return Redirect::to('list-product');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
    	DB::table('product')->where('product_id',$product_id)->delete();
    	Session::put('message','Xóa sản phẩm thành công !');
    	return Redirect::to('list-product');
    }

//end admin


    public function product_detail($product_id){
        $category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $detail = DB::table('product')
        ->join('category','category.category_id','=','product.category_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->where('product.product_id',$product_id)->get();

        //product same category(recommended)
        foreach ($detail as $key => $value) {
            $category_id= $value->category_id;
        }
        $recommended_product = DB::table('product')
        ->join('category','category.category_id','=','product.category_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->where('category.category_id',$category_id)->orderby('product.product_id','desc')->limit(3)->get();



        return view('pages.product.product_detail')->with('category',$category_product)->with('brand',$brand_product)->with('product_detail' ,$detail)->with('recommended',$recommended_product);
    }

    public function search(Request $request) {
        $category_product=DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $keyword = $request->keyword;

        $search_product=DB::table('product')->where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.product.search_result')->with('category',$category_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}
