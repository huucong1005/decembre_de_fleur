<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Gallery;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;

class ProductController extends Controller
{


    public function add_product(){
         
     	$category_product=Category::orderby('category_order','asc')->get();
        $brand_product=Brand::orderby('brand_order','asc')->get();

    	return view('admin.product.add_product')->with('category_product',$category_product)->with('brand_product', $brand_product);
    }

    public function list_product(){

        $list_product = Product::with('category')->with('brand')->get();
        return view('admin.product.list_product')->with(compact('list_product'));      
         
    	// $list_product = DB::table('product')->join('category','category.category_id','=','product.category_id')->join('brand','brand.brand_id','=','product.brand_id')->orderby('product.product_id','desc')->get();
    	// $manager_product = view('admin.product.list_product')->with('list_product',$list_product);
    	// return view('admin_layout')->with('admin.product.list_product',$manager_product);
    }

    public function list_product_discount(){

        $list_product_discount = Product::get();
        return view('admin.product.list_product_discount')->with(compact('list_product_discount'));      
         
    }

    public function store_product(Request $request){
         
    	
    	$data= array();
    	$data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
    	$data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = 0;
        $data['product_view'] = 0;
        $data['product_discount'] = 0;
        $data['product_cost'] = $request->product_cost;
        $data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
        $data['product_tags'] = $request->product_tags;
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
           Toastr::success('Thêm mới sản phẩm thành công !','Thành công');
            return Redirect::to('list-product');
    	}
        $data['product_image']='';
    	DB::table('product')->insert($data);
    	Toastr::success('Thêm mới sản phẩm thành công !','Thành công');
    	return Redirect::to('list-product');
    }

    public function active_product($product_id){
         
    	DB::table('product')->where('product_id',$product_id)->update(['product_status'=>1]);
    	Toastr::success('Kích hoạt hiển thị thành công !','Thành công');
    	return Redirect::to('list-product');
    }

    public function unactive_product($product_id){
         
    	DB::table('product')->where('product_id',$product_id)->update(['product_status'=>0]);
    	Toastr::success('Ẩn thành công !','Thành công');
    	return Redirect::to('list-product');
    }

    public function edit_product($product_id){
         
        $category_product=Category::orderby('category_order','asc')->get();
        $brand_product=Brand::orderby('brand_order','asc')->get();

    	$edit_product = DB::table('product')->where('product_id',$product_id)->get();

    	$manager_product = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('brand_product', $brand_product)->with('category_product', $category_product);
    	return view('admin_layout')->with('admin.product.edit_product',$manager_product);
    }

    public function edit_discount_all(){
        
        return view('admin.product.edit_discount_all');
    }

    public function edit_product_discount($product_id){
         

        $edit_product_discount = DB::table('product')->where('product_id',$product_id)->get();

        $manager_product = view('admin.product.edit_product_discount')->with('edit_product_discount',$edit_product_discount);
        return view('admin_layout')->with('admin.product.edit_product_discount',$manager_product);
    }

    public function update_product(Request $request, $product_id){
         
    	
    	$data= array();
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_cost'] = $request->product_cost;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_tags'] = $request->product_tags;
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
            Toastr::success('Cập nhật sản phẩm thành công !','Thành công');
            return Redirect::to('list-product');
        }

    	DB::table('product')->where('product_id',$product_id)->update($data);
    	Toastr::success('Cập nhật sản phẩm thành công !','Thành công');
    	return Redirect::to('list-product');
    }

    public function update_discount_all(Request $request){
        
        $data= array();      
        $data['product_discount'] = $request->discount_all;
        $all_product = DB::table('product')->get();
 
        foreach ($all_product as $item) {
            DB::table('product')->where('product_id',$item->product_id)->update($data);
        }

        Toastr::success('Cập nhật giảm giá cho tất cả sản phẩm thành công !','Thành công');
        return Redirect::to('list-product-discount');
    }

    public function update_product_discount(Request $request, $product_id){
         
        
        $data= array();
        
        $data['product_quantity'] = $request->product_quantity;
        $data['product_cost'] = $request->product_cost;
        $data['product_price'] = $request->product_price;
        $data['product_discount'] = $request->product_discount;


        DB::table('product')->where('product_id',$product_id)->update($data);
        Toastr::success('Cập nhật sản phẩm thành công !','Thành công');
        return Redirect::to('list-product-discount');
    }

    public function delete_product($product_id){
         
        $product=Product::find($product_id);
        $product->delete();

        $product_comment=Comment::where('comment_product_id',$product_id);
        $product_comment->delete();

         Toastr::success('Xóa sản phẩm thành công !','Thành công');
        return Redirect::to('list-product');
    }

