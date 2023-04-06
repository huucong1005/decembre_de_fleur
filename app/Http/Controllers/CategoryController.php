<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;

class CategoryController extends Controller
{


    public function add_category(){
        $category_parent = Category::where('category_parent', 0)->get();
    	return view('admin.category.add_category')->with(compact('category_parent'));
    }

    public function list_category(){
        $category_parent = Category::where('category_parent', 0)->get();

        $list_category = Category::orderBy('category_order', 'ASC')->orderBy('category_parent', 'DESC')->get();
        return view('admin.category.list_category')->with(compact('list_category','category_parent'));  
    }

    public function store_category(Request $request){
         
    	
    	$data= array();
    	$data['category_name'] = $request->category_name;
        $data['category_slug'] = $request->category_slug;
    	$data['category_parent'] = $request->category_parent;
        $data['category_desc'] = $request->category_desc;
    	$data['category_status'] = $request->category_status;
        $data['category_order'] = 0;

    	DB::table('category')->insert($data);
    	Toastr::success('Thêm mới danh mục thành công !','Thành công');
    	return Redirect::to('list-category');
    }

    public function active_category($category_id){
         
    	DB::table('category')->where('category_id',$category_id)->update(['category_status'=>1]);
    	Toastr::success('Hiển thị danh mục thành công !','Thành công');
    	return Redirect::to('list-category');
    }

    public function unactive_category($category_id){
         
    	DB::table('category')->where('category_id',$category_id)->update(['category_status'=>0]);
    	Toastr::success('Ẩn danh mục thành công !','Thành công');
    	return Redirect::to('list-category');
    }
    public function arrange_category(Request $request)
    {
        $data=$request->all();
        $category_id=$data["page_id_array"];
        foreach($category_id as$key=>$value){
            $category =Category::find($value);
            $category->category_order=$key;
            $category->save();
        }echo "Updated !";
    }

    public function edit_category($category_id){
         
    	$edit_category = DB::table('category')->where('category_id',$category_id)->get();
        $category_parent = Category::where('category_parent', 0)->get();
    	$manager_category = view('admin.category.edit_category')->with('edit_category',$edit_category)->with('category_parent', $category_parent);
    	return view('admin_layout')->with('admin.category.edit_category',$manager_category);
    }

    public function update_category(Request $request, $category_id){
         
    	
    	$data= array();
    	$data['category_name'] = $request->category_name;
        $data['category_slug'] = $request->category_slug;
        $data['category_parent'] = $request->category_parent;
    	$data['category_desc'] = $request->category_desc;

    	DB::table('category')->where('category_id',$category_id)->update($data);
    	Toastr::success('Cập nhật danh mục thành công !','Thành công');
    	return Redirect::to('list-category');
    }

    public function delete_category($category_id){

        $category_count= Category::where('category_parent',$category_id)->count();
        $product_count= Product::where('category_id',$category_id)->count();


        if ($category_count!=0) {
            Toastr::error('Danh mục gốc này vẫn đang tồn tại các danh mục con !','Thất bại');
            return Redirect::to('list-category'); 
        }elseif($product_count!=0) {
           Toastr::error('Danh mục gốc này vẫn đang tồn tại các sản phẩm !','Thất bại');
            return Redirect::to('list-category'); 
        }else{
            $category=Category::find($category_id);
            $category->delete();
            Toastr::success('Đã xóa danh mục khỏi hệ thống','Thành công');
            return Redirect::to('list-category');
         }	
    }
        
//end admin


    public function show_category_home(Request $request, $category_slug){
        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status',1)->orderBy('cate_post_id', 'DESC')->get();
        $category_parent = Category::where('category_parent', 0)->get();

        $category_by_slug=Category::where('category_slug',$category_slug)->get();
        $min_price= Product::min('product_price');
        $min_price_range= $min_price-(($min_price/100)*10);
        $max_price= Product::max('product_price');
        $max_price_range= $max_price+(($max_price/100)*10);

        foreach ($category_by_slug as $key => $value) {
           $category_id=$value->category_id;
        }
        if (isset($_GET['sort_by'])){

            $sort_by=$_GET['sort_by'];

            if ($sort_by=='giam_dan') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status','1')->orderby('product_price','desc')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='tang_dan') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status','1')->orderby('product_price','asc')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='kytu_az') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status','1')->orderby('product_name','asc')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status','1')->orderby('product_name','desc')->paginate(9)->appends(request()->query());
            }

        }elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $start_price = $_GET['start_price'];
            $end_price = $_GET['end_price'];

            $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status','1')->whereBetween('product_price',[$start_price,$end_price])->orderby('product_price','asc')->paginate(9)->appends(request()->query());

        }else{
            $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status','1')->orderby('product_id','desc')->paginate(9);
        }

        $category_name=DB::table('category')->where('category.category_slug',$category_slug)->limit(1)->get();
        
        // dd($category_by_id);

        return view('pages.category.show_category_product')->with('category',$category_product)->with('brand',$brand_product)->with('category_post',$category_post)->with('category_parent',$category_parent)->with('category_name', $category_name)->with('category_by_id', $category_by_id)->with('min_price',$min_price)->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range);
    }


}
