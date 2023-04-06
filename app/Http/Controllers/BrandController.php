<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
session_start();
use Toastr;

class BrandController extends Controller
{

//begin admin


    public function add_brand(){
    	return view('admin.brand.add_brand');
    }

    public function list_brand(){
        $list_brand = Brand::get();
        return view('admin.brand.list_brand')->with(compact('list_brand'));  

    }

    public function store_brand(Request $request){
    	
    	$data= array();
    	$data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = $request->brand_slug;
    	$data['brand_desc'] = $request->brand_desc;
    	$data['brand_status'] = $request->brand_status;
        $data['brand_order'] = 0;

    	DB::table('brand')->insert($data);
        Toastr::success('Thêm mới thương hiệu thành công !','Thành công');
    	return Redirect::to('list-brand');
    }

    public function active_brand($brand_id){
    	DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
    	Toastr::success('Hiển thị thương hiệu thành công !','Thành công');
    	return Redirect::to('list-brand');
    }

    public function unactive_brand($brand_id){
    	DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
    	Toastr::success('Ẩn thương hiệu thành công !','Thành công');
    	return Redirect::to('list-brand');
    }

    public function edit_brand($brand_id){
    	$edit_brand = DB::table('brand')->where('brand_id',$brand_id)->get();
    	$manager_brand = view('admin.brand.edit_brand')->with('edit_brand',$edit_brand);
    	return view('admin_layout')->with('admin.brand.edit_brand',$manager_brand);
    }

    public function update_brand(Request $request, $brand_id){
    	
    	$data= array();
    	$data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = $request->brand_slug;
    	$data['brand_desc'] = $request->brand_desc;

    	DB::table('brand')->where('brand_id',$brand_id)->update($data);
    	Toastr::success('Cập nhật thương hiệu thành công !','Thành công');
    	return Redirect::to('list-brand');
    }
    public function arrange_brand(Request $request)
    {
        $data=$request->all();
        $brand_id=$data["page_id_array"];
        foreach($brand_id as$key=>$value){
            $brand =Brand::find($value);
            $brand->brand_order=$key;
            $brand->save();
        }echo "Updated !";
    }

    public function delete_brand($brand_id){
        $product_count= Product::where('brand_id',$brand_id)->count();


        if($product_count!=0) {
            Toastr::error('Thất bại! thương hiệu này vẫn đang tồn tại các sản phẩm !' ,'Thất bại');
            return Redirect::to('list-brand'); 
        }else{
            $brand=Brand::find($brand_id);
            $brand->delete();
            // Toastr::success('Đã xóa thương hiệu khỏi hệ thống!','Thành công');
            return Redirect::to('list-brand');
         }  
    }
//end admin




public function show_brand_home($brand_slug){
        $category_product=Category::where('category_status','1')->orderby('category_order','asc')->get();
        $brand_product=Brand::where('brand_status','1')->orderby('brand_order','asc')->get();
        $category_post = CategoryPost::where('cate_post_status','1')->orderBy('cate_post_id', 'DESC')->get();



        $brand_by_slug=Brand::where('brand_slug',$brand_slug)->get();
        $min_price= Product::min('product_price');
        $min_price_range= $min_price-(($min_price/100)*10);
        $max_price= Product::max('product_price');
        $max_price_range= $max_price+(($max_price/100)*10);

        foreach ($brand_by_slug as $key => $value) {
           $brand_id=$value->brand_id;
        }
        if (isset($_GET['sort_by'])){

            $sort_by=$_GET['sort_by'];

            if ($sort_by=='giam_dan') {
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->where('product_status','1')->orderby('product_price','desc')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='tang_dan') {
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->where('product_status','1')->orderby('product_price','asc')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='kytu_az') {
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->where('product_status','1')->orderby('product_name','asc')->paginate(9)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->where('product_status','1')->orderby('product_name','desc')->paginate(9)->appends(request()->query());
            }

        }elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $start_price = $_GET['start_price'];
            $end_price = $_GET['end_price'];

            $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->where('product_status','1')->whereBetween('product_price',[$start_price,$end_price])->orderby('product_price','asc')->paginate(9)->appends(request()->query());

        }else{
            $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->where('product_status','1')->orderby('product_id','desc')->paginate(9);
        }


        $brand_name=DB::table('brand')->where('brand.brand_slug',$brand_slug)->limit(1)->get();
        
        // dd( $brand_by_id);

        return view('pages.brand.show_brand_product')->with('category',$category_product)->with('brand',$brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name)->with('category_post',$category_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range);
    }


}