//end admin


    public function product_detail($product_slug){
       $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $category_parent = Category::where('category_parent', 0)->get();
        
        $detail = DB::table('product')
        ->join('category','category.category_id','=','product.category_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->where('product.product_slug',$product_slug)->get();

        //product same category(recommended)
        foreach ($detail as $key => $value) {
            $category_id= $value->category_id;
            $product_id= $value->product_id;
        }

        //image gallery
        $gallery = Gallery::where('product_id',$product_id)->get();

        $rating=Rating::where('product_id', $product_id)->avg('rating');
        $rating=round($rating);

        $recommended_product = DB::table('product')
        ->join('category','category.category_id','=','product.category_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->where('category.category_id',$category_id)->orderby('product.product_id','desc')->limit(3)->get();
 
        $product_view=Product::where('product_slug',$product_slug)->first();
        $product_view->product_view=$product_view->product_view+1;
        $product_view->save();

        return view('pages.product.product_detail')->with('category',$category_product)->with('brand',$brand_product)->with('product_detail' ,$detail)->with('recommended',$recommended_product)->with('category_post',$category_post)->with('gallery',$gallery)->with('category_parent',$category_parent)->with('rating', $rating);
    }

    public function search(Request $request) {
       $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $keyword = $request->keywords_submit;

        $search_product=Product::where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.product.search_result')->with('category',$category_product)->with('keyword',$keyword)->with('brand',$brand_product)->with('search_product',$search_product)->with('category_post',$category_post);
    }


    public function tag(Request $request , $product_tag){
        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();

        $tag= str_replace("-"," ",$product_tag);
        
        $product_item = Product::where('product_status',1)->where('product_name','LIKE','%'.$tag.'%')->orWhere('product_tags','LIKE','%'.$tag.'%')->orWhere('product_slug','LIKE','%'.$tag.'%')->paginate(9);

        return view('pages.product.tag')->with('category',$category_product)->with('brand',$brand_product)
        ->with('category_post',$category_post)->with('product_tag',$product_tag)->with('product_item',$product_item);
    }

    public function autocomplete_search(Request $request)
    {
        $data =$request->all();
        if ($data['query']) {
            $product = Product::where('product_status',1)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $product_count = $product->count();
            $output= '<ul class="dropdown-menu" style="  display: block;  width:70%;  position: relative;">';
            if($product_count==0){
                $output.='<span style="margin-left:10px;"> Sản phẩm này không tồn tại !</span>';
            }else{
            foreach($product as$key =>$val){
                $output.='<li class="result-item"> <a href="#">'.$val->product_name.'</a></li>';
            }}
            $output.='</ul>';
            echo $output;
            
        }
    }

    public function quickview(Request $request){
        $product_id=$request->product_id;
        $product= Product::find($product_id);
        $gallery= Gallery::where('product_id', $product_id)->get();

        $output['product_gallery']='';
        foreach($gallery as$key=>$item){
            $output['product_gallery'].='<p><img width="100%" src="../public/uploads/gallery/'.$item->gallery_image.'"></p>';
        }
        $output['product_name']=$product->product_name;
        $output['product_id']=$product->product_id;
        $output['product_image']='<p><img width="100%" src="../public/uploads/product/'.$product->product_image.'"></p>';
        $output['product_desc']=$product->product_desc;
        $output['product_price']=number_format($product->product_price,0,',','.');
        $output['product_content']=$product->product_content;
        $output['product_button']='<input type="button" value="Thêm vào giỏ hàng" style=" margin: 15px ;" class="btn btn-primary add-to-cart-quickview" name="add-to-cart" data-id_product="'.$product->product_id.'">';


        $output['product_quickview_value']='

        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_cost.'" class="cart_product_cost_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';


        echo json_encode($output);
    }


}
